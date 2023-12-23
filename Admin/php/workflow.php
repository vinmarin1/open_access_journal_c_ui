<?php
include 'function/workflow_function.php';
include 'function/email_function.php';

$aid = isset($_GET['aid']) ? $_GET['aid'] : 1;
$emc = 3;

$article_data = get_article_data($aid);
$article_files = get_article_files($aid);
$article_discussion = get_article_discussion($aid);
$article_participant = get_article_participant($aid);
$reviewer_email = get_reviewer_content($emc);
$article_contributors = get_article_contributor($aid);
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
                                                                            <th colspan="3"><h6>Submission Files</h6></th>
                                                                            <th style="text-align: right;">
                                                                                <button type="button" class="btn btn-outline-dark" id="uploadButton" style="width: 150px;" data-bs-toggle="modal" data-bs-target="#addFilesModal">Upload File</button>
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php if (empty($article_files)): ?>
                                                                        <tr>
                                                                            <td colspan="4" class="text-center">No Files</td>
                                                                        </tr>
                                                                    <?php else: ?>
                                                                        <?php foreach ($article_files as $article_filesval): ?>
                                                                            <tr>
                                                                                <td width="5%"><?php echo $article_filesval->article_files_id; ?></td>
                                                                                <td width="65%">
                                                                                    <a href="../../Files/submitted-article/<?php echo urlencode($article_filesval->file_name); ?>" download>
                                                                                        <?php echo $article_filesval->file_name; ?>
                                                                                    </a>
                                                                                </td>
                                                                                <td width="25%"><?php echo $article_filesval->file_type; ?></td>
                                                                                <td width="5%"></td>
                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                        <?php endif; ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <th colspan="4" style="text-align: right;">
                                                                            <button type="button" class="btn btn-outline-dark" id="uploadButton" style="width: 150px;">Download File</button>
                                                                        </th>
                                                                    </tfoot>   
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mt-4 mt-lg-0" id="dynamic-column">
                                                            <?php if ($article_data[0]->status <= 4): ?>
                                                                <div class="alert alert-white" role="alert">
                                                                    <p>Submission accepted for review.</p>
                                                                </div>
                                                            <?php else: ?>
                                                                <a href="javascript:void(0);" onclick="sendForReview()" class="btn btn-primary btn-lg btn-block mb-2" style="width: 100%;">Send for Review</a>
                                                                <button type="button" class="btn btn-outline-primary btn-lg btn-block mb-2" style="width: 100%;">Accept and Skip Review</button>
                                                                <a href="javascript:void(0);" onclick="sendForDecline()" class="btn btn-outline-danger btn-lg btn-block" style="width: 100%;">Decline Submission</a>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="col-md-9 mt-4" id="dynamic-column">
                                                            <div class="table-responsive text-nowrap">
                                                                <table class="table table-striped" id="DataTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th colspan="2"><h6>Pre-Review Discussions</h6></th>
                                                                            <th style="text-align: right;">
                                                                                <button type="button" class="btn btn-outline-dark" id="uploadButton" style="width: 150px;" data-bs-toggle="modal" data-bs-target="#addDiscussionModal">Add Discussion</button>
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php if (empty($article_discussion)): ?>
                                                                        <tr>
                                                                            <td colspan="3" class="text-center">No Items</td>
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
                                                                            <td colspan="3" class="text-center">No Items</td>
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

                                                <?php if ($article_data[0]->status >= 5): ?>
                                                <div class="tab-pane fade" id="navs-top-review" role="tabpanel">
                                                    <div class="row">
                                                        <div class="alert alert-white" role="alert">
                                                            <p>Not currently accepted for review.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php else: ?>
                                                <div class="tab-pane fade" id="navs-top-review" role="tabpanel">
                                                    <div class="row">
                                                        <div class="col-md-9" id="dynamic-column">
                                                            <div class="table-responsive text-nowrap">
                                                                <table class="table table-striped" id="DataTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th colspan="3"><h6>Review Files</h6></th>
                                                                            <th style="text-align: right;">
                                                                                <button type="button" class="btn btn-outline-dark" id="uploadButton" style="width: 150px;" data-bs-toggle="modal" data-bs-target="#addReviewFilesModal">Select Files</button>
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php if (empty($article_files)): ?>
                                                                        <tr>
                                                                            <td colspan="4" class="text-center">No Files</td>
                                                                        </tr>
                                                                    <?php else: ?>
                                                                        <?php foreach ($article_files as $article_filesval): ?>
                                                                            <tr>
                                                                                <td width="5%"><?php echo $article_filesval->article_files_id; ?></td>
                                                                                <td width="65%">
                                                                                    <a href="../../Files/submitted-article/<?php echo urlencode($article_filesval->file_name); ?>" download>
                                                                                        <?php echo $article_filesval->file_name; ?>
                                                                                    </a>
                                                                                </td>
                                                                                <td width="25%"><?php echo $article_filesval->file_type; ?></td>
                                                                                <td width="5%"></td>
                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                        <?php endif; ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <th colspan="4" style="text-align: right;">
                                                                            <button type="button" class="btn btn-outline-dark" id="uploadButton" style="width: 150px;">Download File</button>
                                                                        </th>
                                                                    </tfoot>   
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mt-4 mt-lg-0" id="dynamic-column">
                                                            <?php if ($article_data[0]->status >= 6): ?>
                                                                <div class="alert alert-white" role="alert">
                                                                    <p>Submission accepted for review.</p>
                                                                </div>
                                                            <?php else: ?>
                                                                <button type="button" class="btn btn-outline-primary btn-lg btn-block mb-2" style="width: 100%;">Request Revision</button>
                                                                <a href="javascript:void(0);" onclick="" class="btn btn-primary btn-lg btn-block mb-2" style="width: 100%;">Accept Submission</a>
                                                                <a href="javascript:void(0);" onclick="" class="btn btn-outline-danger btn-lg btn-block" style="width: 100%;">Decline Submission</a>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="col-md-9 mt-4" id="dynamic-column">
                                                            <div class="table-responsive text-nowrap">
                                                                <table class="table table-striped" id="DataTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th colspan="3"><h6>Revisions</h6></th>
                                                                            <th style="text-align: right;">
                                                                                <button type="button" class="btn btn-outline-dark" id="uploadButton" style="width: 150px;">Upload Revision</button>
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php if (empty($article_discussion)): ?>
                                                                        <tr>
                                                                            <td colspan="4" class="text-center">No Files</td>
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
                                                                        <th colspan="4" style="text-align: right;"></th>
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
                                                                            <td colspan="3" class="text-center">No Items</td>
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
                                                        <div class="col-md-12 mt-4" id="dynamic-column">
                                                            <div class="table-responsive text-nowrap">
                                                                <table class="table table-striped" id="DataTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th colspan="2"><h6>Reviewers</h6></th>
                                                                            <th style="text-align: right;">
                                                                                <button type="button" class="btn btn-outline-dark" id="uploadButton" style="width: 150px;" data-bs-toggle="modal" data-bs-target="#addReviewerModal">Add Reviewers</button>
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php if (empty($article_discussion)): ?>
                                                                        <tr>
                                                                            <td colspan="3" class="text-center">No Items</td>
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
                                                        <div class="col-md-12 mt-4" id="dynamic-column">
                                                            <div class="table-responsive text-nowrap">
                                                                <table class="table table-striped" id="DataTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th colspan="2"><h6>Review Discussion</h6></th>
                                                                            <th style="text-align: right;">
                                                                                <button type="button" class="btn btn-outline-dark" id="uploadButton" style="width: 150px;" data-bs-toggle="modal" data-bs-target="#addReviewDiscussionModal">Add Discussion</button>
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php if (empty($article_discussion)): ?>
                                                                        <tr>
                                                                            <td colspan="3" class="text-center">No Items</td>
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
                                                    </div>
                                                </div>
                                                <?php endif; ?>

                                                <?php if ($article_data[0]->status >= 4): ?>
                                                <div class="tab-pane fade" id="navs-top-copyediting" role="tabpanel">
                                                    <div class="row">
                                                        <div class="alert alert-white" role="alert">
                                                            <p>Not currently accepted for copyediting.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php else: ?>
                                                <div class="tab-pane fade" id="navs-top-copyediting" role="tabpanel">
                                                    <div class="row">
                                                        <div class="col-md-9" id="dynamic-column">
                                                            <div class="table-responsive text-nowrap">
                                                                <table class="table table-striped" id="DataTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th colspan="3"><h6>Draft Files</h6></th>
                                                                            <th style="text-align: right;">
                                                                                <button type="button" class="btn btn-outline-dark" id="uploadButton" style="width: 150px;" data-bs-toggle="modal" data-bs-target="#addCopyeditingFilesModal">Select Files</button>
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php if (empty($article_files)): ?>
                                                                        <tr>
                                                                            <td colspan="4" class="text-center">No Files</td>
                                                                        </tr>
                                                                    <?php else: ?>
                                                                        <?php foreach ($article_files as $article_filesval): ?>
                                                                            <tr>
                                                                                <td width="5%"><?php echo $article_filesval->article_files_id; ?></td>
                                                                                <td width="65%">
                                                                                    <a href="../../Files/submitted-article/<?php echo urlencode($article_filesval->file_name); ?>" download>
                                                                                        <?php echo $article_filesval->file_name; ?>
                                                                                    </a>
                                                                                </td>
                                                                                <td width="25%"><?php echo $article_filesval->file_type; ?></td>
                                                                                <td width="5%"></td>
                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                        <?php endif; ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <th colspan="4" style="text-align: right;">
                                                                            <button type="button" class="btn btn-outline-dark" id="uploadButton" style="width: 150px;">Download File</button>
                                                                        </th>
                                                                    </tfoot>   
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mt-4 mt-lg-0" id="dynamic-column">
                                                            <a href="javascript:void(0);" onclick="" class="btn btn-primary btn-lg btn-block mb-2" style="width: 100%;">Send to Production</a>
                                                            <a href="javascript:void(0);" onclick="" class="btn btn-outline-danger btn-lg btn-block" style="width: 100%;">Cancel Copyediting</a>
                                                        </div>
                                                        <div class="col-md-9 mt-4" id="dynamic-column">
                                                            <div class="table-responsive text-nowrap">
                                                                <table class="table table-striped" id="DataTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th colspan="2"><h6>Copyediting Discussions</h6></th>
                                                                            <th style="text-align: right;">
                                                                                <button type="button" class="btn btn-outline-dark" id="uploadButton" style="width: 150px;" data-bs-toggle="modal" data-bs-target="#addCopyeditingnModal">Add Discussion</button>
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php if (empty($article_discussion)): ?>
                                                                        <tr>
                                                                            <td colspan="3" class="text-center">No Items</td>
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
                                                                            <td colspan="3" class="text-center">No Items</td>
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
                                                <?php endif; ?>

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
                                                    <!-- <li class="nav-item">
                                                        <button type="button" id="addpadding" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-three" aria-controls="navs-top-three" aria-selected="false">Meta Data</button>
                                                    </li> -->
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
                                                                    <div class="d-flex justify-content-end mt-4" style="margin-bottom: -28px;">
                                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="navs-top-two" role="tabpanel">
                                                        <div class="row">
                                                            <div class="col-md-12" id="dynamic-column">
                                                                <div class="table-responsive text-nowrap">
                                                                    <table class="table table-striped" id="DataTable">
                                                                        <thead>
                                                                            <tr>
                                                                                <th colspan="4"><h6>Contributors</h6></th>
                                                                                <th style="text-align: right;">
                                                                                    <button type="button" class="btn btn-outline-dark" id="uploadButton" style="margin-left: -10px" data-bs-toggle="modal" data-bs-target="#addContributorsModal">Add</button>
                                                                                </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <?php if (empty($article_contributors)): ?>
                                                                            <tr>
                                                                                <td colspan="5" class="text-center">No data</td>
                                                                            </tr>
                                                                        <?php else: ?>
                                                                            <?php foreach ($article_contributors as $article_contributorsval): ?>
                                                                                <tr>
                                                                                    <td width="5%"><?php echo $article_contributorsval->contributors_id; ?></td>
                                                                                    <td width="40%"><?php echo $article_contributorsval->publicname; ?> <span class="badge rounded-pill bg-label-primary"><?php echo $article_contributorsval->contributor_type; ?></span></td>
                                                                                    <td width="25%"><?php echo $article_contributorsval->email; ?></td>
                                                                                    <td width="25%"><?php echo $article_contributorsval->orcid; ?></td>
                                                                                    <td width="5%">
                                                                                        <a href="javascript:void(0);" onclick="" class="btn btn-outline-primary">View</a>
                                                                                    </td>
                                                                                </tr>
                                                                            <?php endforeach; ?>    
                                                                        <?php endif; ?>
                                                                        </tbody>
                                                                        <tfoot>
                                                                            <th colspan="5" style="text-align: right;"></th>
                                                                        </tfoot> 
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="navs-top-four" role="tabpanel">
                                                        <div class="row">
                                                            <div class="col-md-12" id="dynamic-column">
                                                                <div class="card-body">
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
        <?php include 'template/footer.php'; include 'workflow_modal.php';?>
    </div>

