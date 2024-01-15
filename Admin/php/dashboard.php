<?php
include 'function/dashboard_functions.php';


?>
<!DOCTYPE html>
<link rel="stylesheet" href="../css/stylesheet1.css?<?php echo time(); ?>">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<html lang="en">
<body>
    <!-- Include header -->
    <?php include 'template/header.php'; ?>
 <br> <br> 
    <div class="home-content">
            <div class="overview-boxes">
                <div class="box">
                    <div class="left-side">
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
                            <div class="left-side">
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
                        <div class="left-side">
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
                            <div class="left-side">
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

                            

                            
                            
                            
                          <style>
        .increase {
                color: green; /* Set your desired color for positive percentages */
            }

     .decrease {
                color: red; /* Set your desired color for negative percentages */
            }
        .chart-container {
            width: 750px;
            height: 450px;
            margin: 20px;
            background: white;
        }

        #doughnutContainer1,
        #doughnutContainer2,
        #doughnutContainer3 {
            width: 340px;
            height: 380px;
            margin: 20px;
            position: absolute;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        #doughnutContainer1 {
            top: 260px;
            right: 100px;
        }

        #doughnutContainer2 {
            top: 700px;
            right: 100px;
        }

        #doughnutContainer3 {
            top: 1180px;
            right: 100px;
        }

        #yearDropdown {
            top: 10px;
            right: 10px;
        }

        .chart-title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
            <!-- Your existing HTML code -->

                 <!-- Chart containers -->
                <div class="chart-container">
                    <select id="yearDropdown">
                    <?php
                // PHP code for dynamically populating the year dropdown
                // This assumes you have executed the previous PHP code snippet to fetch available years
                foreach ($availableYears as $year) {
                    $selected = ($year == $selectedYear) ? 'selected' : '';
                    echo "<option value='$year' $selected>$year</option>";
                }
                ?>
                    </select>
                    <div class="chart-title">Article Engagement Based On Journal Type</div>
                    <canvas id="lineChart1"></canvas>
                    <div id="conditionalDiv" style="display: none;">Conditional Content</div>
                    <!-- Add a dropdown for selecting the type -->

                    <!-- Add canvas elements for the charts -->
                </div> 
                <div class="chart-container">
                    <div class="chart-title">Article Engagement Based On User Demographics</div>
                    <canvas id="lineChart2"></canvas>
                </div>
                <div class="chart-container">
                    <div class="chart-title">Article Submission Per Quarter</div>
                    <canvas id="barChart"></canvas>
                </div>       
                        
                <div id="doughnutContainer1">
                    <div class="chart-title">Published Vs Not Published</div>
                    <canvas id="doughnutChart1"></canvas>
                </div>
                <div id="doughnutContainer2">
                    <div class="chart-title">User Demographics</div>
                    <canvas id="doughnutChart2"></canvas>
                </div>
                <div id="doughnutContainer3">
                    <div class="chart-title">Role Distribution</div>
                    <canvas id="doughnutChart3"></canvas>
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
            });
        }

        // Function to create a line chart
        function createLineChart(chartId, data) {
            console.log(totalGavel,"hello")
            var ctx = document.getElementById(chartId).getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: data,
                
            });
        }

        // Function to create a doughnut chart
        function createDoughnutChart(chartId, data) {
            var ctx = document.getElementById(chartId).getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: data,
            });
        }

    //     function updateGraph() {
    //     var selectedType = document.getElementById("logType").value;

    //     // Update the data and redraw the corresponding chart
    //     if (selectedType === 'read') {
    //         updateChart(readsData, 'Monthly Reads', 'blue');
    //     } else if (selectedType === 'download') {
    //         updateChart(downloadsData, 'Monthly Downloads', 'green');
    //     }
    // }
    // function updateChart(data, label, color) {
    //     var ctx = document.getElementById(selectedType + 'Chart').getContext('2d');
    //     var chart = new Chart(ctx, {
    //         type: 'line',
    //         data: {
    //             labels: Object.keys(data),
    //             datasets: [{
    //                 label: label,
    //                 data: Object.values(data),
    //                 borderColor: color,
    //                 borderWidth: 2,
    //                 fill: false
    //             }]
    //         }
    //     });

        // Function to fill data for all 12 months
        function fillDataForAllMonths(data) {
            var filledData = Array(12).fill(0); // Initialize array with zeros for all 12 months

            data.forEach(function (item) {
                filledData[item.month - 1] = item.monthly_reads ; // Subtract 1 to match array index
            });
            
            return filledData;
            
        }

        // Create an array with data filled for all 12 months
        var dynamicData = fillDataForAllMonths(totalGavel);
        var dynamicData1 = fillDataForAllMonths(totalLamp);
        var dynamicData2 = fillDataForAllMonths(totalStar);
        console.log(dynamicData)

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
        
<!-- Years for the dropdown list -->
var years = ['2023', '2024', '2025'];

