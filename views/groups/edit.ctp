<div class="container_12">
    <h1 class="grid_6 push_3" style="font-size: 20pt; font-weight: bold;">Editing Group</h1>
    <?= $this->Form->create("Group", array("class" => "grid_6 push_3 alpha omega", "id" => "new-group", "type" => "post", "url" => "/groups/edit")) ?>
        <?= $this->Form->input("Group.id", array("type"=>"hidden"));?>
        <div class="input">
            <label for="type">Group type</label>
            <?= $this->Form->select("Group.type", $types, 1);?>
        </div>
        <?= $this->Form->input("Group.name", array("label" => "Name")) ?>
        <div class="input add-members">
            <label for="type">Member(s)</label>
            <?= $this->Form->select("User.User", $users, null, array("multiple"=>"multiple"));?>
        </div>
    <?= $this->Form->end("Update") ?>
</div>