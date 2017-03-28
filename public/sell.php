<?php
    
    // configuration
    require("../includes/config.php");
    
    if ($_SERVER["REQUEST_METHOD"] == "GET")

    {
        $rows = CS50::query("SELECT symbol FROM portfolio WHERE id = ?", $_SESSION["id"]);
        $positions = [];
        foreach($rows as $row){
            $positions[] = [
                "symbol" => $row["symbol"]
                ];
        }
        
        render("sell_form.php", ["title" => "Sell", "positions" => $positions]);
    }
    
    
    if ($_SERVER["REQUEST_METHOD"] == "POST")
     {

   
        if(empty($_POST["symbol"])){
        
         apologize("please select a valid symbol.");
         
         }
         
         $transaction = 'SELL';
  
        $stock = lookup($_POST["symbol"]);
        
         $shares = CS50::query("SELECT shares FROM portfolio WHERE id = ? AND symbol = ?", 
         $_SESSION["id"], $_POST["symbol"]);
         
         $sell = CS50::query("INSERT INTO history (id, transaction, symbol, shares, date_time) 
VALUES(?, ?, ?, ?, NOW())", $_SESSION["id"], $transaction,
strtoupper($stock["symbol"]), $shares[0]["shares"]);
          
            
        CS50::query("DELETE FROM portfolio WHERE id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);

        CS50::query("UPDATE users SET cash = cash + ? WHERE id = ?", 
        ($stock["price"] * $shares[0]["shares"]), $_SESSION["id"]);
        
       
        redirect("index.php");
        
        
    }
      
?>