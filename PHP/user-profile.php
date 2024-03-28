<?php
require_once 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    

    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "../Files/uploaded-profile/";
        $targetFile = $targetDir . basename($_FILES["file"]["name"]);
        
   
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
          
            $sqlUpdateProfile = "UPDATE author SET profile_pic = :profile_pic WHERE author_id = :author_id";
            $params = array(':profile_pic' => $targetFile, ':author_id' => $id);
            
            if (database_run($sqlUpdateProfile, $params)) {
           
                echo 'success';
            } else {
               
                echo 'database_error';
            }
        } else {
           
            echo 'file_error';
        }
    } else {
      
        echo 'no_file';
    }
} else {
  
    echo 'invalid_request';
}
?>
