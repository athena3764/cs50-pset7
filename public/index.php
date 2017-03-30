<?php

    //configuration
    require("../includes/config.php"); 
    
    //return a set of records from the database
    $rows = CS50::query("SELECT symbol, shares FROM portfolio WHERE id = ?", $_SESSION["id"]);
    $cash = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]); 
    
    //declare an array
    $positions = [];
    foreach ($rows as $row){
    
    //return a stock by symbol
    $stock = lookup($row["symbol"]);
    if ($stock !== false)
    {   
        //store each record in an array
        $positions[] = [
            "name" => $stock["name"],
            "price" => $stock["price"],
            "shares" => $row["shares"],
            "symbol" => $row["symbol"],
            "total" => $row["shares"]*$stock["price"]
            ];
    }
}

    //use the render function to display the records via portfolio.php
    render("portfolio.php", ["cash" => $cash, "positions" => $positions, "title" => "Portfolio"]);
?>
 
 
