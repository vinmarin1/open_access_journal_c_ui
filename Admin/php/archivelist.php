<?php
include 'function/redirect.php';
include 'function/archived_function.php';

$archivedlist = get_archived_list();
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <!-- Include header -->
    <?php include 'template/header.php'; ?>

    <!-- Content wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Others /</span> Archived</h4>

        <div class="card">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table table-striped" id="DataTable">
                    <thead>
                        <tr>
                            <th>Archived ID</th>
                            <th>Archived Title</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($archivedlist as $archivedlistval): ?>
                            <tr>
                                <td width="10%"><?php echo $archivedlistval->archive_id; ?></td>
                                <td width="85%"><?php echo $archivedlistval->title; ?></td>
                                <td width="5%">
                                    <button type="button" class="btn btn-primary" onclick="viewArchived('<?php echo $archivedlistval->action; ?>')">
                                        View
                                    </button>
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

    <script>
        $(document).ready(function() {
            var dataTable = $('#DataTable').DataTable({
                "paging": true,
                "ordering": true,
                "searching": true,
            });
        });

        function viewArchived(action) {
        $('#sloading').show();


        if (action === 'userarchived.php' || action === 'journalarchived.php' || action === 'issuearchived.php') {
            action = '../php/' + action;
        }
        window.location.href = action;
    }
    </script>
</body> 
</html>
