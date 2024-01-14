<?php
include 'function/redirect.php';
include 'function/journal_function.php';

$journallist = get_journal_list();
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <!-- Include header -->
    <?php include 'template/header.php'; ?>

    <!-- Content wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Others /</span> Reports</h4>

        <div class="card">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                <h5 class="card-header mb-0">Journal List</h5>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table table-striped" id="DataTable">
                    <thead>
                        <tr>
                            <th>Article ID</th>
                            <th>Article</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($journallist as $journallistval): ?>
                            <tr>
                                <td width="5%"><?php echo $journallistval->journal_id; ?></td>
                                <td width="85%"><?php echo $journallistval->journal; ?></td>
                                <td width="10%">
                                    <button type="button" class="btn btn-outline-success" onclick="updateModal(<?php echo $journallistval->journal_id; ?>)">Update</button>
                                    <button type="button" class="btn btn-outline-danger" onclick="archiveJournal(<?php echo $journallistval->journal_id; ?>, '<?php echo $journallistval->journal; ?>', '<?php echo $journallistval->journal_title; ?>')">Archive</button>
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

</script>
</body>
</html>
