<?php
/**
 * Description of budget
 *
 * @author triho
 */
class Budget extends AppModel {
    var $name = "Budget";
    var $belongsTo = array(
        "User" => array(
            "className" => "User",
            "foreignKey" => "user_id"
        )
    );
    
    var $hasMany = array("Expense");
    
    /**
     * Get the current budget of this month
     * @return type id
     */
    public function get_current_budget_id(){
        $budget = $this->find("first", array(
            "conditions" => array(
                "MONTH(period_date)"=> date("j")
            )
        ));
        
        if (isset ($budget) && count($budget)>0){
            return $budget["Budget"]["id"];
        }
        else return null;
    }
}

?>
