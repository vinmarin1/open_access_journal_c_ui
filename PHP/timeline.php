<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TIMELINE</title>
<link href="../CSS/timeline.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<body>


<div class="header-container" id="header-container">
 
</div>

<nav class="navigation-menus-container"  id="navigation-menus-container">
  
</nav>

<div class="form-container">

<div class="btn-group" role="group" aria-label="Basic radio toggle button group">
  <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off">
  <label class="btn btn-outline-dark" for="btnradio1">Review</label>

  <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
  <label class="btn btn-outline-dark" for="btnradio2">Create</label>


</div>

<form id="multiSForm" method="POST" action="../php/submit.php">
    
  <h3>Submit your paper</h3>
  <div>
    <span class="step" title="Start"></span>
    <span class="step" title="Details"></span>
    <span class="step" title="Upload Files"></span>
    <span class="step" title="Confirmation"></span>
    <span class="step" title="For Editors"></span>
    
   
  </div>
  <!-- One "tab" for each step in the form: -->
  <div class="tab" id="tab1">
    <h5 class="title">Submission Checklist</h5>
    <h6 style="color: #115272">Indicate that this submission is ready to be considered by this journal by checking off the following (comments to the editor can be added below).</h6>
    <div class="guidelines">
        <p>The submission has not been previously published, nor is it before another journal for consideration (or an explanation has been provided in Comments to the Editor).

Note that your paper will be submitted to iThenticate.com (Plagiarism Detection Software) to check the similarity score.
</p>
<p>
The submission file is in Microsoft Word document file format. Please do NOT submit in pdf.
</p>
<p>
Where available, URLs for online references have been provided.
</p>

<p>
The text is single-column; single-spaced; uses a 11-point font (except for section headings which is 12); employs italics, rather than underlining (except with URL addresses); and all illustrations, figures, and tables are placed within the text at the appropriate points, rather than at the end. The Book Antiqua font should be used for all text in the paper. Use A4 page set-up. The top and bottom margins are 1.4 inches and the right/left margins are 1.2 inches.
</p>
<p>
The text adheres to the stylistic and bibliographic requirements outlined in the Author Guidelines, which is found in About the Journal.

<!-- <p class="line">_____________________________________________________________</p> -->


    </div>
    <h5 class="title" style="margin-top: 40px">Copyright Notice</h5>
  <h6 style="color: #115272">Authors who publish with this journal also agree to the following terms: 
  <p class="h6" style="color: #115272; margin-top: 20px">Authors are able to enter into separate, additional contractual arrangements for the non-exclusive distribution of the journal's published version of the work (e.g., post it to an institutional repository or publish it in a book), with an acknowledgement of its initial publication in this journal. 
</p>
<p class="h6" style="color: #115272; margin-top: 20px">
Authors are permitted and encouraged to post their work online (e.g., in institutional repositories or on their website) as this can lead to productive exchanges, as well as earlier and greater citation of published work.
</p>


</h6>

<h5 class="title" style="margin-top: 40px">Journal's Privacy Statement</h5>
<p class="h6" style="color: #115272; margin-top: 20px">
The names and email addresses entered in this journal site will be used exclusively for the stated purposes of this journal and will not be made available for any other purpose or to any other party
</p>
<div class="form-check">
  <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate" name="privacy">
  <label class="form-check-label" for="flexCheckIndeterminate">
    The authors agree to the terms of this Copyright Notice, which will apply to this submission if and when it is published by this journal (comments to the editor can be added below).
  </label>
</div>





  </div>
 
  <div class="tab">
  <h5 class="title">Submission Checklist</h5>
  <h6 style="color: #115272">Please provide the following details to help us manage your submission in our system.</h6>
 
  <div class="journal_type_container">
  <h5 class="title">Journal Type</h5>
  <div class="category">
  <div class="form-check category-type" style="margin-left: 10px">
  <input class="form-check-input radio-select" type="radio" name="category" id="flexRadioDefault1" value="">
  <label class="form-check-label" for="flexRadioDefault1" style="color: #115272; font-family: Times New Roman;">
    The Gavel
  </label>
</div>
<div class="form-check category-type" style="margin-left: 10px">
  <input class="form-check-input radio-select" type="radio" name="category" id="flexRadioDefault2" value="">
  <label class="form-check-label" for="flexRadioDefault2" style="color: #115272; font-family: Times New Roman;">
   The Star
  </label>
</div>
<div class="form-check category-type"  style="margin-left: 10px">
  <input class="form-check-input radio-select" type="radio" name="category" id="flexRadioDefault3" value="">
  <label class="form-check-label" for="flexRadioDefault3" style="color: #115272; font-family: Times New Roman;">
   The Lamp
  </label>
</div>
<div class="input-group mb-3">
<span class="input-group-text" id="basic-addon2">Title</span>
  <input type="text" name="title" id="title" class="form-control" aria-describedby="basic-addon2" >
  
</div>
<div class="input-group">
  <span class="input-group-text">Abstract</span>
  <textarea class="form-control" id="abstract" aria-label="With textarea" name="abstract"></textarea>
</div>
<div class="input-group mb-3">
<span class="input-group-text" id="basic-addon2">Reference</span>
  <input type="text" name="reference" id="reference" class="form-control" aria-describedby="basic-addon2" >
  
</div>

<div class="input-group mb-3">
<span class="input-group-text" id="basic-addon2">Keyword</span>
  <input type="text" name="keyword" id="keyword" class="form-control" aria-describedby="basic-addon2" >
  
</div>

  </div>
  
  </div>
 
    
  </div>
  <div class="tab">
    <div class="upload-container">
    <h5 class="title upload-title">Upload File</h5 class="title">
    <button type="button" class="btn btn-primary btn-sm" onclick="openFileModal()" id="upload-btn">Upload your file</button>
    <input type="file" id="hiddenFileInput" style="display: none;">
    </div>
 
<table class="table">
  <thead>
    <tr>
      <th scope="col">File Name</th>
      <th scope="col">Type</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody id="fileList">

  </tbody>
</table>


  </div>
  <div class="tab">
  <div class="upload-container">
 <?php
if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
  $first_name = $_SESSION['first_name'];
  echo "<p id='contributor' style='display: none'>$first_name</p>";

}
?>

   <button type="button" class="btn btn-primary btn-sm" id="contributor-btn">Add Contributors</button>
   
    </div>
   <table class="table">
  <thead>
    <tr>
      <th class="" scope="col">Contributors</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td name="contributor" id="contributor"><?php echo $first_name; ?></td>
      <td><button class="btn btn-danger btn-sm" style="display: none;"></button></td>
    </tr>
  </tbody>
  <tbody id="contributors-table-body"></tbody>
</table>



  </div>
  <div class="tab">
  <h5 class="title contributors-title">Comments for editors</h5>
 <h6 style="color: #115272">Please provide the following details to help our editorial team manage your submission.</h6>
 <div class="input-group">
  <span class="input-group-text">Comments</span>
  <textarea class="form-control" id="comment" name="comment" aria-label="With textarea"></textarea>
</div>
  </div>
  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  
</form>
</div>





<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../JS/reusable-header.js"></script>
<script src="../JS/timeline.js"></script>
</body>
</html>
 
 
