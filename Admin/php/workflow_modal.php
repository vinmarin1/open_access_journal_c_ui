<?php
include 'function/workflow_function.php';
include 'function/userandroles_function.php';

if(isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true){
    $firstName = isset($_SESSION['first_name']) ? ucfirst($_SESSION['first_name']) : '';;
    $lastName = isset($_SESSION['last_name']) ? ' ' . ucfirst($_SESSION['last_name']) : '';
}

$aid = isset($_GET['aid']) ? $_GET['aid'] : 1;

$submission_files = get_submission_files($aid);
$review_files = get_review_files($aid);
$copyediting_files = get_copyediting_files($aid);
$copyeditingrevision_files = get_copyeditingrevision_files($aid);
// $copyeditedsubmission_files = get_copyeditedsubmission_files($aid);
// $copyeditedrevision_files = get_copyeditedrevision_files($aid);
// $copyedited_files = get_copyedited_files($aid);
$allcopyedited_files = get_allcopyedited_files($aid);
$allproduction_files = get_production_files($aid);
$revision_files = get_revision_files($aid);
$articlelogs = get_article_logs($aid);
$articledata = get_article_data($aid);
$journal_id = $articledata[0]->journal_id;
$issuelist = get_issues_list($journal_id);
?>

<!-- Add Discussion Modal -->
<div class="modal fade" id="addDiscussionModal" tabindex="-1" aria-hidden="true">
    <form id="addModalForm1">
        <div class="modal-dialog modal-lg" role="document" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="discussionType"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <input type="hidden" id="discussionTypeInput" class="form-control" readonly>
                            <label for="xsubmissionsubject" class="form-label">Subject</label>
                            <input type="text" id="submissionsubject" class="form-control" placeholder="Subject" required/>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xsubmissionmessage" class="form-label">Message</label>
                            <textarea class="form-control" id="submissionmessage" rows="9"></textarea>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xsubmissionfiletype" class="form-label">File Type</label>
                            <select id="submissionfiletype" class="form-select" onchange="enableFileInput1()">
                                <option value="">Select</option>
                                <option value="Title page">Title page</option>
                                <option value="File with author">File with author</option>
                                <!-- <option value="File with no author">File with no author</option> -->
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2" id="divsubmissionfilexx">
                            <label for="submissionfilexx" class="form-label">Upload File</label>
                            <input class="form-control" type="file" id="submissionfilexx" accept=".doc, .docx" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addDiscussion()">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!--View Discussion Modal -->
<div class="modal fade" id="ViewDiscussionModal" tabindex="-1" aria-hidden="true">
    <form id="addModalForm">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">View Pre-Review Discussion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2" id="dynamic-column">
                            <input type="hidden" id="discussion_id" class="form-control"/>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped" id="DataTableSubmissionDiscussion">
                                    <thead>
                                        <tr>    
                                            <th colspan="2">
                                                <h5 class="card-header" id="discussionSubject"></h5>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Answer rows will be dynamically added here -->
                                    </tbody>
                                    <tfoot>
                                        <th colspan="2" style="text-align: right;"></th>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2" id="messageContainer" style="display: none;">
                            <div class="row mb-2">
                                <div class="col-md-12 mb-2">
                                    <label for="xsubmissionmessage" class="form-label">Message</label>
                                    <textarea class="form-control" id="submissionmessagex" rows="9"></textarea>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12 mb-2">
                                    <label for="xsubmissionfiletype" class="form-label">File Type</label>
                                    <select id="submissionfiletypex" class="form-select" onchange="enableFileInput2()">
                                        <option value="">Select</option>
                                        <option value="Title page">Title page</option>
                                        <option value="File with author">File with author</option>
                                        <!-- <option value="File with no author">File with no author</option> -->
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12 mb-2" id="divsubmissionfilexxx">
                                    <label for="submissionfilexx" class="form-label">Upload File</label>
                                    <input class="form-control" type="file" id="submissionfilexxx" accept=".doc, .docx" />
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12 mt-2" id="dynamic-column" style="text-align: right;">
                                    <button type="button" class="btn btn-primary" onclick="replyDiscussion()">Send Message</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2" id="addMessageButtonx">
                        <div class="col-md-12 mt-2" id="dynamic-column" style="text-align: right;">
                            <button type="button" id="addMessageButton" class="btn btn-primary">Add Message</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Add Logs Modal -->
<div class="modal fade" id="viewLogsModal" tabindex="-1" aria-hidden="true">
    <form id="addModalForm">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">View Article Logs</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped" id="DataTable">
                                    <thead>
                                        <tr>
                                            <th>MESSAGE</th>
                                            <th>FROM</th>
                                            <th>DATE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (empty($articlelogs)): ?>
                                        <tr>
                                            <td colspan="3" class="text-center">No Items</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($articlelogs as $articlelogsval): ?>
                                            <tr>
                                                <td width="50%"><?php echo $articlelogsval->type; ?></td>
                                                <td width="30%">
                                                    <?php 
                                                        if (!empty($articlelogsval->fromuser)) {
                                                            echo $articlelogsval->fromuser;
                                                        } else {
                                                            echo $article_data[0]->author; 
                                                        }
                                                    ?>
                                                </td>
                                                <td width="20%">
                                                    <?php
                                                    $dateTime = new DateTime($articlelogsval->date);
                                                    echo $dateTime->format('j, F Y');
                                                    ?>
                                                </td>

                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    </tbody>
                                    <tfoot>
                                        <th colspan="3" style="text-align: right;">
                                        </th>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- SUBMISSION PAGE -->
<!-- Add Files Modal -->
<div class="modal fade" id="addFilesModal" tabindex="-1" aria-hidden="true">
    <form id="updatesubmisionfile" enctype="multipart/form-data">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Update Submission Files</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xfiles" class="form-label">If you are uploading a revision of an existing file, please indicate which file.</label>
                            <select id="submissionfileid" class="form-select" onchange="enableFileInput()">
                                <option value="">Select File</option>
                                <?php foreach ($submission_files as $submission_filesval): ?>
                                    <option value="<?php echo $submission_filesval->article_files_id; ?>"><?php echo $submission_filesval->file_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2" id="divxsubmissionfile">
                            <label for="formFileAddFiles" class="form-label">Upload New File</label>
                            <input class="form-control" type="file" id="submissionfile" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateFileSubmission()">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- REVIEW PAGE -->
