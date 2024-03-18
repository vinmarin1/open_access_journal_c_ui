<?php
include 'function/redirect.php';
include 'function/editor_dashboard.php';
if(isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true){
    $journal_id = isset($_SESSION['journal_id']) ? ($_SESSION['journal_id']) : '';
}

$submissionlist = get_journalsubmission($journal_id);  
$comparisonlist = get_submissioncomparison($journal_id);
$usercount = get_usercount();
$publishedcount = get_publishedcount($journal_id);
$engagementcount = get_engagementcount();
$ongoingcount = get_ongoingcount($journal_id);
$userdemographicslist = get_userdemographics();
$donationamount = get_donationamount();
// $top5contributorslist = get_top5contributors_list();s
// $top5reviewerlist = get_top5reviewer_list();
// $top5downloadedlist = get_top5downloadedlist();

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

// User Demographics
$ageGroups = ['1-17', '18-24', '25-34', '35-44', '44+'];
$data = array_fill_keys($ageGroups, 0);
foreach ($userdemographicslist as $row) {
    $ageGroup = $row->age_group;
    $count = $row->count; 
    $data[$ageGroup] = $count;
}

$barData = [];

foreach ($ageGroups as $ageGroup) {
    $barData[] = $data[$ageGroup];
}

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

$barChartData1 = [
    'datasets' => [],
    'labels' => $ageGroups,
];

foreach ($ageGroups as $index => $ageGroup) {
    $barChartData1['datasets'][] = [
        'label' => $ageGroup,
        'data' => [], 
        'backgroundColor' => $colors[$index], 
        'borderColor' => 'rgba(255, 99, 132, 1)',
        'borderWidth' => 1
    ];
    
    foreach ($userdemographicslist as $row) {
        if ($row->age_group === $ageGroup) {
            $barChartData1['datasets'][$index]['data'][] = $row->count;
        } else {
            $barChartData1['datasets'][$index]['data'][] = 0; 
        }
    }
}

$barChartData1Json = json_encode($barChartData1);

$donationamount = get_donationamount();

$dates = [];
$amounts = [];

foreach ($donationamount as $donation) {
    $date = substr($donation['month'], 6, 3);
    $dates[] = $date;
    $amounts[] = $donation['total_donation'];
}

$donationData = [];
foreach ($dates as $index => $date) {
    $donationData[] = [
        'date' => $date,
        'amount' => $amounts[$index]
    ];
}

$donationDataJson = json_encode($donationData);

?>
<!DOCTYPE html>
<html lang="en">
<style>
#myChart {
    width: 100% !important;
    height: 100% !important;
    max-height: 200px !important;
}
#myChart2 {
    width: 100% !important;
    height: 100% !important;
    max-height: 200px !important;
}
#myChart3 {
    width: 100% !important;
    height: 100% !important;
    max-height: 200px !important;
}
#donationChart {
    width: 100% !important;
    height: 100% !important;
    max-height: 200px !important;
}
</style>
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
                                                <a class="dropdown-item" href="journalreport.php" target="_blank">View More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <canvas id="myChart"></canvas>
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
                                            <a class="dropdown-item" href="totalpublished.php?m=<?php echo date('n'); ?>&y=<?php echo date('Y'); ?>" target="_blank">View More</a>
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
                                                <a class="dropdown-item" href="journalreport.php" target="_blank">View More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <canvas id="myChart2"></canvas>
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
                                            <a class="dropdown-item" href="totalreport.php?y=<?php echo date('Y'); ?>" target="_blank">View More</a>
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
<script>
var data3 = <?php echo $barChartData1Json; ?>;
const barChartData1 = {
    labels: data3.labels,
    datasets: data3.datasets
};

const barChartOptions1 = {
    indexAxis: 'y',
    scales: {
        x: {
            stacked: true,
            beginAtZero: true,
        },
        y: {
            stacked: true,
            beginAtZero: true,
        }
    }
};

const barCtx1 = document.getElementById('myChart3').getContext('2d');

const barChart1 = new Chart(barCtx1, {
    type: 'bar',
    data: barChartData1,
    options: barChartOptions1
});
</script>
<script>
// Parse the donation data from PHP
    const donationData = <?php echo $donationDataJson; ?>;

    // Extract dates and amounts from the donation data
    const dates = donationData.map(donation => donation.date);
    const amounts = donationData.map(donation => donation.amount);

    // Create a new Chart instance
    const ctx = document.getElementById('donationChart').getContext('2d');
    const donationChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: dates,
            datasets: [{
                label: 'Donation Amount',
                data: amounts,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
