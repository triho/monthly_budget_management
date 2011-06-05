<?= $this->Html->css("index"); ?>
<?= $javascript->link("index"); ?>
<div class="container_12">
    <div class="grid_10 push_1">
        <h1>Monthly Budget Management</h1>
    </div>

    <div class="grid_10 push_1">
        <p>Today is <?= date("l, F j, Y") ?></p>
        <p>Total spending of this month is <b><?= $this->Number->currency($totalSpendingOfThisMonth) ?></b></p>
    </div>
    
    <div class="grid_10 push_1">
        <table>
            <thead>
                <tr>
                    <th width="25%">Date</th>
                    <th width="25%">Location</th>
                    <th width="10%">Amount</th>
                    <th width="10%">By</th>
                    <th width="10%">Group</th>
                    <th width="20%">Control</th>
                </tr>
            </thead>
            <tbody>
                <? if (isset($expenses) && !empty($expenses)): ?>
                    <? foreach ($expenses as $expense): ?>
                        <tr>
                            <td>
                                <? $unixTimeStamp = strtotime($expense["Expense"]["expense_date"]); ?>
                                <?= date("l, F j, Y", $unixTimeStamp) ?>
                            </td>
                            <td><?= $expense["Expense"]["name"] ?></td>
                            <td class="money"><?= $this->Number->currency($expense["Expense"]["amount"]) ?></td>
                            <td><?= $expense["User"]["first_name"] . " " . $expense["User"]["last_name"] ?></td>
                            <td><?= $expense["Group"]["name"]?$expense["Group"]["name"]:"Individual" ?></td>
                            <td>
                                <?= $this->Html->link("Edit", "/expenses/edit/{$expense["Expense"]["id"]}"); ?>
                                <?= $this->Html->link("Delete", "/expenses/delete/{$expense["Expense"]["id"]}") ?>
                            </td>
                        </tr>
                    <? endforeach ?>
                <? else: ?>
                        <tr>
                            
                        </tr>
                <? endif ?>
            </tbody>
        </table>
    </div>
</div>



