<?php
include 'dbcon.php';
session_start();
if (!isset($_SESSION['LOGGED_IN']) || $_SESSION['LOGGED_IN'] !== true) {
  header('Location: ./login.php');
  exit();
}

$id = $_SESSION['id'];

$sqlSelectProfile = "SELECT first_name, last_name, birth_date, gender, marital_status, orc_id, afiliations, position, field_of_expertise, country FROM author WHERE author_id = :author_id";

$resultProfile = database_run($sqlSelectProfile, array(':author_id' => $id));

if ($resultProfile) {
  if (count($resultProfile) > 0) {
    $userProfile = $resultProfile[0];

    $requiredFields = ['first_name', 'last_name', 'birth_date', 'gender', 'marital_status', 'orc_id', 'afiliations', 'position', 'field_of_expertise', 'country'];

    $profileComplete = true;
    foreach ($requiredFields as $field) {
      if (empty($userProfile->$field)) {
        $profileComplete = false;
        break;
      }
    }
    if ($profileComplete === false) {
      // Add JavaScript alert before redirecting
      echo "<script>alert('Please complete your profile to submit an article.');</script>";
      echo "<script>window.location.href = './user-dashboard.php';</script>";
      exit(); // Ensure script execution stops here
    }
  } else {
    echo 'ERROR, Please provide us your profile details';
  }
} else {
  echo 'Something Went Wrong';
}
?>


<!DOCTYPE html>
<html>

<head>
<?php include('./meta.php'); ?>
<title>Submit Article</title>
<link href="../CSS/ex_submit.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">


</head>

<body>

<div class="header-container" id="header-container">
</div>

<nav class="navigation-menus-container"  id="navigation-menus-container">
</nav>


<form action="ex_submit_con.php" method="post" id="form" enctype="multipart/form-data" id="submit-form">
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation" style="margin-left: -10px;">
    <button class="nav-link active" id="privacy-tab" data-bs-toggle="tab" data-bs-target="#privacy-tab-pane" type="button" role="tab" aria-controls="privacy-tab-pane" aria-selected="true">Privacy</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="article-tab" data-bs-toggle="tab" data-bs-target="#article-tab-pane" type="button" role="tab" aria-controls="article-tab-pane" aria-selected="false">Article Details</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="file-tab" data-bs-toggle="tab" data-bs-target="#file-tab-pane" type="button" role="tab" aria-controls="file-tab-pane" aria-selected="false">Upload File</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="contributors-tab" data-bs-toggle="tab" data-bs-target="#contributors-tab-pane" type="button" role="tab" aria-controls="contributors-tab-pane" aria-selected="false">Contributors</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="comment-tab" data-bs-toggle="tab" data-bs-target="#comment-tab-pane" type="button" role="tab" aria-controls="comment-tab-pane" aria-selected="false">Notes</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review-tab-pane" type="button" role="tab" aria-controls="review-tab-pane" aria-selected="false">Preview</button>
  </li>
</ul>


