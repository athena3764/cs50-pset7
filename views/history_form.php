<table class = "table">
    <tr>
        <th>Transaction</th>
        <th>Symbol</th>
        <th>Shares</th>
        <th>Price</th>
        <th>Date/Time</th>
    </tr>
   <?php foreach ($positions as $position): ?>
    <tr>
        <td><?= $position["transaction"] ?></td>
        <td><?= $position["symbol"] ?></td>
        <td><?= $position["shares"] ?></td>
        <td><?= $position["price"] ?></td>
        <td><?= $position["date_time"] ?></td>
    </tr>
<?php endforeach ?>
</table>
