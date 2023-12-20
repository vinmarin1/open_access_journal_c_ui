<?php

function database_run($query, $vars = array(), $isInsert = false)
{
    $string = "mysql:host=mysql5044.site4now.net;dbname=db_aa3190_qoaj";
    $con = new PDO($string, 'aa3190_qoaj', 'Password1234.');

    if (!$con) {
        return false;
    }

    $stm = $con->prepare($query);
    $check = $stm->execute($vars);

    if ($check) {
        // If it's an INSERT statement and $isInsert is true, return the last inserted ID
        if ($isInsert) {
            return $con->lastInsertId();
        }

        $data = $stm->fetchAll(PDO::FETCH_OBJ);

        if (count($data) > 0) {
            return $data;
        }
    }

    return false;
}
