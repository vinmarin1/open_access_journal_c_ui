<?php
include 'function/dashboard_functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dashboard.css?">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>

        .increase {
            color: green;
        }

        .decrease {
            color: red;
        }

        .chart-container {
            width: 100%;
            max-width: 1200px;
            margin: 20px auto;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            padding: 20px;
            box-sizing: border-box;
        }

        .chart-container:not(:last-child) {
            margin-bottom: 20px;
        }

        #yearDropdown {
            margin-bottom: 10px;
        }

        .chart-title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 18px;
        }
        canvas {
            max-height: 300px;
        }
        .box{
            height: 150px;
        }
    </style>
</head>

<body>
    <!-- Include header -->
    <?php include 'template/header.php'; ?>
    <br>    <br>
    <div class="home-content">
        <div class="overview-boxes"  style="margin-bottom: -1px;">
                <div class="box">
                    <div class="box-content">
                        <div class="box-topic">Total Users</div>
                        <div class="number"><?php echo $totalUsers; ?></div>
                        <div class="indicator">
                            <!-- <i class='bx bx-up-arrow-alt'></i> -->
                            <!-- <span class="text">Up from yesterday</span> -->
                        </div>
                    </div>
                    <i class='bx bx-user cart'></i>
                </div>

                <div class="box">
                    <div class="box-content">
                        <div class="box-topic">Total Articles</div>
                        <div class="number"><?php echo $totalArticles; ?></div>
                        <div class="indicator">
                            <!-- <i class='bx bx-up-arrow-alt'></i> -->
                            <!-- <span class="text">Up from yesterday</span> -->
                        </div>
                    </div>
                    <i class='bx bx-book cart two'></i>
                </div>

               <div class="box">
                    <div class="box-content">
                        <div class="box-topic">Total Engagements</div>
                        <div class="number"><?php echo $totalEngagements; ?></div>
                        <div class="indicator">
                            <!-- <i class='bx bx-up-arrow-alt'></i> -->
                            <!-- <span class="text">Up from yesterday</span> -->
                        </div>
                    </div>
                    <i class='bx bx-book cart three'></i>
                </div>

          
                <div class="box">
                    <div class="box-content">
                        <div class="box-topic">Total Ongoing Articles</div>
                        <div class="number"><?php echo $totalOngoingarticles; ?></div>
                        <div class="indicator">
                            <!-- <i class='bx bx-down-arrow-alt down'></i> -->
                            <!-- <span class="text">Down From Today</span> -->
                        </div>
                    </div>
                    <i class='bx bx-book cart four'></i>
                </div>
            </div>

            <!-- Doughnut chart containers in a single row -->
            <div class="container">
                <div class="row mb-2 justify-content-center text-center" >
                    <div class="col-md-4 mb-2">
                        <div class="chart-container" id="doughnutContainer1">
                            <div class="chart-title">Published Vs Not Published</div>
                            <canvas id="doughnutChart1"></canvas>
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="chart-container" id="doughnutContainer2">
                            <div class="chart-title">User Demographics</div>
                            <canvas id="doughnutChart2"></canvas>
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="chart-container" id="doughnutContainer3">
                            <div class="chart-title">Role Distribution</div>
                            <canvas id="doughnutChart3"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="chart-container" style="margin-top: -10px;">
                    <select id="yearDropdown">
                        <?php
                        foreach ($availableYears as $year) {
                            $selected = ($year == $selectedYear) ? 'selected' : '';
                            echo "<option value='$year' $selected>$year</option>";
                        }
                        ?>
                    </select>
                    <div class="chart-title">Article Engagement Based On Journal Type</div>
                    <canvas id="lineChart1"></canvas>
                    <div id="conditionalDiv" style="display: none;">Conditional Content</div>
                </div>
            </div>

            <div class="container">
                <div class="chart-container"  style="margin-top: -5px;">
                    <div class="chart-title">Article Engagement Based On User Demographics</div>
                    <canvas id="lineChart2"></canvas>
                </div>
            </div>

            <div class="container">
                <div class="chart-container"  style="margin-top: -5px;">
                    <div class="chart-title">Donations</div>
                    <canvas id="lineChart3"></canvas>
                </div>
            </div>
            
            <div class="container">
                <div class="chart-container" >
                    <div class="chart-title">Article Submission Per Quarter</div>
                    <canvas id="barChart"></canvas>
                </div>
            </div>