<!-- Assign Reviewer Modal -->
<div class="modal fade" id="AssignReviewer" tabindex="-1" aria-hidden="true">
    <form id="addModalForm1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Add this Reviewer</h5>
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
                            <input type="hidden" name="quillContentOne" id="quillContentOne">
                            <div id="quill-emailcontent" style="height: 350px;"></div>
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

<!-- Add Reviewer Modal -->
<div class="modal fade" id="addReviewerModal" tabindex="-1" aria-hidden="true">
    <form id="addModalForm">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Assign Reviewer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped" id="DataTableReviewer">
                                    <thead>
                                        <tr>
                                            <th colspan="3">
                                            <h5 class="card-header">Locate a Reviewer</h5>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($userlist)): ?>
                                            <tr>
                                                <td colspan="3" class="text-center">No Items</td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($userlist as $userlistval): ?>
                                                <tr>
                                                    <td width="5%"><?php echo $userlistval->author_id; ?></td>
                                                    <td width="85%"><?php echo $userlistval->last_name; ?>, <?php echo $userlistval->first_name; ?></td>
                                                    <td width="10%"> <button type="button" class="btn btn-outline-dark" id="uploadButton" style="width: 150px;" data-bs-toggle="modal" data-bs-target="#AssignReviewer">Select Reviewer</button></td>
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
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addRecord()">Save changes</button>
                </div> -->
            </div>
        </div>
    </form>
