<?php
include 'function/submission_functions.php';

$journallist = get_journal_list();
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <!-- Include header -->
    <?php include 'template/header.php'; ?>

    <!-- Content wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center py-3">
            <h4><span class="text-muted fw-light">Main /</span> Submission</h4>
            <button type="button" onclick="window.location.href='newarticleapi.php'" class="btn btn-primary">New Submission</button>
        </div>

            <div class="row mb-5 mt-4">
            <?php
                $journals = get_journal_list();

                if ($journals) {
                    foreach ($journals as $journal) {
                        ?>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img class="card-img card-img-left img-fluid" src="../assets/img/Gavel.png" alt="Card image" />
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $journal->journal; ?></h5>
                                            <p class="card-text"><?php echo $journal->description; ?></p>
                                            <p class="card-text"><small class="text-muted">Last updated <?php echo $journal->last_updated; ?></small></p>
                                            <a href="javascript:void(0);" onclick="viewSubmissionList(<?php echo $journal->journal_id; ?>)" class="btn btn-primary">View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<p>No journals found.</p>';
                }
                ?>
                </div>
            </div>

        <!-- Include footer -->
        <?php include 'template/footer.php'; ?>
    </div>

    <!-- Initialize DataTables -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
    jQuery(document).ready(function($) {
        $('#DataTable').DataTable({
        });
    });

    function viewSubmissionList(journalId) {
        $('#sloading').show();

        setTimeout(function () {
            window.location.href = "../php/submissionlist.php?cid=" + journalId;
        }, 2000);

        window.onload = function () {
            $('#sloading').hide();
        };
    }
    </script>
</body>
</html>