<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="privacy-tab-pane" role="tabpanel" aria-labelledby="privacy-tab" tabindex="0">
    <h2>Step 1. Starting the Submission</h2>
    <hr class="divider">
    <h3 class="form-heading">Submission Checklist</h3>
    <span class="form-sub-heading">Indicate that this submission is ready to be considered by this journal by checking off the following (comments to the editor can be added below).</span>
 

  <div class="descript-1 pt-3">
    <div class=" " id="checkList-1">
      <label for="check-1" class="checkItem">
        <input type="checkbox" class="my-checkbox" id="check-1" name="">
        <p class="st-1">The submission has not been previously published, nor is it before another journal for consideration (or an explanation has been provided in Comments to the Editor).</p>
      </label>
    </div>
    <div class="" id="checkList-2">
      <label for="check-2" class="checkItem">
        <input type="checkbox" class="my-checkbox" id="check-2">
        <p class="st-2">Note that your paper will be submitted to iThenticate.com (Plagiarism Detection Software) to check the similarity score.</p>
      </label>
    </div>
    <div class="" id="checkList-3">
      <label for="check-3" class="checkItem">
        <input type="checkbox" class="my-checkbox" id="check-3">
        <p class="st-3">The submission file is in Microsoft Word document file format. Please do NOT submit in pdf.</p>
      </label>
    </div>
    <div class="" id="checkList-4">
      <label for="check-4" class="checkItem">
        <input type="checkbox" class="my-checkbox" id="check-4">
        <p class="st-4">Where available, URLs for online references have been provided.</p>
      </label>
    </div>
    <!-- <div class="" id="checkList-5">
    <input type="checkbox" class="my-checkbox" id="check-5">
    <p class="st-4">Where available, URLs for online references have been provided.</p>
    </div> -->
    <div class="" id="checkList-6">
      <label for="check-6" class="checkItem">
        <input type="checkbox" class="my-checkbox" id="check-6">
        <p class="st-5" >The text is single-column; single-spaced; uses a 11-point font (except for section headings which is 12); employs italics, rather than underlining (except with URL addresses); and all illustrations, figures, and tables are placed within the text at the appropriate points, rather than at the end. The Book Antiqua font should be used for all text in the paper. Use A4 page set-up. The top and bottom margins are 1.4 inches and the right/left margins are 1.2 inches.</p>
      </label>
    </div>
    <div class="" id="checkList-7">
      <label for="check-7" class="checkItem">
        <input type="checkbox" class="my-checkbox" id="check-7">
        <p class="st-6">The text adheres to the stylistic and bibliographic requirements outlined in the Author Guidelines, which is found in About the Journal.</p>
      </label>
    </div>
  </div>
  
  <hr class="divider">

  <h3 class="form-heading">Copyright Notice</h3>
  <p class="form-sub-heading">Authors who publish with this journal also agree to the following terms: </p>
  <p>Authors are able to enter into separate, additional contractual arrangements for the non-exclusive distribution of the journal's published version of the work (e.g., post it to an institutional repository or publish it in a book), with an acknowledgement of its initial publication in this journal.</p>
  <p>Authors are permitted and encouraged to post their work online (e.g., in institutional repositories or on their website) as this can lead to productive exchanges, as well as earlier and greater citation of published work.</p>

  <hr class="divider">

  <h3 class="form-heading" >Journal's Privacy Statement</h3>
  <p class="form-sub-heading">The names and email addresses entered in this journal site will be used exclusively for the stated purposes of this journal and will not be made available for any other purpose or to any other party</p>

  <div class="descript-2 pt-3">

  <div class="">
  <label for="check" class="checkItem">
    <input type="checkbox" class="my-checkbox" id="check" name="check" value="1">
    <p class="st-7">The authors agree to the terms of this Copyright Notice, which will apply to this submission if and when it is published by this journal (comments to the editor can be added below).</p>
  </label>

  

</div>

</div>
<div class="d-flex gap-1 w-100 justify-content-end ">
  <button type="button" class="btn btn-primary btn-sm" id="next1" >Next</button>
