<?php
include 'function/redirect.php';
include 'function/issue_function.php';
$issid = isset($_GET['issid']) ? $_GET['issid'] : 1;

$articlelist = get_article_list($issid);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include the DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
</head>
<body>
    <!-- Include header -->
    <?php include 'template/header.php'; ?>

    <!-- Content wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center py-3">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Journal /</span> Article Issue</h4>
            <button type="button" class="btn btn-primary" id="submitButton" onclick="submitCheckedArticles()">Submit Checked Articles</button>
        </div>

        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table table-striped" id="DataTable">
                    <thead>
                        <tr>
                            <th><input class="form-check-input" type="checkbox" id="checkAll"></th>
                            <th>Article ID</th>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($articlelist as $articlelistval): ?>
                            <tr>
                                <td width="5%"><input class="form-check-input article-checkbox" type="checkbox" value="" data-article-id="<?php echo $articlelistval->article_id; ?>"/></td>
                                <td width="5%"><?php echo $articlelistval->article_id; ?></td>
                                <td><?php echo $articlelistval->title; ?></td>
                                <td width="5%">                         
                                    <a href="javascript:void(0);" onclick="viewWorkflow(<?php echo $articlelistval->article_id; ?>)" class="btn btn-outline-dark">View</a>
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

    <!-- Include the DataTables JS file -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            var dataTable = $('#DataTable').DataTable({
                "paging": true,
                "ordering": true,
                "searching": true,
            });

            $('#DataTable').on('change', '.article-checkbox, #checkAll', function () {
                var isChecked = $(this).is(':checked');
                var articleId = $(this).data('article-id');

                if ($(this).is('#checkAll')) {
                    $('.article-checkbox').prop('checked', isChecked);
                }

                $('#checkAll').prop('checked', $('.article-checkbox:checked').length === $('.article-checkbox').length);
            });
        });

        function viewWorkflow(articleId) {
            $('#sloading').show();

            setTimeout(function () {
                window.location.href = "../php/workflow.php?aid=" + articleId;
            }, 2000);

            window.onload = function () {
                $('#sloading').hide();
            };
        }

        function submitCheckedArticles() {
            // Disable the button to prevent multiple submissions
            $('#submitButton').prop('disabled', true);
            $('#sloading').show();

            var checkedArticles = getCheckedArticles();
            console.log('Checked Articles:', checkedArticles);

            $.ajax({
                type: 'POST',
                url: '../php/function/articleissue_function.php',
                data: { action: 'send_emails', checkedArticles: checkedArticles },
                dataType: 'json',
                success: function(response) {
                    console.log('Response:', response);

                    if (response.status) {
                        alert("Emails sent successfully");
                        location.reload();
                    } else {
                        alert("Failed to send emails");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("Error in AJAX request");
                },
                complete: function() {
                    // Enable the button and hide the loading indicator
                    $('#submitButton').prop('disabled', false);
                    $('#sloading').hide();
                }
            });
        }

        function getCheckedArticles() {
            var checkedArticles = [];
            $('.article-checkbox:checked').each(function () {
                checkedArticles.push($(this).data('article-id'));
            });
            return checkedArticles;
        }
    </script>
</body>
</html>
