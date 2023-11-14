<?php

require 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $data = $_POST;

    $errors = signup($data);

    if (empty($errors)) {
        // Login successful
        echo json_encode(array("success" => "Login successful"));
    } else {
        // Login failed, send error messages
        echo json_encode(array("error" => implode( $errors)));
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

    $checkEmail = database_run("select * from author where email = :email limit 1", ['email' => $data['email']]);
    if (is_array($checkEmail)) {
        $errors[] = "The email already exists";
    }


    $checkPnumber = database_run("select * from author where phone_number = :pnumber limit 1", ['pnumber' => $data['pnumber']]);
    if (is_array($checkPnumber)) {
        $errors[] = "The phone number already exist";
    }

    $checkOrcID = database_run("select * from author where orc_id = :orcid limit 1", ['orcid' => $data['orcid']]);
    if (is_array($checkOrcID)) {
        $errors[] = "The Orc ID already exist";
    }

    $checkOrcLink= database_run("select * from author where url_orc_id = :orcidUrl limit 1", ['orcidUrl' => $data['orcidUrl']]);
    if (is_array($checkOrcLink)) {
        $errors[] = "The Orc Link already exist";
    }




    // Save the data to the database if there are no errors
    if (empty($errors)) {
      
        $arr['fname'] = $data['fname'];
        $arr['mdname'] = $data['mdname'];
        $arr['lname'] = $data['lname'];
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

        $query = "INSERT INTO author (first_name, middle_name, last_name,email, password, gender, birth_date, phone_number, school_name, field_of_expertise, bio, orc_id, url_orc_id, date_added, role) VALUES 
        (:fname, :mdname, :lname, :email, :password, :genSelect, :bdate, :pnumber, :sclname, :expertise, :bio, :orcid, :orcidUrl, :date_added, :role)";
   
        database_run($query, $arr);
    }
    return $errors;
}


?>