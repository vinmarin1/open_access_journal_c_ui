<?php
include 'function/redirect.php';
include 'function/issue_function.php';

$issueslist = get_issues_list();
$journallist = get_journal_list();
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
                            <th>ID</th>
                            <th>ISSN</th>
                            <th>Volume</th>
                            <th>Number</th>
                            <th>Year</th>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                <tbody>
                <?php foreach ($issueslist as $issueslistval): ?>
                            <tr>
                                <td width="5%"><?php echo  $issueslistval->issues_id; ?></td>
                                <td width="10%"><?php echo  $issueslistval->issn; ?></td>
                                <td width="5%"><?php echo  $issueslistval->volume; ?></td>
                                <td width="5%"><?php echo  $issueslistval->number; ?></td>
                                <td width="5%"><?php echo  $issueslistval->year; ?></td>
                                <td width="65%"><?php echo  $issueslistval->title; ?></td>
                                <td width="5%">
                                    <button type="button" class="btn btn-success" title="Update" onclick="updateModal(<?php echo $issueslistval->issues_id; ?>)"><i class="bx bx-edit-alt"></i></button>
                                    <button type="button" class="btn btn-danger" title="Delete" onclick="archiveIssue(<?php echo $issueslistval->issues_id; ?>, '<?php echo $issueslistval->volume; ?>', '<?php echo $issueslistval->title; ?>')"><i class="bx bx-trash"></i></button>
                                    <button type="button" class="btn btn-info" title="Article List" onclick="viewAllArticle(<?php echo $issueslistval->issues_id; ?>)"><i class="bx bx-list-ol"></i></button>
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

            $('#year').val(new Date().getFullYear());
        });

        function viewAllArticle(issueId) {
            $('#sloading').show();

            setTimeout(function () {
                window.location.href = "../php/articleissuelist.php?issid=" + issueId;
            }, 2000);

            window.onload = function () {
                $('#sloading').hide();
            };
        }

        function addRecord() {
        var form = document.getElementById('addModalForm');
        var formData = new FormData();
        formData.append('issn', $('#issn').val());
        formData.append('volume', $('#volume').val());
        formData.append('number', $('#number').val());
        formData.append('year', $('#year').val());
        formData.append('title', $('#title').val());
        formData.append('journal_id', $('#journal_id').val());
        formData.append('cover_image', $('#cover_image')[0].files[0]);
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

    
    function updateModal(id) {
        console.log(id);
        $.ajax({
            type: 'POST',
            url: '../php/function/issue_function.php',
            data: { action: 'fetch', id: id },
            dataType: 'json',
            success: function (response) {
                console.log('Response from server:', response);

                if (response.status === true && response.data.length > 0) {
                    const issueData = response.data[0];
                    console.log('Issue Data:', issueData);
                    $('#xid').val(issueData.issues_id);
                    $('#xissn').val(issueData.issn);
                    $('#xvolume').val(issueData.volume);
                    $('#xnumber').val(issueData.number);
                    $('#xyear').val(issueData.year);
                    $('#xtitle').val(issueData.title);

                    $('#updateModal').modal('show');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('AJAX Error:', textStatus, errorThrown);
                console.log('Error fetching issue data');
            }
        });
    }

    function saveChanges() {
        $('#sloading').toggle();
        console.log('Save button clicked');
        
            var id = $('#xid').val();
            var updatedData = {
            issn: $('#xissn').val(), 
            volume: $('#xvolume').val(),
            number: $('#xnumber').val(),
            year: $('#xyear').val(),
            title: $('#xtitle').val(),
        };

        $.ajax({
            type: 'POST',
            url: '../php/function/issue_function.php',
            data: {
                action: 'update',
                id :id ,
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
                    console.error('Error updating issue data:', response.message);
                    alert("Failed to update record. Please try again.");
                }
            },
        });
    }
    
    function archiveIssue(id, volume, title) {
        $('#archiveModal').modal('show');
        $('#archiveModalTitle').text('Delete Issue');
        $('#issuesInfo').html('<strong>volume:</strong> ' + volume + ' <br><strong>Title:</strong> ' + title + '<br><strong>ID:</strong> ' + id);

        $('#archiveModalSave').off().on('click', function () {
            $('#sloading').toggle();
            $.ajax({
                url: "../php/function/issue_function.php",
                method: "POST",
                data: { action: "archive", id: id},
                success: function (data) {
                    var response = JSON.parse(data);

                    if (response.status) {
                        $('#sloading').toggle();
                        $('#archiveModalMessage').text('Issue archived successfully');
                    } else {
                        $('#archiveModalMessage').text('Failed to archive issue');
                    }
                        $('#archiveModal').modal('hide');
                        location.reload();
                },
                error: function (xhr, status, error) {
                    console.error("Ajax request failed:", error);
                    $('#archiveModalMessage').text('Failed to archive issue');
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
                    <h5 class="modal-title" id="exampleModalLabel3">Add Issue</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xissn" class="form-label">ISSN</label>
                            <input type="text" id="issn" class="form-control" placeholder="ISSN" required/>
                        </div>
                    </div>
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
                            <input type="number" id="year" class="form-control" placeholder="year" min="1900" max="2099" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xtitle" class="form-label">Title</label>
                            <textarea class="form-control" id="title" rows="9"></textarea>
                        </div>
                    </div>   
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label for="xjournal" class="form-label">Journal</label>
                            <select id="journal_id" class="form-select">
                                <option value="Null">Select Journal</option>
                                <?php foreach ($journallist as $journal): ?>
                                    <option value="<?php echo $journal->journal_id; ?>"><?php echo $journal->journal; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2" id="xcover_image">
                            <label for="formFileAddFiles" class="form-label">Cover Image</label>
                            <input class="form-control" type="file" id="cover_image" />
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
                    <h5 class="modal-title" id="exampleModalLabel3">Update Issues</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <input type="hidden" id="xid" class="form-control"/>
                            <label for="xissn" class="form-label">ISSN</label>
                            <input type="text" id="xissn" class="form-control" placeholder="ISSN" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xvolume" class="form-label">Volume</label>
                            <input type="number" id="xvolume" class="form-control" placeholder="volume" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xnumber" class="form-label">Number</label>
                            <input type="number" id="xnumber" class="form-control" placeholder="number" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xyear" class="form-label">Year</label>
                            <input type="number" id="xyear" class="form-control" placeholder="year" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                                <label for="xtitle" class="form-label">title</label>
                                <textarea class="form-control" id="xtitle" rows="9"></textarea>
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
                    <h5 class="modal-title" id="archiveModalTitle">Delete Issue</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h5 class="modal-title" id="modalToggleLabel">Are you sure you want to delete this Issue?</h5>
                        <p id="issuesInfo"></p>
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

