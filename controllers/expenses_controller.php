<?php

/**
 * Description of expenses_controller
 *
 * @author triho
 */
class ExpensesController extends AppController {

    var $use = array("Expense");
    var $helpers = array("Number");
    var $paginate = array(
        "limit" => 25,
        "order" => array(
            "Expense.expense_date" => "DESC"
        )
    );

    /**
     * View all expenses
     */
    public function index() {        
        $this->loadModel("Group");
        $groups = $this->Group->find("list", array(
                    "fields" => array("Group.id", "Group.name"),
                    "joins" => array(
                        array(
                            "table" => "users_groups",
                            "alias" => "UsersGroup",
                            "type" => "INNER",
                            "conditions" => array(
                                "UsersGroup.group_id = Group.id"
                            )
                        )
                    ),
                    "conditions" => array(
                        "UsersGroup.user_id" => $this->Session->read("Auth.User.id")
                    )
                ));
        $groupSet = array_keys($groups);
        $this->set("groups", $groups);

        $months = array(1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June", 7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December");
        $this->set("months", $months);
        
        for ($i = 2010; $i < 2020; $i++) {
            $years[$i] = $i;
        }
        $this->set("years", $years);

        $isFilterByDate = false;

        if (!empty($this->data)) {
            if ($this->data["Filter"]["name"] != "") {
                $conditions["Expense.group_id"] = $this->data["Filter"]["name"];
            }

            if ($this->data["Filter"]["month"] != "") {
                $conditions["MONTH(Expense.expense_date)"] = $this->data["Filter"]["month"];
                $isFilterByDate = true;
            }

            if ($this->data["Filter"]["year"] != "") {
                $conditions["YEAR(Expense.expense_date)"] = $this->data["Filter"]["year"];
                $isFilterByDate = true;
            }
        }


        if (!$isFilterByDate) {
            $conditions["MONTH(Expense.expense_date)"] = date("m");
            $conditions["YEAR(Expense.expense_date)"] = date("Y");
            $this->data["Filter"]["month"] = date("n");
            $this->data["Filter"]["year"] = date("Y");
        }
        
        if (!empty($groups)){
            $conditions["OR"] = array(
                array(
                    "Expense.group_id" => $groupSet,
                    "Expense.user_id <>" => $this->Session->read("Auth.User.id")
                ),
                "Expense.user_id" => $this->Session->read("Auth.User.id")
            );
        }

        $expenses = $this->paginate("Expense", $conditions);
        // Calculate expenses
        $sum = 0;
        if (!empty($expenses)) {
            foreach ($expenses as $expense) {
                $sum += $expense["Expense"]["amount"];
            }
        }
        $this->set("totalSpendingOfThisMonth", $sum);
        $this->set("expenses", $expenses);
    }

    /**
     * Add new expenses
     */
    public function add() {
        if (!empty($this->data)) {
            $expenseDate = date("Y-m-d", strtotime($this->data["Expense"]["expense_date"]));
            $this->data["Expense"]["expense_date"] = $expenseDate;

            if ($this->data["Expense"]["is_group"] != 1) {
                $this->data["Expense"]["group_id"] = -1;
            }
            $this->data["Expense"]["user_id"] = $this->Session->read("Auth.User.id");
            unset($this->data["Expense"]["is_group"]);

            if ($this->Expense->save($this->data)) {
                $this->Session->setFlash("New expense has been added");
                $this->go_back();
            }
        } else {
            $groupNames = $this->get_group_names();
            $this->set("groups", $groupNames);
        }
    }

    /**
     * Edit expense
     * @param type $id 
     */
    public function edit($id = null) {
        if (empty($this->data)) {
            $this->Expense->id = $id;
            $this->data = $this->Expense->read();
            $this->data["Expense"]["expense_date"] = date("m/d/Y", strtotime($this->data["Expense"]["expense_date"]));
            // Get all groups
            $groupNames = $this->get_group_names();
            $this->set("groups", $groupNames);

            if ($this->data["Expense"]["group_id"] != -1) {
                $this->data["Expense"]["is_group"] = 1;
            }
        } else {
            $expenseDate = date("Y-m-d", strtotime($this->data["Expense"]["expense_date"]));
            $this->data["Expense"]["expense_date"] = $expenseDate;
            $this->data["Expense"]["user_id"] = $this->Session->read("Auth.User.id");
            if ($this->Expense->save($this->data)) {
                $this->Session->setFlash("Successfully updating expense");
                $this->go_back();
            }
        }
    }

    /**
     * Delete expenses
     * @param type $id
     * @return type true|false
     */
    public function delete($id) {
        if ($id != null) {
            if ($this->Expense->delete($id, false)) {
                $this->Session->setFlash("Delete successfully");
            } else {
                $this->Session->setFlash("Could not delete");
            }
            $this->go_back();
        }
    }

    /**
     * Get all group names from the group list that belongs to the user
     * @return array
     */
    private function get_group_names() {
        $this->loadModel("User");
        $records = $this->User->find("all", array(
                    "conditions" => array(
                        "User.id" => $this->Session->read("Auth.User.id")
                    )
                ));
        if (!empty($records)) {
            $groups = $records[0]["Group"];
            if (empty($groups))
                return array();
            foreach ($groups as $group) {
                $list[$group["id"]] = $group["name"];
            }
            return $list;
        }
        else
            return array();
    }

}

?>