</div>
  </div>
  <div class="tab-pane fade" id="article-tab-pane" role="tabpanel" aria-labelledby="article-tab" tabindex="0">
    <div class="article-details">
      <div class="details">
        <h2>Step 2. Article Details</h2>
        <span class="main-sub">Please provide the following details to help us manage your submission in our system.</span>
      </div>
      <hr class="divider"/>
      <div class="input-details d-flex flex-column-reverse gap-4 flex-sm-row">
        <div class="form-floating w-100 mt-1" id="form-floating">
          <span class="form-label">Title <p id="title-validation" style="color: red; display: none; font-size: 14px;">The minimum word for title is 5 and maximum of 100 words</p></span>
          <input class="form-control artcl" type="text"  id="title" name="title">
          <span class="form-label">Abstract<p id="abstract-validation" style="color: red; display: none;  font-size: 14px">The minimum word for abstract is 10 and maximum of 600 words</p></span>
          <textarea class="form-control" name="editor" id="editor" cols="30" rows="10"></textarea>
        
          <input class="form-control artcl" type="text" id="abstract" name="abstract"  style="display: none;">
          <div class="d-flex flex-column">
          <span id="total-words-abstract" class="text-end w-full"></span>
          </div>
  
        </div>
  
        <div class="form-floating-2" id="form-floating-2">
         
          <!-- <h5 id="duplication-title">Checking of Details</h5> -->
          <div class="duplicated-article">
            <h6 class="checker-titles">Originality Checker <span id="flaggedT"></span></h6>
            <div id="flagged">
            
            </div>
            <h6></h6>
            <!-- <label id="label-title">Article: </label> -->
            <p id="label-title" class="d-none">Article:</p>
            <div id="similar-title" class="text-muted" onclick="openArticleDetails()"></div>
  
           
          
            <div id ="similar-abstract"></div>
          
            <!-- <label  id="label-result">Result: </label> -->
            <p id="label-result"class="d-none">Result:</p>
            <div class="d-flex gap-2 text-muted">
              Title: <div id="result-duplication" style="color: #115272">...</div>
              Abstract: <div id="result-duplication2" style="color: #115272">...</div>
            </div>
           
          </div>
  
          <div class="journal-type-container">
            <h6 class="checker-titles">Journal Classification</h6>
            <select class="form-select" name="journal-type" id="journal-type">
              <?php
                  $sqlJournal = "SELECT journal_id, journal FROM journal";
                  $resultJournal = database_run($sqlJournal); 

                  if ($resultJournal) {
                      foreach ($resultJournal as $journal) {
                          $journalId = $journal->journal_id;
                          $journalName = $journal->journal;
                          echo '<option value="' . $journalId . '">' . $journalName . '</option>';
                      }
                  } else {
                      echo '<option value="1" id="gavel">The Gavel</option>';
                      echo '<option value="2" id="lamp">The Lamp</option>';
                      echo '<option value="3" id="star">The Star</option>';
                  }
              ?>
              <!-- <option value="1" id="gavel">The Gavel</option>
              <option value="2" id="lamp">The Lamp</option>
              <option value="3" id="star">The Star</option> -->
            </select>
            <span id="journal-info" class="suggestion-title text-muted">Pahina can suggest journal based on your article</span>
            <span class="text-danger" id="journal-error"></span>
          </div>
          <button type="button" class="btn btn-primary btn-sm mt-2" id="check-duplication" onclick="checkDuplication()">
              <span id="check-text">Check</span>
              <div class="spinner-border spinner-border-sm" role="status" id="check-spinner" style="display: none;">
                  <span class="visually-hidden">Loading...</span>
              </div>
              <span id="checking-text" style="display: none;">Checking...</span>
          </button>
  
        
          <!-- <button type="button" class="btn btn-primary btn-sm" id="btn-okay">Okay</button> -->
        </div>
      </div>
      <div class="input-details-2 mt-2 w-100 w-sm-50 d-flex flex-column gap-4" id="form-floating-3">
        <div>
          <span class="form-label">Keywords <p id="keywords-validation" style="color: red; display: none; font-size: 14px">Maximum of 5 keywords*</p></span>
          <div class="d-flex flex-column flex-sm-row gap-2 mb-4" style="min-height: 30px">
              <div id="display-keywords" class="d-flex flex-wrap gap-2">
                <span class="border px-2 py-1 rounded">...</span>
              </div>
              <div class="d-flex gap-1">
                <input class="form-control artcl" type="text" list="keywordList" id="keywords" name="keywords" placeholder="type and enter">
                <button class="btn btn-white border" id="keyword-btn" >+</button>
              </div>
          </div>
          <datalist id="keywordList">
          </datalist>
          
          <span class="form-label mt-4" >Reference <p id="reference-validation" style="color: red; display: none; font-size: 14px;">Reference is required*</p></span>
          <textarea class="form-control" name="editor2" id="editor2" cols="30" rows="10"></textarea>
          <input class="form-control" type="text" id="reference"  name="reference" style="display: none;">
        </div>
      </div>
      <div class="d-flex gap-1 w-100 justify-content-end ">
        <button type="button" class="btn btn-secondary btn-sm mt-4" id="prev">Prev</button>
        <button type="button" class="btn btn-primary btn-sm mt-4" id="next" >Next</button>
      </div>
    
    </div>
  </div>

  <div class="tab-pane fade" id="file-tab-pane" role="tabpanel" aria-labelledby="file-tab" tabindex="0">

  <div class="table-input">
  <h2>Step 3. Upload Files</h2>
  <span class="main-sub" id="sub-13">Provide any files our editorial team may need to evaluate your submission. In addition to the main work, you may wish to submit data sets, conflict of interest statements, or other supplementary files if these will be helpful for our editors.</span>
  <hr class="divider"/>
  <!-- <button type="button" class="btn btn-primary btn-sm mt-5" onclick="openFileModal()" id="upload-btn">Upload File</button> -->

  <input type="file" class="form-control" name="file_name" id="file_name" accept=".docx" style="display: none">
  <input type="file" class="form-control" name="file_name2" id="file_name2" accept=".docx" style="display: none">
  <input type="file" class="form-control" name="file_name3" id="file_name3" accept=".docx" style="display: none">

