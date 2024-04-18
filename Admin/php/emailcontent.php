<?php
include 'function/redirect.php';
include 'function/workflow_function.php';
include 'function/email_function.php';

if(isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true){
    $firstName = isset($_SESSION['first_name']) ? ucfirst($_SESSION['first_name']) : '';;
    $lastName = isset($_SESSION['last_name']) ? ' ' . ucfirst($_SESSION['last_name']) : '';
}

$aid = isset($_GET['aid']) ? $_GET['aid'] : 1;
$emc = isset($_GET['emc']) ? $_GET['emc'] : 1;
$issid = isset($_GET['issid']) ? $_GET['issid'] : 1;

$article_data = get_article_data($aid);
$email_content = get_email_content($emc);
$article_contributor = get_article_contributor($aid);
$author_id = $article_data[0]->author_id;
$author_details = getauthordetails($author_id);
$submission_files = get_submission_files($aid);
$review_files = get_review_files($aid);
$revision_files = get_revision_files($aid);
$copyedited_files = get_copyedited_files($aid);
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
                                <button
                                type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true"><?php echo $email_content[0]->title; ?></button>
                            </li>
                        </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12" id="dynamic-column">
                                    <h5 class="card-header">Notify Authors</h5>
                                    <p>Send an email to the authors to let them know that this submission will be sent for peer review. If possible, give the authors some indication of how long the peer review process might take and when they should expect to hear from the editors again. This email will not be sent until the decision is recorded.</p>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="defaultFormControlInput1" class="form-label">To</label>

                                            <div class="input-group">
                                                <?php
                                                $emailString = '';

                                                foreach ($article_contributor as $article_contributorval) {
                                                    if (isset($article_contributorval->email) && $article_contributorval->email !== '') {
                                                        $emailString .= $article_contributorval->email . ', ';
                                                    }
                                                }

                                                $emailString = rtrim($emailString, ', ');
                                                ?>

                                                <input type="hidden" id="hiddenEmail" name="hiddenEmail" value="<?php echo $emailString; ?>">
                                                <input type="text" class="form-control" id="author" placeholder="Author" value="Author" aria-describedby="defaultFormControlHelp" readonly/>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <input type="hidden" id="article_id" name="article_id" value="<?php echo $article_data[0]->article_id; ?>">
                                            <input type="hidden" id="id" name="id" value="<?php print $email_content[0]->id ?>">
                                            <label for="defaultFormControlInput2" class="form-label">Subject</label>
                                            <input type="text" class="form-control" id="subject" placeholder="Subject" value="<?php echo $email_content[0]->subject; ?>" aria-describedby="defaultFormControlHelp" readonly/>
                                        </div>   
                                        <div class="mb-3">
                                            <input type="hidden" name="quillContentOne" id="quillContentOne">
                                            <div id="quill-emailcontent" style="height: 350px;"></div>
                                        </div>
                                        <?php
                                        if ($emc == 1):
                                        ?>
                                            <h5 class="card-header">Files</h5>
                                            <p>Select files you want to add in review round.</p>
                                            <div class="col-md-12" id="dynamic-column">
                                                <div class="table-responsive text-nowrap">
                                                    <table class="table table-striped" id="DataTable">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="4"><h6>Submission Files</h6></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php if (empty($submission_files)): ?>
                                                            <tr>
                                                                <td colspan="4" class="text-center">No Files</td>
                                                            </tr>
                                                        <?php else: ?>
                                                            <?php foreach ($submission_files as $submission_filesval): ?>
                                                                <?php
                                                                $isChecked = ($submission_filesval->file_type === 'File with no author name') ? 'checked' : '';
                                                                ?>
                                                                <tr>
                                                                    <td width="5%"><input class="form-check-input submission-checkbox" type="checkbox" value="" id="defaultCheck1" data-article-files-id="<?php echo $submission_filesval->article_files_id; ?>" <?php echo $isChecked; ?> /></td>
                                                                    <td width="5%"><?php echo $submission_filesval->article_files_id; ?></td>
                                                                    <td width="65%">
                                                                        <a href="../../Files/submitted-article/<?php echo urlencode($submission_filesval->file_name); ?>" download>
                                                                            <?php echo $submission_filesval->file_name; ?>
                                                                        </a>
                                                                    </td>
                                                                    <td width="25%"><?php echo $submission_filesval->file_type; ?></td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                        </tbody>
                                                        <tfoot>
                                                            <th colspan="4" style="text-align: right;">
                                                            </th>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php
                                        if ($emc == 3):
                                        ?>
                                            <h5 class="card-header">Files</h5>
                                            <p>Select files you want to add in copyediting.</p>
                                            <!-- <div class="col-md-12" id="dynamic-column">
                                                <div class="table-responsive text-nowrap">
                                                    <table class="table table-striped" id="DataTable">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="4"><h6>Submission Files</h6></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if (empty($submission_files)): ?>
                                                                <tr>
                                                                    <td colspan="4" class="text-center">No Files</td>
                                                                </tr>
                                                            <?php else: ?>
                                                                <?php foreach ($submission_files as $submission_filesval): ?>
                                                                    <?php if ($submission_filesval->file_type !== 'File with no author name'): ?>
                                                                        <tr>
                                                                            <td width="5%"><input class="form-check-input review-checkbox" type="checkbox" value="" id="defaultCheck1" data-article-files-id="<?php echo $submission_filesval->article_files_id; ?>"/></td>
                                                                            <td width="5%"><?php echo $submission_filesval->article_files_id; ?></td>
                                                                            <td width="65%">
                                                                                <a href="../../Files/submitted-article/<?php echo urlencode($submission_filesval->file_name); ?>" download>
                                                                                    <?php echo $submission_filesval->file_name; ?>
                                                                                </a>
                                                                            </td>
                                                                            <td width="25%"><?php echo $submission_filesval->file_type; ?></td>
                                                                        </tr>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </tbody>
                                                        <tfoot>
                                                            <th colspan="4" style="text-align: right;">
                                                            </th>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                            </br> -->
                                            <div class="col-md-12" id="dynamic-column">
                                                <div class="table-responsive text-nowrap">
                                                    <table class="table table-striped" id="DataTable">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="4"><h6>Revision Files</h6></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php if (empty($revision_files)): ?>
                                                            <tr>
                                                                <td colspan="4" class="text-center">No Files</td>
                                                            </tr>
                                                        <?php else: ?>
                                                            <?php foreach ($revision_files as $revision_filesval): ?>
                                                                <tr>
                                                                    <td width="5%"><input class="form-check-input revision-checkbox" type="checkbox" value="" id="defaultCheck1" data-revision-files-id="<?php echo $revision_filesval->revision_files_id; ?>"/></td>
                                                                    <td width="5%"><?php echo $revision_filesval->revision_files_id; ?></td>
                                                                    <td width="65%">
                                                                        <a href="../../Files/revision-article/<?php echo urlencode($revision_filesval->file_name); ?>" download>
                                                                            <?php echo $revision_filesval->file_name; ?>
                                                                        </a>
                                                                    </td>
                                                                    <td width="25%"><?php echo $revision_filesval->file_type; ?></td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                        </tbody>
                                                        <tfoot>
                                                            <th colspan="4" style="text-align: right;">
                                                            </th>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php
                                        if ($emc == 5):
                                        ?>
                                            <h5 class="card-header">Files</h5>
                                            <p>Select files you want to add in production.</p>
                                            <!-- <div class="col-md-12" id="dynamic-column">
                                                <div class="table-responsive text-nowrap">
                                                    <table class="table table-striped" id="DataTable">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="4"><h6>Submission Files</h6></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if (empty($submission_files)): ?>
                                                                <tr>
                                                                    <td colspan="4" class="text-center">No Files</td>
                                                                </tr>
                                                            <?php else: ?>
                                                                <?php foreach ($submission_files as $submission_filesval): ?>
                                                                    <?php if ($submission_filesval->copyedited == 1): ?>
                                                                        <tr>
                                                                            <td width="5%"><input class="form-check-input copyeditedsubmission-checkbox" type="checkbox" value="" id="defaultCheck1" data-article-files-id="<?php echo $submission_filesval->article_files_id; ?>"/></td>
                                                                            <td width="5%"><?php echo $submission_filesval->article_files_id; ?></td>
                                                                            <td width="65%">
                                                                                <a href="../../Files/submitted-article/<?php echo urlencode($submission_filesval->file_name); ?>" download>
                                                                                    <?php echo $submission_filesval->file_name; ?>
                                                                                </a>
                                                                            </td>
                                                                            <td width="25%"><?php echo $submission_filesval->file_type; ?></td>
                                                                        </tr>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </tbody>
                                                        <tfoot>
                                                            <th colspan="4" style="text-align: right;">
                                                            </th>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-3" id="dynamic-column">
                                                <div class="table-responsive text-nowrap">
                                                    <table class="table table-striped" id="DataTable">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="4"><h6>Revision Files</h6></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if (empty($revision_files)): ?>
                                                                <tr>
                                                                    <td colspan="4" class="text-center">No Files</td>
                                                                </tr>
                                                            <?php else: ?>
                                                                <?php foreach ($revision_files as $revision_filesval): ?>
                                                                    <?php if ($revision_filesval->copyedited == 1): ?>
                                                                        <tr>
                                                                            <td width="5%"><input class="form-check-input revisioncopyedited-checkbox" type="checkbox" value="" id="defaultCheck1" data-revision-files-id="<?php echo $revision_filesval->revision_files_id; ?>"/></td>
                                                                            <td width="5%"><?php echo $revision_filesval->revision_files_id; ?></td>
                                                                            <td width="65%">
                                                                                <a href="../../Files/revision-article/<?php echo urlencode($revision_filesval->file_name); ?>" download>
                                                                                    <?php echo $revision_filesval->file_name; ?>
                                                                                </a>
                                                                            </td>
                                                                            <td width="25%"><?php echo $revision_filesval->file_type; ?></td>
                                                                        </tr>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </tbody>
                                                        <tfoot>
                                                            <th colspan="4" style="text-align: right;">
                                                            </th>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div> -->
                                            <div class="col-md-12 mt-3" id="dynamic-column">
                                                <div class="table-responsive text-nowrap">
                                                    <table class="table table-striped" id="DataTable">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="4"><h6>Copyedited Files</h6></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if (empty($copyedited_files)): ?>
                                                                <tr>
                                                                    <td colspan="4" class="text-center">No Files</td>
                                                                </tr>
                                                            <?php else: ?>
                                                                <?php foreach ($copyedited_files as $copyedited_filesval): ?>
                                                                    <tr>
                                                                        <td width="5%"><input class="form-check-input copyedited-checkbox" type="checkbox" value="" id="defaultCheck1" data-final-files-id="<?php echo $copyedited_filesval->final_files_id; ?>" checked/></td>
                                                                        <td width="5%"><?php echo $copyedited_filesval->final_files_id; ?></td>
                                                                        <td width="65%">
                                                                            <a href="../../Files/copyedited-file/<?php echo urlencode($copyedited_filesval->file_name); ?>" download>
                                                                                <?php echo $copyedited_filesval->file_name; ?>
                                                                            </a>
                                                                        </td>
                                                                        <td width="25%"><?php echo $copyedited_filesval->file_type; ?></td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </tbody>
                                                        <tfoot>
                                                            <th colspan="4" style="text-align: right;">
                                                            </th>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="d-flex justify-content-end mt-4">
                                    <a href="../php/workflow.php?aid=<?php echo $article_data[0]->article_id; ?>" class="btn btn-outline-danger">Cancel</a>
                                    <button type="submit" class="btn btn-primary ms-2" id="submitBtn">Submit</button>
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
    document.addEventListener('DOMContentLoaded', function () {
        var toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'],
            ['blockquote', 'code-block'],
        ];

        var quill = new Quill('#quill-emailcontent', {
            modules: {
                toolbar: toolbarOptions
            },
            theme: 'snow'
        });

        var emailContent = <?php echo json_encode($email_content[0]->content); ?>;
        var title = <?php echo json_encode($article_data[0]->title); ?>;
        var articleid = <?php echo json_encode($article_data[0]->article_id); ?>;
        var url = "https://qcuj.online/PHP/index.php?urli=https://qcuj.online/PHP/submitted-article.php?id=" + articleid;
        var decisionText = <?php echo json_encode($email_content[0]->desicion); ?>;
        var urlText = "Submission URL:";

        if (emailContent.trim() !== '') {
            var delta = JSON.parse(emailContent);
            var titleDelta = { insert: ' "' + title + '"' };
            var urlDelta = { insert: ' ' + url + '\n' };
            var decisionIndex = delta.ops.findIndex(op => op.insert.includes(decisionText));
            var urlIndex = delta.ops.findIndex(op => op.insert.includes(urlText));

            delta.ops.splice(decisionIndex + 3, 0, titleDelta);
            delta.ops.splice(urlIndex + 2, 0, urlDelta);

            quill.setContents(delta); 
        } else {

            quill.setContents([{ insert: title + ' \n\n' }]);
        }

        var form = document.getElementById('quillForm');
        var quillContentInputOne = document.getElementById('quillContentOne');

        var submitBtn = document.getElementById('submitBtn');
        if (submitBtn) {
            submitBtn.addEventListener('click', function () {
                sendEmail(quill);
            });
        }
    });

    var issues_id = <?php echo json_encode($issid); ?>;
    var round = <?php echo json_encode($article_data[0]->round); ?>;
    var fromuser = <?php echo json_encode($lastName . ', ' . $firstName); ?>;

    function sendEmail(quillInstance) {
        $('#sloading').toggle();
        var hiddenEmail = $('#hiddenEmail').val();
        var subject = $('#subject').val();
        var article_id = $('#article_id').val();
        var author_id = <?php echo json_encode ($article_data[0]->author_id); ?>;
        var author_email = <?php echo json_encode ($author_details[0]->email); ?>;
        var id = $('#id').val();
        var title = <?php echo json_encode($article_data[0]->title); ?>;

        var checkedCheckboxes = $('.submission-checkbox:checked');
        var checkedCheckboxes1 = $('.review-checkbox:checked');
        var checkedCheckboxes2 = $('.revision-checkbox:checked');
        // var checkedCheckboxes3 = $('.copyeditedsubmission-checkbox:checked');
        // var checkedCheckboxes4 = $('.revisioncopyedited-checkbox:checked');
        var checkedCheckboxes5 = $('.copyedited-checkbox:checked');

        var checkedData = [];
        checkedCheckboxes.each(function () {
            var articleFilesId = $(this).data('article-files-id');
            checkedData.push({
                articleFilesId: articleFilesId
            });
        });

        // var checkedData1 = [];
        // checkedCheckboxes1.each(function () {
        //     var articleFilesId = $(this).data('article-files-id');
        //     checkedData1.push({
        //         articleFilesId: articleFilesId
        //     });
        // });

        var checkedData2 = [];
        checkedCheckboxes2.each(function () {
            var revisionFilesId = $(this).data('revision-files-id');
            checkedData2.push({
                revisionFilesId: revisionFilesId
            });
        });

        // var checkedData3 = [];
        // checkedCheckboxes3.each(function () {
        //     var articleFilesId = $(this).data('article-files-id');
        //     checkedData3.push({
        //         articleFilesId: articleFilesId
        //     });
        // });
        

        // var checkedData4 = [];
        // checkedCheckboxes4.each(function () {
        //     var revisionFilesId = $(this).data('revision-files-id');
        //     checkedData4.push({
        //         revisionFilesId: revisionFilesId
        //     });
        // });
        
        var checkedData5 = [];
        checkedCheckboxes5.each(function () {
            var copyeditedFilesId = $(this).data('final-files-id');
            checkedData5.push({
                copyeditedFilesId: copyeditedFilesId
            });
        });

        var jsonCheckedData = JSON.stringify(checkedData);
        // var jsonCheckedData1 = JSON.stringify(checkedData1);
        var jsonCheckedData2 = JSON.stringify(checkedData2);
        // var jsonCheckedData3 = JSON.stringify(checkedData3);
        // var jsonCheckedData4 = JSON.stringify(checkedData4);
        var jsonCheckedData5 = JSON.stringify(checkedData5);
        var deltaContent = quillInstance.getContents();
        var jsonContent = JSON.stringify(deltaContent);
            console.log(jsonCheckedData5);

        $.ajax({
            type: 'POST',
            url: '../php/function/email_function.php',
            data: {
                hiddenEmail: hiddenEmail,
                subject: subject,
                quillContentOne: jsonContent,
                article_id: article_id,
                author_id: author_id,
                author_email: author_email,
                id: id,
                issues_id: issues_id,
                round: round,
                fromuser: fromuser,
                title: title,
                checkedData: jsonCheckedData,
                // checkedData1: jsonCheckedData1,
                checkedData2: jsonCheckedData2,
                // checkedData3: jsonCheckedData3,
                // checkedData4: jsonCheckedData4,
                checkedData5: jsonCheckedData5,
                action: 'email'
            },
            success: function (response) {
                $('#sloading').toggle();
                console.log(response);
                alert('Email sent to author successfully.');
                if (<?php print $email_content[0]->id ?> == 1) {
                    window.location.href = '../php/workflow.php?aid=<?php echo $article_data[0]->article_id; ?>#navs-top-review';
                } else if (<?php print $email_content[0]->id ?> == 2) {
                    window.location.href = '../php/workflow.php?aid=<?php echo $article_data[0]->article_id; ?>#navs-top-submission';
                } else if (<?php print $email_content[0]->id ?> == 3) {
                    window.location.href = '../php/workflow.php?aid=<?php echo $article_data[0]->article_id; ?>#navs-top-copyediting';
                } else if (<?php print $email_content[0]->id ?> == 4) {
                    window.location.href = '../php/workflow.php?aid=<?php echo $article_data[0]->article_id; ?>#navs-top-review';
                } else if (<?php print $email_content[0]->id ?> == 5) {
                    window.location.href = '../php/workflow.php?aid=<?php echo $article_data[0]->article_id; ?>#navs-top-production';
                } else if (<?php print $email_content[0]->id ?> == 6) {
                    window.location.href = '../php/workflow.php?aid=<?php echo $article_data[0]->article_id; ?>#navs-top-production';
                } else if (<?php print $email_content[0]->id ?> == 7) {
                    window.location.href = '../php/workflow.php?aid=<?php echo $article_data[0]->article_id; ?>#navs-top-production';
                } else if (<?php print $email_content[0]->id ?> == 8) {
                    window.location.href = '../php/workflow.php?aid=<?php echo $article_data[0]->article_id; ?>#navs-top-production';
                }
            },
            error: function (error) {
                console.error(error);
            }
        });
    }
    </script>
</body>
</html>
