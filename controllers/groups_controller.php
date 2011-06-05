<?php
/**
 * Description of groups_controller
 *
 * @author triho
 */
class GroupsController extends AppController {
    var $use = array("Group");
    
//    var $scaffold;
    
    var $paginate = array(
        "limit" => 25,
        "order" => array(
            "Group.name" => "asc"
        )
    );
    
    /**
     * Define the index page
     */
    function index(){
        $this->paginate["Group"] = array(
            "fields" => array("Group.id", "Group.name", "Group.type"),
            "joins" => array(
                array(
                    "table" => "users_groups",
                    "alias" => "UsersGroup",
                    "type" => "INNER",
                    "conditions" => array(
                        "UsersGroup.group_id = Group.id"
                    )
                )
            ),
            "recursive" => -1,
            "conditions" => array(
                "UsersGroup.user_id" => $this->Session->read("Auth.User.id")
            )
        );
        
        $groups = $this->paginate("Group");
        
        $this->set("groups", $groups);
    }
    
    /**
     * Add new group into the database
     */
    function add(){
        if (!empty($this->data)){
            $this->data["User"]["User"][] = $this->Session->read("Auth.User.id");
            if ($this->Group->save($this->data)){
                $this->Session->setFlash("Successfully create new group {$this->data["Group"]["name"]}");
                $this->go_back("index");
            }
        }else{
            $this->loadModel("User");
            $users = $this->User->find("superlist", array(
                "fields" => array("User.id", "User.first_name", "User.last_name"),
                "separator" => " ",
                "conditions" => array(
                    "User.id <>" => $this->Session->read("Auth.User.id")
                )
            ));
            
            $types = array("1"=>"Private", "2"=>"Public");
            $this->set("types", $types);
            $this->set("users", $users);
        }
    }
    /**
     * Edit the current group info
     */
    function edit($id = null){
        if (!empty($this->data)){
            $this->data["User"]["User"][] = $this->Session->read("Auth.User.id");
            if($this->Group->save($this->data)){
                $this->Session->setFlash("Your group {$this->data["Group"]["name"]} has been stored successfully");
                $this->go_back("index");
            }
        }else{
            $this->Group->id = $id;
            $this->data = $this->Group->read();
            // Get all current group members
            $this->loadModel("User");
            $users = $this->User->find("list", array(
                "fields" => "User.id",
                "conditions" => array(
                    "UsersGroup.group_id" => $this->data["Group"]["id"]
                ),
                "joins" => array(
                    array(
                        "table" =>"users_groups",
                        "alias" => "UsersGroup",
                        "type" => "INNER",
                        "conditions" => array(
                            "UsersGroup.user_id = User.id"
                        )
                    )
                )
            ));
            $this->data["User"]["User"] = $users;
            // Fetch the data entries
            $users = $this->User->find("superlist", array(
                "fields" => array("User.id", "User.first_name", "User.last_name"),
                "separator" => " ",
                "conditions" => array(
                    "User.id <>" => $this->Session->read("Auth.User.id")
                )
            ));
            
            $types = array("1"=>"Private", "2"=>"Public");
            $this->set("types", $types);
            $this->set("users", $users);
        }
    }
}

?>