</div>
<!-- JavaScript for creating charts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Function to create a bar chart
    function createBarChart(chartId, data) {
        var ctx = document.getElementById(chartId).getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

    // Function to create a line chart
    function createLineChart(chartId, data) {
        // console.log(totalGavel, "hello")
        var ctx = document.getElementById(chartId).getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

    // Function to create a doughnut chart
    function createDoughnutChart(chartId, data) {
        var ctx = document.getElementById(chartId).getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

    // Function to fill data for all 12 months
    function fillDataForAllMonths(data) {
        var filledData = Array(12).fill(0); // Initialize array with zeros for all 12 months

        data.forEach(function (item) {
            filledData[item.month - 1] = item.monthly_reads; // Subtract 1 to match array index
        });

        return filledData;
    }

    // Create an array with data filled for all 12 months
    var dynamicData = fillDataForAllMonths(totalGavel);
    var dynamicData1 = fillDataForAllMonths(totalLamp);
    var dynamicData2 = fillDataForAllMonths(totalStar);

    // Data for the line chart
    var lineChartData1 = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'Novemeber', 'December'],
        datasets: [{
                label: 'Gavel',
                data: dynamicData,
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                fill: false
            },
            {
                label: 'Lamp',
                data: dynamicData1,
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                fill: false
            },
            {
                label: 'Star',
                data: dynamicData2,
                borderColor: 'rgba(255, 205, 86, 1)',
                borderWidth: 1,
                fill: false
            }
        ]
    };

    // Years for the dropdown list
    var years = ['2023', '2024', '2025'];

    // Populate the dropdown list with the selected year
    var dropdown = document.getElementById('yearDropdown');
    for (var i = 0; i < years.length; i++) {
        var option = document.createElement('option');
        option.value = years[i];
        option.text = years[i];

        // Set the selected attribute for the current year
        if (years[i] == <?php echo $selectedYear; ?>) {
            option.selected = true;
        }

        dropdown.add(option);
    }

    // Data for the line chart

    var lineChartData2 = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'Novemeber', 'December'],
        datasets: [{
                label: 'QCU',
                data: <?php echo  json_encode(array_column($qcuResult, 'count')); ?>,
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                fill: false
            },
            {
                label: 'FACULTY',
                data: <?php echo json_encode(array_column($facultyResult, 'count')); ?>,
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                fill: false
            },
            {
                label: 'OTHERS',
                data: <?php echo json_encode(array_column($othersResult, 'count')); ?>,
                borderColor: 'rgba(255, 205, 86, 1)',
                borderWidth: 1,
                fill: false
            }
        ]
    };

            // / Data for the line chart 3
            // Parse the JSON string to get the JavaScript object
    var lineChartData3 = JSON.parse('<?php echo $jsonResult3; ?>');
    // Use the parsed data for the chart
    var lineChartData3 = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        datasets: [{
            label: 'DONATIONS',
            data: <?php echo json_encode(array_column($result3, 'donation_count')); ?>,
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1,
            fill: false
        }]
    };


    // Data for the bar chart
    var barChartData = {
        labels: ['1st', '2nd', '3rd', '4th'],
        datasets: [{
                label: 'Gavel',
                data: [barChartData[0].q1_count, barChartData[0].q2_count, barChartData[0].q3_count, barChartData[0].q4_count],
                backgroundColor: 'rgba(75, 192, 192, 0.5)', // First color
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            },
            {
                label: 'Lamp',
                data: [barChartData[1].q1_count, barChartData[1].q2_count, barChartData[1].q3_count, barChartData[1].q4_count],
                backgroundColor: 'rgba(255, 99, 132, 0.5)', // Second color
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            },
            {
                label: 'Star',
                data: [barChartData[2].q1_count, barChartData[2].q2_count, barChartData[2].q3_count, barChartData[2].q4_count],
                backgroundColor: 'rgba(255, 205, 86, 0.5)', // Third color
                borderColor: 'rgba(255, 205, 86, 1)',
                borderWidth: 1
            }
        ]
    };

    // Data for Doughnut Chart 1
    var doughnutChartData1 = {
        labels: ['Not Published', 'Published'],
        datasets: [{
            data: [doughnutChartData1[0].not_published_count, doughnutChartData1[0].published_count],
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(75, 192, 192, 0.5)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(75, 192, 192, 1)',
            ],
            borderWidth: 1
        }]
    };

    // Data for Doughnut Chart 2
    var doughnutChartData2 = {
        labels: <?php echo json_encode(array_column($result2, 'position')); ?>,
        datasets: [{
            data: <?php echo json_encode(array_column($result2, 'position_count')); ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(255, 205, 86, 0.5)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(255, 205, 86, 1)'
            ],
            borderWidth: 1
        }]
    };


    // Data for Doughnut Chart 3
    var doughnutChartData3 = {
        labels: ['Author', 'Reviewer'],
        datasets: [{
            data: [contributorData[0].contributorCount, reviewerData[0].reviewerCount],
            backgroundColor: [
                'rgba(75, 192, 192, 0.5)',
                'rgba(255, 205, 86, 0.5)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(255, 205, 86, 1)'
            ],
            borderWidth: 1
        }]
    };

    // Create charts
    createLineChart('lineChart1', lineChartData1);
    createLineChart('lineChart2', lineChartData2);
    createLineChart('lineChart3', lineChartData3);
    createBarChart('barChart', barChartData);
    createDoughnutChart('doughnutChart1', doughnutChartData1);
    createDoughnutChart('doughnutChart2', doughnutChartData2);
    createDoughnutChart('doughnutChart3', doughnutChartData3);

