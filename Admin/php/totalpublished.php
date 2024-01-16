<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
</head>
<style>
        #DataTable {
            margin: -2px; 
            margin-left: 1px; 
        }
        #totalPublished{
            color: #566A7F !important;
        }
    </style>
<body>
    <?php include 'template/header.php'; ?>

    <!-- Content wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4" style="display: flex; justify-content: space-between; align-items: baseline;">
            <span class="text-muted fw-light">Others / Report / </span>&nbsp Published Article
            <span id="totalPublished" class="text-muted" style="margin-left: auto"></span>
        </h4>
        
        <div class="row mb-2">
            <div class="col-md-6 mb-2">
                <form id="reportForm">
                    <select id="month" name="month" onchange="getReport()" class="form-select">

                        <?php
                        $currentMonth = date("n");
                        for ($i = 1; $i <= 12; $i++) {
                            $selected = ($i == $currentMonth) ? 'selected' : '';
                            echo "<option value='$i' $selected>" . date("F", mktime(0, 0, 0, $i, 1)) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6 mb-2">
                    <select id="year" name="year" onchange="getReport()" class="form-select">
                        <?php
                        $startYear = 2012; 
                        $currentYear = date("Y");
                        for ($i = $startYear; $i <= ($currentYear); $i++) {
                            $selected = ($i == $currentYear) ? 'selected' : '';
                            echo "<option value='$i' $selected>$i</option>";
                        }
                        ?>
                    </select>
                </div>
            </form>
        </div>
        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table table-striped" id="DataTable">
                    <thead>
                        <tr>
                            <th>Article ID</th>
                            <th>Title</th>
                            <th>Publication Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be dynamically loaded here -->
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

    <!-- DataTables initialization script -->
    <script>
        function getReport() {
            var month = document.getElementById('month').value;
            var year = document.getElementById('year').value;

            if ($.fn.DataTable.isDataTable('#DataTable')) {
                $('#DataTable').DataTable().destroy();
            }

            $(document).ready(function () {
                var table = $('#DataTable').DataTable({
                    "ajax": {
                        "url": "../php/function/totalpublished_f.php",
                        "data": { "month": month, "year": year },
                        "type": "GET"
                    },
                    "columns": [
                        { "data": "article_id" },
                        { "data": "title" },
                        { "data": "publication_date" }
                    ],  
                    "columnDefs": [
                        {
                            "render": function (data, type, row) {
                                return data.length > 123 ? data.substring(0, 123) + '...' : data;
                            },
                            "targets": 1
                        }
                    ],
                    "footerCallback": function (row, data, start, end, display) {
                        var api = this.api();

                        // Get the total number of rows
                        var totalRows = api.data().count();

                        // Update the content of the span with the total count
                        $('#totalPublished').text('Total Published: ' + totalRows);
                    }
                });
            });
        }

        window.onload = getReport;
    </script>
</body>
</html>