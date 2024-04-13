<?php
include 'function/redirect.php';
include 'function/dashboard_function.php';

$submissionlist = get_journalsubmission();  
$comparisonlist = get_submissioncomparison();
$usercount = get_usercount();
$publishedcount = get_publishedcount();
$engagementcount = get_engagementcount();
$ongoingcount = get_ongoingcount();
$userdemographicslist = get_userdemographics();
$donationamount = get_donationamount();
$top5contributorslist = get_top5contributors_list();
$top5reviewerlist = get_top5reviewer_list();
$top5downloadedlist = get_top5downloadedlist();

if ($submissionlist) {
    $datasets = [];

    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    $colors = [
        '#71dd37',
        '#03c3ec',
        '#ffab00',
        '#ff3e1d'
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
    '#71dd37',
    '#03c3ec',
    '#ffab00',
    '#ff3e1d',
    '#8592a3'
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
                    <div class="col-lg-6 col-md-12">
                        <div class="card mb-4">
                            <div class="card-body" id="cardBody1">
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
                                                <a href="#" class="download-chart-btn dropdown-item" data-chart="myChart">Download</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <canvas id="myChart" class="chart-canvas"></canvas>
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
                                            <a class="dropdown-item" href="userreport.php">View More</a>
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
                

                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="card mb-4">
                            <div class="card-body" id="cardBody2"> 
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5 class="card-title mb-2">Journal Comparison</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="dropdown" style="margin-right: -10px;">
                                            <button class="btn p-0" type="button" id="cardOpt2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="cardOpt2">
                                                <a class="dropdown-item" href="journalreport.php" target="_blank">View More</a>
                                                <a href="#" class="download-chart-btn dropdown-item" data-chart="myChart2">Download</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <canvas id="myChart2" class="chart-canvas"></canvas>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5 class="card-title mb-2">User Demographics</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="dropdown" style="margin-right: -10px;">
                                            <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                <a class="dropdown-item" href="userreport.php">View More</a>
                                                <a href="#" class="download-chart-btn dropdown-item" data-chart="myChart3">Download</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <canvas id="myChart3" class="chart-canvas"></canvas>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5 class="card-title mb-2">Donation</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="dropdown" style="margin-right: -10px;">
                                            <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                <a class="dropdown-item" href="donationreportmtd.php?m=<?php echo date('n'); ?>&y=<?php echo date('Y'); ?>" target="_blank">View More</a>
                                                <a href="#" class="download-chart-btn dropdown-item" data-chart="donationChart">Download</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <canvas id="donationChart" class="chart-canvas"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="card mb-4">
                            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                <div class="card-title mb-0">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0 me-2">The top 5 downloaded articles for <br><span id="currentMonth2"></span></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                </div>
                                <?php
                                    if (isset($top5downloadedlist['top5downloadedlist']) && count($top5downloadedlist['top5downloadedlist']) > 0) {
                                        foreach ($top5downloadedlist['top5downloadedlist'] as $top5downloadedlistval) {
                                            $shortTitle = strlen($top5downloadedlistval->title) > 50 ? substr($top5downloadedlistval->title, 0, 50) . '...' : $top5downloadedlistval->title;
                                            $escapedTitle = htmlspecialchars($top5downloadedlistval->title);
                                            $articleID = $top5downloadedlistval->article_id;
                                            $titleHtml = "<a href='workflow.php?aid=$articleID' target='_blank' title='$escapedTitle'>$shortTitle</a>";
                                    ?>
                                            <ul class="p-0 m-0">
                                                <li class="d-flex mb-3 pb-1">
                                                    <div class="avatar flex-shrink-0 me-3">
                                                        <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-book"></i></span>
                                                    </div>
                                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                        <div class="">
                                                            <h6 class="mb-0"><?php echo $titleHtml; ?></h6>
                                                        </div>
                                                        <div class="user-progress">
                                                            <small class="fw-semibold"><?php echo $top5downloadedlistval->download_count; ?></small>
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
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                        <div class="card-title mb-0">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h6 class="m-0 me-2 mb-2">The top 5 contributors for <br><span id="currentMonth"></span></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="dropdown">
                                                <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt1">
                                                    <a class="dropdown-item" href="topcontributors.php" target="_blank">View More</a>
                                                </div>
                                            </div>
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
                                                <div class="avatar" style="margin-right: 10px;">
                                                    <?php if (!empty($top5contributorslistval->profile_pic)): ?>
                                                        <img src="../<?php echo $top5contributorslistval->profile_pic; ?>" alt="" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;" />
                                                    <?php else: ?>
                                                        <img src="https://qcuj.online/Files/uploaded-profile/no_profile.jpg" alt="" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;" />
                                                    <?php endif; ?>
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
                            <div class="col-lg-6 col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                        <div class="card-title mb-0">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h6 class="m-0 me-2 mb-2">The top 5 reviewer for <br><span id="currentMonth1"></span></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="dropdown">
                                                <button class="btn p-0" type="button" id="cardOpt2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt2">
                                                    <a class="dropdown-item" href="topreviewer.php" target="_blank">View More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                        </div>
                                        <?php
                                            if (isset($top5reviewerlist['top5reviewerlist']) && count($top5reviewerlist['top5reviewerlist']) > 0) {
                                                    foreach ($top5reviewerlist['top5reviewerlist'] as $top5reviewerlistval) {
                                        ?>
                                            <ul class="p-0 m-0">
                                                <li class="d-flex mb-3 pb-1">
                                                    <div class="avatar" style="margin-right: 10px;">
                                                        <?php if (!empty($top5reviewerlistval->profile_pic)): ?>
                                                            <img src="../<?php echo $top5reviewerlistval->profile_pic; ?>" alt="" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;";/>
                                                        <?php else: ?>
                                                            <img src="https://qcuj.online/Files/uploaded-profile/no_profile.jpg" alt="" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;" />
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                        <div class="">
                                                            <h6 class="mb-0"><?php echo $top5reviewerlistval->last_name; ?>, <?php echo $top5reviewerlistval->first_name; ?>
                                                            <a href="javascript:void(0);" onclick="openPageCentered('../../PHP/reviewerdashboard.php?orc_id=<?php echo $top5reviewerlistval->orc_id; ?>')"><?php echo $top5reviewerlistval->last_name . ", " . $top5reviewerlistval->first_name; ?></a></h6>
                                                          
                                                        </div>
                                                        <div class="user-progress">
                                                            <small class="fw-semibold"><?php echo $top5reviewerlistval->count_reviewed; ?></small>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
    window.jsPDF = window.jspdf.jsPDF;

    $('.download-chart-btn').click(function(event) {
        var chartId = $(this).data('chart');
        var canvas = $('#' + chartId)[0];


        var canvasWidth = canvas.width;
        var canvasHeight = canvas.height;

        var cardTitle = $(this).closest('.card-body').find('.card-title').text().trim();
        var pdf = new jsPDF('l', 'pt', [canvasWidth, canvasHeight]);

        var titleCanvas = document.createElement('canvas');
        titleCanvas.width = canvasWidth;
        titleCanvas.height = 30; 
        var titleCtx = titleCanvas.getContext('2d');
        titleCtx.font = '18px Arial';
        titleCtx.fillStyle = 'black';
        titleCtx.textAlign = 'center';
        titleCtx.fillText(cardTitle, canvasWidth / 2, 20); 

        var titleImgData = titleCanvas.toDataURL('image/png');
        pdf.addImage(titleImgData, 'PNG', 0, 0, canvasWidth, 30); 
        var imgData = canvas.toDataURL('image/png');
        pdf.addImage(imgData, 'PNG', 0, 30, canvasWidth, canvasHeight - 30);
        pdf.save(cardTitle + '.pdf');
    });
});
</script>
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
    document.getElementById("currentMonth1").textContent = currentMonth;
    document.getElementById("currentMonth2").textContent = currentMonth;
    
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
    const donationData = <?php echo $donationDataJson; ?>;

    const dates = donationData.map(donation => donation.date);
    const amounts = donationData.map(donation => donation.amount);

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
