<?php
include 'function/redirect.php';
include 'function/report_function.php';

$yearval = isset($_GET['y']) ? $_GET['y'] : date('Y');

$counterlist = get_counter_list($yearval);
$totalreport = get_totalreportforgraph($yearval);
$seriesData = [
    'read' => ['name' => 'read', 'data' => array_fill(0, 12, 0)],
    'downloaded' => ['name' => 'downloaded', 'data' => array_fill(0, 12, 0)],
    'citation' => ['name' => 'citation', 'data' => array_fill(0, 12, 0)],
    'support' => ['name' => 'support', 'data' => array_fill(0, 12, 0)]
];

foreach ($totalreport['totalreportforgraph'] as $totalreport) {
    $month = intval(substr($totalreport->month, -1));
    $total_read = intval($totalreport->total_read);
    $total_download = intval($totalreport->total_download);
    $total_citation = intval($totalreport->total_citation);
    $total_support = intval($totalreport->total_support);

    if ($month >= 1 && $month <= 12) {
        $seriesData['read']['data'][$month - 1] += $total_read; 
        $seriesData['downloaded']['data'][$month - 1] += $total_download; 
        $seriesData['citation']['data'][$month - 1] += $total_citation; 
        $seriesData['support']['data'][$month - 1] += $total_support; 
    }
}

foreach ($seriesData as &$data) {
    foreach ($data['data'] as &$value) {
        if ($value < 0) {
            $value = abs($value);
        }
    }
}

$seriesData = array_values($seriesData);
$seriesString = json_encode($seriesData);
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
        Others / <a href="../php/reportlist.php"> <span class="text-muted fw-light">&nbsp;Report /</span></a>&nbsp; Article Report
            <span id="totalPublished" class="text-muted" style="margin-left: auto">
                <button type="button" class="btn btn-success" onclick="exportToExcel()">
                    Export &nbsp<i class="bx bx-download"></i>
                </button>
            </span>
        </h4>

        <div class="row mb-2">
            <div class="col-md-12 mb-2">
                <form id="reportForm">
                    <select class="form-select" onchange="doset(this.value)" name="yearval" id="yearval">
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
            </form>
        </div>

        <div class="col-12 mb-4">
            <div class="card">
                <div class="row row-bordered g-0">
                    <div class="col-md-12">
                        <h5 class="card-header m-0 me-2 pb-3">Article Engagement</h5>
                        <div id="totalRevenueChart" class="px-2"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="table-responsive text-nowrap" id="nopadding">
                <table class="table table-striped" id="DataTable">
                    <thead>
                        <tr>
                            <th>Article ID</th>
                            <th>Title</th>
                            <th>Read</th>
                            <th>Download</th>
                            <th>Citation</th>
                            <th>Support</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($counterlist['counterlist']) && count($counterlist['counterlist']) > 0) {
                            foreach ($counterlist['counterlist'] as $counterlistval) {
                                ?>
                                <tr data-toggle="modal" data-target="">
                                    <td width="5%"><?php echo $counterlistval->article_id; ?></td>
                                    <td width="75%"><?php echo $counterlistval->title; ?></td>
                                    <td width="5%"><?php echo $counterlistval->read_count; ?></td>
                                    <td width="5%"><?php echo $counterlistval->download_count; ?></td>
                                    <td width="5%"><?php echo $counterlistval->citation_count; ?></td>
                                    <td width="5%"><?php echo $counterlistval->support_count; ?></td>
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

        function doset(yearval) {
            $('#sloading').show();
            var url = "totalreport.php?y=" + yearval;

            window.location.href = url;
        }

        function exportToExcel() {
            var dataTable = $('#DataTable').DataTable();
            var data = dataTable.rows().data();

            var wsData = data.toArray().map(row => [row[0], row[1], row[2], row[3]]);

            var ws = XLSX.utils.aoa_to_sheet([["Article ID", "Title", "Read", "Download"]].concat(wsData));

            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');
 
            var yearval = <?php echo json_encode($yearval); ?>;

            var filename = 'ArticleCounter' + yearval + '.xlsx';
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
                    colors: ['#71dd37', '#ffab00', '#ff3e1d', '#004e98'],
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
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
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
    </script>
</body>
</html>
