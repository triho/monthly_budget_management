<? //=$javascript->link(array("users/add")); ?>
<div class="container_12">
    <div class="grid_6 push_3 alpha omega">
        <h1>My Profile</h1>
        <?= $this->Form->create(null, array("url" => "/users/edit", "id" => "current-user", "type" => "POST")); ?>
            <?= $this->Form->hidden("User.id"); ?>
            <?= $this->Form->input("User.first_name", array("label" => "First Name")); ?>
            <?= $this->Form->input("User.last_name", array("label" => "Last Name")); ?>
            <?= $this->Form->input("User.email", array("label"=>"Email")); ?>
            <?= $this->Form->input("User.username", array("label" => "Username")); ?>
        <div class="submit">
            <?= $this->Form->submit("Update", array("div" => FALSE)) ?>
            <?= $this->Html->link("Change password", "/users/change_password"); ?>
        </div>
    </div>

</div>

