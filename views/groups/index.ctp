<div class="container_12">
    <h1 class="grid_10 push_1">My Groups</h1>
    <div class="grid_10 push_1">
        <?= $this->Html->link("Add new group", "/groups/add", array("class"=>"button")); ?>
    </div>
    <div class="grid_10 push_1">
        <table>
            <thead>
                <tr>
                    <th width="30%"><?=$this->Paginator->sort("Type", "type")?></th>
                    <th width="50%"><?=$this->Paginator->sort("Name", "name")?></th>
                    <th width="20%">Control</th>
                </tr>
            </thead>
            <tbody>
                <? if (isset($groups)): ?>
                    <? foreach ($groups as $group): ?>
                        <tr>
                            <td><?= $group["Group"]["type"]==1?"Private":"Public"?></td>
                            <td><?= $group["Group"]["name"] ?></td>
                            <td>
                                <?= $this->Html->link("Edit", "/groups/edit/{$group["Group"]["id"]}"); ?>
                                <?= $this->Html->link("Delete", "/groups/delete/{$group["Group"]["id"]}", null, "Are you sure you want to delete?")?>
                            </td>
                        </tr>
                    <? endforeach; ?>
                <? endif; ?>
            </tbody>
        </table>
    </div>
</div>
