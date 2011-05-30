<?php
/**
 * Description of expenses_controller
 *
 * @author triho
 */
class ExpensesController extends AppController {
    var $use = array("Expense");
    
    var $helpers = array("Number");
    
    /**
     * View all expenses
     */
    public function view_all(){
        $expenses = $this->Expense->find("all", array(
            "conditions" => array(
                "Expense.expense_date <" => date("Y-m-d", time()+365*24*60*60)
            ),
            "order" => array("Expense.expense_date DESC")
        ));
        
        $this->set("expenses", $expenses);
    }
}

?>
