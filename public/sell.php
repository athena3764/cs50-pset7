<?php
    
    // configuration
    require("../includes/config.php");
    
    if ($_SERVER["REQUEST_METHOD"] == "GET")

    {   
        
        //return the stock symbol
        $rows = CS50::query("SELECT symbol FROM portfolio WHERE id = ?", $_SESSION["id"]);
        
        //stores the symbol in an array
        $positions = [];
        foreach($rows as $row){
            $positions[] = [
                "symbol" => $row["symbol"]
                ];
        }
        
        //use the render function to display the record via sell_form.php
        render("sell_form.php", ["title" => "Sell", "positions" => $positions]);
    }
    
   
    if ($_SERVER["REQUEST_METHOD"] == "POST")
     {

        //check if user have selected a valid symbol
        if(empty($_POST["symbol"])){
        
         apologize("please select a valid symbol.");
        
        }
        
        
        //declare a name for transaction 
        $transaction = 'SELL';
        
        //return a stock by symbol
        $stock = lookup($_POST["symbol"]);
        
        //return stock shares
        $shares = CS50::query("SELECT shares FROM portfolio WHERE id = ? AND symbol = ?", 
        $_SESSION["id"], $_POST["symbol"]);
        
        //insert new records into the database 
        $sell = CS50::query("INSERT INTO history (id, transaction, symbol, shares, date_time) 
VALUES(?, ?, ?, ?, NOW())", $_SESSION["id"], $transaction,
strtoupper($stock["symbol"]), $shares[0]["shares"]);
          
        //delete stock from the database    
        CS50::query("DELETE FROM portfolio WHERE id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);
        
        //update cash
        CS50::query("UPDATE users SET cash = cash + ? WHERE id = ?", 
        ($stock["price"] * $shares[0]["shares"]), $_SESSION["id"]);
        
        //redirect user to another page
        redirect("index.php");
        
        
    }
      
?>
