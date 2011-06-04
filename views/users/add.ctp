<?=$javascript->link(array("users/add"));?>
<div class="container_12">
    <?=$this->Form->create(null, array("url"=>"/users/add", "id"=>"new-user", "class"=>"grid_6 push_3 alpha omega", "type"=>"POST"));?>
        <?=$this->Form->input("User.first_name", array("label"=>"First Name"));?>
        <?=$this->Form->input("User.last_name", array("label"=>"Last Name"));?>
        <?=$this->Form->input("User.username", array("label"=>"Username"));?>
        <?=$this->Form->input("User.password", array("type"=>"password", "label"=>"Password", "id"=>"password"));?>
        <?=$this->Form->input("User.confirm_password", array("label"=>"Confirm Password", "id"=>"confirm-password", "type"=>"password"));?>
    <?=$this->Form->submit("Create", array("div" => "middle"))?>
</div>
