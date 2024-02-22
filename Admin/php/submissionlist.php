<?php
include 'function/redirect.php';
include 'function/submission_functions.php';

$cid_get = isset($_GET['cid']) ? $_GET['cid'] : 1;

if(isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true){
    $journal_id = isset($_SESSION['journal_id']) ? ($_SESSION['journal_id']) : '';
    if(empty($journal_id) && $journal_id !== NULL) {
        $cid = $cid_get;
    } else {
        $cid = $journal_id;
    }
}

// $cid = $cid_get;
$contributor = get_contributor_list();
$journals = get_journal_detail($cid);
$incomplete_articles = get_article_list($cid);
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <!-- Include header -->
    <?php include 'template/header.php'; ?>

    <!-- Content wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Submission /</span> <?php echo $journals[0]->journal; ?></h4>

        <!-- Status tabs -->
        <ul class="nav nav-tabs mb-3" id="statusTabs">
            <li class="nav-item">
                <a class="nav-link active" id="tabAll" data-status="">All</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tabPending" data-status="Pending">Pending</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tabReview" data-status="Review">Review</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tabCopyediting" data-status="Copyediting">Copyediting</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tabProduction" data-status="Production">Production</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tabPublished" data-status="Published">Published</a>
            </li>
        </ul>

        <!-- Table with Status filter -->
        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table table-striped" id="DataTable">
                    <thead>
                        <tr>
                            <th>Article ID</th>
                            <th>Article</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($incomplete_articles as $incomplete_articlesval): ?>
                            <tr>
                                <td width="5%"><?php echo $incomplete_articlesval->article_id; ?></td>
                                <td width="75%">
                                    <b>
                                        <?php
                                        $author_names = [];
                                        foreach ($contributor as $contributorval) {
                                            if ($contributorval->article_id == $incomplete_articlesval->article_id) {
                                                $author_names[] = $contributorval->firstname . ', ' . $contributorval->lastname;
                                            }
                                        }
                                        $author_name = implode(', ', $author_names);
                                        ?>
                                    </b><br>
                                    <?php echo $incomplete_articlesval->title; ?>
                                </td>
                                <?php
                                    $statusNumber = $incomplete_articlesval->status;

                                    $statusInfo = [
                                        0 => ['label' => 'Archived', 'class' => 'label-danger'],
                                        1 => ['label' => 'Published', 'class' => 'label-success'],
                                        11 => ['label' => 'Scheduled', 'class' => 'label-info'],
                                        2 => ['label' => 'Production', 'class' => 'label-dark'],
                                        3 => ['label' => 'Copyediting', 'class' => 'label-primary'],
                                        4 => ['label' => 'Review', 'class' => 'label-warning'],
                                        5 => ['label' => 'Pending', 'class' => 'label-secondary'],
                                        6 => ['label' => 'Reject', 'class' => 'label-danger'],
                                    ];

                                    if (isset($statusInfo[$statusNumber])) {
                                        $statusLabel = $statusInfo[$statusNumber]['label'];
                                        $statusClass = $statusInfo[$statusNumber]['class'];
                                    } else {
                                        $statusLabel = 'Unknown';
                                        $statusClass = 'label-secondary';
                                    }
                                    ?>

                                <td width="15%">
                                    <span class="badge bg-<?php echo $statusClass; ?> me-1">
                                        <?php echo $statusLabel; ?>
                                    </span>
                                </td>
                                <td width="5%">                         
                                    <a href="javascript:void(0);" onclick="viewWorkflow(<?php echo $incomplete_articlesval->article_id; ?>, '<?php echo $incomplete_articlesval->workflow; ?>')" class="btn btn-outline-dark">View</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>    
                </table>
            </div>
        </div>

        <!-- Include footer -->
        <?php include 'template/footer.php'; ?>
    </div>

    <!-- Include the DataTables CSS and JS files -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <!-- DataTables initialization script with status filter -->
    <script>
        $(document).ready(function() {
            var dataTable = $('#DataTable').DataTable({
                "paging": true,
                "ordering": true,
                "searching": true,
                "order": [[0, 'desc']]  
            });

            // Apply the status filter when a tab is clicked
            $('#statusTabs a').on('click', function (e) {
                e.preventDefault();

                // Remove 'active' class from all tabs
                $('#statusTabs a').removeClass('active');

                // Add 'active' class to the clicked tab
                $(this).addClass('active');

                var statusValue = $(this).data('status');
                dataTable.column(2).search(statusValue).draw();
            });
        });

        function viewWorkflow(articleId, workflow) {
            $('#sloading').show(); // Show loading indicator

            setTimeout(function () {
                // Redirect to the workflow page after 2 seconds
                window.location.href = "../php/workflow.php?aid=" + articleId + workflow;
            }, 2000);

            // Hide loading indicator when the page is fully loaded
            window.onload = function () {
                $('#sloading').hide();
            };
        }
    </script>
</body>
</html>
