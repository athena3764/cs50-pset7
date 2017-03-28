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
        if (empty($_POST["quote"]))
        {
            apologize("You must provide a stock symbol.");
        }
        
         $stock = lookup($_POST["quote"]);
         
        if($stock == false){
            
            apologize("please enter a valid symbol.");
            
        }
        else{
            
            render("quote.php",  ["s" => $stock]);

        }
        
    }

?>