<table class="table table-hover" id="table-file">
  <thead>
    <tr>
      <th scope="col" >File Name</th>
      <th scope="col">File Type</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody id="fileList">
    <tr>
      <td id="fileName1" style="font-family: Arial, Helvetica, sans-serif;"></td>
      <td id="fileType1" style="font-family: Arial, Helvetica, sans-serif;">File with author name</td>
      <td>
        <button type="button" class="btn btn-primary btn-sm" style="margin-right: 5px" id="addFileName" onclick="openFilename(1)">Add File</button>
        <button type="button" class="btn btn-danger btn-sm" id="deleteFileName" onclick="deleteFilename(1)">Delete</button>
      </td>
    </tr>
    <tr>
      <td id="fileName2" style="font-family: Arial, Helvetica, sans-serif;"></td>
      <td id="fileType2" style="font-family: Arial, Helvetica, sans-serif;">File with no author name</td>
      <td>
        <button type="button" class="btn btn-primary btn-sm" style="margin-right: 5px" id="addFileName2" onclick="openFilename(2)">Add File</button>
        <button type="button" class="btn btn-danger btn-sm" id="deleteFileName2" onclick="deleteFilename(2)">Delete</button>
      </td>
    </tr>
    <tr>
      <td id="fileName3" style="font-family: Arial, Helvetica, sans-serif;"></td>
      <td id="fileType3" style="font-family: Arial, Helvetica, sans-serif;">Title Page</td>
      <td>
        <button type="button" class="btn btn-primary btn-sm" style="margin-right: 5px" id="addFileName3" onclick="openFilename(3)">Add File</button>
        <button type="button" class="btn btn-danger btn-sm" id="deleteFileName3" onclick="deleteFilename(3)">Delete</button>
      </td>
    </tr>
  </tbody>