<!-- Add Revision Modal -->
<div class="modal fade" id="addRevisionModal" tabindex="-1" aria-hidden="true">
    <form id="addModalForm1">
        <div class="modal-dialog modal-lg" role="document" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Add File Revision</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xrevisionfiletype" class="form-label">File Type</label>
                            <select id="revisionfiletype" class="form-select" onchange="enableFileInput3()">
                                <option value="">Select</option>
                                <option value="Title page">Title page</option>
                                <option value="File with author">File with author</option>
                                <!-- <option value="File with no author">File with no author</option> -->
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2" id="divrevisionfile">
                            <label for="submissionfilexx" class="form-label">Upload File</label>
                            <input class="form-control" type="file" id="revisionfile" accept=".doc, .docx" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addRevisionFile()">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Add Review Files Modal -->
<div class="modal fade" id="addReviewFilesModal" tabindex="-1" aria-hidden="true">
    <form id="addModalForm">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Select Review Files</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-12  mb-2" id="dynamic-column">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped" id="DataTable">
                                    <thead>
                                        <tr>
                                            <th colspan="4">
                                            <h5 class="card-header">Submissiom File</h5>
                                            <p>Select files you want to add in review round.</p>
                                            </th>
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
                                                $isReviewEqualToOne = ($submission_filesval->review == 1);
                                            ?>
                                            <tr>
                                                <td width="5%">
                                                    <input class="form-check-input review-checkbox" type="checkbox" value="" id="defaultCheck1" data-article-files-id="<?php echo $submission_filesval->article_files_id; ?>" <?php echo $isReviewEqualToOne ? 'checked' : ''; ?> />
                                                </td>
                                                <td width="5%"><?php echo $submission_filesval->article_files_id; ?></td>
                                                <td width="65%">
                                                    <a href="../../../Files/submitted-article/<?php echo ($submission_filesval->file_name); ?>" download>
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
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12  mb-2" id="dynamic-column">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped" id="DataTable">
                                    <thead>
                                        <tr>
                                            <th colspan="4">
                                                <h5 class="card-header">Review File</h5>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($review_files)): ?>
                                            <tr>
                                                <td colspan="4" class="text-center">No Files</td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($review_files as $review_filesval): ?>
                                                <tr>
                                                    <td width="5%"><?php echo $review_filesval->article_files_id; ?></td>
                                                    <td width="70%">
                                                        <a href="../../../Files/submitted-article/<?php echo ($review_filesval->file_name); ?>" download>
                                                            <?php echo $review_filesval->file_name; ?>
                                                        </a>
                                                    </td>
                                                    <td width="25%"><?php echo $review_filesval->file_type; ?></td>
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
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateReviewFiles()">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Add Reviewer Answer Modal -->
<div class="modal fade" id="addReviewerAnswerModal" tabindex="-1" aria-hidden="true">
    <form id="addModalForm1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="roundInfo"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2" id="dynamic-column">
                        <input type="hidden" id="reviewer_assigned_id" class="form-control"/>
                        <input type="hidden" id="accessible" class="form-control"/>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped" id="DataTableAnswer">
                                    <thead>
                                        <tr>
                                            <th>Question</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Answer rows will be dynamically added here -->
                                    </tbody>
                                    <tfoot>
                                        <th colspan="2" style="text-align: right;"></th>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="acceptButton" data-bs-dismiss="modal" onclick="acceptReviewerAnswer()">Accept</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- COPYEDTING PAGE -->
