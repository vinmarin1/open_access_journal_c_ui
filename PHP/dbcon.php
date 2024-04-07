<?php
$string = "mysql:host=srv1320.hstgr.io;dbname=u944705315_pahina2024";
// $string = "mysql:host=localhost;dbname=u944705315_pahina2024";
$username = 'u944705315_pahina2024';
$password = 'Qcujournal1234.';

function database_run($query, $vars = array(), $isInsert = false)
{
    static $con = null; 
    // Establish connection if not already established
    if ($con === null) {
        global $string, $username, $password;
        try {
            $con = new PDO($string, $username, $password);
        } catch (PDOException $e) {
            return false;
        }
    }

    $stm = $con->prepare($query);
    $check = $stm->execute($vars);

    if ($check) {
        if ($isInsert) {
            $lastInsertId = $con->lastInsertId();
            return $lastInsertId;
        }

        $data = $stm->fetchAll(PDO::FETCH_OBJ);

        if (count($data) > 0) {
            return $data;
        }
    }

    return false;
}