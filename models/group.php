<?php

/**
 * Description of group
 *
 * @author triho
 */
class Group extends AppModel {

    var $name = "Group";
    var $useTable = "groups";
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

}

?>
