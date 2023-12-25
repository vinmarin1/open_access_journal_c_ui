<?php
session_start();
if(isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true){

} else {
    echo '<script>window.location.href = "../../index.php";</script>';
}
?>

