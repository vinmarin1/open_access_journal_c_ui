<?php
include 'announcement_function.php';

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
               <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add Announcement </button>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
                <table class="table table-striped" id="DataTableAnnouncement">
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
                                <td width="50%"><?php echo  $announcementlistval->announcement_description; ?></td>
                                <td width="50%"><?php echo  $announcementlistval->announcement; ?></td>
                                <td width="50%"><?php echo  $announcementlistval->upload_image; ?></td>
                                <td width="50%"><?php echo  $announcementlistval->expired_date; ?></td>
                                <td width="10%">
                                <button type="button" class="btn btn-outline-success">Update</button>
                                    <!-- btn for delete prod modal -->
                                    <button type="button" class="btn btn-outline-danger">Archive</button>
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
        function addRecord() {
        var formData = {
            announcement_type_id: $("#announcement_type_id").val(),
            title: $("#title").val(),
            announcement_description: $("#announcement_description").val(),
            announcement: $("#announcement").val(),
            upload_image: $("#upload_image").val()
            expired_date: $("#expired_date").val(),
            action: "add"
        };

        $.ajax({
            url: "announcement_function.php",
            method: "POST",
            data: formData,
            success: function (data) {
                var response = JSON.parse(data);

                // Show alert
                if (response.status) {
                    alert("Record added successfully");
                } else {
                    alert("Failed to add record");
                }

                // Reload the page
                location.reload();
            },
            error: function (xhr, status, error) {
                console.error("Ajax request failed:", error);
            }
        });
    }

    </script>
     
     <!-- addModal -->
     <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
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
                                        <label for="announcement_description" class="form-label ps-2">Description</label>
                                        <input type="text" name="announcement_description" class="form-control information-input" id="announcement_description" placeholder="">
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
                                        <label for="expired_date" class="form-label ps-2">Expired Date</label>
                                        <input type="date" name="expired_date" class="form-control information-input" id="expired_date" placeholder="">
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" onclick="addRecord()">Save changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
</body>
</html>
