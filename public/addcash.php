<?php
    
    // configuration
    require("../includes/config.php");
    
if ($_SERVER["REQUEST_METHOD"] == "GET"){
    
    //render form
    render("addcash_form.php", ["title" => "Add Cash"]);
}
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //check if the user enters the number.
    if (empty($_POST["money"])){
        apologize("You must enter a number.");
    }
    
    //check if the input is a non-negative digit number
    if (!preg_match("/^\d+$/", $_POST["money"])){
        apologize("Please enter a non-negative integer for cash.");
    }
    
    //update cash
    CS50::query("UPDATE users SET cash = cash + ? WHERE id = ?",
                $_POST["money"], $_SESSION["id"]);
    redirect("index.php");
}

?>