<!-- Add Copyediting Files Modal -->
<div class="modal fade" id="addCopyeditingFilesModal" tabindex="-1" aria-hidden="true">
    <form id="addModalForm">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Select Copyediting Files</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-12  mb-2" id="dynamic-column">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped" id="DataTable">
                                    <thead>
                                        <tr>
                                            <th colspan="4">
                                            <h5 class="card-header">Submissiom File</h5>
                                            <p>Select files you want to add in copyediting.</p>
                                            </th>
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
                                                <?php
                                                    $isReviewEqualToOne = ($submission_filesval->copyediting == 1);
                                                ?>
                                                <tr>
                                                    <td width="5%">
                                                        <input class="form-check-input copyediting-checkbox" type="checkbox" value="" id="defaultCheck1" data-article-files-id="<?php echo $submission_filesval->article_files_id; ?>" <?php echo $isReviewEqualToOne ? 'checked' : ''; ?> />
                                                    </td>
                                                    <td width="5%"><?php echo $submission_filesval->article_files_id; ?></td>
                                                    <td width="65%">
                                                        <a href="../../../Files/submitted-article/<?php echo ($submission_filesval->file_name); ?>" download>
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
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12  mb-2" id="dynamic-column">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped" id="DataTable">
                                    <thead>
                                        <tr>
                                            <th colspan="4">
                                            <h5 class="card-header">Revision File</h5>
                                            <p>Select files you want to add in copyediting.</p>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($revision_files)): ?>
                                            <tr>
                                                <td colspan="4" class="text-center">No Files</td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($revision_files as $revision_filesval): ?>
                                                <?php
                                                    $isReviewEqualToOne = ($revision_filesval->copyediting == 1);
                                                ?>
                                                <tr>
                                                    <td width="5%">
                                                        <input class="form-check-input copyeditingrevision-checkbox" type="checkbox" value="" id="defaultCheck1" data-revision-files-id="<?php echo $revision_filesval->revision_files_id; ?>" <?php echo $isReviewEqualToOne ? 'checked' : ''; ?> />
                                                    </td>
                                                        <td width="5%"><?php echo $revision_filesval->revision_files_id; ?></td>
                                                    <td width="65%">
                                                        <a href="../../../Files/revision-article/<?php echo ($revision_filesval->file_name); ?>" download>
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
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12  mb-2" id="dynamic-column">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped" id="DataTable">
                                    <thead>
                                        <tr>
                                            <th colspan="4">
                                            <h5 class="card-header">Copyediting File</h5>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($copyediting_files)): ?>
                                            <tr>
                                                <td colspan="4" class="text-center">No Files</td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($copyediting_files as $copyediting_filesval): ?>
                                            <tr>
                                                <td width="5%"><?php echo $copyediting_filesval->article_files_id; ?></td>
                                                <td width="65%">
                                                    <a href="../../../Files/submitted-article/<?php echo ($copyediting_filesval->file_name); ?>" download>
                                                        <?php echo $copyediting_filesval->file_name; ?>
                                                    </a>
                                                </td>
                                                <td width="25%"><?php echo $copyediting_filesval->file_type; ?></td>
                                                <td width="5%"><span class="badge rounded-pill bg-label-warning">Submission</span></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <?php foreach ($copyeditingrevision_files as $copyeditingrevision_filesval): ?>
                                            <tr>
                                                <td width="5%"><?php echo $copyeditingrevision_filesval->revision_files_id; ?></td>
                                                <td width="65%">
                                                    <a href="../../../Files/revision-article/<?php echo ($copyeditingrevision_filesval->file_name); ?>" download>
                                                        <?php echo $copyeditingrevision_filesval->file_name; ?>
                                                    </a>
                                                </td>
                                                <td width="25%"><?php echo $copyeditingrevision_filesval->file_type; ?></td>
                                                <td width="5%"><span class="badge rounded-pill bg-label-warning">Revision</span></td>

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
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateCopyeditingFiles()">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Add Copyedited Files Modal -->
<div class="modal fade" id="addCopyeditedFilesModal" tabindex="-1" aria-hidden="true">
    <form id="addModalForm">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Select Copyedited Files</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2" id="xuploadfile">
                        <div class="col-md-12 mt-2" id="dynamic-column" style="text-align: right;">
                            <button type="button" id="uploadfile" class="btn btn-primary">Upload File</button>
                        </div>
                    </div>
                    <div class="col-md-12 mb-2" id="uploadfileContainer" style="display: none;">
                        <div class="row mb-2">
                            <div class="col-md-12 mb-2">
                                <h5 class="card-header">Upload File</h5>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12 mb-2">
                                <label for="xcopyeditedfiletype" class="form-label">File Type</label>
                                <select id="copyeditedfiletype" class="form-select" onchange="enableFileInput4()">
                                    <option value="">Select</option>
                                    <option value="Final">Final</option>
                                    <option value="Title page">Title page</option>
                                    <option value="File with author">File with author</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12 mb-2" id="divcopyeditedfile">
                                <label for="xcopyeditedfile" class="form-label">Upload File</label>
                                <input class="form-control" type="file" id="copyeditedfile" accept=".doc, .docx, .pdf" />
                            </div>
                        </div>
                    <hr>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-12  mb-2" id="dynamic-column">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped" id="DataTable">
                                    <thead>
                                        <tr>
                                            <th colspan="4">
                                            <h5 class="card-header">Copyedited File</h5>
                                            <p>Select files you want to add in copyedited.</p>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($allcopyedited_files)): ?>
                                            <tr>
                                                <td colspan="4" class="text-center">No Files</td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($allcopyedited_files as $allcopyedited_filesval): ?>
                                                <?php
                                                    $isReviewEqualToOne = ($allcopyedited_filesval->copyedited == 1);
                                                ?>
                                                <tr>
                                                    <td width="5%">
                                                        <input class="form-check-input copyedited-checkbox" type="checkbox" value="" id="defaultCheck1" data-final-files-id="<?php echo $allcopyedited_filesval->final_files_id; ?>" <?php echo $isReviewEqualToOne ? 'checked' : ''; ?> />
                                                    </td>
                                                        <td width="5%"><?php echo $allcopyedited_filesval->final_files_id; ?></td>
                                                    <td width="65%">
                                                        <a href="../../../Files/final-file/<?php echo ($allcopyedited_filesval->file_name); ?>" download>
                                                            <?php echo $allcopyedited_filesval->file_name; ?>
                                                        </a>
                                                    </td>
                                                    <td width="25%"><?php echo $allcopyedited_filesval->file_type; ?></td>
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
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12  mb-2" id="dynamic-column">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped" id="DataTable">
                                    <thead>
                                        <tr>
                                            <th colspan="4">
                                            <h5 class="card-header">Copyedited File</h5>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $hasCopyeditedFiles = false;

                                        foreach ($allcopyedited_files as $allcopyedited_filesval) {
                                            if ($allcopyedited_filesval->copyedited == 1) {
                                                $hasCopyeditedFiles = true;
                                                break;
                                            }
                                        }

                                        if ($hasCopyeditedFiles) {
                                            foreach ($allcopyedited_files as $allcopyedited_filesval) {
                                                if ($allcopyedited_filesval->copyedited == 1) {
                                                    ?>
                                                    <tr>
                                                        <td width="5%"><?php echo $allcopyedited_filesval->final_files_id; ?></td>
                                                        <td width="65%">
                                                            <a href="../../../Files/final-file/<?php echo ($allcopyedited_filesval->file_name); ?>" download>
                                                                <?php echo $allcopyedited_filesval->file_name; ?>
                                                            </a>
                                                        </td>
                                                        <td width="25%"><?php echo $allcopyedited_filesval->file_type; ?></td>
                                                        <td width="5%"><span class="badge rounded-pill bg-label-warning">Copyedited</span></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }

                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="4" class="text-center">No Items</td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <th colspan="4" style="text-align: right;">
                                        </th>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateCopyeditedFiles()">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>


<!-- Add Issue Modal -->
<div class="modal fade" id="addIssueModal" tabindex="-1" aria-hidden="true">
    <form id="addModalForm">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Select Issues</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped" id="DataTable">
                                    <thead>
                                        <tr>
                                            <th colspan="5">
                                                <h5 class="card-header">Issues</h5>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (empty($issuelist)): ?>
                                        <tr>
                                            <td colspan="5" class="text-center">No Items</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($issuelist as $issuelistval): ?>
                                            <tr>
                                                <td width="5%"><?php echo $issuelistval->issues_id; ?></td>
                                                <td width="20%">Volume <?php echo $issuelistval->volume; ?></td>
                                                <td width="50%"><?php echo $issuelistval->title; ?></td>
                                                <td width="20%"><?php echo $issuelistval->year; ?></td>
                                                <td width="5%">
                                                <button type="button" class="btn btn-outline-dark" onclick="SendForReadyPublication('<?php echo $issuelistval->issues_id; ?>')">View</button>

                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5" style="text-align: right;"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Add Production Modal -->
<div class="modal fade" id="addProductionFilesModal" tabindex="-1" aria-hidden="true">
    <form id="addModalForm">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Select Production Ready Files</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2" id="xuploadproductionfile">
                        <div class="col-md-12 mt-2" id="dynamic-column" style="text-align: right;">
                            <button type="button" id="uploadproductionfile" class="btn btn-primary">Upload File</button>
                        </div>
                    </div>
                    <div class="col-md-12 mb-2" id="uploadproductionfileContainer" style="display: none;">
                        <div class="row mb-2">
                            <div class="col-md-12 mb-2">
                                <h5 class="card-header">Upload File</h5>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12 mb-2">
                                <label for="xproductionfiletype" class="form-label">File Type</label>
                                <select id="productionfiletype" class="form-select" onchange="enableFileInput5()">
                                    <option value="">Select</option>
                                    <option value="Final">Final</option>
                                    <option value="Title page">Title page</option>
                                    <option value="File with author">File with author</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12 mb-2" id="divproductionfile">
                                <label for="xproductionfile" class="form-label">Upload File</label>
                                <input class="form-control" type="file" id="productionfile" accept=".pdf" />
                            </div>
                        </div>
                    <hr>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2" id="dynamic-column">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped" id="DataTable">
                                    <thead>
                                        <tr>
                                            <th colspan="4">
                                            <h5 class="card-header">Copyedited File</h5>
                                            <p>Select files you want to see in publication.</p>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($allcopyedited_files)): ?>
                                            <tr>
                                                <td colspan="4" class="text-center">No Files</td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($allcopyedited_files as $allcopyedited_filesval): ?>
                                                <?php
                                                    $isReviewEqualToOne = ($allcopyedited_filesval->production == 1);
                                                ?>
                                                <tr>
                                                    <td width="5%">
                                                        <input class="form-check-input copyedited-checkbox" type="checkbox" value="" id="defaultCheck1" data-finalcopyedited-files-id="<?php echo $allcopyedited_filesval->final_files_id; ?>" <?php echo $isReviewEqualToOne ? 'checked' : ''; ?> />
                                                    </td>
                                                        <td width="5%"><?php echo $allcopyedited_filesval->final_files_id; ?></td>
                                                    <td width="65%">
                                                        <a href="../../../Files/final-file/<?php echo ($allcopyedited_filesval->file_name); ?>" download>
                                                            <?php echo $allcopyedited_filesval->file_name; ?>
                                                        </a>
                                                    </td>
                                                    <td width="25%"><?php echo $allcopyedited_filesval->file_type; ?></td>
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
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2" id="dynamic-column">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped" id="DataTable">
                                    <thead>
                                        <tr>
                                            <th colspan="4">
                                            <h5 class="card-header">Production File</h5>
                                            <p>Select files you want to see in publication.</p>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($allproduction_files)): ?>
                                            <tr>
                                                <td colspan="4" class="text-center">No Files</td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($allproduction_files as $allproduction_filesval): ?>
                                                <?php
                                                    $isReviewEqualToOne = ($allproduction_filesval->production == 1);
                                                ?>
                                                <tr>
                                                    <td width="5%">
                                                        <input class="form-check-input production-checkbox" type="checkbox" value="" id="defaultCheck1" data-finalproduction-files-id="<?php echo $allproduction_filesval->final_files_id; ?>" <?php echo $isReviewEqualToOne ? 'checked' : ''; ?> />
                                                    </td>
                                                        <td width="5%"><?php echo $allproduction_filesval->final_files_id; ?></td>
                                                    <td width="65%">
                                                        <a href="../../../Files/final-file/<?php echo ($allproduction_filesval->file_name); ?>" download>
                                                            <?php echo $allproduction_filesval->file_name; ?>
                                                        </a>
                                                    </td>
                                                    <td width="25%"><?php echo $allproduction_filesval->file_type; ?></td>
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
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12  mb-2" id="dynamic-column">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped" id="DataTable">
                                    <thead>
                                        <tr>
                                            <th colspan="4">
                                            <h5 class="card-header">Production Ready File</h5>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $hasCopyeditedFiles = false;

                                        foreach ($allcopyedited_files as $allcopyedited_filesval) {
                                            if ($allcopyedited_filesval->production == 1) {
                                                $hasCopyeditedFiles = true;
                                                break;
                                            }
                                        }

                                        foreach ($allproduction_files as $allproduction_filesval) {
                                            if ($allproduction_filesval->production == 1) {
                                                $hasCopyeditedFiles = true;
                                                break;
                                            }
                                        }

                                        if ($hasCopyeditedFiles) {
                                            foreach ($allcopyedited_files as $allcopyedited_filesval) {
                                                if ($allcopyedited_filesval->production == 1) {
                                                    ?>
                                                    <tr>
                                                        <td width="5%"><?php echo $allcopyedited_filesval->final_files_id; ?></td>
                                                        <td width="65%">
                                                            <a href="../../../Files/final-file/<?php echo ($allcopyedited_filesval->file_name); ?>" download>
                                                                <?php echo $allcopyedited_filesval->file_name; ?>
                                                            </a>
                                                        </td>
                                                        <td width="25%"><?php echo $allcopyedited_filesval->file_type; ?></td>
                                                        <td width="5%"><span class="badge rounded-pill bg-label-warning">Copyedited</span></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }

                                            foreach ($allproduction_files as $allproduction_filesval) {
                                                if ($allproduction_filesval->production == 1) {
                                                    ?>
                                                    <tr>
                                                        <td width="5%"><?php echo $allproduction_filesval->final_files_id; ?></td>
                                                        <td width="65%">
                                                            <a href="../../../Files/final-file/<?php echo ($allproduction_filesval->file_name); ?>" download>
                                                                <?php echo $allproduction_filesval->file_name; ?>
                                                            </a>
                                                        </td>
                                                        <td width="25%"><?php echo $allproduction_filesval->file_type; ?></td>
                                                        <td width="5%"><span class="badge rounded-pill bg-label-warning">Production</span></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }

                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="4" class="text-center">No Items</td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <th colspan="4" style="text-align: right;">
                                        </th>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateProductionFiles()">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- PUBLICATION PAGE -->
<!-- Add Contributors Modal -->
<div class="modal fade" id="addContributorsModal" tabindex="-1" aria-hidden="true">
     <form id="addModalForm">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Add Contributors</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-6 mb-2">
                            <label for="xfirstname" class="form-label">First Name</label>
                            <input type="text" id="first_name" class="form-control" placeholder="First Name" required/>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="xlastname" class="form-label">Last Name</label>
                            <input type="text" id="last_name" class="form-control" placeholder="Last Name" required/>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="xpublicname" class="form-label">Public Name</label>
                            <input type="text" id="xpublicname" class="form-control" placeholder="Public Name"/>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="xemail">Email</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                <input type="text" id="email" class="form-control" placeholder="juan.delacruz" aria-label="juan.delacruz" aria-describedby="basic-icon-default-email2" required/>
                                <span id="semail" class="input-group-text">@example.com</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="xphone_number">Phone No</label>
                            <div class="input-group input-group-merge">
                                <span id="sphone_number" class="input-group-text"><i class="bx bx-phone"></i></span>
                                <input type="text" id="phone_number" class="form-control phone-mask" placeholder="639 799 8941" aria-label="639 799 8941" aria-describedby="basic-icon-default-phone2" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 mb-2">
                            <label for="xorcid" class="form-label">ORCID</label>
                            <input type="text" id="orcid" class="form-control" placeholder="ORCID" required/>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="xorcidurl" class="form-label">ORCID URL</label>
                            <input type="text" id="orcidurl" class="form-control" placeholder="ORCID URL" required/>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">Notify user by email.</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addRecord()">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
$(document).ready(function () {
    $('#addMessageButton').on('click', function () {

        $('#messageContainer').show();
        $('#addMessageButtonx').hide();
    });
});

$(document).ready(function () {
    $('#uploadfile').on('click', function () {

        $('#uploadfileContainer').show();
        $('#xuploadfile').hide();
    });
});

$(document).ready(function () {
    $('#uploadproductionfile').on('click', function () {

        $('#uploadproductionfileContainer').show();
        $('#uploadproductionfile').hide();
    });
});

$(document).ready(function() {
    enableFileInput();
    enableFileInput1();
    enableFileInput2();
    enableFileInput3();
    enableFileInput4();
    enableFileInput5();
});

function enableFileInput() {
    var selectedValue = $('#submissionfileid').val();
    
    if (selectedValue !== '') {
        $('#divxsubmissionfile').show();
        $('#submissionfile').prop('required', true); 
    } else {
        $('#divxsubmissionfile').hide();
        $('#submissionfile').prop('required', false); 
    }
}

function enableFileInput1() {
    var selectedValue = $('#submissionfiletype').val();
    
    if (selectedValue !== '') {
        $('#divsubmissionfilexx').show();
    } else {
        $('#divsubmissionfilexx').hide();
    }
}

function enableFileInput2() {
    var selectedValue = $('#submissionfiletypex').val();
    
    if (selectedValue !== '') {
        $('#divsubmissionfilexxx').show();
    } else {
        $('#divsubmissionfilexxx').hide();
    }
}

function enableFileInput3() {
    var selectedValue = $('#revisionfiletype').val();
    
    if (selectedValue !== '') {
        $('#divrevisionfile').show();
    } else {
        $('#divrevisionfile').hide();
    }
}

function enableFileInput4() {
    var selectedValue = $('#copyeditedfiletype').val();
    
    if (selectedValue !== '') {
        $('#divcopyeditedfile').show();
    } else {
        $('#divcopyeditedfile').hide();
    }
}

function enableFileInput5() {
    var selectedValue = $('#productionfiletype').val();
    
    if (selectedValue !== '') {
        $('#divproductionfile').show();
    } else {
        $('#divproductionfile').hide();
    }
}

function updateReviewFiles() {
    $('#sloading').toggle();
    updateReviewCheckedFiles();
    updateReviewUncheckedFiles();
}

function updateReviewCheckedFiles() {
    var checkedCheckboxes = $('.review-checkbox:checked');

    if (checkedCheckboxes.length === 0) {
        console.log("No checked files. Aborting update.");
        return; // Exit the function
    }

    var checkedData = [];
    checkedCheckboxes.each(function () {
        var articleFilesId = $(this).data('article-files-id');
        checkedData.push({
            articleFilesId: articleFilesId
        });
    });

    var jsonCheckedData = JSON.stringify(checkedData);

    console.log('Checked Data:', checkedData);

    $.ajax({
        type: 'POST',
        url: '../php/function/wf_modal_function.php',
        data: {
            checkedData: jsonCheckedData,
            action: 'updatereviewcheckedfile'
        },
        success: function(response) {
            $('#sloading').toggle();
            console.log('Checked checkboxes data sent successfully.');
            console.log(response);
            location.reload();
        },
        error: function(error) {
            console.error('Error sending checked checkboxes data:', error);
        }
    });
}

function updateReviewUncheckedFiles() {
    var uncheckedCheckboxes = $('.review-checkbox:not(:checked)');

    if (uncheckedCheckboxes.length === 0) {
        console.log("No unchecked files. Aborting update.");
        return; // Exit the function
    }

    var uncheckedData = [];
    uncheckedCheckboxes.each(function () {
        var articleFilesId = $(this).data('article-files-id');
        uncheckedData.push({
            articleFilesId: articleFilesId
        });
    });

    var jsonUncheckedData = JSON.stringify(uncheckedData);

    console.log('Unchecked Data:', uncheckedData);

    $.ajax({
        type: 'POST',
        url: '../php/function/wf_modal_function.php',
        data: {
            uncheckedData: jsonUncheckedData,
            action: 'updatereviewuncheckedfile'
        },
        success: function(response) {
            $('#sloading').toggle();
            console.log('Unchecked checkboxes data sent successfully.');
            console.log(response);
            location.reload();
        },
        error: function(error) {
            console.error('Error sending unchecked checkboxes data:', error);
        }
    });
}

function updateCopyeditingFiles() {
    $('#sloading').toggle();
    updateCopyeditingCheckedFiles();
    updateCopyeditingUncheckedFiles();
}

function updateCopyeditingCheckedFiles() {
    var checkedCheckboxes = $('.copyediting-checkbox:checked');
    var checkedCheckboxes1 = $('.copyeditingrevision-checkbox:checked');

    if (checkedCheckboxes.length === 0 && checkedCheckboxes1.length === 0) {
        console.log("No checkboxes checked. Aborting update.");
        return;
    }

    var checkedData = [];
    checkedCheckboxes.each(function () {
        var articleFilesId = $(this).data('article-files-id');
        checkedData.push({
            articleFilesId: articleFilesId
        });
    });

    var checkedData1 = [];
    checkedCheckboxes1.each(function () {
        var revisionFilesId = $(this).data('revision-files-id');
        checkedData1.push({
            revisionFilesId: revisionFilesId
        });
    });

    var jsonCheckedData = JSON.stringify(checkedData);
    var jsonCheckedData1 = JSON.stringify(checkedData1);

    console.log('Checked Data:', jsonCheckedData);
    console.log('Checked Data:', jsonCheckedData1);

    $.ajax({
        type: 'POST',
        url: '../php/function/wf_modal_function.php',
        data: {
            checkedData: jsonCheckedData,
            checkedRevisionData: jsonCheckedData1,
            action: 'updatecopyeditingcheckedfile'
        },
        success: function(response) {
            $('#sloading').toggle();
            console.log('Checked checkboxes data sent successfully.');
            console.log(response);
            location.reload();
        },
        error: function(error) {
            console.error('Error sending checked checkboxes data:', error);
        }
    });
}

function updateCopyeditingUncheckedFiles() {
    var uncheckedCheckboxes = $('.copyediting-checkbox:not(:checked)');
    var uncheckedCheckboxes1 = $('.copyeditingrevision-checkbox:not(:checked)');

    if (uncheckedCheckboxes.length === 0 && uncheckedCheckboxes1.length === 0) {
        console.log("No unheckboxes checked. Aborting update.");
        return;
    }

    var uncheckedData = [];
    uncheckedCheckboxes.each(function () {
        var articleFilesId = $(this).data('article-files-id');
        uncheckedData.push({
            articleFilesId: articleFilesId
        });
    });

    var uncheckedData1 = [];
    uncheckedCheckboxes1.each(function () {
        var revisionFilesId = $(this).data('revision-files-id');
        uncheckedData1.push({
            revisionFilesId: revisionFilesId
        });
    });

    var jsonUncheckedData = JSON.stringify(uncheckedData);
    var jsonUncheckedData1 = JSON.stringify(uncheckedData1);

    console.log('Unchecked Data:', jsonUncheckedData);
    console.log('Unchecked Data:', jsonUncheckedData1);

    $.ajax({
        type: 'POST',
        url: '../php/function/wf_modal_function.php',
        data: {
            uncheckedData: jsonUncheckedData,
            uncheckedRevisionData: jsonUncheckedData1,
            action: 'updatecopyeditinguncheckedfile'
        },
        success: function(response) {
            $('#sloading').toggle();
            console.log('Unchecked checkboxes data sent successfully.');
            console.log(response);
            location.reload();
        },
        error: function(error) {
            console.error('Error sending unchecked checkboxes data:', error);
        }
    });
}

function updateFileSubmission() {
    $('#sloading').toggle();
    var submissionFileId = $('#submissionfileid').val();
    var submissionFile = $('#submissionfile')[0].files[0];
    var articleId = <?php echo json_encode($aid); ?>;
    var fileType = $('#submissionfileid option:selected').text(); // Get the selected file type
    console.log(fileType);

    if ($('#submissionfile').prop('required') && !submissionFile) {
        $('#sloading').toggle();
        alert('File is required. Please select a file.');
        return; 
    }

    if (submissionFile) {
        if (submissionFile.size >= 1.5 * 1024 * 1024) { 
            $('#sloading').toggle();
            alert("File size exceeds the limit of 1.5 MB. Please upload a smaller file.");
            return;
        }
    }

    var formData = new FormData();
    formData.append('submissionfileid', submissionFileId);
    formData.append('submissionfile', submissionFile);
    formData.append('action', 'updatesubmissionfile');
    formData.append('article_id', articleId);
    formData.append('fileType', fileType); // Append the file type to the form data

    $.ajax({
        url: "../php/function/wf_modal_function.php",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            $('#sloading').toggle();
            console.log(response);
            location.reload();
        },
        error: function (xhr, status, error) {
            console.error(xhr, status, error);
        }
    });
}

var articleId = <?php echo json_encode($aid); ?>;
var fromuser = <?php echo json_encode($lastName . ', ' . $firstName); ?>;

function addDiscussion() {
    $('#sloading').toggle();
    var discussionTypeInput = $('#discussionTypeInput').val();
    var submissionSubject = $('#submissionsubject').val();
    var submissionMessage = $('#submissionmessage').val();
    var submissionFiletype = $('#submissionfiletype').val();
    var submissionFile = $('#submissionfilexx')[0].files[0];

    if (submissionFile) {
        if (submissionFile.size >= 1.5 * 1024 * 1024) { 
            $('#sloading').toggle();
            alert("File size exceeds the limit of 1.5 MB. Please upload a smaller file.");
            return;
        }
    }

    var formData = new FormData();
    formData.append('article_id', articleId);
    formData.append('fromuser', fromuser);
    formData.append('discussiontype', discussionTypeInput);
    formData.append('submissionsubject', submissionSubject);
    formData.append('submissionmessage', submissionMessage);
    formData.append('submissionfiletype', submissionFiletype);
    formData.append('submissionfile', submissionFile);
    formData.append('action', 'adddiscussion');

    $.ajax({
        url: "../php/function/wf_modal_function.php",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            $('#sloading').toggle();
            console.log(response);
            location.reload();
        },
        error: function (xhr, status, error) {
            console.error(xhr, status, error);
        }
    });
}

function replyDiscussion() {
    $('#sloading').toggle();
    var discussionId = $('#discussion_id').val();
    var submissionMessage = $('#submissionmessagex').val();
    var submissionFiletype = $('#submissionfiletypex').val();
    var submissionFile = $('#submissionfilexxx')[0].files[0];
    
    if (submissionFile) {
        if (submissionFile.size >= 1.5 * 1024 * 1024) { 
            $('#sloading').toggle();
            alert("File size exceeds the limit of 1.5 MB. Please upload a smaller file.");
            return;
        }
    }

    var formData = new FormData();
    formData.append('fromuser', fromuser);
    formData.append('discussion_id', discussionId);
    formData.append('submissionmessage', submissionMessage);
    formData.append('submissionfiletype', submissionFiletype);
    formData.append('submissionfile', submissionFile);
    formData.append('action', 'replydiscussion');

    $.ajax({
        url: "../php/function/wf_modal_function.php",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            $('#sloading').toggle();
            console.log(response);
            location.reload();
        },
        error: function (xhr, status, error) {
            console.error(xhr, status, error);
        }
    });
}

