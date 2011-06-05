<?= $this->Html->css(array("expenses/index")); ?>
<?= $javascript->link(array("jquery.dataTables.min")); ?>
<div class="container_12">
    <div class="grid_10 push_1">
        <h1>View all expenses</h1>
        <div class="total-spending">
            <h3>
                <div class="grid_2 alpha">Total Spending: </div>
                <div class="grid_10 omega"><?= $this->Number->currency($totalSpendingOfThisMonth); ?></div>
            </h3>
        </div>
        <div class="filter">
            <h3 class="grid_1 alpha">Filters</h3>
            <div class="grid_11 omega">
                <?= $this->Form->create("Filter", array("url" => "/expenses/")); ?>
                <?= $this->Form->select("name", $groups, null, array("empty" => "all")); ?>
                <?= $this->Form->select("month", $months, null, array("empty" => "all")); ?>
                <?= $this->Form->select("year", $years, null, array("empty" => "all")); ?>
                <?= $this->Form->end(array("label" => "Filter", "div" => false)); ?>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th width="25%"><?= $this->Paginator->sort("Date", "expense_date") ?></th>
                    <th width="25%"><?= $this->Paginator->sort("Location", "name") ?></th>
                    <th width="10%"><?= $this->Paginator->sort("Amount", "amount") ?></th>
                    <th width="10%"><?= $this->Paginator->sort("By", "User.first_name") ?></th>
                    <th width="15%"><?= $this->Paginator->sort("Group", "Group.name") ?></th>
                    <th width="15%">Control</th>
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
                            <td class="money"><?= $this->Number->currency($expense["Expense"]["amount"]) ?></td>
                            <td><?= $expense["User"]["first_name"] . " " . $expense["User"]["last_name"] ?></td>
                            <td><?= $expense["Group"]["name"] ? $expense["Group"]["name"] : "Individual"; ?></td>
                            <td>
                                <?= $this->Html->link("Edit", "/expenses/edit/{$expense["Expense"]["id"]}"); ?>
                                <?= $this->Html->link("Delete", "/expenses/delete/{$expense["Expense"]["id"]}", null, "Are you sure you want to delete?") ?>
                            </td>
                        </tr>
                    <? endforeach; ?>
                <? endif; ?>
            </tbody>
        </table>
    </div>
</div>

