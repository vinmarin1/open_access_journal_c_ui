<?php
include 'function/workflow_function.php';
$aid = isset($_GET['aid']) ? $_GET['aid'] : 1;

$article_data = get_article_data($aid);
$article_files = get_article_files($aid);
$article_discussion = get_article_discussion($aid);
$article_participant = get_article_participant($aid);
?>

<!DOCTYPE html>
<html lang="en">
<style>
.custom-body {
  height: 50%;
  overflow: auto;
  max-height: 400px;
  margin: 0 auto; 
}

#nopadding {
  padding: 0 !important;
}

#addspadding {
  padding: 10px 30px 10px 30px;
  font-size: 15px;
  margin-right: 15px;
}

#addpadding {
  padding: 14px 30px 14px 30px;
  font-size: 15px;
  margin-right: 15px;
}
table {
  border: 1px solid #000;
  border-collapse: collapse;
}
</style>

<body>
    <!-- Include header -->
    <?php include 'template/header.php'; ?>

    <!-- Content wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="py-3 mb-4"><?php echo $article_data[0]->article_id; ?> / <?php echo $article_data[0]->title; ?></h5>

            <div class="row">
                <div class="col-xl-12">
                    <div class="nav-align-top mb-4">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <button type="button" id="addspadding" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true"> Workflow</button>
                            </li>
                            <li class="nav-item">
                                <button type="button" id="addspadding" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false"> Publication</button>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                                <div class="row">
                                    <div class="col-xl-12" id="nopadding">
                                        <div class="nav-align-top mb-4">
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <button type="button" id="addspadding" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-submission" aria-controls="navs-top-submission" aria-selected="true"> Submission</button>
                                                </li>
                                                <li class="nav-item">
                                                    <button type="button" id="addspadding" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-review" aria-controls="navs-top-review" aria-selected="false"> Review</button>
                                                </li>
                                                <li class="nav-item">
                                                    <button type="button" id="addspadding" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-copyediting" aria-controls="navs-top-copyediting" aria-selected="false"> Copyediting</button>
                                                </li>
                                                <li class="nav-item">
                                                    <button type="button" id="addspadding" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-production" aria-controls="navs-top-production" aria-selected="false"> Production</button>
                                                </li>
                                            </ul>

                                            <div class="tab-content">
                                                <div class="tab-pane fade show active" id="navs-top-submission" role="tabpanel">
                                                    <div class="row">
                                                        <div class="col-md-9" id="dynamic-column">
                                                            <div class="table-responsive text-nowrap">
                                                                <table class="table table-striped" id="DataTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th colspan="2"><h6>Submission Files</h6></th>
                                                                            <th style="text-align: right;">
                                                                                <button type="button" class="btn btn-outline-dark" id="uploadButton" style="width: 150px;">Upload File</button>
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php if (empty($article_files)): ?>
                                                                        <tr>
                                                                            <td colspan="3" class="text-center">No data</td>
                                                                        </tr>
                                                                    <?php else: ?>
                                                                        <?php foreach ($article_files as $article_filesval): ?>
                                                                            <tr>
                                                                                <td width="5%"><?php echo $article_filesval->id; ?></td>
                                                                                <td width="85%"><?php echo $article_filesval->file_name; ?></td>
                                                                                <td width="5%"></td>
                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                        <?php endif; ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <th colspan="3" style="text-align: right;">
                                                                            <button type="button" class="btn btn-outline-dark" id="uploadButton" style="width: 150px;">Download File</button>
                                                                        </th>
                                                                    </tfoot>   
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mt-4 mt-lg-0" id="dynamic-column">
                                                            <a href="../php/emailcontent.php?aid=<?php echo $article_data[0]->article_id; ?>&emc=1" class="btn btn-primary btn-lg btn-block mb-2" style="width: 100%;">Send for Review</a>
                                                            <button type="button" class="btn btn-outline-primary btn-lg btn-block mb-2" id="uploadButton" style="width: 100%;">Accept and Skip Review</button>
                                                            <a href="../php/emailcontent.php?aid=<?php echo $article_data[0]->article_id; ?>&emc=2" class="btn btn-outline-danger btn-lg btn-block" id="uploadButton" style="width: 100%;">Decline Submission</a>
                                                        </div>

                                                        <div class="col-md-9 mt-4" id="dynamic-column">
                                                            <div class="table-responsive text-nowrap">
                                                                <table class="table table-striped" id="DataTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th colspan="2"><h6>Pre-Review Discussions</h6></th>
                                                                            <th style="text-align: right;">
                                                                                <button type="button" class="btn btn-outline-dark" id="uploadButton" style="width: 150px;">Add Discussion</button>
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php if (empty($article_discussion)): ?>
                                                                        <tr>
                                                                            <td colspan="3" class="text-center">No data</td>
                                                                        </tr>
                                                                    <?php else: ?>
                                                                        <?php foreach ($article_discussion as $article_discussionval): ?>
                                                                            <tr>
                                                                                <td width="5%"><?php echo $article_discussionval->id; ?></td>
                                                                                <td width="85%"><?php echo $article_discussionval->file_name; ?></td>
                                                                                <td width="5%"></td>
                                                                            </tr>
                                                                        <?php endforeach; ?>    
                                                                    <?php endif; ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <th colspan="3" style="text-align: right;"></th>
                                                                    </tfoot>   
                                                                </table>
                                                            </div>
                                                        </div>  
                                                        <div class="col-md-3 mt-4" id="dynamic-column">
                                                            <div class="table-responsive text-nowrap">
                                                                <table class="table table-striped" id="DataTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th colspan="2"><h6>Participants</h6></th>
                                                                            <th style="text-align: right;">
                                                                                <button type="button" class="btn btn-outline-dark" id="uploadButton" style="margin-left: -10px">Add</button>
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php if (empty($article_participant)): ?>
                                                                        <tr>
                                                                            <td colspan="3" class="text-center">No data</td>
                                                                        </tr>
                                                                    <?php else: ?>
                                                                        <?php foreach ($article_participant as $article_participantval): ?>
                                                                            <tr>
                                                                                <td width="5%"><?php echo $article_participantval->id; ?></td>
                                                                                <td width="85%"><?php echo $article_participantval->file_name; ?></td>
                                                                                <td width="5%"></td>
                                                                            </tr>
                                                                        <?php endforeach; ?>    
                                                                    <?php endif; ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <th colspan="3" style="text-align: right;"></th>
                                                                    </tfoot> 
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="navs-top-review" role="tabpanel">
                                                    <p>
                                                    Donut dragée jelly pie halvah. Danish gingerbread bonbon cookie wafer candy oat cake ice
                                                    cream. Gummies halvah tootsie roll muffin biscuit icing dessert gingerbread. Pastry ice cream
                                                    cheesecake fruitcake.
                                                    </p>
                                                    <p class="mb-0">
                                                    Jelly-o jelly beans icing pastry cake cake lemon drops. Muffin muffin pie tiramisu halvah
                                                    cotton candy liquorice caramels.
                                                    </p>
                                                </div>

                                                <div class="tab-pane fade" id="navs-top-copyediting" role="tabpanel">
                                                    <p>
                                                    Donut dragée jelly pie halvah. Danish gingerbread bonbon cookie wafer candy oat cake ice
                                                    cream. Gummies halvah tootsie roll muffin biscuit icing dessert gingerbread. Pastry ice cream
                                                    cheesecake fruitcake.
                                                    </p>
                                                    <p class="mb-0">
                                                    Jelly-o jelly beans icing pastry cake cake lemon drops. Muffin muffin pie tiramisu halvah
                                                    cotton candy liquorice caramels.
                                                    </p>
                                                </div>

                                                <div class="tab-pane fade" id="navs-top-production" role="tabpanel">
                                                    <p>
                                                    Donut dragée jelly pie halvah. Danish gingerbread bonbon cookie wafer candy oat cake ice
                                                    cream. Gummies halvah tootsie roll muffin biscuit icing dessert gingerbread. Pastry ice cream
                                                    cheesecake fruitcake.
                                                    </p>
                                                    <p class="mb-0">
                                                    Jelly-o jelly beans icing pastry cake cake lemon drops. Muffin muffin pie tiramisu halvah
                                                    cotton candy liquorice caramels.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                                <div class="container" id="nopadding">
                                    <div class="row">
                                        <!-- Left-side navigation -->
                                        <div class="col-md-2" id="nopadding">
                                            <div class="nav-align-left mb-4">
                                                <ul class="nav nav-tabs flex-column" role="tablist">
                                                    <li class="nav-item">
                                                        <button type="button" id="addpadding" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-one" aria-controls="navs-top-one" aria-selected="true">Title & Abstract</button>
                                                    </li>
                                                    <li class="nav-item">
                                                        <button type="button" id="addpadding" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-two" aria-controls="navs-top-two" aria-selected="false">Contributors</button>
                                                    </li>
                                                    <li class="nav-item">
                                                        <button type="button" id="addpadding" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-three" aria-controls="navs-top-three" aria-selected="false">Meta Data</button>
                                                    </li>
                                                    <li class="nav-item">
                                                        <button type="button" id="addpadding" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-four" aria-controls="navs-top-four" aria-selected="false"> References</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Content section -->
                                        <div class="col-md-10">
                                            <div class="col-xl-12" id="nopadding">
                                                <div class="tab-content">
                                                    <div class="tab-pane fade show active" id="navs-top-one" role="tabpanel">
                                                        <div class="row">
                                                            <div class="col-md-12" id="dynamic-column">
                                                                <div class="card-body">
                                                                    <div class="mb-3">
                                                                        <label for="defaultFormControlInput1" class="form-label">Title</label>
                                                                        <input type="text" class="form-control" id="title" placeholder="Title" value="<?php echo $article_data[0]->title; ?>" aria-describedby="defaultFormControlHelp" />
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="defaultFormControlInput2" class="form-label">Keywords</label>
                                                                        <input type="text" class="form-control" id="keyword" placeholder="Keywords" aria-describedby="defaultFormControlHelp" />
                                                                    </div>   
                                                                    <div class="mb-3">
                                                                        <label for="defaultFormControlInput3" class="form-label">Abstract</label>
                                                                        <div id="quill-abstract" style="height: 250px;"></div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="defaultFormControlInput3" class="form-label">Reference</label>
                                                                        <div id="quill-reference" style="height: 250px;"></div>
                                                                    </div>
                                                                    <div class="d-flex justify-content-end mt-4" style="margin-bottom: -28px;">
                                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="navs-top-two" role="tabpanel">
                                                        <div class="col-md-12" id="dynamic-column">
                                                            <div class="table-responsive text-nowrap">
                                                                <table class="table table-striped" id="DataTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th colspan="2"><h6>Contributors</h6></th>
                                                                            <th style="text-align: right;">
                                                                                <button type="button" class="btn btn-outline-dark" id="uploadButton" style="margin-left: -10px">Add</button>
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php if (empty($article_participant)): ?>
                                                                        <tr>
                                                                            <td colspan="3" class="text-center">No data</td>
                                                                        </tr>
                                                                    <?php else: ?>
                                                                        <?php foreach ($article_participant as $article_participantval): ?>
                                                                            <tr>
                                                                                <td width="5%"><?php echo $article_participantval->id; ?></td>
                                                                                <td width="85%"><?php echo $article_participantval->file_name; ?></td>
                                                                                <td width="5%"></td>
                                                                            </tr>
                                                                        <?php endforeach; ?>    
                                                                    <?php endif; ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <th colspan="3" style="text-align: right;"></th>
                                                                    </tfoot> 
                                                                </table>
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
                </div>
            </div>

        <!-- Include footer -->
        <?php include 'template/footer.php'; ?>
    </div>
    <script>
        var quill = new Quill('#quill-abstract', {
            theme: 'snow'
        });

        var quillTwo = new Quill('#quill-reference', {
            theme: 'snow'
        });

        var abstractContent = '<?php echo addslashes($article_data[0]->abstract); ?>';
        var referenceContent = '<?php echo addslashes($article_data[0]->references); ?>';

        quill.clipboard.dangerouslyPasteHTML(abstractContent);
        quillTwo.clipboard.dangerouslyPasteHTML(referenceContent);
    </script>
</body>
</html>