</table>
    <div class="d-flex gap-1 w-100 justify-content-end mt-5">
        <button type="button" class="btn btn-secondary btn-sm" id="prev3">Prev</button>
        <button type="button" class="btn btn-primary btn-sm" id="next3" >Next</button>
    </div>
  </div>

  </div>

  <div class="tab-pane fade" id="contributors-tab-pane" role="tabpanel" aria-labelledby="contributors-tab" tabindex="0">
  
  <div class="contributors-container">
  <h2>Step 4. Add Contributors</h2>
  <span class="main-sub" id="sub-14">Add details for all of the contributors to this submission. Contributors added here will be sent an email confirmation of the submission, as well as a copy of all editorial decisions recorded against this submission.</span>

  <?php
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $public_name = $_SESSION['public_name'];
    $orc_id = $_SESSION['orc_id'];
    $email = $_SESSION['email'];
  ?>
  <hr class="divider"/>
  <div class="btn-container">
      <button type="button" id="addCont" class="btn btn-primary btn-sm" onclick="addRow()">Add Contributor</button>
      <button type="button" id="deleteCont" class="btn btn-danger btn-sm" onclick="deleteData()">Delete Contributor</button>
      <!-- <button type="button" class="btn btn-primary btn-sm" onclick="saveData()">Save Data</button> -->
    </div>
  <div class="table-responsive-sm">
    <table class="table table-striped" id="contributorTable" >
            <thead>
                <tr>
                    <th >Email</th>
                    <th >First Name</th>
                    <th >Last Name</th>
                    <th >Public Name</th>
                    <th >ORCID</th>
                    <th id="cont-col">Contributor Type</th>
                    <th>Action</th>
                </tr>
               <tr>
                
                <?php
                  $sql = "SELECT email, first_name, last_name, public_name, orc_id FROM author WHERE author_id = :author_id";
                  $sqlRun = database_run($sql, array('author_id' => $id));
                  if($sqlRun !== false){
                      foreach($sqlRun as $row){
                          $email = $row->email;
                          $first_name = $row->first_name;
                          $last_name = $row->last_name;
                          $public_name = $row->public_name;
                          $orc_id = $row->orc_id;
                          echo '
                              <td><input type="text" style="width: 100%; padding:4px 8px" value="'.$email.'" disabled></td>
                              <td><input type="text" style="width: 118px; padding:4px 8px" value="'.$first_name.'" disabled></td>
                              <td><input type="text" style="width: 118px; padding:4px 8px" value="'.$last_name.'" disabled></td>
                              <td><input type="text" style="width: 118px; padding:4px 8px" value="'.$public_name.'" disabled></td>
                              <td><input type="text" style="width: 118px; padding:4px 8px" value="'.$orc_id.'" disabled></td>
                              <td><input type="checkbox" id="authorPcontact" class="-input"><input type="hidden" id="authorPcontactValue" name="authorPcontactValue" value=""><label style="font-weight: normal; font-size: 11px; margin-left: 10px;">Primary Contact</label></td>
                          ';
                      }
                  }
                  ?>

                <!-- <td><input type="text" style="width: 100%; padding:4px 8px"  value="<?php echo $email ?>"  disabled></td>
                <td><input type="text" style="width: 118px; padding:4px 8px" value="<?php echo $first_name ?>" disabled></td>
                <td><input type="text" style="width: 118px; padding:4px 8px" value="<?php echo $last_name ?>" disabled></td>
                <td><input type="text" style="width: 118px; padding:4px 8px"  value="<?php echo $public_name ?>" disabled></td>
                <td><input type="text" style="width: 118px; padding:4px 8px" value="<?php echo $orc_id ?>"  disabled></td>
                <td><input type="checkbox" id="authorPcontact" class="-input"><input type="hidden" id="authorPcontactValue" name="authorPcontactValue" value=""><label style="font-weight: normal; font-size: 11px; margin-left: 10px;">Primary Contact</label></td> -->
                
                
               </tr>
            </thead>
            <tbody>
              
            </tbody>
        </table>
      </div>
      <div class="d-flex gap-1 w-100 justify-content-end mt-5">
        <button type="button" class="btn btn-secondary btn-sm" id="prev4">Prev</button>
        <button type="button" class="btn btn-primary btn-sm" id="next4" >Next</button>
      </div>

  </div>

  </div>

  <div class="tab-pane fade" id="comment-tab-pane" role="tabpanel" aria-labelledby="comment-tab" tabindex="0">
    <div class="comment-container">
    <h2>Step 5. Author Notes</h2>
    <span class="main-sub">Please provide the following details to help our editorial team manage your submission.</span>
    <div id="editor4" style="display: none"></div>

    </div>
    <textarea class="form-control" name="editor3" id="editor3" cols="30" rows="10" style="width: 94%; height: auto; margin-left: auto;  margin-right: auto; margin-bottom: 10px; "></textarea>
    <input class="form-control" type="text" id="notes" name="notes" style="display: none; ">
    <div class="d-flex gap-1 w-100 justify-content-end mt-5">
      <button type="button" class="btn btn-secondary btn-sm" id="prev5">Prev</button>
      <button type="button" class="btn btn-primary btn-sm" id="next5" >Next</button>
      
    </div>
  </div>

  <div class="tab-pane fade" id="review-tab-pane" role="tabpanel" aria-labelledby="review-tab" tabindex="0">
  <h2>Step 6. Review and Submit</h2>
  <span class="main-sub">Review the information you have entered before you complete your submission. You can change any of the details displayed here by clicking the edit button at the top of each section.</span>
  <br/>
  <span class="main-sub">
    Once you complete your submission, a member of our editorial team will be assigned to review it. Please ensure the details you have entered here are as accurate as possible.
  </span>

  <div class="article-info-container">
    <div class="article-header d-flex justify-content-between">
      <span class="" style="font-weight: 600">Details</span>
      <button type="button" class="btn btn-outline-light btn-sm" id="update-cont-2">View</button>
    </div>
    <div class="editable-content mt-3" id="editable-content">
      <label id="sub-26">Title: </label><br>
      <input type="text" class="form-control" id="input5f1" readonly><br>

      <label id="sub-28" style="margin-top: 30px">Abstract: </label><br>
      <!-- <input type="text" class="form-control" id="input7"  readonly><br> -->
      <textarea class="form-control" name="input7" id="input7" cols="30" rows="10" readonly></textarea>

      <label id="sub-27">Keywords: </label><br>
      <input type="text" class="form-control" id="input6" name="input6" readonly><br>
    
      <label id="sub-29">Reference: </label><br>
      <!-- <input type="text" class="form-control" id="input8" readonly><br> -->
      <textarea class="form-control" name="input8" id="input8" cols="30" rows="10" readonly></textarea>
    </div>

  
    <div class="file-container">
      <!-- <h5 class="title11" id="title-11">Files: </h5> -->
      <div class="file-header-container d-flex justify-content-between">
        <span class="" style="font-weight:600" id="title1f">File name</span>
        <button type="button" class="btn btn-outline-light btn-sm" id="update-cont-3">View</button>
    
      </div>
      <div class="file-content-container mt-3 mb-2">
        <input type="text" class="form-control" id="input9" readonly>
        <input type="text" class="form-control" id="input9f" readonly>
        <input type="text" class="form-control" id="input9g" readonly>
      </div>
    </div>

    <div class="cont-container">
      <!-- <h5 class="title12" id="title-12">Contributors: </h5> -->
      <!-- <div class="cont-header-container">
        <h5 class="title13" id="title-13">Contributors Name</h5>
        <button type="button" class="btn btn-outline-light btn-sm" id="update-cont-4">View</button>
    
      </div> -->
      <!-- <div class="file-content-container mt-3"> -->
        <!-- <input type="text" class="form-control" id="input10" readonly> -->
        <!-- <table class="table table-striped" id="table-contributor-preview" name="table-contributor">
          <thead>
            <tr >
        
              <th scope="col" style="background-color: var(--main, #0858A4); color: white; font-weight: normal;">First Name</th>
              <th scope="col" style="background-color: var(--main, #0858A4); color: white; font-weight: normal;">Last Name</th>
              <th scope="col" style="background-color: var(--main, #0858A4); color: white; font-weight: normal;">Public Name</th>
              <th scope="col" style="background-color: var(--main, #0858A4); color: white; font-weight: normal;">ORCID</th>
              <th scope="col" style="background-color: var(--main, #0858A4); color: white; font-weight: normal;">EMAIL</th>
              <th scope="col" style="background-color: var(--main, #0858A4); color: white; font-weight: normal;">CO-AUTHOR</th>
              <th scope="col" style="background-color: var(--main, #0858A4); color: white; font-weight: normal;">PRIMARY CONTACT</th>
              <th scope="col" style="background-color: var(--main, #0858A4); color: white; font-weight: normal; ">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo $first_name; ?></td>
              <td><?php echo $lastName; ?></td>
              <td></td>
              <td><?php echo $orc_id; ?></td>
              <td><?php echo $email; ?></td>
              <td><input type="checkbox" disabled></td>
              <td><input type="checkbox" id="checkbox2"></td>
              <td style="width: 150px"></td>
            </tr>
          </tbody>
        </table> -->
      <!-- </div> -->
    </div>
    
   

  </div>
  <div class="d-flex gap-1 w-100 justify-content-end mt-5">
  <button type="button" class="btn btn-secondary btn-sm" id="prevReview">Prev</button>
  <button type="button" class="btn btn-success btn-sm" id="submit" onclick="saveData()" >Submit</button>
  
  </div>
  </div>

