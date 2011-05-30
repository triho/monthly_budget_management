<div class="container_12">
    <div id="notification" class="grid_12">
        <?=$this->Session->flash('auth');?>
    </div>
    
    <?php
        echo $this->Form->create('User', array('action' => 'login', "class"=>"grid_6 push_3"));
        echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Form->end('Login', array("id"=>"login"));
    ?>
</div>
