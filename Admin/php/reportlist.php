<?php
include 'function/redirect.php';
include 'function/report_function.php';

if(isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true){
    $journal_id = isset($_SESSION['journal_id']) ? ($_SESSION['journal_id']) : '';
}

$reportlist = get_report_list($journal_id);
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <!-- Include header -->
    <?php include 'template/header.php'; ?>

    <!-- Content wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Others /</span> Report</h4>

        <div class="card">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table table-striped" id="DataTable">
                    <thead>
                        <tr>
                            <th>Report ID</th>
                            <th>Report Title</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reportlist as $reportlistval): ?>
                            <tr>
                                <td width="10%"><?php echo $reportlistval->report_id; ?></td>
                                <td width="85%"><?php echo $reportlistval->title; ?></td>
                                <td width="5%">
                                    <button type="button" class="btn btn-outline-dark" onclick="viewReport('<?php echo $reportlistval->action; ?>')">
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

        function viewReport(action) {
        $('#sloading').show();

        if (action === 'totalarchive.php' || action === 'totalpublished.php' || action === 'donationreportmtd.php') {
            var currentDate = new Date();
            var currentMonth = currentDate.getMonth() + 1;
            var currentYear = currentDate.getFullYear();

            action = '../php/' + action + '?m=' + currentMonth + '&y=' + currentYear;
        } else if (action === 'allarticlereportmtd.php') {
            var currentDate = new Date();
            var currentMonth = currentDate.getMonth() + 1;
            var currentYear = currentDate.getFullYear();

            action = '../php/' + action + '?m=' + currentMonth + '&y=' + currentYear + '&s=10';
        } else if (action === 'allarticlereportytd.php') {
            var currentDate = new Date();
            var currentMonth = currentDate.getMonth() + 1;
            var currentYear = currentDate.getFullYear();

            action = '../php/' + action + '?y=' + currentYear + '&s=10';
        } else if (action === 'totalreport.php') {
            var currentDate = new Date();
            var currentMonth = currentDate.getMonth() + 1;
            var currentYear = currentDate.getFullYear();

            action = '../php/' + action + '?y=' + currentYear;
        } if (action === 'topcontributors.php' || action === 'topreviewer.php' || action === 'journalreport.php') {
            action = '../php/' + action;
        }
        window.location.href = action;
    }
    </script>
</body>
</html>