</div>
<div id="btn-action">
<!-- <button type="submit" class="btn btn-success btn-sm" id="submit" onclick="saveData()"  disabled>Submit</button> -->
<!-- <button type="button" class="btn btn-primary btn-sm" id="next" >Next</button>

<button type="button" class="btn btn-secondary btn-sm" id="prev">Prev</button> -->

</div>

<!-- Add this element to your HTML code -->
<div id="loadingOverlay">
    <div id="loadingSpinner"></div>
</div>

</form>



<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../JS/reusable-header.js"></script>
<script src="../JS/ex_submit_keywords.js"></script>  
<script src="../JS/ex_submit.js"></script>  
<script src="../JS/ex_submit_duplicate_article.js"></script>
<script src="../JS/ex_submit_journal_type.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
function includeNavbar() {
  fetch('../PHP/navbar.php')
    .then(response => response.text())
    .then(data => {
      document.getElementById('navigation-menus-container').innerHTML = data;
      // Now that the content is loaded, you can attach event listeners or perform other operations as needed
      // For example, you can attach the notification button click event listener here
      attachNotificationButtonListener();
    })
    .catch(error => console.error('Error loading navbar.php:', error));
}

function attachNotificationButtonListener() {
  $(document).on('click', '#notification-button', function () {
    $("#notification-count").text("0");
    $("#notification-count").hide();
    // Send AJAX request to mark notifications as read
    $.ajax({
      url: "../PHP/mark_notifications_read.php",
      type: "POST",
      data: { author_id: <?php echo $_SESSION['id']; ?> },
      success: function (response) {
        console.log("Notifications marked as read:", response);
        // Update notification count on success
        // $("#notification-count").text("0");
        // $("#notification-count").hide();

      },
      error: function (xhr, status, error) {
        console.error("Error marking notifications as read:", error);
      }
    });
  });
}

