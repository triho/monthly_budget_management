<?=$javascript->link(array("expenses/edit"))?>
<div class="container_12">
    <h1 class="grid_6 push_3 alpha omega" style="font-size: 20pt; font-weight: bold;">Editing Expense</h1>
    <?=$this->Form->create("Expense", array("url"=>"/expenses/edit", "class"=>"grid_6 push_3 omega alpha"))?>
        <?= $this->Form->hidden("Expense.id");?>
        <?= $this->Form->input("Expense.is_group", array("label"=>"is group expense", "type"=>"checkbox", "id"=>"is-group"));?>
        <div class="input select" id="group-name">
            <label for="user_id">Choose your group</label>
            <?= $this->Form->select("Expense.group_id", $groups, null);?>
        </div>
        <?= $this->Form->input("Expense.name", array("label" => "Location")) ?>
        <?= $this->Form->input("Expense.amount", array("label" => "Amount")) ?>
        <?= $this->Form->input("Expense.expense_date", array("label" => "Date", "type"=>"text", "id"=>"expense-date")) ?>
    <?=$this->Form->end("Update")?>
</div>
