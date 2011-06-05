<?php

/**
 * Description of user
 *
 * @author triho
 */
class User extends AppModel {

    var $name = "User";
    var $hasMany = array("Expense", "Budget");
    var $hasAndBelongsToMany = array(
        'Group' => array(
            'className' => 'Group',
            'joinTable' => 'users_groups',
            'foreignKey' => 'user_id',
            'associationForeignKey' => 'group_id',
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
    
    var $validate = array(
        "first_name" => array(
            "rule_1" => array(
                "rule" => "alphaNumeric",
                "message" => "First name must be alpha numeric"
            ),
            "rule_2" => array(
                "rule" => "notEmpty",
                "message" => "First name must not be empty"
            )
        ),
        "last_name" => array(
            "rule_1" => array(
                "rule" => "notEmpty",
                "message" => "Last name must not be empty"
            ),
            "rule_2" => array(
                "rule" => "alphaNumeric",
                "message" => "Last name must contain only letter or digits"
            )
        ),
        "username" => array(
            "rule_1" => array(
                "rule" => "alphaNumeric",
                "message" => "Username has to be either number or digit"
            ),
            "rule_2" => array(
                "rule" => "notEmpty",
                "message" => "Username must not be empty"
            ),
            "rule_3" => array(
                "rule" => "isUnique",
                "message" => "This username was taken"
            )
        ),
        "password" => array(
            "rule_1" => array(
                "rule" => "notEmpty",
                "message" => "Password must not be empty"
            ),
            "rule_2" => array(
                "rule" => array("minLength", 6),
                "message" => "Your password has to be longer than 6"
            ),
            "rule_3" => array(
                "rule" => array("check_password_confirmation"),
                "message" => "Your confirmation password does not match your inserted password"
            )
            
        ),
        "confirm_password" => array(
            "rule_1" => array(
                "rule" => "notEmpty",
                "message" => "Confirm password must not be empty"
            )
            
        )
    );

    /**
     * Add the salt into the hash functions
     * @param type $data
     * @return type $data
     */
    public function hashPasswords($data) {
        if (isset($data["User"]["password"])) {
            $data["User"]["password"] = $this->md5_password($data["User"]["password"]);
            return $data;
        }
        return $data;
    }

    /**
     * 
     * @param string $password
     * @param string $passwordConfirm
     * @return boolean answer
     */
    function check_password_confirmation() {
        if (!(isset($this->data["User"]["confirm_password"]))) return false;
        if ($this->data["User"]["password"] != $this->md5_password($this->data["User"]["confirm_password"]))
            return false;
        else
            return true;
    }
    
    /**
     * Hash the password with MD5
     * @param string $password
     * @return string 
     */
    private function md5_password($password){
        return md5($password."elephantisabiganimal");
    }

}

?>
