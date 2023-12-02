<?php
include 'submission_functions.php';

$journallist = get_journal_list();
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <!-- Include header -->
    <?php include 'header.php'; ?>

    <!-- Content wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Main /</span> Submission</h4>

            <div class="row mb-5">
            <?php
                $journals = get_journal_list();

                if ($journals) {
                    foreach ($journals as $journal) {
                        ?>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <!-- Add the 'img-fluid' class to make the image responsive -->
                                        <img class="card-img card-img-left img-fluid" src="../assets/img/Gavel.png" alt="Card image" />
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $journal->journal; ?></h5>
                                            <p class="card-text"><?php echo $journal->description; ?></p>
                                            <p class="card-text"><small class="text-muted">Last updated <?php echo $journal->last_updated; ?></small></p>
                                            <!-- You can add more information as needed -->
                                            <a href="../php/submissionlist.php?cid=<?php echo $journal->journal_id; ?>" class="btn btn-primary">View</a>
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
        <?php include 'footer.php'; ?>
    </div>

    <!-- Initialize DataTables -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        jQuery(document).ready(function($) {
            $('#DataTable').DataTable({
            });
        });
    </script>
</body>
</html>
