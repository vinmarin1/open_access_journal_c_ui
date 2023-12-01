<?php

// Check if the function is not already defined
if (!function_exists('connect_to_database')) {
    function connect_to_database()
    {
        $host = 'mysql5049.site4now.net';
        $dbname = 'db_aa0682_movies';
        $username = 'aa0682_movies';
        $password = 'Password1234.';

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            // You may want to handle the error more gracefully in a production environment
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}

?>
