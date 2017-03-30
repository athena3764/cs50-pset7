<?php

//configuration
require("../includes/config.php");

if ($_SERVER["REQUEST_METHOD"] == "GET"){
        
        //render form
        render("buy_form.php", ["title" => "Buy"]);
    }
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
    //check if a stock symbol or share is entered.
    if (empty($_POST["symbol"]) || empty($_POST["shares"]))
    {
        apologize("You must provide a stock symbol or share.");
    }
    //check if the input is a non-negative digit number
    if (!preg_match("/^\d+$/", $_POST["shares"]))
    {
        apologize("Please enter a non-negative integer for shares.");
    }
    
    //Returns a stock by symbol 
    $stock = lookup($_POST["symbol"]);
    
    //check if the user enters a valid symbol 
    if($stock == false){
        apologize("please enter a valid symbol.");
    }
    
    //retrieve user's cash from the database
    $user_cash = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
    
    //check if user has enough cash
    if ($user_cash[0]["cash"] - ($stock["price"] * $_POST["shares"]) <0){
        apologize("Not enough cash.");
    }
    else{
        $transaction = 'BUY';
        
        //insert the new records in the database
        $buy = CS50::query("INSERT INTO history (id, transaction,  symbol, shares, date_time) 
VALUES(?, ?, ?, ?, NOW())", $_SESSION["id"], $transaction,
strtoupper($stock["symbol"]), $_POST["shares"]);
        $add = CS50::query("INSERT INTO portfolio (id, symbol, shares) 
VALUES(?, ?, ?) ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)", $_SESSION["id"], 
strtoupper($stock["symbol"]), $_POST["shares"]);
        
        //update cash
        CS50::query("UPDATE users SET cash = cash - ? WHERE id = ?",
        ($stock["price"] * $_POST["shares"]), $_SESSION["id"]);
        
        //redirect the user to another page 
        redirect("index.php"); 
      }
    } 
?>
 

