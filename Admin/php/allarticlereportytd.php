<?php
include 'function/redirect.php';
include 'function/report_function.php';

$yearval = isset($_GET['y']) ? $_GET['y'] : date('Y');
$statusval = isset($_GET['s']) ? $_GET['s'] : '';

$articlelist = get_allytd_article_list($yearval, $statusval);
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
            <span class="text-muted fw-light">Others / Report / </span>&nbsp;Article List YTD
            <span id="totalPublished" class="text-muted" style="margin-left: auto">
                <button type="button" class="btn btn-success" onclick="exportToExcel()">
                    Export &nbsp<i class="bx bx-download"></i>
                </button>
            </span>
        </h4>
        <div class="row mb-2">
            <div class="col-md-6 mb-2">
                <!-- Removed duplicate form tag -->
                <ul class="nav nav-tabs mb-3" id="statusTabs">
                    <li class="nav-item">
                        <a class="nav-link" id="MTD" data-status="" onclick="showLoading(); window.location.href='allarticlereportmtd.php?m=' + (new Date().getMonth() + 1) + '&y=' + new Date().getFullYear() + '&s=10';">MTD</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="YTD" data-status="">YTD</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-6 mb-2">
                <!-- Removed duplicate form tag -->
                <select class="form-select" onchange="doset(yearval.value, this.value)" name="statusval" id="statusval">
                    <?php
                    $statusOptions = [
                        '10'  => 'All',
                        '0' => 'Archive',
                        '1' => 'Published',
                        '2' => 'Production',
                        '3' => 'Copyediting',
                        '4' => 'Review',
                        '5' => 'Pending',
                        '6' => 'Reject',
                    ];

                    foreach ($statusOptions as $key => $value) {
                        ?>
                        <option value="<?php echo $key; ?>" <?php echo ($statusval == $key) ? 'selected' : ''; ?>>
                            <?php echo $value; ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12 mb-2">
                <!-- Removed duplicate form tag -->
                <select class="form-select" onchange="doset(this.value)" name="yearval" id="yearval">
                    <option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
                    <?php
                    $yr = date('Y');
                    for ($x = 1; $x <= 6; $x++) {
                        $yr = $yr - 1;
                        ?>
                        <option value="<?php echo $yr; ?>" <?php echo ($yearval == $yr) ? 'selected' : ''; ?>>
                            <?php echo $yr; ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="card">
            <div class="table-responsive text-nowrap" id="nopadding">
                <table class="table table-striped" id="DataTable">
                    <thead>
                        <tr>
                            <th>Article ID</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Submission Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($articlelist['articlelist']) && count($articlelist['articlelist']) > 0) {
                            foreach ($articlelist['articlelist'] as $articlelistval) {
                                ?>
                                <tr data-toggle="modal" data-target="">
                                    <td width="5%"><?php echo $articlelistval->article_id; ?></td>
                                    <td width="85%"><?php echo $articlelistval->title; ?></td>
                                    <?php
                                    $statusNumber = $articlelistval->status;

                                    $statusInfo = [
                                        0 => ['label' => 'Archived', 'class' => 'label-dark'],
                                        1 => ['label' => 'Published', 'class' => 'label-success'],
                                        2 => ['label' => 'Production', 'class' => 'label-info'],
                                        3 => ['label' => 'Copyediting', 'class' => 'label-primary'],
                                        4 => ['label' => 'Review', 'class' => 'label-warning'],
                                        5 => ['label' => 'Pending', 'class' => 'label-secondary'],
                                        6 => ['label' => 'Reject', 'class' => 'label-danger'],
                                    ];

                                    if (isset($statusInfo[$statusNumber])) {
                                        $statusLabel = $statusInfo[$statusNumber]['label'];
                                        $statusClass = $statusInfo[$statusNumber]['class'];
                                    } else {
                                        $statusLabel = 'Unknown';
                                        $statusClass = 'label-secondary';
                                    }
                                    ?>

                                    <td width="55%">
                                        <span class="badge bg-<?php echo $statusClass; ?> me-1">
                                            <?php echo $statusLabel; ?>
                                        </span>
                                    </td>
                                    <td width="5%"><?php echo $articlelistval->date_added; ?></td>
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
            $('#DataTable').DataTable();
        });

        function doset(yearval) {
                var statusval = $('#statusval').val();
                $('#sloading').show();
                var url = "allarticlereportytd.php?y=" + yearval + '&s=' + statusval;

                window.location.href = url;
            }

        function exportToExcel() {
            var dataTable = $('#DataTable').DataTable();
            var data = dataTable.rows().data();

            var wsData = data.toArray().map(row => [row[0], row[1], getStatusText(row[2]), row[3]]);

            var ws = XLSX.utils.aoa_to_sheet([["Article ID", "Title", "Status", "Date Submitted"]].concat(wsData));

            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

            var yearval = <?php echo json_encode($yearval); ?>;
            var statusval = $('#statusval').val();

            var statusLabel = getStatusLabel(statusval);

            var filename = statusLabel + '_articles_' + yearval + '.xlsx';
            XLSX.writeFile(wb, filename);
        }

        function getStatusText(htmlString) {
            var doc = new DOMParser().parseFromString(htmlString, 'text/html');
            var textContent = doc.body.textContent || "";
            return textContent.trim();
        }

        function getStatusLabel(statusValue) {
            var statusInfo = {
                '10': 'AllArticle',
                '0': 'Archive',
                '1': 'Published',
                '2': 'Production',
                '3': 'Copyediting',
                '4': 'Review',
                '5': 'Pending',
                '6': 'Reject'
            };

            return statusInfo[statusValue] || 'Unknown';
        }

        function showLoading() {
            $('#sloading').show();
        }
    </script>
</body>
</html>
