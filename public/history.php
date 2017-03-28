<?php

    // configuration
    require("../includes/config.php"); 
 
   $rows = CS50::query("SELECT transaction, date_time, symbol, shares 
   FROM history WHERE id = ?", $_SESSION["id"]);
   
   $positions = [];
   
   foreach($rows as $row){
       
       $stock = lookup($row["symbol"]);
        if ($stock !== false)
    {
       $positions[]=[
           "transaction" => $row["transaction"],
           "date_time" => $row["date_time"],
           "symbol" => $stock["symbol"],
           "shares" => $row["shares"],
           "price" => $stock["price"]
           ];
    }
   }
    
    render("history_form.php", ["positions" => $positions, "title" => "History"]);

?>