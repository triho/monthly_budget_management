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
//        "Budget" => array(
//            "className" => "Budget",
//            "foreignKey" => "budget_id"
//        )
    );
}
?>