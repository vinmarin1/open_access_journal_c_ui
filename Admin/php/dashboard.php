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
                                    <i class='bx bxs-cloud-download cart two'></i>
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
                    <select id="yearDropdown"></select>
                    <div class="chart-title">Article Engagement Based On Journal Type</div>
                    <canvas id="lineChart1"></canvas>
                    <div id="conditionalDiv" style="display: none;">Conditional Content</div>
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
            data: [60, 40, 70, 50, 80, 30, 40, 45, 60, 75, 80, 30],
            borderColor: 'rgba(255, 205, 86, 1)',
            borderWidth: 1,
            fill: false
        }
    ]
};
        
          // Years for the dropdown list
        var years = ['2023', '2024', '2025'];

        // Populate the dropdown list
        var dropdown = document.getElementById('yearDropdown');
        for (var i = 0; i < years.length; i++) {
            var option = document.createElement('option');
            option.value = years[i];
            option.text = years[i];
            dropdown.add(option);
        }



        // Data for the line chart
        var lineChartData2 = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'Novemeber', 'December'],
            datasets: [{
                  label: 'Gavel',
            data: [50, 30, 60, 40, 70, 20, 30, 35, 50, 65, 70, 20],
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1,
            fill: false
        },
        {
            label: 'Lamp',
            data: [40, 20, 50, 30, 60, 10, 20, 25, 40, 55, 60, 10],
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1,
            fill: false
        },
        {
            label: 'Star',
            data: [60, 40, 70, 50, 80, 30, 40, 45, 60, 75, 80, 30],
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
        data: [50, 30, 60, 40],
        backgroundColor: 'rgba(75, 192, 192, 0.5)', // First color
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
    }, {
        label: 'Lamp',
        data: [70, 20, 30, 35],
        backgroundColor: 'rgba(255, 99, 132, 0.5)', // Second color
        borderColor: 'rgba(255, 99, 132, 1)',
        borderWidth: 1
    }, {
        label: 'Star',
        data: [50, 65, 70, 20],
        backgroundColor: 'rgba(255, 205, 86, 0.5)', // Third color
        borderColor: 'rgba(255, 205, 86, 1)',
        borderWidth: 1
    }]
};
        // Data for Doughnut Chart 1
        var doughnutChartData1 = {
                    labels: ['Not Published', 'Published'],
                    datasets: [{
                        data: [50, 100],
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
                    labels: ['Qcu', 'Faculty', 'Others'],
                    datasets: [{
                        data: [300, 50, 100],
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
