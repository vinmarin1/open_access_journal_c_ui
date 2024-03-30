<?php

function database_run($query, $vars = array(), $isInsert = false)
{
    $string = "mysql:host=srv1320.hstgr.io;dbname=u944705315_pahina2024";

    // $con = new PDO($string, 'u944705315_pahina2024', 'Qcujournal1234.');

    // $string = "mysql:host=localhost;dbname=journal";
    // $string = "mysql:host=srv1320.hstgr.io;dbname=journal";
    // $con = new PDO($string, 'root', '');


    // if (!$con) {
    //     return false;
    // }

    try {
        $con = new PDO($string, 'u944705315_pahina2024', 'Qcujournal1234.');
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    } catch (PDOException $e) {
        // If connection fails, redirect to error page
        header("Location: error.php?message=" . urlencode('Database connection failed: ' . $e->getMessage()));
        exit();
    }

    $stm = $con->prepare($query);
    $check = $stm->execute($vars);

    if ($check) {
      
        if ($isInsert) {
            $lastInsertId = $con->lastInsertId();
            $con = null; 
            return $lastInsertId;
        }

        $data = $stm->fetchAll(PDO::FETCH_OBJ);
        $con = null;

        if (count($data) > 0) {
            return $data;
        }
    }
    $con = null;
    return false;
    
}
