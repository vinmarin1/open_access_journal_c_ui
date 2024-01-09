<?php
session_start();

require 'dbcon.php';
$userId = $_SESSION['id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCU PUBLICATION | Review</title>
    <link rel="stylesheet" href="../CSS/review-process.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>



<div class="header-container" id="header-container">
</div>

<nav class="navigation-menus-container"  id="navigation-menus-container">
</nav>


<form id="form" method="post" action="reviewer_answer.php">
    <!-- Step 1 -->
    <div class="step active" id="step1">
        <div class="main-container">
            <div class="content-over">
                <div class="cover-content">
                    <p> Dashboard / Reviewer / Submitted Articles </p>
                    <h3> 
                        <?php 
                        $sqlReviewraticle = "SELECT article.title 
                                            FROM article 
                                            JOIN reviewer_assigned ON article.author_id = reviewer_assigned.author_id 
                                            WHERE reviewer_assigned.article_id = article.article_id AND article.status = 5
                                            AND reviewer_assigned.author_id = :author_id";

                        $result = database_run($sqlReviewraticle, array('author_id' => $userId));

                        if ($result !== false) {
                            foreach ($result as $row) {
                                echo $row->title;
                            }
                        } else {
                            echo "No articles found."; 
                        }
                        ?>
                </h3>


                </div>
            </div>
        </div>


        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1">
                    <!-- This is a Blank space -->
                </div>

                <div class="col-md-6 abstract" style="padding-top:20px; height: auto"> 
                    <h4>Abstract</h4>
                        <p>
                        <?php 
                        $sqlAbstract = "SELECT article.abstract 
                                            FROM article 
                                            JOIN reviewer_assigned ON article.author_id = reviewer_assigned.author_id 
                                            WHERE reviewer_assigned.article_id = article.article_id AND article.status = 5
                                            AND reviewer_assigned.author_id = :author_id";

                        $result = database_run($sqlAbstract, array('author_id' => $userId));

                        if ($result !== false) {
                            foreach ($result as $row) {
                                echo $row->abstract;
                            }
                        } else {
                            echo "No articles found."; 
                        }
                        ?>
                        </p>
                </div>

                <div class="col-md-4">
                    <!-- This is a Blank space -->

                    <div>
                        <div class="status">
                            <p>
                                <?php

                                    $sqlStatus = "SELECT article_status.status, article.title FROM article_status JOIN article ON article_status.status_id = article.status JOIN reviewer_assigned ON article.article_id = reviewer_assigned.article_id AND article.status = 5
                                    AND reviewer_assigned.author_id = :author_id";

                                    $result = database_run($sqlStatus, array('author_id' => $userId));

                                    if ($result !== false) {
                                    foreach ($result as $row) {
                                    echo $row->status;
                                    }
                                    } else {
                                    echo "No status for this article"; 
                                    }
                                ?>
                                
                            </p>
                        </div>
                        <hr style="height: 2px; background-color: #0858a4; width: 100%">
                        <h4 style="color: #0858a4; font-family: Arial, Helvetica, sans-serif;" >Submitted in the 
                        <?php
                            $sqlJournal = "SELECT journal.journal, article.title FROM journal JOIN article ON journal.journal_id = article.journal_id JOIN reviewer_assigned ON article.article_id = reviewer_assigned.article_id AND article.status = 5
                            AND reviewer_assigned.author_id = :author_id";

                            $result = database_run($sqlJournal, array('author_id' => $userId));

                            if ($result !== false) {
                            foreach ($result as $row) {
                            echo $row->journal;
                            }
                            } else {
                            echo "No status for this article"; 
                            }
                        ?>
                        </h4>
                        <div class="logs-date">                
                            <p style="color: black; font-weight: bold;">Logs</p>
                            <p style="font-weight: bold;">Review</p>
                            <p style="font-size: x-small; margin-top: -15px; " >Send for review</p>
                            <p style="font-weight: bold;">Submission</p>
                            <p style="font-size: x-small; margin-top: -15px; " >Submitted in the 
                        
                            <?php
                              $sqlJournal = "SELECT journal.journal, article.title FROM journal JOIN article ON journal.journal_id = article.journal_id JOIN reviewer_assigned ON article.article_id = reviewer_assigned.article_id AND article.status = 5
                              AND reviewer_assigned.author_id = :author_id";
  
                              $result = database_run($sqlJournal, array('author_id' => $userId));
  
                              if ($result !== false) {
                              foreach ($result as $row) {
                              echo $row->journal;
                              }
                              } else {
                              echo "Can't determine or the file has been put on the archive"; 
                              }
                            
                            ?>
                            
                            </p>
                            <a href="#!">View All Logs</a>
                        </div>
                        <div class="date">
                            <p style="color: black; font-weight: bold;">Date</p>
                            <p style="font-size: x-small;">2023-11-09</p>
                            <p style="margin-top:28px ; font-size: x-small;">2023-11-09</p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-1">
                    <!-- This is a Blank space -->
                </div>

                <div class="col-md-6">
                    <div class="table-container">
                        <h5>Files Submitted</h5>
                        <table class="table table-hover" id="table-file" style="border-collapse: separate; border-spacing: 10px 10px 10px 10px;">
                            <thead>
                                <tr>
                                <th scope="col" style="background-color: #0858a4; color: white; font-weight: normal;">File</th>
                                <th scope="col" style="background-color: #0858a4; color: white; font-weight: normal;">Date</th>
                                </tr>
                            </thead>
                            <tbody id="fileList">
                                <tr>
                                    <td id="fileName1">
                                    <?php
                                    $sqlFileName = "SELECT article_files.file_name, article.title FROM article_files JOIN article ON article_files.article_id = article.article_id JOIN reviewer_assigned ON article.article_id = reviewer_assigned.article_id WHERE article_files.file_type = 'File with no author' AND article.status = 5
                                    AND reviewer_assigned.author_id = :author_id";
        
                                    $result = database_run($sqlFileName, array('author_id' => $userId));
        
                                    if ($result !== false) {
                                    foreach ($result as $row) {
                                    echo $row->file_name;
                                    }
                                    } else {
                                    echo "Can't find the file or it has been put on the archive"; 
                                    }
                                    
                                    ?>
                                    </td>
                                    <td id="fileType1">
                                    <?php
                                        $sqlFileDate = "SELECT article_files.date_added, article.title FROM article_files JOIN article ON article_files.article_id = article.article_id JOIN reviewer_assigned ON article.article_id = reviewer_assigned.article_id WHERE article_files.file_type = 'File with no author' AND article.status = 5
                                        AND reviewer_assigned.author_id = :author_id";
            
                                        $result = database_run($sqlFileDate, array('author_id' => $userId));
            
                                        if ($result !== false) {
                                        foreach ($result as $row) {
                                        echo $row->date_added;
                                        }
                                        } else {
                                        echo "Can't determine date added or the file has been put on the archive"; 
                                        }
                                        
                                    ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- <div class="table-container">
                            <h5>Files Submitted</h5>
                            <table class="table table-hover" id="table-file" style="border-collapse: separate; border-spacing: 10px 10px 10px 10px;">
                                <thead>
                                    <tr>
                                    <th scope="col" style="background-color: #0858a4; color: white; font-weight: normal;">File</th>
                                    <th scope="col" style="background-color: #0858a4; color: white; font-weight: normal;">ORCID</th>
                                    </tr>
                                </thead>
                                <tbody id="fileList">
                                    <tr>
                                        <td id="fileName1">File Name</td>
                                        <td id="fileType1">04923045324</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> -->
                    </div>
                </div>

                <div class="col-md-4">
                    <!-- This is a Blank space -->
                    <div class="table-container">
                        <h5>Comments</h5>
                        <table class="table table-hover" id="table-file">
                            <thead>
                                <tr>
                                <th scope="col" style="background-color: #0858a4; color: white; font-weight: normal;">Comments</th>
                                </tr>
                            </thead>
                            <tbody id="commentList">
                                <tr>
                                    <td id="comment1">

                                    <!---------Comments here---------->

                                    </td>
                                </tr>
                            </tbody>
                        </table>              
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-1">
                    <!-- This is a Blank space -->
                </div>

                <div class="col-md-6">

                    <div class="keywords">
                        <p style="margin-top: 20px; margin-bottom: 10px; color: #959595 ">Keywords</p>
                        <div class="keyword1">
                        <ul style="display: flex;">
                            <?php
                            $sqlKeyword = "SELECT article.keyword FROM article JOIN reviewer_assigned ON article.article_id = reviewer_assigned.article_id AND article.status = 5 WHERE reviewer_assigned.author_id = :author_id";
                            
                            $result = database_run($sqlKeyword, array('author_id' => $userId));

                            if ($result !== false) {
                                foreach ($result as $row) {
                                    $keywords = explode(',', $row->keyword);
                                    foreach ($keywords as $keyword) {
                                        echo '<li style="list-style-type: none; 
                                                        margin-right: 5px;
                                                        width: auto;
                                                        color: #0858a4;
                                                        border: 1px solid #0858a4;
                                                        border-radius: 10px;
                                                        background-color: white;
                                                        font-size: 12px;">' . trim($keyword) . '</li>';
                                    }
                                    
                                }
                            } else {
                                echo "No keywords for this article";
                            }
                            ?>
                        </ul>

                        </div>
                    </div>


                </div>

                <div class="col-md-4">
                    <!-- This is a Blank space -->
                    <div class="btn">
                        <button class="btn tbn-primary btn-md nextBtn"  onclick="nextStep()" >Accept</button>
                        <button id="btnReject" class="btn tbn-primary btn-md" onclick="prevStep()" >Reject</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Step 2 -->
    <div class="step" id="step2">

        <div class="main-container">
            <div class="content-over">
                <div class="cover-content">
                    <p> Dashboard / Reviewer / Submitted Articles / Steps and Guideline</p>
                    <h3> Review Form Response </h3>
                </div>
            </div>
        </div>



        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <!-- This is a Blank space -->
                </div>

                <div class="col-md-8 rev-guide" style="padding-top:20px;">
                    <h4>Review Steps</h4>

                    <hr style="height: 2px; background-color: #0858a4; width: 100%">

                    <ol>
                        <li> Consult Reviewer Guidelines below. </li>
                        <li> Click on file names to download and review (on screen or by printing) the files associated with this submission. Submission Manuscript 9106-29276-2-RV.DOCX 2023-10-16 Supplementary File(s) None </li>
                        <li> Click on icon to fill in the review form. Review Form Comment </li>
                        <li> In addition, you can upload files for the editor and/or author to consult. Uploaded files None </li>
                        <li> Select a recommendation and submit the review to complete the process. You must enter a review or upload a file before selecting a recommendation.</li>
                    </ol>


                    <h4>Review Guidelines</h4>
                    <hr style="height: 2px; background-color: #0858a4; width: 100%">
                    <div class="guidelines">
                        <p>
                        The International Journal of Learning, Teaching and Educational Research values the role of reviewers in the peer-review process that enables us to publish high-quality materials in a timely way.
                        </p>
                        <p>
                        Reviewers are expected to accept for review only articles in which they have sufficient expertise. Any conflict of interest must be reported to the Chief Editor.
                        </p>
                        <p>
                        Reviewers should submit their reviews using the online form provided on the portal. They are expected to provide a clear recommendation and justifications for their recommendation for either acceptance or rejection of an article.
                        </p>
                        <p>
                        Reviewers should appreciate that they are a privileged group of persons who are having first-hand access to unpublished work and they should therefore maintain the confidentiality of all such works to which they are given access.
                        </p>
                        <p>
                        Reviewers must analyze the methodology and results and discuss whether these could be repeated.
                        </p>
                        <p>
                        Reviewers must identify gaps that could or should be addressed in order to provide a better understanding of the results.
                        </p>
                        <p>
                        Reviewers should provide comments on how the article can be enhanced in terms of focus, style, and length.
                        </p>
                        <p>
                        Reviewers must check whether the references are relevant, recent, and in the proper format.
                        </p>
                        <p>
                        Reviewers must comment on the overall originality of the work and its contribution to the field.
                        </p>
                        <p>
                        Reviewers will be expected to re-review articles which are submitted again after substantial improvements.
                        </p>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" id="checkBox" name="checkBox" value="1" >
                        <label for="checkBox" style="color: #0858a4;" >I have read and will follow the steps and Guidelines of reviewing this assign Article.</label><br>
                    </div>

                    <div class="btn-action">
                        <button class="btn tbn-primary btn-md" id="reviewBtn" onclick="nextStep()" disabled>Review Form</button>
                    </div> 
                </div>

                <div class="col-md-2">
                    <!-- This is a Blank space -->
                </div>
            </div>
        </div>  
    </div>

        <!-- Step 3 -->
    <div class="step" id="step3">


        <div class="main-container">
            <div class="content-over">
                <div class="cover-content">
                    <p> Dashboard / Reviewer / Submitted Articles / Steps and Guideline / Review Form</p>
                    <h3> Review Form Response </h3>
                </div>
            </div>
        </div>


        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1">
                    <!-- This is a Blank space -->
                </div>



                <div class="col-md-10" style="padding-top:20px;">
                    <h5 style="background-color:#0858a4; color: white; padding:10px;" >Research Article Review Form</h5>
                    <div class="contents">
                        <div class="row">
                            <div class="col-md-5 firstContent">

                            <!-- Content for the left half of the screen -->
                                <h4>Note: </h4>
                                <p>Denotes Required Field</p>

                                <h5>Paper Length:</h5>

                                <div>
                                <?php
                                $sqlQuestionnaire = "SELECT question, answer FROM reviewer_questionnaire";
                                $result = database_run($sqlQuestionnaire);

                                if ($result) {
                                    foreach ($result as $row) {
                                        $question = htmlspecialchars($row->question);
                                        echo '<li class="list-group-item mt-4" style="list-style: none; font-family: &quot;Times New Roman&quot;, Times, serif; color: #0858a4; font-size: 20px;">' . $question . '</li>';

                                        // Split the choices using commas
                                        $choices = explode(',', $row->answer);

                                        // Display each choice as a radio button
                                        foreach ($choices as $choice) {
                                            $uniqueId = htmlspecialchars(trim($choice)) . '_' . uniqid(); // Create a unique ID for each radio button
                                            echo '<input type="radio" name="answers[' . $question . ']" value="' . htmlspecialchars(trim($choice)) . '" id="' . $uniqueId . '">';
                                            echo '<label for="' . $uniqueId . '" style="font-size: small; color: gray;">' . htmlspecialchars(trim($choice)) . '</label><br>';
                                        }
                                    }
                                } else {
                                    echo 'The questionnaire has not been updated yet';
                                }
                                ?>




                                  
                                </div>

                                <!-- <div>
                                    <input type="radio" name="paperLength" value="quiteShort" id="quiteShort">
                                    <label for="quiteShort">Quite Short</label>
                                </div>

                                <div>
                                    <input type="radio" name="paperLength" value="ok" id="ok">
                                    <label for="ok">Ok</label>
                                </div>

                                <div>
                                    <input type="radio" name="paperLength" value="quiteLong" id="quiteLong">
                                    <label for="quiteLong">Quite Long</label>
                                </div>

                                <div style="margin-bottom: 10px;" >
                                    <input type="radio" name="paperLength" value="tooLong" id="tooLong">
                                    <label for="tooLong">Too Long</label>
                                </div>


                                <h5>Originality:</h5>

                                <div>
                                    <input type="radio" name="originality" value="Nil" id="Nil">
                                    <label for="Nil">Nil</label>
                                </div>

                                <div>
                                    <input type="radio" name="originality" value="acceptable" id="acceptable">
                                    <label for="acceptable">Acceptable</label>
                                </div>

                                <div>
                                    <input type="radio" name="originality" value="good" id="good">
                                    <label for="good">Good</label>
                                </div>

                                <div style="margin-bottom: 10px;">
                                    <input type="radio" name="originality" value="veryInnovative" id="veryInnovative">
                                    <label for="veryInnovative">Very Innovative</label>
                                </div>

                                <h5>Paper Representation:</h5>

                                <div>
                                    <input type="checkbox" name="representation" value="improveSignificantly" id="improveSignificantly">
                                    <label for="improveSignificantly">Must Improve Significantly</label>
                                </div>

                                <div>
                                    <input type="checkbox" name="representation" value="improveSlightly" id="improveSlightly">
                                    <label for="improveSlightly">Must Improve Slightly</label>
                                </div>

                                <div style="margin-bottom: 10px;">
                                    <input type="checkbox" name="representation" value="ok" id="ok">
                                    <label for="ok">Ok</label>
                                </div>

                                <h5>Scope of Paper:</h5>

                                <div>
                                    <input type="radio" name="scope" value="notRelevant" id="notRelevant">
                                    <label for="notRelevant">Not relevant</label>
                                </div>

                                <div>
                                    <input type="radio" name="scope" value="relevant" id="relevant">
                                    <label for="relevant">Relevant</label>
                                </div>

                                <div style="margin-bottom: 10px;">
                                    <input type="radio" name="scope" value="highlyRelevant" id="highlyRelevant">
                                    <label for="highlyRelevant">Highly relevant</label>
                                </div>

                                <h5>Related work:</h5>

                                <div>
                                    <input type="radio" name="related" value="nil" id="nil">
                                    <label for="nil">Nil</label>
                                </div>

                                <div>
                                    <input type="radio" name="related" value="veryPoor" id="veryPoor">
                                    <label for="veryPoor">Very poor</label>
                                </div>

                                <div>
                                    <input type="radio" name="related" value="poor" id="poor">
                                    <label for="poor">Poor</label>
                                </div>

                                <div>
                                    <input type="radio" name="related" value="acceptable" id="acceptable">
                                    <label for="acceptable">Acceptable</label>
                                </div>

                                <div style="margin-bottom: 10px;">
                                    <input type="radio" name="related" value="excellent" id="excellent">
                                    <label for="excellent">Excellent</label>
                                </div>

                                <h5>Reviewers Expertise:</h5>

                                <div>
                                    <input type="radio" name="expertise" value="nill" id="nill" >
                                    <label for="nill">Nil</label>
                                </div>

                                <div>
                                    <input type="radio" name="expertise" value="veryLow" id="veryLow" >
                                    <label for="veryLow">Very low</label>
                                </div>

                                <div>
                                    <input type="radio" name="expertise" value="low" id="low" >
                                    <label for="low">Low</label>
                                </div>

                                <div>
                                    <input type="radio" name="expertise" value="knowledgeable" id="knowledgeable" >
                                    <label for="knowledgeable">Knowledgeable</label>
                                </div>

                                <div>
                                    <input type="radio" name="expertise" value="high" id="high" >
                                    <label for="high">High</label>
                                </div>

                                <div>
                                    <input type="radio" name="expertise" value="veryHigh" id="veryHigh" >
                                    <label for="veryHigh">Very high</label>
                                </div>

                                <div style="margin-bottom: 30px;">
                                    <input type="radio" name="expertise" value="expert" id="expert" >
                                    <label for="expert">Expert</label>
                                </div> -->




                            </div>



                            <!----------------in between------------------>



                            <div class="col-md-6 comments">
                            <!-- Content for the right half of the screen -->
                            <h4>Additional comment for the following lines: Originality, <br> Literature Review, Evaluation.</h4>                    
                                <textarea id="addiComment" name="addiComment" class="form-control" rows="8"></textarea>
                            <br>
                            <h5>Reference:</h5>
                                <textarea id="reference" name="reference" class="form-control" rows="5" required></textarea>
                            <br>
                                <h5>Languages:</h5>
                            <textarea id="languages" name="languages" class="form-control" rows="5" required></textarea>
                            </div>

                        </div>

                        <hr style="height: 2px; background-color: #0858a4; width: 100%;">

                        <div class="decisions">
                            <h5>Decision:</h5>

                            <div>
                                <input type="radio" name="decision" value="decline" id="decline">
                                <label for="decline">Decline</label>
                            </div>

                            <div>
                                <input type="radio" name="decision" value="acceptSignif" id="acceptSignif">
                                <label for="acceptSignif">Accept if significant modifications are carried out</label>
                            </div>

                            <div>
                                <input type="radio" name="decision" value="acceptMinor" id="acceptMinor">
                                <label for="acceptMinor">Accept if minor modifications are carried out</label>
                            </div>

                            <div>
                                <input type="radio" name="decision" value="acceptWithout" id="acceptWithout">
                                <label for="acceptWithout">Accept without modifications</label>
                            </div>

                        </div>

                        <div class="btn-final">
                            <button type="submit" id="btnSubmit" class="btn tbn-primary btn-md" >Submit</button>
                            <button type="button" id="btnCancel" class="btn tbn-primary btn-md" onclick="prevStep()" >Cancel</button>
                        </div>
                    </div>
                </div>



                <div class="col-md-1">
                    <!-- This is a Blank space -->
                </div>

            </div>
        </div>
    </div>
  
</form>


  <div id="loadingOverlay">
        <div id="loadingSpinner"></div>
    </div>
</body>
</html>




<div class="footer" id="footer">

</div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="../JS/reusable-header.js"></script>
    <script src="../JS/review-process.js"></script>

</body>
</html>