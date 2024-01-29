<?php

function database_run($query, $vars = array(), $isInsert = false)
{
    $string = "mysql:host=srv1158.hstgr.io;dbname=u944705315_qcuj";
    $con = new PDO($string, 'u944705315_qcuj', 'Qcujournal1234.');

    if (!$con) {
        return false;
    }

    $stm = $con->prepare($query);
    $check = $stm->execute($vars);

    if ($check) {
      
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
