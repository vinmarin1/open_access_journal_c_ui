<?php
session_start();

// Destroy the session
session_destroy();

// Redirect to the login page
echo '<script>window.location.href = "../PHP/login.php";</script>';
