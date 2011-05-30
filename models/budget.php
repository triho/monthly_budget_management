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
}

?>
