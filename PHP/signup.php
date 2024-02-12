<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCU PUBLICATION | SIGN-UP</title>
    <link rel="stylesheet" href="../CSS/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
</head>
<body>

<?php include 'header.php' ?>
<?php include 'navbar.php' ?>

<div class="form-container">
	
    <form method="POST" id="form" action="signup-function.php">
      

       <p class="h4 mt-4">REGISTER</p>
       <div class="input-field pt-5">
           <label for="email">Email:</label><span id="span1">*</span><span id="spanEmailValidation" style="display: none; color: red; font-size: 11px">Invalid email</span>
           <input type="email" class="input form-control" name="email"  id="email" >
        </div>

       <div class="input-field ">
           <label for="fname">First Name:</label><span id="span2">*</span></span><span id="spanFnameValidation" style="display: none; color: red; font-size: 11px">First name should be at least 2 characters</span>
           <input type="text" class="input form-control" name="fname"  id="fname" >
        </div>
        <div class="input-field">
            <label for="mdname">Middle Name:</label><span id="span3">*</span><span id="spanMdValidation" style="display: none; color: red; font-size: 11px">Middle name should be at least 2 characters</span>
           <input type="text" class="input form-control" name="mdname"  id="mdname" >
        </div>
        <div class="input-field">
            <label for="lname">Last Name:</label><span id="span4">*</span><span id="spanLnValidation" style="display: none; color: red; font-size: 11px">Last name should be at least 2 characters</span>
           <input type="text" class="input form-control" name="lname"  id="lname" >
        </div>

    
       
        <div class="input-field">
            <label for="password">Password:</label><span id="span5">*</span><span id="spanPasswordValidation" style="display: none; color: red; font-size: 11px">Password should contain at least 1 uppercase 1 special character and must not exceed 8 characters</span>
           <input type="password" class="input form-control" name="password"  id="password" >
        </div>
      
      <div class="fluid-container" id="footer-form">
     
      <button type="button" class="btn btn-outline-primary btn-sm" id="privacyBtn"  data-bs-toggle="modal" data-bs-target="#exampleModal">Check Privacy</button>
      <input type="submit" value="Register" class="btn btn-primary btn-sm" id="signUpBtn">

      </div>

      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div id="firstP">
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Recusandae quae deserunt vel laboriosam omnis molestiae cupiditate impedit, sapiente eveniet fuga illum fugiat rem nihil ipsa culpa harum cumque explicabo dignissimos earum officiis accusantium voluptatibus porro iusto? Quos aspernatur obcaecati dicta velit voluptas. Ipsam quia, dolores mollitia odit omnis, nesciunt repellat voluptatibus consequatur fugiat nemo asperiores? Necessitatibus, voluptatum aspernatur placeat labore dignissimos eveniet laudantium unde ullam distinctio excepturi dolores possimus enim, sapiente, a cupiditate quidem? Aut, dolor voluptate cupiditate, quidem ullam exercitationem laborum consequatur ad mollitia expedita dolore! Dolore asperiores libero quos veniam ex, voluptatem ullam rerum accusantium quam. Nam magni modi et optio animi ea rerum vitae tenetur repudiandae corrupti nulla ratione natus ab ullam id suscipit, odio fugiat aliquam recusandae quod dolores! Quod velit alias ea ducimus non ab aliquam aliquid. Non dolorem, praesentium ipsa voluptatum, aut, porro quas quae provident suscipit ipsam sint dolor excepturi minus facilis autem tenetur unde molestiae illum asperiores! Voluptates suscipit ratione, veritatis eos exercitationem vel vitae minima, repudiandae soluta accusantium, sequi velit alias sint atque totam fuga distinctio? Magni reiciendis porro facilis commodi suscipit, at consectetur officiis rerum, quod maiores nulla beatae pariatur possimus accusamus. 
              </div>
              <div id="secondP">
              Quod aspernatur incidunt ad laudantium, nesciunt animi beatae nisi! Modi dolorem eligendi sapiente expedita, assumenda suscipit quam recusandae consectetur omnis ab? Minus odit error dolor consequatur facere consequuntur possimus, magnam unde minima beatae quibusdam sunt similique. Fugiat a, accusantium quasi laudantium suscipit pariatur tenetur velit aliquid nostrum iure ipsum aliquam cum dolorum quod hic quos ad deleniti iusto corrupti obcaecati ratione debitis. Est id nihil dignissimos, officia eaque consectetur voluptatem ab optio sequi nostrum accusamus quae impedit cupiditate pariatur delectus similique. Esse nesciunt temporibus incidunt, ducimus dolores ipsa in laboriosam, dolorem quam optio expedita deserunt quibusdam distinctio eius alias et porro vel voluptates possimus libero accusamus impedit consequatur? Rerum, delectus magnam optio assumenda placeat unde perspiciatis voluptas doloribus nihil a omnis voluptatibus amet exercitationem, eos modi non numquam tempore culpa ratione et! Iste impedit repellendus, beatae deserunt neque magni nemo, officia quae ipsam expedita numquam placeat, fugiat ratione qui esse alias sed nobis aliquam. Eveniet repellat distinctio quod esse consequuntur commodi. Alias facere, ipsam beatae nulla saepe adipisci, quis incidunt ullam corporis itaque expedita eaque! Temporibus voluptatibus neque rem ex modi excepturi asperiores blanditiis non sequi odit? Accusantium, veniam non repellendus nulla delectus quas aliquid soluta veritatis cupiditate sed nesciunt eos, quasi nemo tenetur! Esse voluptatum excepturi labore perspiciatis blanditiis culpa, incidunt suscipit vel non illo officia reprehenderit eaque corporis saepe exercitationem ea cum vero! Suscipit, molestias iste illum consequuntur earum cupiditate, magni minima aperiam quia pariatur dolorum deserunt temporibus rerum maiores, consectetur omnis laudantium magnam.
              </div>
              <div id="thirdP">
              Hic beatae voluptatibus tenetur et provident aut in, recusandae animi totam? Animi repellat nobis voluptatibus eveniet modi debitis maxime necessitatibus suscipit ipsa esse aspernatur aliquid laudantium labore eaque, tempora cumque vel, consequuntur, voluptates aliquam nemo illum porro accusamus iusto! Nemo dolore molestiae suscipit harum, corrupti officiis incidunt rem explicabo, alias voluptates perferendis repellat sunt. Aliquid, nemo. Consectetur doloribus ab repellat. At, in.
              </div>

            </div>
            <div class="modal-footer">
          
              <input type="checkbox" class="form-check" name="privacyPolicy" name="privacyPolicy" id="privacyPolicy" value="1" disabled>
              <button type="button"  class="btn btn-primary btn-sm" id="btn-agree" disabled>I Agree</button>
              <!-- <p id="privacyStatement" style="font-size: 15px">I've read and agree with the terms and privacy of the website.</p> -->
            </div>
          </div>
        </div>
      </div>
              

    </form>
</div>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="../JS/signup.js"></script>
</body>
</html>