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
        
        //create a new password
        $new_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        
        //check if the user enters username or password
        if (empty($_POST["username"]) || empty($_POST["password"])){
            apologize("Please enter your username or password.");
        }
        
        //check if the confirmation password is identical to the password
        if ($_POST["password"] !== $_POST["confirmation"]){
             apologize("Please re-enter your password.");   
        }
        
        //update password
        CS50::query("UPDATE users SET hash = ? WHERE username = ?", 
        $new_password, $_POST["username"] );
  
        //redirect the user to another page
        redirect("login.php");
        
    }
?>
