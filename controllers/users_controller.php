<?php

/**
 * Description of users_controller
 *
 * @author triho
 */
class UsersController extends AppController {

    /**
     * Is overriden by Authentication component of cakePHP
     */
    function login() {
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
        if (!empty($this->data)) {
            if ($this->User->save($this->data)) {
                $this->Session->setFlash("Your account has been created successfully");
                $this->redirect(array("url" => "/pages/"));
            }
        }
    }

}

?>
