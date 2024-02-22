<?php
include 'function/redirect.php';
include 'function/report_function.php';

$topcontributorslist = get_topcontributors_list();
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
</head>
<style>
    #nopadding {
        padding: 0 !important;
    }
    #totalPublished {
        color: #566A7F !important;
    }
</style>
<body>
    <?php include 'template/header.php'; ?>

    <!-- Content wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4" style="display: flex; justify-content: space-between; align-items: baseline;">
            <span class="text-muted fw-light">Others / Report / </span>&nbsp; Top Contributors
            <span id="totalPublished" class="text-muted" style="margin-left: auto">
                <button type="button" class="btn btn-success" onclick="exportToExcel()">
                    Export &nbsp<i class="bx bx-download"></i>
                </button>
            </span>
        </h4>

        <div class="row mb-2">
        <div class="card">
            <div class="table-responsive text-nowrap" id="nopadding">
                <table class="table table-striped" id="DataTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Conributes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($topcontributorslist['topcontributorslist']) && count($topcontributorslist['topcontributorslist']) > 0) {
                            foreach ($topcontributorslist['topcontributorslist'] as $topcontributorslistval) {
                                ?>
                                <tr data-toggle="modal" data-target="">
                                    <td width="45%"><?php echo $topcontributorslistval->lastname; ?>, <?php echo $topcontributorslistval->firstname; ?></td>
                                    <td width="40%"><?php echo $topcontributorslistval->email; ?></td>
                                    <td width="5%"><?php echo $topcontributorslistval->email_count; ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php include 'template/footer.php'; ?>
    </div>

    <!-- Include the DataTables CSS and JS files -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>

    <!-- DataTables initialization script -->
    <script>
        $(document).ready(function () {
            $('#DataTable').DataTable({
                "order": [[2, "desc"]] 
            });
        });

        function exportToExcel() {
            var dataTable = $('#DataTable').DataTable();
            var data = dataTable.rows().data();

            var wsData = data.toArray().map(row => [row[0], row[1], row[2]]);

            var ws = XLSX.utils.aoa_to_sheet([["Name", "Email", "Conributes"]].concat(wsData));

            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

            var filename = 'Top-Contributors.xlsx';
            XLSX.writeFile(wb, filename);
        }

    </script>
</body>
</html>
