<?php
include 'function/issue_function.php';

    $issueslist = get_issues_list();
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <!-- Include header -->
    <?php include 'template/header.php'; ?>

    <!-- Content wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span> Issues</h4>

        <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
            <h5 class="card-header mb-0">Issues</h5>
            <div style="display: flex; margin-top: 15px; margin-right: 15px;"> 
             <!-- Button trigger modal -->
             <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Issues </button>
            </div>
        </div>
           <!-- Modal -->
           <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Issues</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form method="post" enctype="multipart/form-data" action="issuelist.php">

                            <div class="form-group row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="volume" class="form-label ps-2">Volume</label>
                                        <input type="number" name="volume" class="form-control Information-input" id="volume" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="number" class="form-label ps-2">Number</label>
                                        <input type="number" name="number" class="form-control information-input" id="number" placeholder="">
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="year" class="form-label ps-2">Year</label>
                                        <input type="number" name="year" class="form-control information-input" id="year" placeholder="">
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
                                
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="cover_image">Cover Image Image</label>
                                    <input type="file" name="cover_image" class="form-control" id="cover_image">
                                </div>
                            </div>
                            <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="url_path" class="form-label ps-2">Url Path</label>
                                        <input type="text" name="url_path" class="form-control information-input" id="url_path" placeholder="">
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
                            <th>Issues ID</th>
                            <th>Volume</th>
                            <th>Number</th>
                            <th>Year</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Cover Image</th>
                            <th>Url Path</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                <tbody>
                <?php foreach ($issueslist as $issueslistval): ?>
                            <tr>
                                <td width="5%"><?php echo   $issueslistval->issues_id; ?></td>
                                <td width="50%"><?php echo  $issueslistval->volume; ?></td>
                                <td width="50%"><?php echo  $issueslistval->number; ?></td>
                                <td width="50%"><?php echo  $issueslistval->year; ?></td>
                                <td width="50%"><?php echo  $issueslistval->title; ?></td>
                                <td width="50%"><?php echo  $issueslistval->description; ?></td>
                                <td width="50%"><?php echo  $issueslistval->cover_image; ?></td>
                                <td width="50%"><?php echo  $issueslistval->url_path; ?></td>
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
        <?php include 'template/footer.php'; ?>
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

        function addRecord() {
            var formData = new FormData($('form')[0]);

            $.ajax({
                url: "issue_function.php",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log("Ajax request successful:", data); // Log the response for debugging
                    // Rest of your code...
                },
                error: function (xhr, status, error) {
                    console.error("Ajax request failed:", error);
                }
            });
        }
    });

    </script>
</body>
</html>

