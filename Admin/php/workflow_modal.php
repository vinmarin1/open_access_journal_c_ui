<?php
include 'function/workflow_function.php';
include 'function/userandroles_function.php';

$aid = isset($_GET['aid']) ? $_GET['aid'] : 1;

$submission_files = get_submission_files($aid);
$review_files = get_review_files($aid);
$copyediting_files = get_copyediting_files($aid);
$production_files = get_production_files($aid);
$userlist = get_user_list();
?>

<style>
    #xsubmissionfile {
        display: none;
    }
</style>

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
                                <option value="Null">Select File</option>
                                <?php foreach ($submission_files as $submission_filesval): ?>
                                    <option value="<?php echo $submission_filesval->article_files_id; ?>"><?php echo $submission_filesval->file_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2" id="xsubmissionfile">
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

<!-- Add Pre-Review Discussion Modal -->
<div class="modal fade" id="addDiscussionModal" tabindex="-1" aria-hidden="true">
    <form id="addModalForm1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Add Pre-Review Discussion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" id="subject" class="form-control" placeholder="Subject" required/>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="9"></textarea>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="formFileAddDiscussion" class="form-label">Upload File</label>
                            <input class="form-control" type="file" id="formFileAddDiscussion" accept=".pdf, .doc, .docx" />
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


<!-- REVIEW PAGE -->
<!-- Add Review Discussion Modal -->
<div class="modal fade" id="addReviewDiscussionModal" tabindex="-1" aria-hidden="true">
    <form id="addModalForm1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Add Review Discussion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" id="subject" class="form-control" placeholder="Subject" required/>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="9"></textarea>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="formFileAddDiscussion" class="form-label">Upload File</label>
                            <input class="form-control" type="file" id="formFileAddDiscussion" accept=".pdf, .doc, .docx" />
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

<!-- Add Revision Modal -->
<div class="modal fade" id="addRevisionModal" tabindex="-1" aria-hidden="true">
    <form id="addModalForm1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Add Revision</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" id="subject" class="form-control" placeholder="Subject" required/>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="9"></textarea>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="formFileAddDiscussion" class="form-label">Upload File</label>
                            <input class="form-control" type="file" id="formFileAddDiscussion" accept=".pdf, .doc, .docx" />
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
                                                        <a href="../../Files/submitted-article/<?php echo urlencode($review_filesval->file_name); ?>" download>
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
                                                <?php
                                                    $isReviewEqualToOne = ($submission_filesval->copyediting == 1);
                                                ?>
                                                <tr>
                                                    <td width="5%">
                                                        <input class="form-check-input copyediting-checkbox" type="checkbox" value="" id="defaultCheck1" data-article-files-id="<?php echo $submission_filesval->article_files_id; ?>" <?php echo $isReviewEqualToOne ? 'checked' : ''; ?> />
                                                    </td>
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
                                        <?php if (empty($review_files)): ?>
                                            <tr>
                                                <td colspan="4" class="text-center">No Files</td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($review_files as $review_filesval): ?>
                                                <tr>
                                                    <td width="5%"><input class="form-check-input copyediting1-checkbox" type="checkbox" value="" id="defaultCheck1" /></td>
                                                    <td width="5%"><?php echo $review_filesval->article_files_id; ?></td>
                                                    <td width="65%">
                                                        <a href="../../../Files/submitted-article/<?php echo urlencode($review_filesval->file_name); ?>" download>
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
                                                    <td width="70%">
                                                        <a href="../../Files/submitted-article/<?php echo urlencode($copyediting_filesval->file_name); ?>" download>
                                                            <?php echo $copyediting_filesval->file_name; ?>
                                                        </a>
                                                    </td>
                                                    <td width="25%"><?php echo $copyediting_filesval->file_type; ?></td>
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

<!-- Add Copyediting Modal -->
<div class="modal fade" id="addCopyeditingnModal" tabindex="-1" aria-hidden="true">
    <form id="addModalForm1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Add Copyediting Discussion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" id="subject" class="form-control" placeholder="Subject" required/>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="9"></textarea>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <label for="formFileAddDiscussion" class="form-label">Upload File</label>
                            <input class="form-control" type="file" id="formFileAddDiscussion" accept=".pdf, .doc, .docx" />
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
function enableFileInput() {
    var selectedValue = $('#submissionfileid').val();
    
    if (selectedValue !== 'Null') {
        $('#xsubmissionfile').show();
        $('#submissionfile').prop('required', true); 
    } else {
        $('#xsubmissionfile').hide();
        $('#submissionfile').prop('required', false); 
    }
}


function updateReviewFiles() {
    $('#sloading').toggle();
    updateReviewCheckedFiles();
    updateReviewUncheckedFiles();
}

function updateReviewCheckedFiles() {
    var checkedCheckboxes = $('.review-checkbox:checked');

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
            action: 'updatecopyeditingcheckedfile'
        },
        success: function(response) {
            console.log('Checked checkboxes data sent successfully.');
            console.log(response);
            location.reload();
        },
        error: function(error) {
            console.error('Error sending checked checkboxes data:', error);
        }
    });
}

// function updateCopyeditingChecked1Files() {
//     var checkedCheckboxes1 = $('.copyediting1-checkbox:checked');

//     var checkedData1 = [];
//     checkedCheckboxes1.each(function () {
//         var articleFilesId = $(this).data('article-files-id');
//         checkedData1.push({
//             articleFilesId: articleFilesId
//         });
//     });

//     var jsonCheckedData1 = JSON.stringify(checkedData1);

//     console.log('Checked Data:', checkedData1);

//     $.ajax({
//         type: 'POST',
//         url: '../php/function/wf_modal_function.php',
//         data: {
//             checkedData: jsonCheckedData1,
//             action: 'updatecopyeditingchecked1file'
//         },
//         success: function(response) {
//             console.log('Checked checkboxes data sent successfully.');
//             console.log(response);
//             location.reload();
//         },
//         error: function(error) {
//             console.error('Error sending checked checkboxes data:', error);
//         }
//     });
// }

function updateCopyeditingUncheckedFiles() {
    var uncheckedCheckboxes = $('.copyediting-checkbox:not(:checked)');

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
            action: 'updatecopyeditinguncheckedfile'
        },
        success: function(response) {
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

    if ($('#submissionfile').prop('required') && !submissionFile) {
        $('#sloading').toggle();
        alert('File is required. Please select a file.');
        return; 
    }

    var formData = new FormData();
    formData.append('submissionfileid', submissionFileId);
    formData.append('submissionfile', submissionFile);
    formData.append('action', 'updatesubmissionfile');

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

</script>

