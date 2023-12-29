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
                <button type="button" id="tabAll" class="btn btn-primary" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#addModal">Add Issue</button>
                <!-- <button type="button" id="tabPublished" class="btn btn-primary">Download</button> -->
            </div>
        </div>
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
         $(document).ready(function()   {
        var dataTable = $('#DataTable').DataTable({
            "paging": true,
            "ordering": true,
            "searching": true,
        });
    });

        function addRecord() {
        var form = document.getElementById('addModalForm');
        var formData = new FormData();
        formData.append('volume', $('#volume').val());
        formData.append('number', $('#number').val());
        formData.append('year', $('#year').val());
        formData.append('title', $('#title').val());
        formData.append('description', $('#description').val());
        formData.append('cover_image', $('#cover_image')[0].files[0]);
        formData.append('url_path', $('#url_path').val());
        formData.append('action', 'add');

        if (form.checkValidity()) {
            $('#sloading').toggle();
            $.ajax({
                url: "../php/function/issue_function.php",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    var response = JSON.parse(data);
                    if (response.status) {
                        $('#sloading').toggle();
                        alert("Record added successfully");
                    } else {
                        alert("Record added successfully");
                    }
                    location.reload();
                },
                error: function (xhr, status, error) {
                    console.error("Ajax request failed:", error);
                }
            });
        } else {
            form.reportValidity();
        }
    }

    function saveChanges() {
        $('#sloading').toggle();
        console.log('Save button clicked');
        
            var issues_id = $('#issues_id').val();
            var updatedData = {
            volume: $('#volume').val(),
            number: $('#number').val(),
            year: $('#year').val(),
            title: $('#title').val(),
            description: $('#description').val(),
        };

        $.ajax({
            type: 'POST',
            url: '../php/function/issue_function.php',
            data: {
                action: 'update',
                issues_id :issues_id ,
                updated_data: updatedData
            },
            dataType: 'json',
            success: function (response) {
                console.log('Update Response:', response);

                if (response.status === true) {
                    $('#sloading').toggle();
                    alert("Record updated successfully");
                    $('#updateModal').modal('hide');
                    location.reload();
                } else {
                    console.error('Error updating journal data:', response.message);
                    alert("Failed to update record. Please try again.");
                }
            },
        });
    }

    </script>

     <!-- Add Modal -->
     <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <form id="addModalForm">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Add Issue</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xvolume" class="form-label">Volume</label>
                            <input type="number" id="volume" class="form-control" placeholder="volume" required/>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xnumber" class="form-label">Number</label>
                            <input type="number" id="number" class="form-control" placeholder="number" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xyear" class="form-label">Year</label>
                            <input type="number" id="year" class="form-control" placeholder="year" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12" mb-2>
                            <label for="xtitle" class="form-label">Title</label>
                            <textarea class="form-control" id="title" rows="9"></textarea>
                        </div>
                    </div>   
                    <div class="row mb-2">
                        <div class="col-md-12" mb-2>
                            <label for="xdescription" class="form-label">Description</label>
                            <textarea class="form-control" id="description" rows="9"></textarea>
                        </div>
                    </div>   
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2" id="xcover_image">
                            <label for="formFileAddFiles" class="form-label">Cover Image</label>
                            <input class="form-control" type="file" id="cover_image" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xurl_path" class="form-label">Url Path</label>
                            <input type="text" id="url_path" class="form-control" placeholder="url_path" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addRecord()">Save changes</button>
                </div>  
            </div>
        </div>
        </form>
    </div>
</body>
</html>

