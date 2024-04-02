<?php
include 'function/redirect.php';
include 'function/archived_function.php';

$journallist = get_journalarchived_list();
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <!-- Include header -->
    <?php include 'template/header.php'; ?>

    <!-- Content wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Others / Archived /</span> Journal</h4>

        <div class="card">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                <h5 class="card-header mb-0">Archived Journal List</h5>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table table-striped" id="DataTable">
                    <thead>
                        <tr>
                            <th>Article ID</th>
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
                                    <button type="button" class="btn btn-danger" title="Delete" onclick="unarchiveJournal(<?php echo $journallistval->journal_id; ?>, '<?php echo $journallistval->journal; ?>', '<?php echo $journallistval->journal_title; ?>')"><i class='bx bxs-archive-out' ></i></button>
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
    
    function unarchiveJournal(journalId, journal, journal_title) {
        $('#archiveModal').modal('show');
        $('#archiveModalTitle').text('Unarchive Journal');
        $('#journalInfo').html('<strong>Journal:</strong> ' + journal + ' <br><strong>Journal_Title:</strong> ' + journal_title + '<br><strong>ID:</strong> ' + journalId);

        $('#archiveModalSave').off().on('click', function () {
            $('#sloading').toggle();
            $.ajax({
                url: "../php/function/archived_function.php",
                method: "POST",
                data: { action: "unarchivejournal", journal_id: journalId },
                success: function (data) {
                    var response = JSON.parse(data);

                    if (response.status) {
                        $('#sloading').toggle();
                        $('#archiveModalMessage').text('Journal unarchived successfully');
                    } else {
                        $('#archiveModalMessage').text('Failed to unarchived journal');
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


    <!-- Archive Modal -->
    <div class="modal fade" id="archiveModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="archiveModalTitle">Unarchived User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h5 class="modal-title" id="modalToggleLabel">Are you sure you want to unarchived this journal?</h5>
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
