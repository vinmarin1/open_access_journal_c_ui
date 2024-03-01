<?php
include 'function/redirect.php';
include 'function/message_function.php';

$messagelist = get_message_list();
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <!-- Include header -->
    <?php include 'template/header.php'; ?>

   <!-- Content wrapper -->
   <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span> Message</h4>

        <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
            <h5 class="card-header mb-0">Message</h5>
            <div style="display: flex; margin-top: 15px; margin-right: 15px;">
                <!-- <button type="button" id="tabAll" class="btn btn-primary" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#addModal">Add Message</button> -->
                <!-- <button type="button" id="tabPublished" class="btn btn-primary">Download</button> -->
            </div>
        </div>

            <div class="table-responsive text-nowrap">
                <table class="table table-striped" id="DataTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Reason</th>
                            <th>Message</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($messagelist as $messagelistval): ?>
                            <tr>
                                <td width="5%"><?php echo  $messagelistval->message_id; ?></td>
                                <td width="85%"><?php echo  $messagelistval->email; ?></td>
                                <td width="85%"><?php echo  $messagelistval->reason; ?></td>
                                <td width="85%"><?php echo  $messagelistval->message; ?></td>
                                <td width="10%">
                                    <button type="button" class="btn btn-outline-success" onclick="updateModal(<?php echo $faqslistval->id; ?>)">Update</button>
                                    <button type="button" class="btn btn-outline-danger" onclick="archiveFaqs(<?php echo $faqslistval->id; ?>, '<?php echo $faqslistval->question; ?>', '<?php echo $faqslistval->answer; ?>')">Archive</button>
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
        });
    });

</script>


</body>
</html>