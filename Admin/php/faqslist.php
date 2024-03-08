<?php
include 'function/redirect.php';
include 'function/faqs_function.php';

$faqslist = get_faqs_list();
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <!-- Include header -->
    <?php include 'template/header.php'; ?>

   <!-- Content wrapper -->
   <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span> FAQS</h4>

         <!-- Status tabs -->
         <ul class="nav nav-tabs mb-3" id="statusTabs">
            <li class="nav-item">
                <a class="nav-link active" id="tabAll" data-status="">All</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tabSUBMITTINGARTICLES" data-status="SUBMITTING ARTICLES">SUBMITTING ATICLES</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tabGENERALQUESTIONS" data-status="GENERAL QUESTIONS">GERERAL QUESTIONS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tabOTHERS" data-status="OTHERS">OTHERS</a>
            </li>
        </ul>

        <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
            <h5 class="card-header mb-0">FAQS</h5>
            <div style="display: flex; margin-top: 15px; margin-right: 15px;">
                <button type="button" id="tabAll" class="btn btn-primary" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#addModal">Add FAQS</button>
                <!-- <button type="button" id="tabPublished" class="btn btn-primary">Download</button> -->
            </div>
        </div>

            <div class="table-responsive text-nowrap">
                <table class="table table-striped" id="DataTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Questions</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($faqslist as $faqslistval): ?>
                            <tr>
                                <td width="5%"><?php echo  $faqslistval->id; ?></td>
                                <td width="85%"><?php echo  $faqslistval->question; ?></td>
                                <td width="85%"><?php echo  $faqslistval->category; ?></td>
                                <td width="10%">
                                    <button type="button" class="btn btn-outline-success" onclick="updateModal(<?php echo $faqslistval->id; ?>)">Update</button>
                                    <button type="button" class="btn btn-outline-danger" onclick="archiveFaqs(<?php echo $faqslistval->id; ?>, '<?php echo $faqslistval->question; ?>', '<?php echo $faqslistval->answer; ?>')">Archive</button>
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
        $('#statusTabs a').on('click', function (e) {
                e.preventDefault();

                $('#statusTabs a').removeClass('active');

                $(this).addClass('active');

                var statusValue = $(this).data('status');
                dataTable.column(2).search(statusValue).draw();
            });
        });

    function addRecord() {
        var form = document.getElementById('addModalForm');
        var formData = new FormData();
        formData.append('question', $('#question').val());
        formData.append('answer', $('#answer').val());
        formData.append('category', $('#category').val());
        formData.append('description', $('#description').val());
        formData.append('link', $('#link').val());
        formData.append('action', 'add');
        
        if (form.checkValidity()) {
            $('#sloading').toggle();
            $.ajax({
                url: "../php/function/faqs_function.php",
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

    function updateModal(id) {
        $.ajax({
            type: 'POST',
            url: '../php/function/faqs_function.php',
            data: { action: 'fetch', id: id },
            dataType: 'json',
            success: function (response) {
                console.log('Response from server:', response);

                if (response.status === true && response.data.length > 0) {
                    const faqsData = response.data[0];
                    console.log('Faqs Data:', faqsData);

                    $('#xid').val(faqsData.id);
                    $('#xquestion').val(faqsData.question);
                    $('#xanswer').val(faqsData.answer);
                    $('#xcategory').val(faqsData.category);
                    $('#xdescription').val(faqsData.description);
                    $('#xlink').val(faqsData.link);
                   

                    $('#updateModal').modal('show');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('AJAX Error:', textStatus, errorThrown);
                console.log('Error fetching Faqs data');
            }
        });
    }

    function saveChanges() {
        $('#sloading').toggle();
        console.log('Save button clicked');
        
        var id = $('#xid').val();
        var updatedData = {
            question: $('#xquestion').val(),
            answer: $('#xanswer').val(),
            category: $('#xcategory').val(),
            description: $('#xdescription').val(),
            link: $('#xlink').val(),
        };

        $.ajax({
            type: 'POST',
            url: '../php/function/faqs_function.php',
            data: {
                action: 'update',
                id: id,
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
                    console.error('Error updating faqs data:', response.message);
                    alert("Failed to update record. Please try again.");
                }
            },
        });
    }
    
    function archiveFaqs(id, question, answer) {
        $('#archiveModal').modal('show');
        $('#archiveModalTitle').text('Archive FAQS');
        $('#faqsInfo').html('<strong>Question:</strong> ' + question + ' <br><strong>Answer:</strong> ' + answer + '<br><strong>ID:</strong> ' + id);

        $('#archiveModalSave').off().on('click', function () {
            $('#sloading').toggle();
            $.ajax({
                url: "../php/function/faqs_function.php",
                method: "POST",
                data: { action: "archive", id: id },
                success: function (data) {
                    var response = JSON.parse(data);

                    if (response.status) {
                        $('#sloading').toggle();
                        $('#archiveModalMessage').text('Faqs archived successfully');
                    } else {
                        $('#archiveModalMessage').text('Failed to archive faqs');
                    }
                        $('#archiveModal').modal('hide');
                        location.reload();
                },
                error: function (xhr, status, error) {
                    console.error("Ajax request failed:", error);
                    $('#archiveModalMessage').text('Failed to archive faqs');
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
                    <h5 class="modal-title" id="exampleModalLabel3">Add Faqs</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xquestion" class="form-label">Question</label>
                            <input type="text" id="question" class="form-control" placeholder="Question" required/>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xanswer" class="form-label">Answer</label>
                            <input type="text" id="answer" class="form-control" placeholder="Answer" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xcategory" class="form-label">Category</label>
                            <select id="announcementtype" class="form-select">
                                <option value="SUBMITTING ARTICLES">SUBMITTING ARTICLES</option>
                                <option value="GENERAL QUESTIONS">GENERAL QUESTIONS</option>
                                <option value="OTHERS">OTHERS</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xdescription" class="form-label">Description</label>
                            <input type="text" id="description" class="form-control" placeholder="Description" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xlink" class="form-label">Link</label>
                            <input type="text" id="link" class="form-control" placeholder="Link" />
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Update Faqs</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <input type="hidden" id="xid" class="form-control"/>
                            <label for="xquestion" class="form-label">Question</label>
                            <input type="text" id="xquestion" class="form-control" placeholder="Question" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xanswer" class="form-label">Answer</label>
                            <input type="text" id="xanswer" class="form-control" placeholder="Answer" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xcategory" class="form-label">Category</label>
                            <input type="text" id="xcategory" class="form-control" placeholder="Category" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xdescription" class="form-label">Description</label>
                            <input type="text" id="xdescription" class="form-control" placeholder="Description" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xlink" class="form-label">Link</label>
                            <input type="text" id="xlink" class="form-control" placeholder="Link" />
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
                    <h5 class="modal-title" id="archiveModalTitle">Archive FAQS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h5 class="modal-title" id="modalToggleLabel">Are you sure you want to archive this faqs?</h5>
                        <p id="faqsInfo"></p>
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