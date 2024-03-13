<?php
include 'function/redirect.php';
include 'function/message_function.php';

$messagelist = get_message_list();
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <!-- Include header -->
    <?php include 'template/header.php'; ?>

   <!-- Content wrapper -->
   <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span> Message</h4>

        <!-- Status tabs -->
        <ul class="nav nav-tabs mb-3" id="statusTabs">
            <li class="nav-item">
                <a class="nav-link active" id="tabAll" data-status="">All</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tabQuestion" data-status="Question">Question</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tabSuggestion" data-status="Suggestion">Suggestion</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tabOthers" data-status="Others">Others</a>
            </li>
        </ul>

        <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
            <h5 class="card-header mb-0">Message List</h5>
            <div style="display: flex; margin-top: 15px; margin-right: 15px;">
                <!-- <button type="button" id="tabAll" class="btn btn-primary" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#addModal">Add Message</button> -->
                <!-- <button type="button" id="tabPublished" class="btn btn-primary">Download</button> -->
            </div>
        </div>

            <div class="table-responsive text-nowrap">
                <table class="table table-striped" id="DataTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Reason</th>
                            <th>Date Added</th>
                            <th>Actions</th>
                        </tr>   
                    </thead>
                    <tbody>
                        <?php foreach ($messagelist as $messagelistval): ?>
                            <tr>
                                <td width="5%"><?php echo  $messagelistval->message_id; ?></td>
                                <td width="5%"><?php echo  $messagelistval->name; ?></td>
                                <td width="50%"><?php echo  $messagelistval->email; ?></td>
                                <td width="10%"><?php echo  $messagelistval->reason; ?></td>
                                <td width="10%"><?php echo  $messagelistval->date_added; ?></td>
                                <td width="5%">
                                    <button type="button" class="btn btn-primary" title="View" onclick="updateModal(<?php echo $messagelistval->message_id; ?>)"><i class="bx bx-window-open"></i></button>
                                    <button type="button" class="btn btn-danger" title="Delete" onclick="archiveMessage(<?php echo $messagelistval->message_id; ?>, '<?php echo $messagelistval->email; ?>', '<?php echo $messagelistval->message; ?>')"><i class="bx bx-trash"></i></button>
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
                dataTable.column(3).search(statusValue).draw();
            });
        });

        
    function updateModal(message_id) {
        $.ajax({
            type: 'POST',
            url: '../php/function/message_function.php',
            data: { action: 'fetch', message_id: message_id },
            dataType: 'json',
            success: function (response) {
                console.log('Response from server:', response);

                if (response.status === true && response.data.length > 0) {
                    const messageData = response.data[0];
                    console.log('Message Data:', messageData);

                    $('#xmessage_id').val(messageData.message_id);
                    $('#xname').val(messageData.name);
                    $('#xemail').val(messageData.email);
                    $('#xreason').val(messageData.reason);
                    $('#xmessage').val(messageData.message);
                   

                    $('#updateModal').modal('show');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('AJAX Error:', textStatus, errorThrown);
                console.log('Error fetching message data');
            }
        });
    }
    
    function archiveMessage(message_id, email, message) {
        $('#archiveModal').modal('show');
        $('#archiveModalTitle').text('Delete Message');
        $('#messageInfo').html('<strong>Email:</strong> ' + email + ' <br><strong>Message:</strong> ' + message + '<br><strong>ID:</strong> ' + message_id);

        $('#archiveModalSave').off().on('click', function () {
            $('#sloading').toggle();
            $.ajax({
                url: "../php/function/message_function.php",
                method: "POST",
                data: { action: "archive", message_id: message_id },
                success: function (data) {
                    var response = JSON.parse(data);

                    if (response.status) {
                        $('#sloading').toggle();
                        $('#archiveModalMessage').text('Message archived successfully');
                    } else {
                        $('#archiveModalMessage').text('Failed to archive Message');
                    }
                        $('#archiveModal').modal('hide');
                        location.reload();
                },
                error: function (xhr, status, error) {
                    console.error("Ajax request failed:", error);
                    $('#archiveModalMessage').text('Failed to archive message');
                    $('#archiveModal').modal('hide');
                    location.reload();
                }
            });
        });
    }
</script>


         <!-- Update Modal -->
         <div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <input type="hidden" id="xmessage_id" class="form-control"/>
                            <label for="xname" class="form-label">Name</label>
                            <input type="text" id="xname" class="form-control" placeholder="Name" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <input type="hidden" id="xmessage_id" class="form-control"/>
                            <label for="xemail" class="form-label">Email</label>
                            <input type="text" id="xemail" class="form-control" placeholder="Email" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xreason" class="form-label">Reason</label>
                            <input type="text" id="xreason" class="form-control" placeholder="Reason" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xmessage" class="form-label">Message</label>
                            <textarea class="form-control" id="xmessage" rows="9"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<!-- Archive Modal -->
<div class="modal fade" id="archiveModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="archiveModalTitle">Delete Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h5 class="modal-title" id="modalToggleLabel">Are you sure you want to delete this Message?</h5>
                        <p id="messageInfo"></p>
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