<!DOCTYPE html>

<html>
<body>
<p>
 
<b>Company:</b> <?=$s["name"] ?> <br> 
<b>Symbol:</b> <?= $s["symbol"]?> <br> 
<b>Stock price:</b> <?= number_format($s["price"],2)?> 

 
 
</p>
</body>
</html>
