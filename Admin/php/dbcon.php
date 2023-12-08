<?php
if (!function_exists('connect_to_database')) {
    function connect_to_database()
    {
        $string = "mysql:host=mysql5049.site4now.net;dbname=db_aa0682_movies";
        $con = new PDO($string, 'aa0682_movies', 'Password1234.');

        if (!$con) {
            return false;
        }

        return $con;
    }
}

if (!function_exists('execute_query')) {
    function execute_query($query, $vars = array(), $isInsert = false)
    {
        $con = connect_to_database();

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
}
?>