<!-- Populate the dropdown list with the selected year -->
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
                datasets: [
                    {
                        label: 'QCU',
                        data: [" . getChartDataArray($qcuResult) . "],
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                        fill: false
                    },
                    {
                        label: 'FACULTY',
                        data: [" . getChartDataArray($facultyResult) . "],
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        fill: false
                    },
                    {
                        label: 'OTHERS',
                        data: [" . getChartDataArray($othersResult) . "],
                        borderColor: 'rgba(255, 205, 86, 1)',
                        borderWidth: 1,
                        fill: false
                    }
                ]
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
                }, {
                    label: 'Lamp',
                    data: [barChartData[1].q1_count, barChartData[1].q2_count, barChartData[1].q3_count, barChartData[1].q4_count],
                    backgroundColor: 'rgba(255, 99, 132, 0.5)', // Second color
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }, {
                    label: 'Star',
                    data: [barChartData[2].q1_count, barChartData[2].q2_count, barChartData[2].q3_count, barChartData[2].q4_count],
                    backgroundColor: 'rgba(255, 205, 86, 0.5)', // Third color
                    borderColor: 'rgba(255, 205, 86, 1)',
                    borderWidth: 1
                }]
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
                    labels: <?php echo json_encode(array_column($result, 'position')); ?>,
                    datasets: [{
                        data: <?php echo json_encode(array_column($result, 'position_count')); ?>,
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
                    labels: [ 'Author', 'Reviewer'],
                    datasets: [{
                        data: [ 50, 100],
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
                createBarChart('barChart', barChartData);
                createDoughnutChart('doughnutChart1', doughnutChartData1);
                createDoughnutChart('doughnutChart2', doughnutChartData2);
                createDoughnutChart('doughnutChart3', doughnutChartData3);
                
        </script>

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
    // Display the most viewed or downloaded articles and Top 5 Authors in a row
    echo "<div class='container-fluid'>";
    echo "<div class='row'>";

    // First Card (Most Viewed or Most Downloaded)
    echo "<div class='col-md-6'>";
    echo "<div class='card mb-4'>";
    echo "<div class='card-header'>
                Top 5 Most " . ucfirst($selectedType) . " Articles
            </div>
            <div class='card-body'>
                <form method='GET' action=''>
                    <label for='type'>Select Type:</label>
                    <select name='type' id='type' onchange='this.form.submit()'>
                        <option value='read' " . ($selectedType == 'read' ? 'selected' : '') . ">Most Viewed</option>
                        <option value='download' " . ($selectedType == 'download' ? 'selected' : '') . ">Most Downloaded</option>
                    </select>
                </form>
                <div class='table-responsive'>";

    echo "<table class='table table-bordered' style='width: 100%;'>
                    <colgroup>
                        <col style='width: 10%;'>
                        <col style='width: 20%;'>
                        <col style='width: 10%;'>
                    </colgroup>
                    <tr>
                        <th>Article ID</th>
                        <th>Title</th>
                        <th>Count</th>
                    </tr>";

    foreach ($mostViewedResult as $row) {
        $articleId = $row->article_id;
        $count = $row->count;

        // Fetch article details for each most viewed or downloaded article
        $articleQuery = "SELECT * FROM article WHERE article_id = $articleId";
        $articleResult = execute_query($articleQuery);

        // Check if the article query was successful
        if ($articleResult !== false && count($articleResult) > 0) {
            echo "<tr>
                    <td>{$articleResult[0]->article_id}</td>
                    <td>{$articleResult[0]->title}</td>
                    <td>{$count}</td>
                  </tr>";
        }
    }

    // Assuming you have a function execute_query() for executing SQL queries

// Create an error handling function
function execute_query_error() {
    // Implement this function based on how your execute_query() handles errors
    // You can use error_get_last() or any other method to get the error details
    // Example:
    $error = error_get_last();
    return $error ? $error['message'] : '';
}

// Specify the author_id for which you want to fetch the top 5 authors
$authorId = "author_id"; // Replace with the desired author_id

// Fetch the top 5 authors based on the count of publications
$query = "SELECT author, COUNT(*) AS publication_count
          FROM article
          WHERE author_id = $authorId
          GROUP BY author
          ORDER BY publication_count DESC
          LIMIT 5";

$result = execute_query($query);

    echo "</table>
          </div>
        </div>
      </div>";
    echo "</div>"; // Close the first column

    // Second Card (Top 5 Authors) - Moved to the right and aligned to the top
    echo "<div class='col-md-6'>";
    echo '<div class="card mb-4 float-end" style="width: 100%;">';
    echo '<div class="card-header">Top 5 Authors based on Publications</div>';
    echo '<div class="card-body">';
    echo '<table class="table table-bordered" style="width: 100%;">';
    echo '<tr>
                <th>Author</th>
                <th>Publication Count</th>
              </tr>';

    foreach ($result as $row) {
        echo "<tr>
                    <td>{$row->author}</td>
                    <td>{$row->publication_count}</td>
                  </tr>";
    }

    echo '</table>';
    echo '</div>';
    echo '</div>';  
    echo "</div>"; // Close the second column

    echo "</div>"; // Close the row
    echo "</div>"; // Close the container
} else {
    echo "Error fetching most viewed or downloaded articles data.";
}
?>
















         

        <!-- Include footer -->
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