function addRevisionFile() {
    $('#sloading').toggle();
    var revisionFileType = $('#revisionfiletype').val();
    var revisionFile = $('#revisionfile')[0].files[0];

    if (revisionFile) {
        if (revisionFile.size >= 1.5 * 1024 * 1024) { 
            $('#sloading').toggle();
            alert("File size exceeds the limit of 1.5 MB. Please upload a smaller file.");
            return;
        }
    }

    var formData = new FormData();
    formData.append('article_id', articleId);
    formData.append('fromuser', fromuser);
    formData.append('revisionfiletype', revisionFileType);
    formData.append('revisionfile', revisionFile);
    formData.append('action', 'addrevisionfile');
    
    $.ajax({
        url: "../php/function/wf_modal_function.php",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            $('#sloading').toggle();
            console.log(response);
            location.reload();
        },
        error: function (xhr, status, error) {
            console.error(xhr, status, error);
        }
    });
}

function updateCopyeditedFiles() {
    $('#sloading').toggle();
    var copyeditedFile = $('#copyeditedfile')[0].files[0];

    if (!copyeditedFile) {
        updateCopyeditedCheckedFiles();
        updateCopyeditedUncheckedFiles();
    } else if (copyeditedFile.size <= 1.5 * 1024 * 1024) {
        uploadCopyeditedFiles();
    } else {
        $('#sloading').toggle();
        alert("File size exceeds the limit of 1.5 MB. Please upload a smaller file.");
        return;
    }

}

