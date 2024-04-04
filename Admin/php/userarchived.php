<?php
include 'function/redirect.php';
include 'function/archived_function.php';

$userlist = get_userarchived_list();
?>

<!DOCTYPE html>
<html lang="en">
<style>
    .nav-link.active {
        color: white !important;
        background-color: #007bff;
    }

    .nav-link:not(.active) {
        color: gray;
    }
</style>
<body>
    <!-- Include header -->
    <?php include 'template/header.php'; ?>

    <!-- Content wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Others / Archived /</span> User</h4>

        <div class="card user-list" style="display: block;">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                <h5 class="card-header mb-0">User Archived List</h5>
                <div style="display: flex; margin-top: 15px; margin-right: 15px;">
                    <!-- <button type="button" id="tabAll" class="btn btn-primary" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#addModal">Add User</button> -->
                    <!-- <button type="button" id="tabPublished" class="btn btn-primary">Download</button> -->
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped" id="DataTableUser">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($userlist as $userlistval): ?>
                            <tr>
                                <td width="5%"><?php echo $userlistval->author_id; ?></td>
                                <td width="50%"><?php echo $userlistval->last_name; ?>, <?php echo $userlistval->first_name; ?></td>
                                <td width="50%"><?php echo $userlistval->email; ?></td>
                                <td width="10%">
                                    <button type="button" class="btn btn-danger" title="Delete" onclick="unarchiveUser(<?php echo $userlistval->author_id; ?>, '<?php echo $userlistval->first_name; ?>', '<?php echo $userlistval->last_name; ?>')"><i class='bx bxs-archive-out' ></i></button>
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

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>
    $(document).ready(function() {
        var dataTable = $('#DataTableUser').DataTable({
            "paging": true,
            "ordering": true,
            "searching": true,
        });
    });

    function unarchiveUser(authorId, firstName, lastName) {
        $('#archiveModal').modal('show');
        $('#archiveModalTitle').text('Retrieve User');
        $('#userInfo').html('<strong>Name:</strong> ' + lastName + ', ' + firstName + '<br><strong>ID:</strong> ' + authorId);

        $('#archiveModalSave').off().on('click', function () {
            $('#sloading').toggle();
            $.ajax({
                url: "../php/function/archived_function.php",
                method: "POST",
                data: { action: "unarchiveuser", author_id: authorId },
                success: function (data) {
                    var response = JSON.parse(data);

                    if (response.status) {
                        $('#sloading').toggle();
                        $('#archiveModalMessage').text('User unarchived successfully');
                    } else {
                        $('#archiveModalMessage').text('Failed to unarchived user');
                    }
                        $('#archiveModal').modal('hide');
                        location.reload();
                },
                error: function (xhr, status, error) {
                    console.error("Ajax request failed:", error);
                    $('#archiveModalMessage').text('Failed to archive user');
                    $('#archiveModal').modal('hide');
                    $('#sloading').toggle();
                    location.reload();
                }
            });
        });
    }

    </script>
     <!-- Archive Modal -->
     <div class="modal fade" id="archiveModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="archiveModalTitle">Retrieve User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h5 class="modal-title" id="modalToggleLabel">Are you sure you want to retrieve this user?</h5>
                        <p id="userInfo"></p>
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
