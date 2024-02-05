<?php
include 'function/redirect.php';
include 'function/announcement_function.php';
$announcementlist = get_announcement_list();
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <!-- Include header -->
    <?php include 'template/header.php'; ?>

    <!-- Content wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span>Announcement</h4>

        <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
            <h5 class="card-header mb-0">Announcement</h5>
            <div style="display: flex; margin-top: 15px; margin-right: 15px;">
                <button type="button" id="tabAll" class="btn btn-primary" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#addModal">Add Announcement</button>
                <!-- <button type="button" id="tabPublished" class="btn btn-primary">Download</button> -->
            </div>
        </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped" id="DataTable">
                    <thead>
                        <tr>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Title</th>
                                <th>Announcement</th>
                                <th>Upload Image</th>
                                <th>Action</th>
                        </tr>
                    </thead>
                <tbody>
                <?php foreach ($announcementlist as $announcementlistval): ?>
                                <tr>
                                    <td width="5%"><?php  echo  $announcementlistval->announcement_id; ?></td>
                                    <td width="15%"><?php echo  $announcementlistval->annoucementtype; ?></td>
                                    <td width="50%"><?php echo  $announcementlistval->title; ?></td>
                                    <td width="10%"><?php echo  $announcementlistval->announcement; ?></td>
                                    <td width="10%"><?php echo  $announcementlistval->upload_image; ?></td>
                                    <td width="10%">
                                <button type="button" class="btn btn-outline-success" onclick="updateModal(<?php echo  $announcementlistval->announcement_id; ?>)">Update</button>
                                <button type="button" class="btn btn-outline-danger" onclick="archiveAnnouncement(<?php echo  $announcementlistval->announcement_id; ?>, '<?php echo $announcementlistval->title; ?>', '<?php echo $announcementlistval->announcement_description; ?>')">Archive</button>
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
        formData.append('annoucementtype', $('#annoucementtype').val());
        formData.append('title', $('#title').val());
        formData.append('announcement_description', $('#announcement_description').val());
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
                    var response = JSON.parse(data);
                    $('#sloading').toggle();
                    if (response.status) {
                        alert("Record added successfully");
                        location.reload();
                    } else {
                        alert('Failed to add record');
                        location.reload();
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Ajax request failed:", error);
                    $('#sloading').toggle();
                    alert("Failed to add record. Please try again.");
                }
            });
        } else {
            form.reportValidity();
        }
    }

    function updateModal(announcement_id) {
        $.ajax({
            type: 'POST',
            url: '../php/function/announcement_function.php',
            data: { action: 'fetch', announcement_id: announcement_id },
            dataType: 'json',
            success: function (response) {
                console.log('Response from server:', response);

                if (response.status === true && response.data.length > 0) {
                    const announcementData = response.data[0];
                    console.log('Announcement Data:', announcementData);

                    $('#xannouncemet_id').val(announcementData.announcement_id);
                    $('#xtitle').val(announcementData.title);
                    $('#xannouncement_description').val(announcementData.announcement_description);
                    $('#xannouncement').val(announcementData.announcement);
                   

                    $('#updateModal').modal('show');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('AJAX Error:', textStatus, errorThrown);
                console.log('Error fetching announcement data');
            }
        });
    }

    function saveChanges() {
        $('#sloading').toggle();
        console.log('Save button clicked');

            var announcement_id = $('#xannouncement_id').val();
            var updatedData = {
            title: $('#xtitle').val(),
            announcement_description: $('#xannouncement_description').val(),
            announcement: $('#xannouncement').val(),
            expired_date: $('#xexpired_date').val(),
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
                    console.error('Error updating announcement data:', response.message);
                    alert("Failed to update record. Please try again.");
                }
            },
        });
    }
    
    function archiveAnnouncement(announcement_id, title, announcement_description) {
        $('#archiveModal').modal('show');
        $('#archiveModalTitle').text('Archive Announcement');
        $('#announcementInfo').html('<strong>title:</strong> ' + title + ' <br><strong>announcement_description:</strong> ' + announcement_description + '<br><strong>ID:</strong> ' + announcement_id);

        $('#archiveModalSave').off().on('click', function () {
            $('#sloading').toggle();
            $.ajax({
                url: "../php/function/announcement_function.php",
                method: "POST",
                data: { action: "archive", announcement_id: announcement_id},
                success: function (data) {
                    var response = JSON.parse(data);

                    if (response.status) {
                        $('#sloading').toggle();
                        $('#archiveModalMessage').text('Announcement archived successfully');
                    } else {
                        $('#archiveModalMessage').text('Failed to archive Announcement');
                    }
                        $('#archiveModal').modal('hide');
                        location.reload();
                },
                error: function (xhr, status, error) {
                    console.error("Ajax request failed:", error);
                    $('#archiveModalMessage').text('Failed to archive announcement');
                    $('#archiveModal').modal('hide');
                    location.reload();
                }
            });
        });
    }

    </script>

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
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xannoucementtype" class="form-label">Annoucement Type</label>
                            <select id="annoucementtype" class="form-select">
                                <option value="Annoucement">Annoucement</option>
                                <option value="News">News</option>
                                <option value="Call for papers">Call for papers</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xtitle" class="form-label">Title</label>
                            <input type="text" id="title" class="form-control" placeholder="title" required/>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xannouncement_description" class="form-label">Description</label>
                            <input type="text" id="announcement_description" class="form-control" placeholder="description" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xannouncement" class="form-label">Announcement</label>
                            <input type="text" id="announcement" class="form-control" placeholder="announcement" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2" id="xUpload_image">
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
        </form>
    </div>

     <!-- Update Modal -->
     <div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Update Announcement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <input type="hidden" id="xannouncement_id" class="form-control"/>
                            <label for="title" class="form-label">Title</label>
                            <input type="text" id="xtitle" class="form-control" placeholder="title" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xannouncement_description" class="form-label">Announcement Description</label>
                            <input type="text" id="xannouncement_description" class="form-control" placeholder="announcement_description" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="announcement" class="form-label">Announcement</label>
                            <input type="text" id="xannouncement" class="form-control" placeholder="announcement" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveChanges()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Archive Modal -->
    <div class="modal fade" id="archiveModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="archiveModalTitle">Archive Announcement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h5 class="modal-title" id="modalToggleLabel">Are you sure you want to archive this Announcement</h5>
                        <p id="announcementInfo"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="archiveModalSave">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