</div>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            dataTable = $('#DataTableReviewer').DataTable({
                "paging": false,
                "ordering": true,
                "columns": [
                    null,
                    null,
                    null
                ]
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            var toolbarOptions = [
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
            ];

            var quill = new Quill('#quill-abstract', {
                theme: 'snow'
            });

            var quillTwo = new Quill('#quill-reference', {
                theme: 'snow'
            });

            var quillThree = new Quill('#quill-emailcontent', {
                modules: {
                    toolbar: toolbarOptions
                },
                theme: 'snow'
            });

            var abstractContent = '<?php echo addslashes($article_data[0]->abstract); ?>';
            var referenceContent = '<?php echo addslashes($article_data[0]->references); ?>';
            var emailContent = <?php echo json_encode($reviewer_email[0]->content); ?>;

            quill.clipboard.dangerouslyPasteHTML(abstractContent);
            quillTwo.clipboard.dangerouslyPasteHTML(referenceContent);

            if (emailContent.trim() !== '') {
                var delta = JSON.parse(emailContent);
                quillThree.setContents(delta); 
            } else {

                quillThree.setContents([{ insert: title + '\n\n' }]);
            }

            var form = document.getElementById('quillForm');
            var quillContentInputOne = document.getElementById('quillContentOne');
        });

        function sendForReview() {
            $('#sloading').show();

            setTimeout(function () {
                window.location.href = "../php/emailcontent.php?aid=<?php echo $article_data[0]->article_id; ?>&emc=1";
            }, 2000);

            window.onload = function () {
                $('#sloading').hide();
            };
        }

        function sendForDecline() {
            $('#sloading').show();

            setTimeout(function () {
                window.location.href = "../php/emailcontent.php?aid=<?php echo $article_data[0]->article_id; ?>&emc=2";
            }, 2000);

            window.onload = function () {
                $('#sloading').hide();
            };
        }                                                   
    </script>

</body>
</html>