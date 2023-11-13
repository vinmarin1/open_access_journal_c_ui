<?php

function database_run($query,$vars = array())
{
	$string = "mysql:host=mysql5049.site4now.net;dbname=db_aa0682_movies";
	$con = new PDO($string,'aa0682_movies','Password1234.');

	if(!$con){
		return false;
	}

	$stm = $con->prepare($query);
	$check = $stm->execute($vars);

	if($check){
		
		$data = $stm->fetchAll(PDO::FETCH_OBJ);
		
		if(count($data) > 0){
			return $data;
		}
	}

	return false;
}

?>