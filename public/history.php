<?php

    // configuration
    require("../includes/config.php");
    
    //returns a result set of records from the database
    $rows = CS50::query("SELECT transaction, date_time, symbol, shares 
    FROM history WHERE id = ?", $_SESSION["id"]);
   
    $positions = [];

    foreach($rows as $row){
        
        //retrieve stock 
        $stock = lookup($row["symbol"]);
        
        /stores each record in an array
        if ($stock !== false){
            $positions[]=[
                "transaction" => $row["transaction"],
                "date_time" => $row["date_time"],
                "symbol" => $stock["symbol"],
                "shares" => $row["shares"],
                "price" => $stock["price"]
            ];
        }
    }
// use the render function to display the record via history_form.php 
render("history_form.php", ["positions" => $positions, "title" => "History"]);

?>
