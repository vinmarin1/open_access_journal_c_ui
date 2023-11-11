<?php


function database_run($query,$vars = array())
{
	$string = "mysql:host=localhost;dbname=qcu_times";
	$con = new PDO($string,'root','');

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

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $data = $_POST;

    $errors = signup($data);

    if (empty($errors)) {
        // Login successful
        echo json_encode(array("success" => "Login successful"));
    } else {
        // Login failed, send error messages
        echo json_encode(array("error" => implode("<br>", $errors)));
    }
}


function signup($data)
{
    $errors = array();

    // Validate the input fields in registration
    // if (!preg_match('/^[a-zA-Z]+$/', $data['username'])) {
    //     $errors[] = "Please enter a Username";
    // }

    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email";
    }

    if (strlen(trim($data['password'])) < 4) {
        $errors[] = "Password must be at least 4 characters long";
    }

    $check = database_run("select * from author where email = :email limit 1", ['email' => $data['email']]);
    if (is_array($check)) {
        $errors[] = "The email already exists";
    }

    // Save the data to the database if there are no errors
    if (empty($errors)) {
      
        $arr['fname'] = $data['fname'];
        $arr['mdname'] = $data['mdname'];
        $arr['lname'] = $data['lname'];
        $arr['public_name'] = "example";
        $arr['email'] = $data['email'];
        $arr['password'] = hash('sha256', $data['password']);
        $arr['genSelect'] = $data['genSelect'];
        $arr['bdate'] = $data['bdate'];
        $arr['pnumber'] = $data['pnumber'];
        $arr['sclname'] = $data['sclname'];
        $arr['expertise'] = $data['expertise'];
        $arr['bio'] = $data['bio'];
        $arr['orcid'] = $data['orcid'];
        $arr['orcidUrl'] = $data['orcidUrl'];
        $arr['date_added'] = date("Y-m-d H:i:s");
        $arr['role'] = "Author";

        $query = "INSERT INTO author (first_name, middle_name, last_name, public_name,email, password, gender, birth_date, phone_number, school_name, field_of_expertise, bio, orc_id, url_orc_id, date_added, role) VALUES 
        (:fname, :mdname, :lname, :public_name,:email, :password, :genSelect, :bdate, :pnumber, :sclname, :expertise, :bio, :orcid, :orcidUrl, :date_added, :role)";
   
        database_run($query, $arr);
    }
    return $errors;
}


?>