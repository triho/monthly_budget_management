<?php

/**
 * Description of users_controller
 *
 * @author triho
 */
class UsersController extends AppController {
    function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow("forgot_password", "add");
    }
    /**
     * Is overriden by Authentication component of cakePHP
     */
    function login() {
        $this->layout = "no_header";
        $this->Auth->loginRedirect = array('controller' => 'pages', 'action' => 'display', "home");
    }

    /**
     * User log out
     */
    function logout() {
        $this->redirect($this->Auth->logout());
    }

    /**
     * Add new user into the system
     */
    function add() {
        $this->layout = "no_header";
        if (!empty($this->data)) {
            if ($this->User->save($this->data)) {
                $this->Session->setFlash("Your account has been created successfully");
                $this->go_back("login");
            }
        }
    }
    
    /**
     * Edit the current user
     */
    function edit(){
        if (!empty($this->data)){
            if ($this->User->save($this->data)){
                $this->Session->setFlash("Your account has been updated successfully");
                $this->go_back();
            }        
        }else{
            $this->User->id = $this->Session->read("Auth.User.id");
            $this->data = $this->User->read();
        }
    }
    
    /**
     * Change password page
     */
    function change_password(){
        if (!empty($this->data)){
            if ($this->User->save($this->data)){
                $this->Session->setFlash("Your new password has been saved");
                $this->go_back("edit");
            }
        }else{
            $this->data["User"]["id"] = $this->Session->read("Auth.User.id");
        }
    }
    /**
     * Forgot password page
     */
    function forgot_password() {
        if (!empty($this->data)) {
            $user = $this->User->find("first", array(
                "fields" => array("User.email"),
                "conditions" => array(
                    "User.email" => $this->data["User"]["email"]
                )
            ));
            if (!empty($user)) {
                $newPassword = $this->User->generate_new_password();
                $this->data["User"]["password"] = $this->User->md5_password($newPassword);
                $this->data["User"]["forgot_password_hash"] = $newPassword;
                if ($this->User->save($this->data)){
                    $this->Email->from = "budgetcustomercare@trihoprojects.com";
                    $this->Email->to = $user["User"]["email"];
                    $this->Email->subject = "Password recovery";
                    $this->Email->replyTo = "budgetcustomercare@trihoprojects.com";
                    $this->Email->template = "forgot_password";
                    $this->Email->sendAs = "html";
                    $this->set("user", $user["User"]);
                    $this->Email->send();
                    $this->Session->setFlash("New password was sent to your email");
                    $this->go_back("login");
                }else{
                    $this->Session->setFlash("There is a problem with the recovery system. Please try again");
                }
            }else{
                $this->Session->setFlash("The inserted email is not valid. Please try again");
            }
        }
        $this->layout = "no_header";
    }
}

?>