function uploadCopyeditedFiles() {
    $('#sloading').toggle();
    var copyeditedFiletype = $('#copyeditedfiletype').val();
    var copyeditedFile = $('#copyeditedfile')[0].files[0];

    var formData = new FormData();
    formData.append('article_id', articleId);
    formData.append('fromuser', fromuser);
    formData.append('copyeditedfiletype', copyeditedFiletype);
    formData.append('copyeditedfile', copyeditedFile);
    formData.append('action', 'uploadcopyeditedfile');

    $.ajax({
        url: "../php/function/wf_modal_function.php",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            $('#sloading').toggle();
            console.log(response);
            location.reload();
        },
        error: function (xhr, status, error) {
            console.error(xhr, status, error);
        }
    });
}

function updateCopyeditedCheckedFiles() {
    var checkedCheckboxes2 = $('.copyedited-checkbox:checked');

    if (checkedCheckboxes2.length === 0) {
        console.log("No checked files. Aborting update.");
        return; // Exit the function
    }

    var checkedData2 = [];
    checkedCheckboxes2.each(function () {
        var copyeditedFilesId = $(this).data('final-files-id');
        checkedData2.push({
            copyeditedFilesId: copyeditedFilesId
        });
    });

    var jsonCheckedData2 = JSON.stringify(checkedData2);

    console.log('Checked Data:', jsonCheckedData2);

    $.ajax({
        type: 'POST',
        url: '../php/function/wf_modal_function.php',
        data: {
            checkedCopyeditedData: jsonCheckedData2,
            action: 'updatecopyeditedcheckedfile'
        },
        success: function(response) {
            console.log('Checked checkboxes data sent successfully.');
            console.log(response);
            $('#sloading').toggle();
            location.reload();
        },
        error: function(error) {
            console.error('Error sending checked checkboxes data:', error);
        }
    });
}

