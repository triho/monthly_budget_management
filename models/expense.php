<?php
/**
 * Description of expense
 *
 * @author triho
 */
class Expense extends AppModel {
    var $name = "Expense";
    
    var $belongsTo = array(
        "User" => array(
            "className" => "User",
            "foreignKey" => "user_id"
        )
    );
    
    var $validate = array(
        "group_id" => array(
            "rule_1" => array(
                "rule" => "default_if_empty",
            )
        )
    );
    
    /**
     * Return the default value of group id if it is empty
     * @return boolean
     */
    function default_if_empty(){
        if ($this->data["Expense"]["group_id"] == ""){
            $this->data["Expense"]["group_id"] = -1;
        }
        return true;
    }
}
?>