<?php

require 'dbcon.php';
require "mail.php";
session_start();

if($_SERVER['REQUEST_METHOD'] == POST){
  
	
 
    $title = $_POST['title'];  
    $vars['email'] = $_SESSION['USER']->email;


    $message = "You've been selected as review for the Journal Title " .$title ;
    $subject = "Review Journal";
    $recipient = $vars['email'];
    send_mail($recipient,$subject,$message);

    echo 'email was sent successfully';
}else{
    echo 'email sent fail';
}
?>