function updateCopyeditedUncheckedFiles() {
    var uncheckedCheckboxes2 = $('.copyedited-checkbox:not(:checked)');

    if (uncheckedCheckboxes2.length === 0) {
        console.log("No unchecked files. Aborting update.");
        return; // Exit the function
    }

    var uncheckedData2 = [];
    uncheckedCheckboxes2.each(function () {
        var copyeditedFilesId = $(this).data('final-files-id');
        uncheckedData2.push({
            copyeditedFilesId: copyeditedFilesId
        });
    });

    var jsonUncheckedData2 = JSON.stringify(uncheckedData2);

    console.log('Unchecked Data:', jsonUncheckedData2);

    $.ajax({
        type: 'POST',
        url: '../php/function/wf_modal_function.php',
        data: {
            uncheckedCopyeditedData: jsonUncheckedData2,
            action: 'updatecopyediteduncheckedfile'
        },
        success: function(response) {
            console.log('Unchecked checkboxes data sent successfully.');
            console.log(response);
            location.reload();
            $('#sloading').toggle();
        },
        error: function(error) {
            console.error('Error sending unchecked checkboxes data:', error);
        }
    });
}

function SendForReadyPublication(issueId) {
    $('#sloading').show();

    setTimeout(function () {
        window.location.href = "../php/emailcontent.php?aid=<?php echo $article_data[0]->article_id; ?>&emc=6&issid=" + issueId;
    }, 2000);

    window.onload = function () {
        $('#sloading').hide();
    };
}

