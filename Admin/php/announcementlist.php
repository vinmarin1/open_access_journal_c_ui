    <?php
    include 'function/announcement_function.php';
    $announcementtypelist = get_announcementtype_list();
    $announcementlist = get_announcement_list();
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <body>
        <!-- Include header -->
        <?php include 'template/header.php'; ?>

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
                <button type="button" id="tabAll" class="btn btn-primary" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#addModal">Add Announcement</button>
                <!-- <button type="button" id="tabPublished" class="btn btn-primary">Download</button> -->
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
                                    <button type="button" class="btn btn-outline-success" onclick="updateModal(<?php echo  $announcementlistval->announcement_id; ?>)">Update</button>
                                    <button type="button" class="btn btn-outline-danger" onclick="archiveAnnouncement(<?php echo  $announcementlistval->announcement_id; ?>, '<?php echo $announcementlistval->announcement_type_id; ?>', '<?php echo $announcementlistval->title; ?>','<?php echo  $announcementlistval->announcement_description; ?>','<?php echo  $announcementlistval->announcement; ?>')">Archive</button>
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
                var dataTable = $('#DataTableAnnouncement').DataTable({
                    "paging": true,
                    "ordering": true,
                    "searching": true,
                });
            });
            
            function addRecord() {
        var form = document.getElementById('addModalForm');
        var formData = new FormData();
        formData.append('title', $('#title').val());
        formData.append('description', $('#description').val());
        formData.append('announcement', $('#announcement').val());
        formData.append('upload_image', $('#upload_image')[0].files[0]);
        formData.append('expired_date', $('#expired_date').val());

        formData.append('action', 'add');

        if (form.checkValidity()) {
            $('#sloading').toggle();
            $.ajax({
                url: "../php/function/announcement_function.php",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                console.log('Response from server:', data);
                var response = JSON.parse(data);
                    if (response.status) {
                        $('#sloading').toggle();
                        alert("Record added successfully");
                    } else {
                        alert("All fields required!");
                    }
                    location.reload();
                },
                error: function (xhr, status, error) {
                console.error('AJAX Error:', xhr, status, error);
               }

            });
        } else {
            form.reportValidity();
        }
    }

    function saveChanges() {
        $('#sloading').toggle();
        console.log('Save button clicked');

            var announcement_id = $('#announcement_id').val();
            var updatedData = {
            announcement_type_id: $('#announcement_type_id').val(),
            title: $('#title').val(),
            description: $('#description').val(),
            announcement: $('#announcement').val(),
            expiry_date: $('#expired_date').val(),
        };

        $.ajax({
            type: 'POST',
            url: '../php/function/announcement_function.php',
            data: {
                action: 'update',
                announcement_id :announcement_id ,
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
        
        <!-- addModal -->
         <!-- Add Modal -->
     <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <form id="addModalForm">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Add Announcement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="announcement_type_id" class="form-label ps-2">Announcement Type</label>
                                        <div class="form-check">
                                            <?php foreach ($announcementtypelist as $announcementtypelistval): ?>
                                                <input type="radio" name="announcement_type_id" id="announcement_type_id<?php echo $announcementtypelistval['announcement_type_id']; ?>" value="<?php echo $announcementType['announcement_type_id']; ?>">
                                                <label class="form-check-label" for="announcement_type_id<?php echo $announcementtypelistval['announcement_type_id']; ?>">
                                                    <?php echo $announcementtypelistval['announcement_type']; ?>
                                                </label><br>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
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
                        <div class="col-md-12" mb-2>
                            <label for="xannouncement" class="form-label">Announcement</label>
                            <textarea class="form-control" id="announcement" rows="9"></textarea>
                        </div>
                    </div>  
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2" id="xupload_image">
                            <label for="formFileAddFiles" class="form-label">Upload Image</label>
                            <input class="form-control" type="file" id="upload_image" />

                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xexpired_date" class="form-label">Expiry Date</label>
                            <input type="date" id="expired_date" class="form-control" placeholder="expired_date" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addRecord()">Save changes</button>
                </div>  
            </div>
    </div>
    </body>
    </html>
