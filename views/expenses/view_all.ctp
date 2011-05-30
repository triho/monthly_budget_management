<?= $javascript->link(array("jquery.dataTables.min")); ?>
<div class="container_12">
    <div class="grid_10 push_1">
        <table>
            <thead>
                <tr>
                    <th width="25%">Date</th>
                    <th width="25%">Location</th>
                    <th width="10%">Amount</th>
                    <th width="20%">By</th>
                    <th width="20%">Control</th>
                </tr>
            </thead>
            <tbody>
                <? if (isset($expenses)): ?>
                    <? foreach ($expenses as $expense): ?>
                        <tr>
                            <td>
                                <? $unixTimeStamp = strtotime($expense["Expense"]["expense_date"]); ?>
                                <?= date("l, F j, Y", $unixTimeStamp) ?> at 
                                <b><?= date("H:i", $unixTimeStamp) ?></b>
                            </td>
                            <td><?= $expense["Expense"]["name"] ?></td>
                            <td><?= $this->Number->currency($expense["Expense"]["amount"]) ?></td>
                            <td><?= $expense["User"]["first_name"] . " " . $expense["User"]["last_name"] ?></td>
                            <td><?= $this->Html->link("Edit", "/expenses/edit/{$expense["Expense"]["id"]}"); ?></td>
                        </tr>
                    <? endforeach; ?>
                <? endif; ?>
            </tbody>
        </table>
    </div>
</div>
