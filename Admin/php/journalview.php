<?php
include 'function/redirect.php';
include 'function/submission_functions.php';

if(isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true){
    $journal_id = isset($_SESSION['journal_id']) ? ($_SESSION['journal_id']) : '';
}

$journallist = get_journal_list($journal_id);
?>
<!DOCTYPE html>
<html lang="en">
    <style>
        .card-text {
        display: -webkit-box;
        -webkit-line-clamp: 7;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    </style>
<body>
    <!-- Include header -->
    <?php include 'template/header.php'; ?>

    <!-- Content wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center py-3">
            <h4><span class="text-muted fw-light">Main /</span> Submission</h4>
            <!-- <button type="button" onclick="window.location.href='newarticleapi.php'" class="btn btn-primary">New Submission</button> -->
        </div>

        <div class="row mb-5 mt-4">
        <?php
            if(empty($journal_id) && $journal_id !== NULL) {
        ?>
            <div class="col-md-6">
                <div class="card mb-3" style="min-height: 340px; max-height: 100%; overflow: hidden;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img class="card-img card-img-left img-fluid" src="../../Files/journal-image/JournalAll.png" alt="Card image" style="height: 100%; width:100%; object-fit: cover;"/>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">All Journals</h5>
                                <p class="card-text">All journals consist of three distinct peer-reviewed publications: QCU Gavel, focusing on social sciences; QCU Lamp, dedicated to education; and QCU Star, centered around science and technology.</p>
                                <p class="card-text"><small class="text-muted">Last updated</small></p>
                                <a href="javascript:void(0);" onclick="viewAllSubmissionList()" class="btn btn-primary">View</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            }
        ?>

            <?php
            if ($journallist) {
                foreach ($journallist as $journallistval) {
                    ?>
                    <div class="col-md-6">
                        <div class="card mb-3" style="min-height: 340px; max-height: 100%; overflow: hidden;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img class="card-img card-img-left img-fluid" src="../../Files/journal-image/<?php echo $journallistval->image; ?>" alt="Card image" style="height: 100%; width:100%; object-fit: cover;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $journallistval->journal; ?></h5>
                                        <p class="card-text"><?php echo $journallistval->description; ?></p>
                                        <p class="card-text"><small class="text-muted">Last updated <?php echo $journallistval->last_updated; ?></small></p>
                                        <?php
                                            $journal_id = isset($_SESSION['journal_id']) ? $_SESSION['journal_id'] : '';
                                            if(empty($journal_id)) {
                                            ?>
                                                <a href="javascript:void(0);" onclick="viewSubmissionList(<?php echo $journallistval->journal_id; ?>)" class="btn btn-primary">View</a>
                                        <?php } else { ?>
                                                <a href="javascript:void(0);" onclick="viewSubmissionList1()" class="btn btn-primary">View</a>
                                        <?php } ?>
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

    function viewSubmissionList1() {
        $('#sloading').show();

        setTimeout(function () {
            window.location.href = "../php/submissionlist.php"
        }, 2000);

        window.onload = function () {
            $('#sloading').hide();
        };
    }

    function viewAllSubmissionList(journalId) {
        $('#sloading').show();

        setTimeout(function () {
            window.location.href = "../php/allsubmissionlist.php"
        }, 2000);

        window.onload = function () {
            $('#sloading').hide();
        };
    }
    </script>
</body>
</html>