</script>
<?php
// Fetch the top 5 contributors based on the "contributors" table
$contributorsQuery = "SELECT email, COUNT(email) AS email_count
                      FROM contributors
                      GROUP BY email
                      ORDER BY email_count DESC
                      LIMIT 5";

$contributorsResult = execute_query($contributorsQuery);

// Check if the query was successful
if ($contributorsResult !== false) {
    echo "<div class='container-fluid'>";
    echo "<div class='row'>";

    echo "<div class='col-md-12'>"; // Use the entire width for landscape shape
    echo "<div class='card mb-4'>";
    echo "<div class='card-header'>Top 5 Contributors </div>";
    echo "<div class='card-body'>";
    echo "<table class='table table-bordered table-striped' style='width: 100%;'>
                    <colgroup>
                        <col style='width: 60%;'> <!-- Adjusted width for Full Name -->
                        <col style='width: 20%;'> <!-- Adjusted width for Email Count -->
                    </colgroup>
                    <tr>
                        <th>Name</th>
                        <th>Contributes</th>
                    </tr>";

    $rowColor = 0; // Variable to alternate row colors
    foreach ($contributorsResult as $row) {
        $email = $row->email;
        // Fetch the full name of the contributor based on email
        $contributorNameQuery = "SELECT CONCAT(firstname, ' ', lastname) AS full_name FROM contributors WHERE email = '$email'";
        $contributorNameResult = execute_query($contributorNameQuery);

        // Check if the contributor name query was successful
        if ($contributorNameResult !== false && count($contributorNameResult) > 0) {
            $fullName = $contributorNameResult[0]->full_name;

            // Use different background colors for alternate rows
            $rowColorClass = ($rowColor % 2 == 0) ? 'even-row' : 'odd-row';

            echo "<tr class='$rowColorClass'>
                    <td>{$fullName}</td>
                    <td>{$row->email_count}</td>
                  </tr>";

            $rowColor++; // Increment for the next iteration
        }
    }

    echo "</table>";
    echo "</div>";
    echo "</div>";
    echo "</div>";

    echo "</div>"; // Close the row
    echo "</div>"; // Close the container
} else {
    echo "Error fetching contributors data. Error: " . execute_query_error();
}
?>


