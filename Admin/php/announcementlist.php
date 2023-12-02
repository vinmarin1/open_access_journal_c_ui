<?php
include 'functions.php';
include 'dbcon.php';
    $announcementlist = get_announcement_list();
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <!-- Include header -->
    <?php include 'header.php'; ?>

    <!-- Content wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span> Announcement</h4>

          <!-- Status tabs -->
          <ul class="nav nav-tabs mb-3" id="statusTabs">
            <li class="nav-item">
                <a class="nav-link" href="announcementlist.php" id="tabIncomplete" data-status="Announcement">Announcement</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="announcementtypelist.php"id="tabProduction" data-status="Announcement Type">Announcement Type</a>
            </li>
        </ul>


        <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
            <h5 class="card-header mb-0">Announcement</h5>
            <div style="display: flex; margin-top: 15px; margin-right: 15px;">

            <?php
if (isset($_POST['add'])) {
    // prepare insert statement
    $announcement_type_id = mysqli_real_escape_string($pdo, $_POST['announcement_type_id']);
    $title = mysqli_real_escape_string($pdo, $_POST['title']);
    $description = mysqli_real_escape_string($pdo, $_POST['description']);
    $announcement = mysqli_real_escape_string($pdo, $_POST['announcement']);
    $expiry_date = mysqli_real_escape_string($pdo,$_POST['expiry_date']);
    //validate prod img
    $file = $_FILES['upload_image'];
    $file_name = $_FILES['upload_image']['name'];
    $file_tmp_name = $_FILES['upload_image']['tmp_name'];
    $file_size = $_FILES['upload_image']['size'];
    $file_error = $_FILES['upload_image']['error'];
    $file_type = $_FILES['upload_image']['type'];

    $file_ext = explode('.', $file_name);
    $file_actual_ext = strtolower(end($file_ext));

    $allowed = array('jpg', 'jpeg', 'png',);

    if($_FILES["upload_image"]["error"] == 4) {
        //means there is no file uploaded
        $image_error = '';
        $file_destination = '';
    }else{
        $sql = "INSERT INTO announcement (announcement_type_id, title, description,announcement,expiry_date) VALUES ('$announcement_type_id', $title, '$description', '$announcement', '$expiry_date');";
        if(mysqli_query($conn, $sql) ){
            $last_announcement_id = mysqli_insert_id($conn);
            echo $last_announcement_id;
            if(in_array($file_actual_ext, $allowed)) {
                if($file_error === 0) {
                    if($file_size < 5000000) {
                        $file_name_new = $last_announcement_id. "." .$file_actual_ext;
                        $file_destination = '../../announcment_images/' .$file_name_new;
                        move_uploaded_file($file_tmp_name, $file_destination);
                        $sql = "UPDATE announcement SET upload_image = '$file_name_new' WHERE announcement_id = $last_announcement_id;";
                        mysqli_query($conn, $sql);
                    }else {
                        $image_error = ' *Your file is too big.';
                    }
                }else {
                    $image_error = ' *There was an error uploading your file.';
                }
            }else{
                $image_error = ' *You cannot upload file of this type.';
            }
        }
    }
}
?>
               <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Announcement </button>
            </div>
        </div>
           <!-- Modal -->
           <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Announcement</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" enctype="multipart/form-data">
                            <div class="form-group row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="announcement_type_id" class="form-label ps-2">Announcement Type ID</label>
                                        <input type="number" name="announcement_type_id" class="form-control Information-input" id="announcement_type_id" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="title" class="form-label ps-2">Title</label>
                                        <input type="text" name="title" class="form-control information-input" id="title" placeholder="">
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="description" class="form-label ps-2">Description</label>
                                        <input type="text" name="description" class="form-control information-input" id="description" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="announcement" class="form-label ps-2">Announcement</label>
                                        <input type="text" name="announcement" class="form-control information-input" id="announcement" placeholder="">
                                    </div>
                                </div>
                                
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="upload_image">Upload Image</label>
                                    <input type="file" name="upload_image" class="form-control" id="upload_image">
                                </div>
                            </div>
                            <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="expiry_date" class="form-label ps-2">Expiry Date</label>
                                        <input type="date" name="expiry_date" class="form-control information-input" id="expiry_date" placeholder="">
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="add" class="btn btn-primary">Save changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>

        <div class="table-responsive text-nowrap">
                <table class="table table-striped" id="DataTable">
                    <thead>
                        <tr>
                            <th>Announcement ID</th>
                            <th>Announcement Type</th>
                            <th>Title</th>
                            <th>description</th>
                            <th>Announcement</th>
                            <th>Upload Image</th>
                            <th>Expiry Date </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                <tbody>
                <?php foreach ($announcementlist as $announcementlistval): ?>
                            <tr>
                                <td width="5%"><?php echo   $announcementlistval->announcement_id; ?></td>
                                <td width="50%"><?php echo  $announcementlistval->announcement_type_id; ?></td>
                                <td width="50%"><?php echo  $announcementlistval->title; ?></td>
                                <td width="50%"><?php echo  $announcementlistval->description; ?></td>
                                <td width="50%"><?php echo  $announcementlistval->announcement; ?></td>
                                <td width="50%"><?php echo  $announcementlistval->upload_image; ?></td>
                                <td width="50%"><?php echo  $announcementlistval->expiry_date; ?></td>
                                <td width="10%">
                                <button type="button" class="btn btn-outline-success">Update</button>
                                    <!-- btn for delete prod modal -->
                                    <button type="button" class="btn btn-outline-danger">Delete</button>
                                  </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
              </table>
            </div>
        </div>    

        <!-- Include footer -->
        <?php include 'footer.php'; ?>
    </div>

    <!-- Include the DataTables CSS and JS files -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <!-- DataTables initialization script with status filter -->
    <script>
        $(document).ready(function() {
            var dataTable = $('#DataTable').DataTable({
                "paging": true,
                "ordering": true,
                "searching": true,
            });
        });
    </script>
</body>
</html>