// Call includeNavbar function to load navbar.php content
includeNavbar();


</script>
<script>


// function addRow() {
//     var index = $('#contributorTable tbody tr').length; // Get the current row index
//     var newRow = '<tr>' +
//         '<td><input class="form-control email-input" type="email" name="emailC[]" style="height: 30px;" required></td>' +
//         '<td><input class="form-control" type="text" name="firstnameC[]" style="height: 30px;" required></td>' +
//         '<td><input class="form-control" type="text" name="lastnameC[]" style="height: 30px;" required></td>' +
//         '<td><input class="form-control" type="text" name="publicnameC[]" style="height: 30px;"></td>' +
//         '<td><input class="form-control" type="number" name="orcidC[]" style="height: 30px;"></td>' +
//         '<td class="align-middle">' +
//         '<div class=" cAuthor" style="display: inline-block; margin-right: 10px">' +
//         '<input class="-input" type="checkbox" name="contributor_type_coauthor[' + index + ']" value="Co-Author">' +
//         '<label class="-label"> Co-Author</label>' +
//         '</div>' +
//         '<div class=" pContact" style="display: inline-block">' +
//         '<input class="-input" type="checkbox" name="contributor_type_primarycontact[' + index + ']" value="Primary Contact">' +
//         '<label class="-label"> Primary Contact</label>' +
//         '</div>' +
//         '</td>'
//         +
//         '<td class="align-middle"><input class="-input" type="checkbox" name="selectToDelete"></td>' +
//         '</tr>';

