<?php

/**
 * Description of group
 *
 * @author triho
 */
class Group extends AppModel {

    var $name = "Group";
    var $useTable = "groups";
    var $hasMany = array(
        "Expense" => array(
            "className" => "Expense",
            "foreignKey" => "group_id",
            "conditions" => array(
                "Expense.group_id <>" => -1
            )
        )
    );
    
    var $hasAndBelongsToMany = array(
        'User' => array(
            'className' => 'User',
            'joinTable' => 'users_groups',
            'foreignKey' => 'group_id',
            'associationForeignKey' => 'user_id',
            'unique' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
            'deleteQuery' => '',
            'insertQuery' => ''
        )
    );
    
    var $validates = array(
        "name" => array(
            "rule" => array("alphaNumeric"),
            "required" => true,
            "allowEmpty" => false,
            "message" => "Name must not be empty OR contains only letters or digits"
        ),
        "type" => array(
            "rule" => array("numeric"),
            "required" => true,
            "allowEmpty" => false,
            "message" => "Type must be numeric"
        )
    );

}

?>
