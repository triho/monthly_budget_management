<div class="container_12">
    <div class="grid_6 push_3 alpha omega">
        <h1>Change password</h1>
        <?= $this->Form->create("User", array("method"=>"POST", "url"=>"/users/change_password"));?>
            <?= $this->Form->input("User.id", array("type"=>"hidden"));?>
            <?= $this->Form->input("User.old_password", array("label"=>"Old password", "type"=>"password")); ?>
            <?= $this->Form->input("User.password", array("type"=>"password", "label"=>"New password")); ?>
            <?= $this->Form->input("User.confirm_password", array("type"=>"password", "label"=>"Confirm new password")); ?>
        <?= $this->Form->end("Submit"); ?>
    </div>
</div>