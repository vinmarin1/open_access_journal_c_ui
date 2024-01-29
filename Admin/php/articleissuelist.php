<?php
include 'function/redirect.php';
include 'function/articleissue_function.php';
$issid = isset($_GET['issid']) ? $_GET['issid'] : 1;

$articlelist = get_article_list($issid);
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <!-- Include header -->
    <?php include 'template/header.php'; ?>

    <!-- Content wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Journal /</span> Article Issue</h4>

        <div class="card">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table table-striped" id="DataTable">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Article ID</th>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($articlelist as $articlelistval): ?>
                            <tr>
                                <td width="5%"><input class="form-check-input article-checkbox" type="checkbox" value="" id="defaultCheck1" data-article-id="<?php echo $articlelistval->article_id; ?>"/></td>
                                <td width="10%"><?php echo $articlelistval->article_id; ?></td>
                                <td width="80%"><?php echo $articlelistval->title; ?></td>
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
    
    <!-- Include the DataTables CSS and JS files -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            var dataTable = $('#DataTable').DataTable({
                "paging": true,
                "ordering": true,
                "searching": true,
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
    </script>
</body>
</html>