<?php
// Fetch the top 5 most viewed or downloaded articles based on the selected type
$selectedType = isset($_GET['type']) ? $_GET['type'] : 'read'; // Default to 'read' if not selected

$mostViewedQuery = "SELECT article_id, COUNT(*) AS count
                    FROM logs
                    WHERE type = '$selectedType'
                    GROUP BY article_id
                    ORDER BY count DESC
                    LIMIT 5";

$mostViewedResult = execute_query($mostViewedQuery);

// Check if the query was successful
if ($mostViewedResult !== false) {
    // Display the Most Viewed or Most Downloaded articles in a table
    echo "<div class='container-fluid'>";
    echo "<div class='row' style='margin-top: 10px;'>";

    echo "<div class='col-md-12'>";
    echo "<div class='card mb-4'>";
    echo "<div class='card-header'>
                Top 5 Most " . ucfirst($selectedType) . " Articles
            </div>
            <div class='card-body'>
                <form method='GET' action='' id='typeForm'>
                    <label for='type'>Select Type:</label>
                    <select name='type' id='type' onchange='updateType(event)' class='form-control'>
                        <option value='read' " . ($selectedType == 'read' ? 'selected' : '') . ">Most Viewed</option>
                        <option value='download' " . ($selectedType == 'download' ? 'selected' : '') . ">Most Downloaded</option>
                    </select>
                </form>
                <div class='table-responsive'>";

    echo "<table class='table table-bordered table-striped' style='width: 100%;'>
                    <colgroup>
                        <col style='width: 20%;'> <!-- Adjusted width for Article ID -->
                        <col style='width: 60%;'> <!-- Adjusted width for Title -->
                        <col style='width: 20%;'> <!-- Adjusted width for Count -->
                    </colgroup>
                    <thead class='thead-dark'>
                        <tr>
                            <th>Article ID</th>
                            <th>Title</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>";

    $rowColor = 0; // Variable to alternate row colors
    foreach ($mostViewedResult as $row) {
        $articleId = $row->article_id;
        $count = $row->count;

        // Fetch article details for each most viewed or downloaded article
        $articleQuery = "SELECT * FROM article WHERE article_id = $articleId";
        $articleResult = execute_query($articleQuery);

        // Check if the article query was successful
        if ($articleResult !== false && count($articleResult) > 0) {
            // Use different background colors for alternate rows
            $rowColorClass = ($rowColor % 2 == 0) ? 'even-row' : 'odd-row';

            echo "<tr class='$rowColorClass'>
                    <td>{$articleResult[0]->article_id}</td>
                    <td>{$articleResult[0]->title}</td>
                    <td>{$count}</td>
                  </tr>";

            $rowColor++; // Increment for the next iteration
        }
    }

    echo "</tbody>";
    echo "</table>";
    echo "</div>";
    echo "</div>";
    echo "</div>";

    echo "</div>"; // Close the row
    echo "</div>"; // Close the container
} else {
    echo "Error fetching most viewed or downloaded articles data.";
}
?>

<script>
function updateType() {
    // Prevent the default form submission behavior
    event.preventDefault();

    // Submit the form using JavaScript
    document.getElementById('typeForm').submit();
}
</script>


        <?php include 'template/footer.php'; ?>
    </div>

    <!-- Initialize DataTables -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        jQuery(document).ready(function($) {
            $('#DataTable').DataTable({
            });
        });
    </script>
    
</body>
</html>

