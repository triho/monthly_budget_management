<div class="container_12">
    <div id="notification" class="grid_12">
        <?=$this->Session->flash('auth');?>
    </div>
    
    <?php
        echo $this->Form->create('User', array('action' => 'login', "class"=>"grid_6 push_3"));
        echo $this->Form->input('username');
        echo $this->Form->input('password');?>
    <div class="submit">
        <?= $this->Form->end(array("id"=>"login", "div"=>false, "label"=>"Login"));?>
        <?//= $this->Html->link("Forgot password", "/users/forgot_password"); ?>
        <?= $this->Html->link("Create a new account", "/users/add"); ?>
    </div>
</div>