function updateProductionFiles() {
    $('#sloading').toggle();
    var productionfile = $('#productionfile')[0].files[0];

    if (!productionfile) {
        updateProductionCheckedFiles();
        updateProductionUncheckedFiles();
    } else if (productionfile.size <= 1.5 * 1024 * 1024) {
        uploadProductionFiles();
    } else {
        $('#sloading').toggle();
        alert("File size exceeds the limit of 1.5 MB. Please upload a smaller file.");
        return;
    }

}

function uploadProductionFiles() {
    $('#sloading').toggle();
    var productionfileFiletype = $('#productionfiletype').val();
    var productionfileFile = $('#productionfile')[0].files[0];

    var formData = new FormData();
    formData.append('article_id', articleId);
    formData.append('fromuser', fromuser);
    formData.append('productionfiletype', productionfileFiletype);
    formData.append('productionfile', productionfileFile);
    formData.append('action', 'uploadproductionfile');

    console.log(productionfileFiletype);
    console.log(productionfileFile);
    $.ajax({
        url: "../php/function/wf_modal_function.php",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            $('#sloading').toggle();
            console.log(response);
            location.reload();
        },
        error: function (xhr, status, error) {
            console.error(xhr, status, error);
        }
    });
}

function updateProductionCheckedFiles() {
    $('#sloading').toggle();
    var checkedCheckboxes1 = $('.production-checkbox:checked');
    var checkedCheckboxes2 = $('.copyedited-checkbox:checked');

    var checkedData1 = [];
    checkedCheckboxes1.each(function () {
        var productionFilesId = $(this).data('finalproduction-files-id');
        checkedData1.push({
            productionFilesId: productionFilesId
        });
    });

    var checkedData2 = [];
    checkedCheckboxes2.each(function () {
        var copyeditedFilesId = $(this).data('finalcopyedited-files-id');
        checkedData2.push({
            copyeditedFilesId: copyeditedFilesId
        });
    });

    var jsonCheckedData1 = JSON.stringify(checkedData1);
    var jsonCheckedData2 = JSON.stringify(checkedData2);

    console.log('Checked Data:', jsonCheckedData1);
    console.log('Checked Data:', jsonCheckedData2);

    $.ajax({
        type: 'POST',
        url: '../php/function/wf_modal_function.php',
        data: {
            checkedProductionData: jsonCheckedData1,
            checkedCopyeditedData: jsonCheckedData2,
            action: 'updatefinalcheckedfile'
        },
        success: function(response) {
            console.log('Checked checkboxes data sent successfully.');
            console.log(response);
            location.reload();
            $('#sloading').toggle();
        },
        error: function(error) {
            console.error('Error sending checked checkboxes data:', error);
        }
    });
}

