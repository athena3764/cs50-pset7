<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("reset_form.php", ["title" => "Register"]);
        
    }

    // else if user reached page via POST (as by submitting a form via POST)
     
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $new_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        
        if (empty($_POST["username"]) || empty($_POST["password"])){
            
            apologize("Please enter your username or password.");
        }
        
        if ($_POST["password"] !== $_POST["confirmation"]){
            
             apologize("Please re-enter your password.");
            
        }
        
        $reset = CS50::query("UPDATE users SET hash = ? WHERE username = ?", 
        $new_password, $_POST["username"] );
        
        if($reset == false){
            
            apologize("try again.");
        }
        
        redirect("login.php");
        
    }
?>