<?= $javascript->link(array("jquery.dataTables.min")); ?>
<div class="container_12">
    <div class="grid_10 push_1">
        <table>
            <thead>
                <tr>
                    <th width="25%"><?=$this->Paginator->sort("Date", "expense_date")?></th>
                    <th width="25%"><?=$this->Paginator->sort("Location", "name")?></th>
                    <th width="10%"><?=$this->Paginator->sort("Amount", "amount")?></th>
                    <th width="20%"><?=$this->Paginator->sort("By", "User.first_name")?></th>
                    <th width="20%">Control</th>
                </tr>
            </thead>
            <tbody>
                <? if (isset($expenses)): ?>
                    <? foreach ($expenses as $expense): ?>
                        <tr>
                            <td>
                                <? $unixTimeStamp = strtotime($expense["Expense"]["expense_date"]); ?>
                                <?= date("l, F j, Y", $unixTimeStamp) ?>
                            </td>
                            <td><?= $expense["Expense"]["name"] ?></td>
                            <td><?= $this->Number->currency($expense["Expense"]["amount"]) ?></td>
                            <td><?= $expense["User"]["first_name"] . " " . $expense["User"]["last_name"] ?></td>
                            <td>
                                <?= $this->Html->link("Edit", "/expenses/edit/{$expense["Expense"]["id"]}"); ?>
                                <?= $this->Html->link("Delete", "/expenses/delete/{$expense["Expense"]["id"]}", null, "Are you sure you want to delete?")?>
                            </td>
                        </tr>
                    <? endforeach; ?>
                <? endif; ?>
            </tbody>
        </table>
    </div>
</div>

