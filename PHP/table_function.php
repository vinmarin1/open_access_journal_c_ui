<?php

require 'dbcon.php';
require "mail.php";
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  
	
 
    $title = $_POST['title'];  
    $email = $_POST['email'];



    $message = "You've been selected as reviewer for the Journal Title <h4>$title</h4>";
    $subject = "Review Journal";
    $recipient = $email;
    send_mail($recipient,$subject,$message);

    echo 'email was sent successfully';
}else{
    echo 'email sent fail';
}
?>