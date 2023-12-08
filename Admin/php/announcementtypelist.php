<?php
include 'announcementtype_function.php';
$announcementtypelist = get_announcementtype_list();
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <!-- Include header -->
    <?php include 'header.php'; ?>

    <!-- Content wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span> Announcement Type</h4>

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
             <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Announcement Type </button>
            </div>
        </div>
          
            <div class="table-responsive text-nowrap">
                <table class="table table-striped" id="DataTable">
                    <thead>
                        <tr>
                            <th>Announcement Type ID</th>
                            <th>Announcement Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </tbody>
           <?php foreach ($announcementtypelist as $announcementtypelistval): ?>
                            <tr>
                                <td width="50%"><?php echo  $announcementtypelistval->announcement_type_id; ?></td>
                                <td width="50%"><?php echo  $announcementtypelistval->announcement_type; ?></td>
                                <td width="10%">
                                     <!-- btn for edit prod modal -->
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
        function addRecord() {
        var formData = {
            announcement_type: $("#announcement_type").val(),
            action: "add"
        };

        $.ajax({
            url: "announcementtype_function.php",
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
     <!-- add Modal -->
     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Announcement Type</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" enctype="multipart/form-data">
                            <div class="form-group row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="announcement_type_id" class="form-label ps-2">Announcement Type </label>
                                        <input type="text" name="announcement_type_id" class="form-control Information-input" id="announcement_type_id" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addRecord()">Save changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
</body>
</html>
