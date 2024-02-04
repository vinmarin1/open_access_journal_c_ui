<?php
include 'function/report_function.php';

$yearval = isset($_GET['y']) ? $_GET['y'] : date('Y');
$monthval = isset($_GET['m']) ? $_GET['m'] : date('m');

$donationlist = get_donation_list($monthval, $yearval);
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
            <span class="text-muted fw-light">Others / Report / </span>&nbsp; Donation Report
            <span id="totalPublished" class="text-muted" style="margin-left: auto">
                <button type="button" class="btn btn-success" onclick="exportToExcel()">
                    Export &nbsp<i class="bx bx-download"></i>
                </button>
            </span>
        </h4>

        <div class="row mb-2">
            <div class="col-md-6 mb-2">
                <form id="reportForm">
                    <select class="form-select" onchange="doset(this.value, monthval.value)" name="yearval" id="yearval">
                        <option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
                        <?php
                        $yr = date('Y');
                        for ($x = 1; $x <= 6; $x++) {
                            $yr = $yr - 1;
                            ?>
                            <option value="<?php echo $yr; ?>" <?php if ($_GET['y'] == $yr) { echo "selected"; } ?>>
                                <?php echo $yr; ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6 mb-2">
                    <select class="form-select" onchange="doset(yearval.value, this.value)" name="monthval" id="monthval">
                        <?php
                        $months = [
                            '01' => 'January',
                            '02' => 'February',
                            '03' => 'March',
                            '04' => 'April',
                            '05' => 'May',
                            '06' => 'June',
                            '07' => 'July',
                            '08' => 'August',
                            '09' => 'September',
                            '10' => 'October',
                            '11' => 'November',
                            '12' => 'December',
                        ];

                        foreach ($months as $key => $value) {
                            ?>
                            <option value="<?php echo $key; ?>" <?php if ($_GET['m'] == $key) { echo "selected"; } ?>>
                                <?php echo $value; ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </form>
        </div>
        <div class="card">
            <div class="table-responsive text-nowrap" id="nopadding">
                <table class="table table-striped" id="DataTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Amount</th>
                            <th>Received Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($donationlist['donationlist']) && count($donationlist['donationlist']) > 0) {
                            foreach ($donationlist['donationlist'] as $donationlistval) {
                                ?>
                                <tr data-toggle="modal" data-target="">
                                    <td width="20%"><?php echo $donationlistval->donation_id; ?></td>
                                    <td width="30%"><?php echo $donationlistval->donator_name; ?></td>
                                    <td width="35%"><?php echo $donationlistval->donator_email; ?></td>
                                    <td width="10%"><?php echo $donationlistval->amount; ?></td>
                                    <td width="5%"><?php echo $donationlistval->created_at; ?></td>
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
            });
        });

        function doset(yearval, monthval) {
            $('#sloading').show();
            var url = "donationreportmtd.php?m=" + monthval + '&y=' + yearval;

            window.location.href = url;
        }

        function exportToExcel() {
            var dataTable = $('#DataTable').DataTable();
            var data = dataTable.rows().data();

            var wsData = data.toArray().map(row => [row[0], row[1], row[2], row[3], row[4]]);

            var ws = XLSX.utils.aoa_to_sheet([["ID", "Name", "Email", "Amount", "Received Date"]].concat(wsData));

            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');
 
            var yearval = <?php echo json_encode($yearval); ?>;
            var monthval = <?php echo json_encode($monthval); ?>;
            var monthName = '<?php echo date('F', mktime(0, 0, 0, $monthval, 1)); ?>';

            var filename = 'donation_' + yearval + '_' + monthName + '.xlsx';
            XLSX.writeFile(wb, filename);
        }

    </script>
</body>
</html>