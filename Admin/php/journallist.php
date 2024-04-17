<?php
include 'function/redirect.php';
include 'function/journal_function.php';

if(isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true){
    $journal_id = isset($_SESSION['journal_id']) ? ($_SESSION['journal_id']) : '';
}

$journallist = get_journal_list($journal_id);
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <!-- Include header -->
    <?php include 'template/header.php'; ?>

    <!-- Content wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Settings /</span> Journal</h4>

        <div class="card">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                <h5 class="card-header mb-0">Journal List</h5>

                <div style="display: flex; margin-top: 15px; margin-right: 15px;">
                <?php if(empty($journal_id) && $journal_id !== NULL) { ?>
                    <button type="button" id="tabAll" class="btn btn-primary" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#addModal">Add Journal</button>
                <?php } ?>
                </div>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table table-striped" id="DataTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($journallist as $journallistval): ?>
                            <tr>
                                <td width="5%"><?php echo $journallistval->journal_id; ?></td>
                                <td width="85%"><?php echo $journallistval->journal; ?></td>
                                <td width="10%">
                                    <button type="button" class="btn btn-success" title="Update" onclick="updateModal(<?php echo $journallistval->journal_id; ?>)"><i class="bx bx-edit-alt"></i></button>
                                    <?php if(empty($journal_id) && $journal_id !== NULL) { ?>
                                        <button type="button" class="btn btn-danger" title="Archive" onclick="archiveJournal(<?php echo $journallistval->journal_id; ?>, '<?php echo $journallistval->journal; ?>', '<?php echo $journallistval->journal_title; ?>')"><i class='bx bxs-archive-in' ></i></button>
                                    <?php } ?>
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
    });

    function addRecord() {
        var form = document.getElementById('addModalForm');
        var formData = new FormData();
        formData.append('journal', $('#journal').val());
        formData.append('journal_title', $('#journal_title').val());
        formData.append('editorial', $('#editorial').val());
        formData.append('description', $('#description').val());
        formData.append('journalimage', $('#journalimage')[0].files[0]);
        formData.append('subject_areas', $('#subject_areas').val());
        formData.append('action', 'add');
        
        if (form.checkValidity()) {
            $('#sloading').toggle();
            $.ajax({
                url: "../php/function/journal_function.php",
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
                        alert("All fields required!");
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

    function updateModal(journalId) {
        $.ajax({
            type: 'POST',
            url: '../php/function/journal_function.php',
            data: { action: 'fetch', journal_id: journalId },
            dataType: 'json',
            success: function (response) {
                console.log('Response from server:', response);

                if (response.status === true && response.data.length > 0) {
                    const journalData = response.data[0];
                    console.log('Journal Data:', journalData);

                    $('#xjournalid').val(journalData.journal_id);
                    $('#xjournal').val(journalData.journal);
                    $('#xjournal_title').val(journalData.journal_title);
                    $('#xeditorial').val(journalData.editorial);
                    $('#xdescription').val(journalData.description);
                    $('#xsubject_areas').val(journalData.subject_areas);

                    $('#updateModal').modal('show');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('AJAX Error:', textStatus, errorThrown);
                console.log('Error fetching user data');
            }
        });
    }

    function saveChanges() {
        var form = document.getElementById('updateModalForm');
        if (form) { 
            var formData = new FormData();
            formData.append('journal_id', $('#xjournalid').val());
            formData.append('journal', $('#xjournal').val());
            formData.append('journal_title', $('#xjournal_title').val());
            formData.append('editorial', $('#xeditorial').val());
            formData.append('description', $('#xdescription').val());
            formData.append('subject_areas', $('#xsubject_areas').val());
            formData.append('journalimage', $('#xupload_image')[0].files[0]);
            formData.append('action', 'update');

            if (form.checkValidity()) {
                $('#sloading').show();
                $.ajax({
                    url: "../php/function/journal_function.php",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        var response = JSON.parse(data);
                        $('#sloading').hide();
                        if (response.status) {
                            alert("Record updated successfully");
                            $('#updateModal').modal('hide');
                            location.reload();
                        } else {
                            alert('Failed to update record: ' + response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX request failed:", error);
                        $('#sloading').hide();
                        alert("Failed to update record. Please try again.");
                    }
                });
            } else {
                form.reportValidity();
            }
        } else {
            console.error("Form with ID 'updateModalForm' not found.");
        }
    }

    function archiveJournal(journalId, journal, journal_title) {
        $('#archiveModal').modal('show');
        $('#archiveModalTitle').text('Archive Journal');
        $('#journalInfo').html('<strong>Journal:</strong> ' + journal + ' <br><strong>Journal_Title:</strong> ' + journal_title + '<br><strong>ID:</strong> ' + journalId);

        $('#archiveModalSave').off().on('click', function () {
            $('#sloading').toggle();
            $.ajax({
                url: "../php/function/journal_function.php",
                method: "POST",
                data: { action: "archive", journal_id: journalId },
                success: function (data) {
                    var response = JSON.parse(data);

                    if (response.status) {
                        $('#sloading').toggle();
                        $('#archiveModalMessage').text('Journal archived successfully');
                    } else {
                        $('#archiveModalMessage').text('Failed to archive journal');
                    }
                        $('#archiveModal').modal('hide');
                        location.reload();
                },
                error: function (xhr, status, error) {
                    console.error("Ajax request failed:", error);
                    $('#archiveModalMessage').text('Failed to archive journal');
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
                    <h5 class="modal-title" id="exampleModalLabel3">Add Journal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xjournal" class="form-label">Journal</label>
                            <input type="text" id="journal" class="form-control" placeholder="Journal" required/>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xjournaltitle" class="form-label">Journal Title</label>
                            <input type="text" id="journal_title" class="form-control" placeholder="Journal Title" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xeditorial" class="form-label">Editorial</label>
                            <!-- <input type="text" id="editorial" class="form-control" placeholder="Journal Editorial" /> -->
                            <textarea class="form-control" id="editorial" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12" mb-2>
                            <label for="xdescription" class="form-label">Description</label>
                            <textarea class="form-control" id="description" rows="9"></textarea>
                        </div>
                    </div>   
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xsubject_areas" class="form-label">Subject Areas</label>
                            <input type="text" id="subject_areas" class="form-control" placeholder="Subject Areas" required/>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2" id="xjournalimage">
                            <label for="formFileAddFiles" class="form-label">Upload Image</label>
                            <input class="form-control" type="file" id="journalimage" />
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
     <form id="updateModalForm">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Update Journal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <input type="hidden" id="xjournalid" class="form-control"/>
                            <label for="xjournal" class="form-label">Journal</label>
                            <input type="text" id="xjournal" class="form-control" placeholder="Journal" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xjournaltitle" class="form-label">Journal Title</label>
                            <input type="text" id="xjournal_title" class="form-control" placeholder="Journal Title" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xeditorial" class="form-label">Editorial</label>
                            <!-- <input type="text" id="xeditorial" class="form-control" placeholder="Journal Editorial" /> -->
                            <textarea class="form-control" id="xeditorial" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                                <label for="xdescription" class="form-label">Description</label>
                                <textarea class="form-control" id="xdescription" rows="9"></textarea>
                            </div>
                        </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                                <label for="xsubject_areas" class="form-label">Subject Areas</label>
                                <input type="text" id="xsubject_areas" class="form-control" placeholder="Subject Areas" />
                            </div>
                        </div>
                    <div class="row mb-2">
                    <div class="col-md-12 mb-2" id="xUpload_image">
                            <label for="formFileAddFiles" class="form-label">Upload Image</label>
                            <input class="form-control" type="file" id="xupload_image" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveChanges()">Save changes</button>
                </div>
            </div>
        </div>
    </form>
    </div>

    <!-- Archive Modal -->
    <div class="modal fade" id="archiveModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="archiveModalTitle">Archive User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h5 class="modal-title" id="modalToggleLabel">Are you sure you want to archive this journal?</h5>
                        <p id="journalInfo"></p>
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
