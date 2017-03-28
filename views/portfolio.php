<table class="table">
    
        <tr>
            <th>Symbol</th>
            <th>Name</th>
            <th>Shares</th>
            <th>Price</th>
            <th>Total Price</th>
        </tr>
            <?php foreach ($positions as $position): ?>

    <tr>
        <td><?= $position["symbol"] ?></td>
         <td><?= $position["name"] ?></td>
        <td><?= $position["shares"] ?></td>
        <td>$<?= $position["price"] ?></td>
        <td>$<?= $position["total"] ?></td>
    </tr>

<?php endforeach ?>
      
 
</table>

 <div><b>Cash in your account:</b> $<?= $cash[0]["cash"] ?></div>
 <a href="addcash.php">Add more cash to the account</a><br>
 <a href="change.php">Change your password</a>