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
    function login(){
        $this->Auth->loginRedirect = array('controller' => 'pages', 'action' => 'display', "home");
    }
    /**
     * User log out
     */
    function logout(){
        $this->redirect($this->Auth->logout());
    }
}

?>
