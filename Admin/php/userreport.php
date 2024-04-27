<?php
include 'function/redirect.php';
include 'function/report_function.php';

$userlist = get_userlist_data();
$userreportlist = get_user_data();
$userreportlist1 = get_user_data1();

$output_series = array();

$male_series = new stdClass();
$male_series->name = 'Male';
$male_series->data = array((int)$userreportlist->MaleCount);

$female_series = new stdClass();
$female_series->name = 'Female';
$female_series->data = array((int)$userreportlist->FemaleCount);

$others_series = new stdClass();
$others_series->name = 'Others';
$others_series->data = array((int)$userreportlist->Others);

$output_series[] = $male_series;
$output_series[] = $female_series;
$output_series[] = $others_series;

$seriesString = json_encode($output_series);

$output_series1 = array();

$student_series = new stdClass();
$student_series->name = 'Student';
$student_series->data = array((int)$userreportlist1->Student);

$faculty_series = new stdClass();
$faculty_series->name = 'Faculty';
$faculty_series->data = array((int)$userreportlist1->Faculty);

$others_series = new stdClass();
$others_series->name = 'Others';
$others_series->data = array((int)$userreportlist1->Others);

$output_series1[] = $student_series;
$output_series1[] = $faculty_series;
$output_series1[] = $others_series;

$seriesString1 = json_encode($output_series1);

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
        Others / <a href="../php/reportlist.php"> <span class="text-muted fw-light">&nbsp;Report /</span></a>&nbsp; User Report
            <span id="totalPublished" class="text-muted" style="margin-left: auto">
                <button type="button" class="btn btn-success" onclick="exportToExcel()">
                    Export &nbsp<i class="bx bx-download"></i>
                </button>
            </span>
        </h4>

        <div class="row mb-2">
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="row row-bordered g-0">
                        <div class="col-md-12 d-flex justify-content-between align-items-center">
                            <h5 class="card-header m-0 me-2 pb-3">User Gender</h5>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                    <a href="#" class="download-chart-btn dropdown-item" data-chart="totalRevenueChart">Download</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="width:100%;" id="totalRevenueChartDiv">
                            <div id="totalRevenueChart">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="row row-bordered g-0">
                        <div class="col-md-12 d-flex justify-content-between align-items-center">
                            <h5 class="card-header m-0 me-2 pb-3">User Position</h5>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                    <a href="#" class="download-chart-btn dropdown-item" data-chart="totalRevenueChart1">Download</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="width:100%;" id="totalRevenueChart1Div">
                            <div id="totalRevenueChart1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="table-responsive text-nowrap" id="nopadding">
                <table class="table table-striped" id="DataTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Affiliation</th>
                            <th>Expertise</th>
                            <th>Gender</th>
                            <th>Position</th>
                            <th>Donation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($userlist['userlist']) && count($userlist['userlist']) > 0) {
                            foreach ($userlist['userlist'] as $userlistval) {
                                ?>
                                <tr data-toggle="modal" data-target="">
                                    <td width="5%"><?php echo $userlistval->author_id; ?></td>
                                    <td width="25%"><?php echo $userlistval->last_name; ?>, <?php echo $userlistval->first_name; ?></td>
                                    <td width="10%"><?php echo $userlistval->email; ?></td>
                                    <td width="15%"><?php echo $userlistval->afiliations; ?></td>
                                    <td width="30%"><?php echo $userlistval->field_of_expertise; ?></td>
                                    <td width="5%"><?php echo $userlistval->gender; ?></td>
                                    <td width="5%"><?php echo $userlistval->position; ?></td>
                                    <td width="5%">₱<?php echo $userlistval->total_amount; ?></td> 
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

    <script>
        function generatePDF(chartContent, fileName) {
            const opt = {
                margin: 1,
                filename: fileName + '.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            };

            html2pdf()
                .set(opt)
                .from(chartContent)
                .save()
                .then(() => {
                });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const downloadBtns = document.querySelectorAll('.download-chart-btn');
            downloadBtns.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const chartId = btn.getAttribute('data-chart');
                    const chartContent = document.getElementById(chartId).innerHTML;
                    const cardHeader = btn.closest('.card').querySelector('.card-header');
                    if (cardHeader) {
                        const headerText = cardHeader.textContent.trim();
                        generatePDF(chartContent, headerText);
                    } else {
                        console.error('Card header not found.');
                    }
                });
            });
        });
    </script>

    <!-- DataTables initialization script -->
    <script>
        $(document).ready(function () {
            $('#DataTable').DataTable({
                "order": [[0, "desc"]] 
            });
        });

        function doset() {
            $('#sloading').show();
            var url = "userreport.php";

            window.location.href = url;
        }

        function exportToExcel() {
            var dataTable = $('#DataTable').DataTable();
            var data = dataTable.rows().data();

            var wsData = data.toArray().map(row => [row[0], row[1], row[2], row[3]]);

            var ws = XLSX.utils.aoa_to_sheet([["ID", "Name", "Gender", "Position"]].concat(wsData));

            var columnSizes = [{ wch: 15 },{ wch: 50 }, { wch: 25 }, { wch: 25 }]; 
            columnSizes.forEach((size, columnIndex) => {
                ws['!cols'] = ws['!cols'] || [];
                ws['!cols'][columnIndex] = size;
            });

            ws['!protect'] = true;

            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

            var filename = 'UserReport.xlsx';
            XLSX.writeFile(wb, filename);
        }

        (function() {
            let cardColor, headingColor, axisColor, shadeColor, borderColor;

            cardColor = config.colors.cardColor;
            headingColor = config.colors.headingColor;
            axisColor = config.colors.axisColor;
            borderColor = config.colors.borderColor;

            var seriesData = <?php echo $seriesString; ?>;
            console.log(seriesData);

            var seriesColors = ['#004e98', '#ff69b4', '#8592a3'];

            seriesData.forEach(function(series, index) {
                if (index < seriesColors.length) {
                    series.color = seriesColors[index];
                }
            });

            // Total Revenue Report Chart - Bar Chart
            // --------------------------------------------------------------------
            const totalRevenueChartEl = document.querySelector('#totalRevenueChart'),
                totalRevenueChartOptions = {
                    series: seriesData,
                    chart: {
                        height: 300,
                        stacked: true,
                        type: 'bar',
                        toolbar: {
                            show: false
                        }
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
                        categories: ['Gender',],
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
                    responsive: [{
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

        (function() {
            let cardColor, headingColor, axisColor, shadeColor, borderColor;

            cardColor = config.colors.cardColor;
            headingColor = config.colors.headingColor;
            axisColor = config.colors.axisColor;
            borderColor = config.colors.borderColor;

            var seriesData = <?php echo $seriesString1; ?>;
            console.log(seriesData);

            var seriesColors = ['#004e98', '#ffab00', '#8592a3'];

            seriesData.forEach(function(series, index) {
                if (index < seriesColors.length) {
                    series.color = seriesColors[index];
                }
            });

            // Total Revenue Report Chart - Bar Chart
            // --------------------------------------------------------------------
            const totalRevenueChartEl = document.querySelector('#totalRevenueChart1'),
                totalRevenueChartOptions = {
                    series: seriesData,
                    chart: {
                        height: 300,
                        stacked: true,
                        type: 'bar',
                        toolbar: {
                            show: false
                        }
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
                        categories: ['Position',],
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
                    responsive: [{
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
                const totalRevenueChart1 = new ApexCharts(totalRevenueChartEl, totalRevenueChartOptions);
                totalRevenueChart1.render();
            }
        })();
    </script>
</body>
</html>
