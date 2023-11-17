<?php 

require 'dbcon.php';
session_start();



if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $data = $_POST;

    $errors = login($data);

    if (empty($errors)) {
        // Login successful
        echo json_encode(array("success" => "Login successful"));
    } else {
        // Login failed, send error messages
        echo json_encode(array("error" => implode("<br>", $errors)));
    }
}

function login($data)
{
    $errors = array();

    // Validate email
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email";
    }

    // Validate password length
    if (strlen(trim($data['password'])) < 4) {
        $errors[] = "Password must be at least 4 characters long";
    }

    // Check login
    if (empty($errors)) {
        $arr['email'] = $data['email'];
        $password = hash('sha256', $data['password']);

        $query = "SELECT * FROM author WHERE email = :email limit 1";

        $row = database_run($query, $arr);

        if (is_array($row)) {
            $row = $row[0];

            if ($password === $row->password) {
                $_SESSION['USER'] = $row;
                $_SESSION['id'] = $row->author_id;
                $_SESSION['LOGGED_IN'] = true;
            } else {
                $errors[] = "Wrong email or password";
            }
        } else {
            $errors[] = "Wrong email or password";
        }
    }

    return $errors;
}



function check_login($redirect = true){

	if(isset($_SESSION['USER']) && isset($_SESSION['LOGGED_IN'])){

		return true;
	}

	if($redirect){
		header("Location: login.php");
		die;
	}else{
		return false;
	}
	
}

function check_verified() {
    $author_id = $_SESSION['USER']->author_id;
    $query = "SELECT * FROM author WHERE author_id  = '$author_id' limit 1";
    $row = database_run($query);

    if (is_array($row)) {
        $row = $row[0];

        if ($row->email == $row->email_verified) {
            header("Location: timeline.php");
            die;
        }
    }

    return false;
}


