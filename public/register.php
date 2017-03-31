<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
        
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //check if user enters username and password
        if (empty($_POST["username"]) || empty($_POST["password"]))
        {   
            apologize("You must provide your username or password.");
        }
        
        //check if password confirmation is identical to password
        else if ($_POST["password"] != $_POST["confirmation"] )
        {
            apologize("Re-enter your password.");
        }
        
        //update username
        $result = CS50::query("INSERT IGNORE INTO users (username, hash, cash) VALUES(?, ?, 10000.0000)", $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT));
        
        //check if username exists
        if($result== false){
            
            apologize("username already exists.");
            
        }
        else{
            
            $rows = CS50::query("SELECT LAST_INSERT_ID() AS id");
            $id = $rows[0]["id"];
            $_SESSION["id"] = $id;
            redirect("index.php");

        }
    
    }

?>
