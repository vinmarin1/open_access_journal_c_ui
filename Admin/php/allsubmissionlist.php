<?php
include 'function/redirect.php';
include 'function/submission_functions.php';
include 'function/journal_function.php';

$contributor = get_contributor_list();
$journal_list = get_journal_list();
$all_articles = get_allarticle_list();
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <!-- Include header -->
    <?php include 'template/header.php'; ?>

    <!-- Content wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><a href="../php/journalview.php"><span class="text-muted fw-light">Submission /</span></a> All</h4>

        <!-- Journal tabs -->
        <ul class="nav nav-tabs mb-3" id="journalTabs">
            <li class="nav-item">
                <a class="nav-link active" id="tabAll" data-status="">All</a>
            </li>

            <?php foreach ($journal_list as $journal): ?>
                <li class="nav-item">
                    <a class="nav-link" id="tab<?php echo $journal->journal_id; ?>" data-status="<?php echo $journal->journal; ?>"><?php echo $journal->journal; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>

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
                            <th>Journal</th>
                            <th>Article</th>
                            <th>Status</th>
                            <th>Added</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($all_articles as $all_articlesval): ?>
                            <tr>
                                <td width="5%"><?php echo $all_articlesval->article_id; ?></td>
                            <?php
                                $matchingJournal = null;
                                foreach ($journal_list as $journal) {
                                    if ($journal->journal_id == $all_articlesval->journal_id) {
                                        $matchingJournal = $journal;
                                        break;
                                    }
                                }
                                ?>
                                <td><?php echo ($matchingJournal !== null) ? $matchingJournal->journal : 'Unknown'; ?></td>
                                <td width="70%">
                                    <b>
                                    <?php
                                        $author_names = [];
                                        foreach ($contributor as $contributorval) {
                                            if ($contributorval->article_id == $all_articlesval->article_id) {
                                                $author_names[] = $contributorval->lastname . ', ' . $contributorval->firstname;
                                            }
                                        }

                                        if (!empty($author_names)) {
                                            $author_name = implode(', ', $author_names);
                                        } else {
                                            $author_name = $all_articlesval->author;
                                        }

                                        echo $author_name;
                                        ?>
                                    </b><br>
                                    <?php echo $all_articlesval->title; ?>
                                </td>
                                <?php
                                    $statusNumber = $all_articlesval->status;

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

                                <td width="10%">
                                    <span class="badge bg-<?php echo $statusClass; ?> me-1">
                                        <?php echo $statusLabel; ?>
                                    </span>
                                </td>
                                <td width="5%">
                                <?php
                                    $date_added = $all_articlesval->date_added;
                                    $formatted_date = date("F d, Y", strtotime($date_added));
                                    echo $formatted_date;
                                    ?>
                                </td>
                                <td width="5%">                         
                                    <a href="javascript:void(0);" onclick="viewWorkflow(<?php echo $all_articlesval->article_id; ?>, '<?php echo $all_articlesval->workflow; ?>')" class="btn btn-outline-dark">View</a>
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

            $('#journalTabs a').on('click', function (e) {
                e.preventDefault();

                $('#journalTabs a').removeClass('active');

                $(this).addClass('active');

                var statusValue = $(this).data('status');
                dataTable.column(1).search(statusValue).draw();
            });

            $('#statusTabs a').on('click', function (e) {
                e.preventDefault();

                $('#statusTabs a').removeClass('active');

                $(this).addClass('active');

                var statusValue = $(this).data('status');
                dataTable.column(3).search(statusValue).draw();
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
