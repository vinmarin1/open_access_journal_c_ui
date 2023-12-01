<?php
include 'submission_functions.php';

// Set the appropriate value for $cid
$cid = 1;

// Assuming $cid is set appropriately before calling this function
$contributor = get_contributor_list();
$incomplete_articles = get_article_list($cid);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Other head elements -->

    <!-- Add DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    <!-- Add jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Your other scripts and stylesheets -->
</head>
<body>
    <!-- Include header -->
    <?php include 'header.php'; ?>

    <!-- Content wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Table Basic</h5>
            <div class="table-responsive text-nowrap">
                <table class="table" id="DataTable">
                    <thead>
                        <tr>
                            <th width="10%">Article ID</th>
                            <th width="30%">Article</th>
                            <th width="10%">Status</th>
                            <th width="10%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($incomplete_articles as $incomplete_articlesval): ?>
                            <tr>
                                <td><?php echo $incomplete_articlesval->article_id; ?></td>
                                <td>
                                    <b>
                                        <?php
                                        $author_names = [];
                                        foreach ($contributor as $contributorval) {
                                            if ($contributorval->article_id == $incomplete_articlesval->article_id) {
                                                $author_names[] = $contributorval->publicname;
                                            }
                                        }

                                        $author_name = implode(', ', $author_names);

                                        echo !empty($author_name) ? $author_name : $incomplete_articlesval->author;
                                        ?>
                                    </b><br>
                                    <?php echo $incomplete_articlesval->title; ?>
                                </td>
                                <td width="8%">
                                    <span class="badge bg-label-<?php echo $incomplete_articlesval->status; ?> me-1">
                                        <?php echo $incomplete_articlesval->status_text; ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Include footer -->
        <?php include 'footer.php'; ?>
    </div>

    <!-- Initialize DataTables -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
    jQuery(document).ready(function($) {
        $('#DataTable').DataTable({
            "columnDefs": [
                {
                    "targets": [1], // Target the second column (index 1)
                    "width": "30%"
                }
            ]
        });
    });
    </script>

</body>
</html>
