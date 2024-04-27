<?php
include 'function/redirect.php';
include 'function/report_function.php';

$yearval = isset($_GET['y']) ? $_GET['y'] : date('Y');
$monthval = isset($_GET['m']) ? $_GET['m'] : date('m');

$articlelist = get_published_article_list($monthval, $yearval);
$articlepublishedtotal = get_published_article_total($monthval, $yearval);
// $totalPublishedArticles = count($articlepublishedtotal['articlelist']);
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
        Others / <a href="../php/reportlist.php"> <span class="text-muted fw-light">&nbsp;Report /</span></a>&nbsp; Published Article
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
                            <th>Article ID</th>
                            <th>Title</th>
                            <th>Publication Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($articlelist['articlelist']) && count($articlelist['articlelist']) > 0) {
                            foreach ($articlelist['articlelist'] as $articlelistval) {
                                ?>
                                <tr data-toggle="modal" data-target="">
                                    <td width="5%"><?php echo $articlelistval->article_id; ?></td>
                                    <td width="90%"><?php echo $articlelistval->title; ?></td>
                                    <td width="5%"><?php echo $articlelistval->publication_date; ?></td>
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
                drawCallback: function () {
                    updateTotalPublished();
                }
            });
        });

        function updateTotalPublished() {
            var totalPublished = $('#articleTableBody tr').length - 1;
            $('#totalPublishedRow td').text('Total Published: ' + totalPublished);
        }

        function doset(yearval, monthval) {
            $('#sloading').show();
            var url = "totalpublished.php?m=" + monthval + '&y=' + yearval;

            window.location.href = url;
        }

        function exportToExcel() {
            var dataTable = $('#DataTable').DataTable();
            var data = dataTable.rows().data();

            var wsData = data.toArray().map(row => [row[0], row[1], row[2]]);

            var ws = XLSX.utils.aoa_to_sheet([["Article ID", "Title", "Archive Date"]].concat(wsData));

            var columnSizes = [{ wch: 15 }, { wch: 150 }, { wch: 25 }]; 
            columnSizes.forEach((size, columnIndex) => {
                ws['!cols'] = ws['!cols'] || [];
                ws['!cols'][columnIndex] = size;
            });

            ws['!protect'] = true;

            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

            var yearval = <?php echo json_encode($yearval); ?>;
            var monthval = <?php echo json_encode($monthval); ?>;
            var monthName = '<?php echo date('F', mktime(0, 0, 0, $monthval, 1)); ?>';

            var filename = 'published_articles_' + yearval + '_' + monthName + '.xlsx';
            XLSX.writeFile(wb, filename);
        }

    </script>
</body>
</html>
