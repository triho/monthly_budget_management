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
        ),
        "Group" => array(
            "className" => "Group",
            "foreignKey" => "group_id",
            "conditions" => array(
                "Expense.group_id <>" => -1
            )
        )
    );
    
    var $validate = array(
        "expense_date" => array(
            "rule_1" => array(
                "rule" => "notEmpty",
                "message" => "Expense date must be declared"
            ),
            "rule_2" => array(
                "rule" => "date",
                "message" => "Expense date must be date"
            )
        ),
        "user_id" => array(
            "rule_1" => array(
                "rule" => "notEmpty",
                "message" => "User id must not be empty"
            ),
            "rule_1" => array(
                "rule" => "numeric",
                "message" => "User id must be a number"
            )
        ),
        "group_id" => array(
            "rule_1" => array(
                "rule" => "default_if_empty",
            )
        ),
        "name" => array(
            "rule_1" => array(
                "rule" => "notEmpty",
                "message" => "Name of item(s) must be mentioned"
            )
        ),
        "amount" => array(
            "rule_1" => array(
                "rule" => "money",
                "message" => "Amount must have format as currency"
            ),
            "rule_2" => array(
                "rule" => "notEmpty",
                "message" => "Amount must not be empty"
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