//     $('#contributorTable tbody').append(newRow);
// }

// // Attach event listener to the email input field for fetching data on blur
// $('#contributorTable tbody').on('blur', 'input.email-input', function() {
//     var email = $(this).val();
//     var currentRow = $(this).closest('tr');

//     if (email !== '') {
      
//         $.ajax({
//             type: 'POST',
//             url: 'fetch_author_data.php', 
//             data: { email: email },
//             dataType: 'json',
//             success: function(response) {
//                 if (response.success) {
//                     // Update the current row with fetched data
//                     currentRow.find('input[name="firstnameC[]"]').val(response.data.first_name);
//                     currentRow.find('input[name="lastnameC[]"]').val(response.data.last_name);
//                     currentRow.find('input[name="publicnameC[]"]').val(response.data.public_name);
//                     currentRow.find('input[name="orcidC[]"]').val(response.data.orc_id);
//                 } else {
//                     // Handle the case where the email does not exist in the database
//                     Swal.fire({
//                     icon: "question",
//                     title: "This email is new to us",
//                     text: "Please try to input the contributors info manually."
                  
//                   });
//                 }
//             },
//             error: function(xhr, status, error) {
//                 console.error('Error fetching data:', error);
//             }
//         });
//     }
// });


// function saveData() {
//   const title = document.getElementById('title');
//   const form = document.getElementById('form');

//   if (title.value === '') {
//     alert('You should provide a title before submission');
  
//     return;
//   } else {
   
//     var formData = new FormData(form);

//     $('#contributorTable tbody tr').each(function (index, row) {
//       var coAuthorCheckbox = $(row).find('input[name="contributor_type_coauthor[]"]');
//       var primaryContactCheckbox = $(row).find('input[name="contributor_type_primarycontact[]"]');

//       if (coAuthorCheckbox.is(':checked')) {
//         formData.append('contributor_type_coauthor[' + index + ']', 'Co-Author');
//       }

//       if (primaryContactCheckbox.is(':checked')) {
//         formData.append('contributor_type_primarycontact[' + index + ']', 'Primary Contact');
//       }
//     });

//     $('#loadingOverlay').show();
    
//     // Continue with the rest of your code
    
//     // Submit the form programmatically
//     form.submit();
//   }
// }



// // function saveData() {


// //   var formData = new FormData($('#form')[0]);

// //   // Add contributor types for each row
// //   $('#contributorTable tbody tr').each(function(index, row) {
// //       var coAuthorCheckbox = $(row).find('input[name="contributor_type_coauthor[]"]');
// //       var primaryContactCheckbox = $(row).find('input[name="contributor_type_primarycontact[]"]');

// //       if (coAuthorCheckbox.is(':checked')) {
// //           formData.append('contributor_type_coauthor[' + index + ']', 'Co-Author');
// //       }

// //       if (primaryContactCheckbox.is(':checked')) {
// //           formData.append('contributor_type_primarycontact[' + index + ']', 'Primary Contact');
// //       }
// //   });

// //   $('#loadingOverlay').show();

// // }


// function deleteData() {
//   // Iterate through each checkbox
//   $('input[name="selectToDelete"]:checked').each(function() {
//       // Delete the corresponding row
//       $(this).closest('tr').remove();
//   });
// }

</script>

</body>
</html>