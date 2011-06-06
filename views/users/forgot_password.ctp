<div class="container_12">
    <div class="grid_6 push_3 alpha omega">
        <h1>Forgot password</h1>
        <?= $this->Form->create("User", array("method"=>"POST", "url"=>"/users/forgot_password")); ?>
            <?= $this->Form->input("User.email", array("label"=>"Your new password will be sent to this email")); ?>
        <div class="submit">
            <?= $this->Form->end(array("label"=>"Send me new password", "div"=>false)); ?>
            <?= $this->Html->link("Back to log in", "/users/login"); ?>
        </div>
    </div>
</div>

