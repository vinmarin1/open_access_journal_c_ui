<?php
include 'function/redirect.php';
include 'function/dashboard_function.php';
$submissionlist = get_journalsubmission();  
$comparisonlist = get_submissioncomparison();
$usercount = get_usercount();
$publishedcount = get_publishedcount();
$engagementcount = get_engagementcount();
$ongoingcount = get_ongoingcount();

if ($submissionlist) {
    $datasets = [];

    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    $colors = [
        '#004e98',
        '#8592a3',
        '#71dd37',
        '#03c3ec',
        '#ffab00',
        '#ff3e1d',
        '#233446' 
    ];

    shuffle($colors);

    $journalDatasets = [];

    foreach ($submissionlist as $submission) {
        $journalId = $submission->journal_id;
        $journalLabel = $submission->journal;

        if (!isset($journalDatasets[$journalId])) {
            $backgroundColor = array_shift($colors);

            $journalDatasets[$journalId] = [
                'label' => $journalLabel,
                'data' => array_fill(0, 12, 0),
                'backgroundColor' => $backgroundColor,
                'borderColor' => 'rgba(255, 255, 255, 1)', 
                'borderWidth' => 1
            ];
        }

        $monthIndex = (int)substr($submission->month_added, 5, 2) - 1;
        $articleCount = (int)$submission->article_count;

        $journalDatasets[$journalId]['data'][$monthIndex] = $articleCount;
    }

    foreach ($journalDatasets as $dataset) {
        $datasets[] = $dataset;
    }

    $datasets_json1 = json_encode($datasets);
} else {
    $datasets_json1 = '[]'; 
}

if ($comparisonlist) {
    $datasets = [];

    $publishedData = [];
    $rejectedData = [];
    $ongoingData = [];
    $months = [];

    for ($i = 1; $i <= 12; $i++) {
        $months[] = date('M', mktime(0, 0, 0, $i, 1));
        $publishedData[] = 0;
        $rejectedData[] = 0;
        $ongoingData[] = 0;
    }

    foreach ($comparisonlist as $row) {
        $monthIndex = date('n', strtotime($row->month_added)) - 1;
        $publishedData[$monthIndex] = $row->published_count;
        $rejectedData[$monthIndex] = $row->rejected_count;
        $ongoingData[$monthIndex] = $row->ongoing_count;
    }

    $datasets[] = [
        'label' => 'Published',
        'data' => $publishedData,
        'backgroundColor' => '#71dd37',
        'borderColor' => 'rgba(75, 192, 192, 1)',
        'borderWidth' => 1
    ];

    $datasets[] = [
        'label' => 'Ongoing',
        'data' => $ongoingData,
        'backgroundColor' => '#ffab00',
        'borderColor' => 'rgba(255, 159, 64, 1)',
        'borderWidth' => 1
    ];

    $datasets[] = [
        'label' => 'Reject',
        'data' => $rejectedData,
        'backgroundColor' => '#ff3e1d',
        'borderColor' => 'rgba(255, 99, 132, 1)',
        'borderWidth' => 1
    ];

    $datasets_json2 = json_encode($datasets);
} else {
    $datasets_json2 = '[]';
}

?>
<!DOCTYPE html>
<html lang="en">
    <body>

        <?php include 'template/header.php'; ?>
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <div class="col-lg-9 col-md-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5 class="card-title mb-2">Journal Submission</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="dropdown" style="margin-right: -10px;">
                                            <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <canvas id="myChart" width="400" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div>
                                        <span class="fw-semibold d-block mb-1">Active Users</span>
                                        <h3 class="card-title mb-2"><?php echo isset($usercount[0]->user_count) ? $usercount[0]->user_count : '0'; ?></h3>
                                    </div>
                                    <div class="avatar flex-shrink-0" style="width:25%; height:25%; margin-left:30px;">
                                        <img src="../assets/img/icons/unicons/users-alt.svg" alt="chart success" class="rounded" />
                                    </div>
                                    <div class="dropdown" style="margin-right: -10px;">
                                        <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div>
                                        <span class="fw-semibold d-block mb-1">Published Articles</span>
                                        <h3 class="card-title mb-2"><?php echo isset($publishedcount[0]->article_count) ? $publishedcount[0]->article_count : '0'; ?></h3>
                                    </div>
                                    <div class="avatar flex-shrink-0" style="width:25%; height:25%;">
                                        <img src="../assets/img/icons/unicons/document-layout-left.svg" alt="chart success" class="rounded" />
                                    </div>
                                    <div class="dropdown" style="margin-right: -10px;">
                                        <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                            <a class="dropdown-item" href="">View More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="row">
                    <div class="col-lg-9 col-md-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5 class="card-title mb-2">Submission Comparison</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="dropdown" style="margin-right: -10px;">
                                            <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <canvas id="myChart2" width="400" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div>
                                        <span class="fw-semibold d-block mb-1">Users Engagement</span>
                                        <h3 class="card-title mb-2"><?php echo isset($engagementcount[0]->engagement_count) ? $engagementcount[0]->engagement_count : '0'; ?></h3>
                                    </div>
                                    <div class="avatar flex-shrink-0" style="width:25%; height:25%;">
                                        <img src="../assets/img/icons/unicons/book-reader.svg" alt="chart success" class="rounded" />
                                    </div>
                                    <div class="dropdown" style="margin-right: -10px;">
                                        <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                            <a class="dropdown-item" href="totalreport.php?y=<?php echo date('Y'); ?>">View More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div>
                                        <span class="fw-semibold d-block mb-1">Ongoing Articles</span>
                                        <h3 class="card-title mb-2"><?php echo isset($ongoingcount[0]->article_count) ? $ongoingcount[0]->article_count : '0'; ?></h3>
                                    </div>
                                    <div class="avatar flex-shrink-0" style="width:25%; height:25%; margin-left:30px;">
                                        <img src="../assets/img/icons/unicons/monitor-heart-rate.svg" alt="chart success" class="rounded" />
                                    </div>
                                    <div class="dropdown" style="margin-right: -10px;">
                                        <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>
</div>
    <?php include 'template/footer.php'; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var data1 = <?php echo $datasets_json1; ?>;
    const barChartData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: data1
    };

    const barChartOptions = {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    };

    const barCtx = document.getElementById('myChart').getContext('2d');

    const barChart = new Chart(barCtx, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
    });
</script>
<script>
    var data2 = <?php echo $datasets_json2; ?>;
    const lineChartData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: data2
    };

    const lineChartOptions = {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    };

    const lineCtx = document.getElementById('myChart2').getContext('2d');

    const lineChart = new Chart(lineCtx, {
        type: 'line',
        data: lineChartData,
        options: lineChartOptions
    });
</script>
