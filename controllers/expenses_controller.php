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
        $expenses = $this->paginate("Expense", array("Expense.expense_date <" => date("Y-m-d", time() + 365 * 24 * 60 * 60)));
        $this->set("expenses", $expenses);
    }
    
    /**
     * Add new expenses
     */
    public function add(){
        if (!empty($this->data)){            
            $expenseDate = date("Y-m-d", strtotime($this->data["Expense"]["expense_date"]));
            $this->data["Expense"]["expense_date"] = $expenseDate;
            $this->data["Expense"]["user_id"] = $this->Session->read("Auth.User.id");
            if ($this->Expense->save($this->data)){
                $this->Session->setFlash("New expense has been added");
                $this->go_back("index");
            }
        }
    }
    
    /**
     * Edit expense
     * @param type $id 
     */
    public function edit($id = null){
        $this->Expense->id = $id;
        if (empty($this->data)){
            $this->data = $this->Expense->read();
            $this->data["Expense"]["expense_date"] = date("m/d/Y", strtotime($this->data["Expense"]["expense_date"]));
        }
        else{
            $expenseDate = date("Y-m-d", strtotime($this->data["Expense"]["expense_date"]));
            $this->data["Expense"]["expense_date"] = $expenseDate;
            $this->data["Expense"]["user_id"] = $this->Session->read("Auth.User.id");
            if ($this->Expense->save($this->data)){
                $this->Session->setFlash("Successfully updating expense");
                $this->go_back("index");
            }
        }
    }
    
    /**
     * Delete expenses
     * @param type $id
     * @return type true|false
     */
    public function delete($id){
        if ($id!=null){
            if ($this->Expense->delete($id, false)){
                $this->Session->setFlash("Delete successfully");
                $this->redirect(array("action"=>"index"));
            }
            else{
                $this->Session->setFlash("Could not delete");
                $this->go_back();
            }
        }
    }

}

?>