function updateProductionUncheckedFiles() {
    $('#sloading').toggle();
    var uncheckedCheckboxes1 = $('.production-checkbox:not(:checked)');
    var uncheckedCheckboxes2 = $('.copyedited-checkbox:not(:checked)');

    var uncheckedData1 = [];
    uncheckedCheckboxes1.each(function () {
        var productionFilesId = $(this).data('finalproduction-files-id');
        uncheckedData1.push({
            productionFilesId: productionFilesId
        });
    });

    var uncheckedData2 = [];
    uncheckedCheckboxes2.each(function () {
        var copyeditedFilesId = $(this).data('finalcopyedited-files-id');
        uncheckedData2.push({
            copyeditedFilesId: copyeditedFilesId
        });
    });

    var jsonUncheckedData1 = JSON.stringify(uncheckedData1);
    var jsonUncheckedData2 = JSON.stringify(uncheckedData2);

    console.log('Unchecked Data:', jsonUncheckedData1);
    console.log('Unchecked Data:', jsonUncheckedData2);

    $.ajax({
        type: 'POST',
        url: '../php/function/wf_modal_function.php',
        data: {
            uncheckedProductionData: jsonUncheckedData1,
            uncheckedCopyeditedData: jsonUncheckedData2,
            action: 'updatefinaluncheckedfile'
        },
        success: function(response) {
            console.log('Unchecked checkboxes data sent successfully.');
            console.log(response);
            location.reload();
            $('#sloading').toggle();
        },
        error: function(error) {
            console.error('Error sending unchecked checkboxes data:', error);
        }
    });
}

function acceptReviewerAnswer() {
    $('#sloading').toggle();
    var assignedId = $('#reviewer_assigned_id').val();


    var formData = new FormData();
    formData.append('reviewer_assigned_id', assignedId);
    formData.append('action', 'updateaccessible');

    $.ajax({
        url: "../php/function/wf_modal_function.php",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            $('#sloading').toggle();
            console.log(response);
            alert("Reviewer answer accepted successfully!");
            location.reload();
        },
        error: function (xhr, status, error) {
            console.error(xhr, status, error);
        }
    });
}


</script>

