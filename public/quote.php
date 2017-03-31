<?php

    // configuration
    require("../includes/config.php");
    
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("quote_form.php", ["title" => "Quote"]);
    }
 
    // else if user reached page via POST (as by submitting a form via POST)
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {   
        //check if user enters a stock symbol
        if (empty($_POST["quote"]))
        {
            apologize("You must provide a stock symbol.");
        }
         
        //return a stock by symbol
        $stock = lookup($_POST["quote"]);
        
        //check if stock symbol is valid
        if($stock == false){
            apologize("please enter a valid symbol.");
        }
        else{
            
            //use the render function to display records via quote.php
            render("quote.php",  ["s" => $stock]);

        }
        
    }

?>
