<?php
include 'function/redirect.php';
include 'function/report_function.php';

$topcontributorslist = get_topcontributors_list();
$top5contributorslist = get_top5contributors_list();
// print_r($top5contributorslist );exit;
$contributorsreport = get_contributorsgraph();
$seriesData = [];
foreach ($contributorsreport['contributorsforgraph'] as $contributors) {
    $year = $contributors->year_number;
    $month = intval(substr($contributors->month, -1)); // Extract month number from "Month X"
    $total_contributes = intval($contributors->total_contributes); // Ensure total_donation is converted to an integer
    
    if (!isset($seriesData[$year])) {
        $seriesData[$year] = [
            'name' => $year,
            'data' => array_fill(0, 12, 0)
        ];
    }

    // Update the total donation for the corresponding month
    if ($month >= 1 && $month <= 12) {
        $seriesData[$year]['data'][$month - 1] += $total_contributes; // Accumulate total donations
    }

    // Ensure that negative total donation values are included correctly
    if ($total_contributes < 0 && $month >= 1 && $month <= 12) {
        $seriesData[$year]['data'][$month - 1] = $total_contributes;
    }
}

// Convert the associative array to a simple array
$series = array_values($seriesData);
$seriesString = json_encode($series);
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
            Others / <a href="../php/reportlist.php"> <span class="text-muted fw-light">&nbsp;Report /</span></a>&nbsp; Top Contributors
            <span id="totalPublished" class="text-muted" style="margin-left: auto">
                <button type="button" class="btn btn-success" onclick="exportToExcel()">
                    Export &nbsp<i class="bx bx-download"></i>
                </button>
            </span>
        </h4>

                <!-- Order Statistics -->
                <div class="row mb-2">
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="row row-bordered g-0">
                        <div class="col-md-12">
                        <h5 class="card-header m-0 me-2 pb-3">Year Report</h5>
                        <div id="totalRevenueChart" class="px-2"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3" id="nomargin">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <h5 class="m-0 me-2">The top 5 contributors for <span id="currentMonth"></span></h5>
                        </div>
                            </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                            </div>
                            <?php
                            if (isset($top5contributorslist['top5contributorslist']) && count($top5contributorslist['top5contributorslist']) > 0) {
                                    foreach ($top5contributorslist['top5contributorslist'] as $top5contributorslistval) {
                                        ?>
                        <ul class="p-0 m-0">
                            <li class="d-flex mb-3 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-mobile-alt"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="">
                                    <h6 class="mb-0"><?php echo $top5contributorslistval->lastname; ?>, <?php echo $top5contributorslistval->firstname; ?></h6>
                                    </div>
                                    <div class="user-progress">
                                    <small class="fw-semibold"><?php echo $top5contributorslistval->email_count; ?></small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <?php
                                    }
                                }
                                ?>
                    </div>
                </div>
            </div>  
        </div>  

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
        var currentDate = new Date();

        var monthNames = [
            "January", "February", "March",
            "April", "May", "June", "July",
            "August", "September", "October",
            "November", "December"
        ];

        var currentMonth = monthNames[currentDate.getMonth()];
        document.getElementById("currentMonth").textContent = currentMonth;

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

        (function () {
            let cardColor, headingColor, axisColor, shadeColor, borderColor;

            cardColor = config.colors.cardColor;
            headingColor = config.colors.headingColor;
            axisColor = config.colors.axisColor;
            borderColor = config.colors.borderColor;
            var seriesData = <?php echo $seriesString; ?>;
            console.log(seriesData);
            
            // Total Revenue Report Chart - Bar Chart
            // --------------------------------------------------------------------
            const totalRevenueChartEl = document.querySelector('#totalRevenueChart'),
                totalRevenueChartOptions = {
            series: seriesData,
                chart: {
                    height: 300,
                    stacked: true,
                    type: 'bar',
                    toolbar: { show: false }
                },
                plotOptions: {
                    bar: {
                    horizontal: false,
                    columnWidth: '33%',
                    borderRadius: 12,
                    startingShape: 'rounded',
                    endingShape: 'rounded'
                    }
                },
                colors: [config.colors.primary, config.colors.info],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 6,
                    lineCap: 'round',
                    colors: [cardColor]
                },
                legend: {
                    show: true,
                    horizontalAlign: 'left',
                    position: 'top',
                    markers: {
                    height: 8,
                    width: 8,
                    radius: 12,
                    offsetX: -3
                    },
                    labels: {
                    colors: axisColor
                    },
                    itemMargin: {
                    horizontal: 10
                    }
                },
                grid: {
                    borderColor: borderColor,
                    padding: {
                    top: 0,
                    bottom: -8,
                    left: 20,
                    right: 20
                    }
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Noc', 'Dec'],
                    labels: {
                    style: {
                        fontSize: '13px',
                        colors: axisColor
                    }
                    },
                    axisTicks: {
                    show: false
                    },
                    axisBorder: {
                    show: false
                    }
                },
                yaxis: {
                    labels: {
                    style: {
                        fontSize: '13px',
                        colors: axisColor
                    }
                    }
                },
                responsive: [
                    {
                    breakpoint: 1700,
                    options: {
                        plotOptions: {
                        bar: {
                            borderRadius: 10,
                            columnWidth: '32%'
                        }
                        }
                    }
                    },
                    {
                    breakpoint: 1580,
                    options: {
                        plotOptions: {
                        bar: {
                            borderRadius: 10,
                            columnWidth: '35%'
                        }
                        }
                    }
                    },
                    {
                    breakpoint: 1440,
                    options: {
                        plotOptions: {
                        bar: {
                            borderRadius: 10,
                            columnWidth: '42%'
                        }
                        }
                    }
                    },
                    {
                    breakpoint: 1300,
                    options: {
                        plotOptions: {
                        bar: {
                            borderRadius: 10,
                            columnWidth: '48%'
                        }
                        }
                    }
                    },
                    {
                    breakpoint: 1200,
                    options: {
                        plotOptions: {
                        bar: {
                            borderRadius: 10,
                            columnWidth: '40%'
                        }
                        }
                    }
                    },
                    {
                    breakpoint: 1040,
                    options: {
                        plotOptions: {
                        bar: {
                            borderRadius: 11,
                            columnWidth: '48%'
                        }
                        }
                    }
                    },
                    {
                    breakpoint: 991,
                    options: {
                        plotOptions: {
                        bar: {
                            borderRadius: 10,
                            columnWidth: '30%'
                        }
                        }
                    }
                    },
                    {
                    breakpoint: 840,
                    options: {
                        plotOptions: {
                        bar: {
                            borderRadius: 10,
                            columnWidth: '35%'
                        }
                        }
                    }
                    },
                    {
                    breakpoint: 768,
                    options: {
                        plotOptions: {
                        bar: {
                            borderRadius: 10,
                            columnWidth: '28%'
                        }
                        }
                    }
                    },
                    {
                    breakpoint: 640,
                    options: {
                        plotOptions: {
                        bar: {
                            borderRadius: 10,
                            columnWidth: '32%'
                        }
                        }
                    }
                    },
                    {
                    breakpoint: 576,
                    options: {
                        plotOptions: {
                        bar: {
                            borderRadius: 10,
                            columnWidth: '37%'
                        }
                        }
                    }
                    },
                    {
                    breakpoint: 480,
                    options: {
                        plotOptions: {
                        bar: {
                            borderRadius: 10,
                            columnWidth: '45%'
                        }
                        }
                    }
                    },
                    {
                    breakpoint: 420,
                    options: {
                        plotOptions: {
                        bar: {
                            borderRadius: 10,
                            columnWidth: '52%'
                        }
                        }
                    }
                    },
                    {
                    breakpoint: 380,
                    options: {
                        plotOptions: {
                        bar: {
                            borderRadius: 10,
                            columnWidth: '60%'
                        }
                        }
                    }
                    }
                ],
                states: {
                    hover: {
                    filter: {
                        type: 'none'
                    }
                    },
                    active: {
                    filter: {
                        type: 'none'
                    }
                    }
                }
                };
            if (typeof totalRevenueChartEl !== undefined && totalRevenueChartEl !== null) {
                const totalRevenueChart = new ApexCharts(totalRevenueChartEl, totalRevenueChartOptions);
                totalRevenueChart.render();
            }
    })();
    </script>
</body>
</html>
