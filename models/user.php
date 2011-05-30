<?php
/**
 * Description of user
 *
 * @author triho
 */
class User extends AppModel {
    var $name = "User";
    
    var $hasMany = array("Expense", "Budget");
    
    /**
     * Add the salt into the hash functions
     * @param type $data
     * @return type $data
     */
    public function hashPasswords($data){
        if (isset($data["User"]["password"])){
            $data["User"]["password"] = md5($data["User"]["password"]."elephantisabiganimal");
            return $data;
        }
        return $data;
    }
}

?>
