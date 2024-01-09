<?php 
require 'dbcon.php';
session_start();
$id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QCU PUBLICATION | USER DASHBOARD</title>
  <link rel="stylesheet" href="../CSS/user-dashboard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

  <div class="header-container" id="header-container">
    <!-- header will be display here by fetching reusable files -->
  </div>

  <nav class="navigation-menus-container" id="navigation-menus-container">
    <!-- navigation menus will be display here by fetching reusable files -->
  </nav>


    <div class="content-over">
      <div class="cover-content">
        <h3>Hello,
          <?php
        if(isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true){
            $firstName = isset($_SESSION['first_name']) ? ucfirst($_SESSION['first_name']) : '';
            $middleName = isset($_SESSION['middle_name']) ? ' ' . ucfirst($_SESSION['middle_name']) : '';
            $lastName = isset($_SESSION['last_name']) ? ' ' . ucfirst($_SESSION['last_name']) : '';
          
            echo $firstName . $middleName . $lastName;
        }
        ?>
        </h3>
      </div>
      <div>
        <button class="btn tbn-primary btn-md" id="btn1" onclick="window.location.href='author-dashboard.php'">As Author</button>
        <button class="btn tbn-primary btn-md" id="btn2" onclick="window.location.href='reviewer-dashboard.php'">As Reviewer</button>
      </div>
    </div>
    <div class="main">
	<div class="main-profile">
		<div class="profile-container">
			<div class="profile-sidebar">
				<!-- Profile Image -->
				<img src="../images/profile.jpg" alt="Profile Picture" class="profile-pic">
			</div>
			<div class="profile-info">
				<div class="row">
					<!--<div class="points">
						<p><span class="label">PHP:</span> 1.00 / Credit</p>
					</div>-->
						<!-- User Info -->
					<div class="user-info">
						<h1>Kyle Angeline David</h1>
						<p class="role">Reviewer / Author</p>
						<!-- <p class="subscription">You're subscribed to Package plan</p> -->
					</div>

				</div>
				<!-- Action Buttons -->
				<div class="action-buttons">
					<button type="button" class="btn tbn-primary btn-md" id="edit-profile">Edit Profile</button>
					
				</div>
				<div class="badge-box" style="background-image: url('../images/badge1.jpg');"></div>
				<div class="badge-box" style="background-image: url('../images/badge2.jpg');"></div>
				<div class="badge-box" style="background-image: url('../images/badge3.jpg');"></div>
				<div class="badge-box" style="background-image: url('../images/badge2.jpg');"></div>
				<div class="badge-box" style="background-image: url('../images/badge1.jpg');"></div>
			</div>
			<hr class="vertical-line">

			<div class="profile-main">
				<!-- Detailed Info -->
				<div class="details">
					<p><span class="label">Position:</span> Student</p>
					<p><span class="label">Gender:</span> Female</p>
					<p><span class="label">Birthday:</span> 10 / 24 / 2002</p>
					<p><span class="label">Country:</span> Philippines</p>
					<p><span class="label">ORCID:</span> 048469754</p>
				</div>
			</div>
		</div>
		<div class="xp-container">
			<!-- XP Bar -->
			<div class="xp-bar">
				<div class="progress-bar">
					<div class="progress" style="width: 56%;"></div>
				</div>
				<span class="xp-label">56/100 XP</span>
			</div>
			
		</div>
	</div>
	<section class="expertise">
		<!-- Expertise info here -->
		<div class="tab">
		  <button class="tablinks" onclick="openTab(event, 'About')" id="defaultOpen">About</button>
		  <button class="tablinks" onclick="openTab(event, 'Contributions')">Contributions</button>
		  <button class="tablinks" onclick="openTab(event, 'Rewards')">Rewards</button>

		</div>


		<div id="About" class="tabcontent" style="display: block;">

			<div id="about-container">
			  <div id="logrecord-container">
				<div class="log-box">Joined December 1, 2023</div>
				<div class="log-box">Author since December 11, 2023</div>
				<div class="log-box">Reviewer since December 19, 2023</div>
			  </div>
			  <div id="info-container">
				<div class="info-box">
				  <div class="bio-container">
				  <h3>Bio </h3>
					<hr>
					<p>
					  “Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet”
					</p>
				  </div>
				</div>
				<div class="info-box">
				  <div class="expertise-container">
				  <h3>Expertise </h3>
					<hr>
					<p>
					  “Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur."
					</p>
				  </div>
				</div>
			  </div>
			</div>
		</div>


		<div id="Contributions" class="tabcontent">
		  <!-- Insert your graph here. For example, an image or a generated chart. -->
			<div id="contribution-container">
			  <div id="contribution-record-container">
				<div class="stats-section">
					<div class="stat-card top-card">
						<h2>Total Contributions</h2>
						<p>98 <span class="increase">+11%</span></p>
					</div>
				</div>
				<div class="stats-section">
					<div class="stat-card top-card">
						<h2>Total Reviewed</h2>
						<p>98 <span class="increase">+11%</span></p>
					</div>
				</div> 
				<div class="stats-section">
					<div class="stat-card top-card">
						<h2>Total Submissions</h2>
						<p>98 <span class="increase">+11%</span></p>
					</div>
				</div> 				
			  </div>
			   <div class="vertical-line"></div>
			  <div id="graph-container">
						<h3>Contributions Graph</h3>
						<canvas id="articlesChart" width="400" height="120"></canvas>
			  </div>
			</div>
		</div>

		<div id="Rewards" class="tabcontent">

			 <!-- Insert your graph here. For example, an image or a generated chart. -->
			<div id="rewards-container">
				<div id="badges-container">
					<h1>Badges</h1>
					<div class="xp-container">
						<!-- XP Bar -->
						<div class="xp-bar">
							<div class="progress-bar">
								<div class="progress" style="width: 66.7%;"></div>
							</div>
							<span class="xp-label">8/12</span>
						</div>
						
					</div>
					<div class="badge-box" style="background-image: url('../images/badge1.jpg');"></div>
					<div class="badge-box" style="background-image: url('../images/badge2.jpg');"></div>
					<div class="badge-box" style="background-image: url('../images/badge3.jpg');"></div><br>
					<div class="badge-box" style="background-image: url('../images/badge3.jpg');"></div>
					<div class="badge-box" style="background-image: url('../images/badge2.jpg');"></div>
					<div class="badge-box" style="background-image: url('../images/badge1.jpg');"></div><br>
					<div class="badge-box" style="background-image: url('../images/badge1.jpg');"></div>
					<div class="badge-box" style="background-image: url('../images/badge2.jpg');"></div>
					<div class="badge-box" style="background-image: url('../images/badge3.jpg');"></div>
					<button class="btn btn-primary btn-md btn-seemore" id="see-more">See more</button>
				</div>

				<div id="credit-history-container">
				  <div class="credit-container">
					<div class="header-container">
						<h1>Credits History</h1>
						<div class="balance-points">Balance:&nbsp;&nbsp;&nbsp;&nbsp;49 </div>
					</div>
					<hr>
					<div class="table-container">
                        <table>
                            <tbody>
                                <tr class="no-data-message" style="display: none;">
                                    <td colspan="6">No records found</td>
                                </tr>
                                <tr>
                                    <td>Review an Article</td>
                                    <td>12 / 16 / 2023</td>
                                    <td>1 Heart</td>
                                    <td><button class="view-button">View</button></td>
                                </tr>
								<tr>
                                    <td>Received Certificate</td>
                                    <td>12 / 16 / 2023</td>
                                    <td>By reviewing</td>
                                    <td><button class="view-button">View</button></td>
                                </tr>
								<tr>
                                    <td>Received Certificate</td>
                                    <td>12 / 16 / 2023</td>
                                    <td>Published</td>
                                    <td><button class="view-button">View</button></td>
                                </tr>
								<tr>
                                    <td>Publish and Article</td>
                                    <td>12 / 16 / 2023</td>
                                    <td>1 Heart</td>
                                    <td><button class="view-button">View</button></td>
                                </tr>
								<tr>
                                    <td>Donate</td>
                                    <td>12 / 16 / 2023</td>
                                    <td>1 Heart</td>
                                    <td><button class="view-button">View</button></td>
                                </tr>
                            </tbody>
                        </table>
					</div>
				  </div>
				</div>
					<!-- Add more rows as needed -->
			</div>
		</div>
		

	</section>
	<section class="published-articles">
            <div class="fluid-container">
                <div class="recommendation-article">
                <h2>Your Published Articles</h2>
                <div class="articles-container">
                <div class="article">
                <p class="h6">Blockchain Beyond Cyptocurrency: Transforming Industries with Distributed Ledger Technology</p>
                    <div class="article-info">
                    <p class="info">THE LAMP</p>
                    <span class="views"></span>103 views
                    </div>
                    <p class="author">By Jane Delacruz</p>
                    <p class="article-content">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nemo sint facilis nihil possimus, illum ullam. Illo voluptatem totam repellendus voluptas.</p>
                    <button class="btn btn-primary btn-md btn-article"  style=" border: 2px #115272 solid;
                    background-color: transparent;
                    border-radius: 20px;
                    color: #115272;
                    width: 100%;">Read Article</button>
                </div>
                <div class="article">
                <p class="h6">Blockchain Beyond Cyptocurrency: Transforming Industries with Distributed Ledger Technology</p>
                    <div class="article-info">
                    <p class="info">THE LAMP</p>
                    <span class="views"></span>103 views
                    </div>
                    <p class="author">By Jane Delacruz</p>
                    <p class="article-content">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nemo sint facilis nihil possimus, illum ullam. Illo voluptatem totam repellendus voluptas.</p>
                    <button class="btn btn-primary btn-md btn-article"  style=" border: 2px #115272 solid;
                    background-color: transparent;
                    border-radius: 20px;
                    color: #115272;
                    width: 100%;">Read Article</button>
                </div>

                <div class="article">
                <p class="h6">Blockchain Beyond Cyptocurrency: Transforming Industries with Distributed Ledger Technology</p>
                    <div class="article-info">
                    <p class="info">THE LAMP</p>
                    <span class="views"></span>103 views
                    </div>
                    <p class="author">By Jane Delacruz</p>
                    <p class="article-content">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nemo sint facilis nihil possimus, illum ullam. Illo voluptatem totam repellendus voluptas.</p>
                    <button class="btn btn-primary btn-md btn-article"  style=" border: 2px #115272 solid;
                    background-color: transparent;
                    border-radius: 20px;
                    color: #115272;
                    width: 100%;">Read Article</button>
                </div>

                <div class="article">
                <p class="h6">Blockchain Beyond Cyptocurrency: Transforming Industries with Distributed Ledger Technology</p>
                    <div class="article-info">
                    <p class="info">THE LAMP</p>
                    <span class="views"></span>103 views
                    </div>
                    <p class="author">By Jane Delacruz</p>
                    <p class="article-content">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nemo sint facilis nihil possimus, illum ullam. Illo voluptatem totam repellendus voluptas.</p>
                    <button class="btn btn-primary btn-md btn-article"  style=" border: 2px #115272 solid;
                    background-color: transparent;
                    border-radius: 20px;
                    color: #115272;
                    width: 100%;">Read Article</button>
                </div>

                <div class="article">
                <p class="h6">Blockchain Beyond Cyptocurrency: Transforming Industries with Distributed Ledger Technology</p>
                    <div class="article-info">
                    <p class="info">THE LAMP</p>
                    <span class="views"></span>103 views
                    </div>
                    <p class="author">By Jane Delacruz</p>
                    <p class="article-content">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nemo sint facilis nihil possimus, illum ullam. Illo voluptatem totam repellendus voluptas.</p>
                    <button class="btn btn-primary btn-md btn-article"  style=" border: 2px #115272 solid;
                    background-color: transparent;
                    border-radius: 20px;
                    color: #115272;
                    width: 100%;">Read Article</button>
                </div>
                </div>
                </div>
            </div>
    <!-- More articles -->
	</section>
	<section class="flex-container">
	  <div class="continue-reading-container">
	  <h1> Continue Reading</h1>
		<div class="continue-reading-article-container">
		  <div class="continue-reading-article-details">
			<h6 style="color: #115272;"><strong>Blockchain Beyond Cyptocurrency: Transforming Industries with Distributed Ledger Technology</strong></h6>
			<p style="color: #454545;">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nemo sint facilis nihil possimus, illum ullam. Illo voluptatem totam repellendus voluptas. </p>
			<div class="continue-reading-keywords">

			</div>
		  </div>
		  <div class="continue-reading-article-stats">
			<div class="continue-reading-stats-container">
			  <div class="continue-reading-view-download">
				<p class="continue-reading-stats-values" style="color: #115272;">99</p>
				<p class="continue-reading-stats-labels" style="color: #959595;">VIEWS</p>
			  </div>
			  <div class="continue-reading-view-downloads">
				<p class="continue-reading-stats-values" style="color: #115272;">99</p>
				<p class="continue-reading-stats-labels" style="color: #959595;">DOWNLOADS</p>
			  </div>
			</div>
			<hr style="border-top: 1px solid #ccc; margin: 10px 0;">
			<div class="continue-reading-published-infos">
			  <h6 class="continue-reading-publish-labels" style="color: #115272;"><strong>Published in The Gavel</strong></h6>
			  <p class="continue-reading-authors" style="color: #959595;">By Jane Delacruz</p>
			</div>
		  </div>
		</div>
		
				<div class="continue-reading-article-container">
		  <div class="continue-reading-article-details">
			<h6 style="color: #115272;"><strong>Blockchain Beyond Cyptocurrency: Transforming Industries with Distributed Ledger Technology</strong></h6>
			<p style="color: #454545;">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nemo sint facilis nihil possimus, illum ullam. Illo voluptatem totam repellendus voluptas. </p>
			<div class="continue-reading-keywords">

			</div>
		  </div>
		  <div class="continue-reading-article-stats">
			<div class="continue-reading-stats-container">
			  <div class="continue-reading-view-download">
				<p class="continue-reading-stats-values" style="color: #115272;">99</p>
				<p class="continue-reading-stats-labels" style="color: #959595;">VIEWS</p>
			  </div>
			  <div class="continue-reading-view-downloads">
				<p class="continue-reading-stats-values" style="color: #115272;">99</p>
				<p class="continue-reading-stats-labels" style="color: #959595;">DOWNLOADS</p>
			  </div>
			</div>
			<hr style="border-top: 1px solid #ccc; margin: 10px 0;">
			<div class="continue-reading-published-infos">
			  <h6 class="continue-reading-publish-labels" style="color: #115272;"><strong>Published in The Gavel</strong></h6>
			  <p class="continue-reading-authors" style="color: #959595;">By Jane Delacruz</p>
			</div>
		  </div>
		</div>
		
				<div class="continue-reading-article-container">
		  <div class="continue-reading-article-details">
			<h6 style="color: #115272;"><strong>Blockchain Beyond Cyptocurrency: Transforming Industries with Distributed Ledger Technology</strong></h6>
			<p style="color: #454545;">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nemo sint facilis nihil possimus, illum ullam. Illo voluptatem totam repellendus voluptas. </p>
			<div class="continue-reading-keywords">

			</div>
		  </div>
		  <div class="continue-reading-article-stats">
			<div class="continue-reading-stats-container">
			  <div class="continue-reading-view-download">
				<p class="continue-reading-stats-values" style="color: #115272;">99</p>
				<p class="continue-reading-stats-labels" style="color: #959595;">VIEWS</p>
			  </div>
			  <div class="continue-reading-view-downloads">
				<p class="continue-reading-stats-values" style="color: #115272;">99</p>
				<p class="continue-reading-stats-labels" style="color: #959595;">DOWNLOADS</p>
			  </div>
			</div>
			<hr style="border-top: 1px solid #ccc; margin: 10px 0;">
			<div class="continue-reading-published-infos">
			  <h6 class="continue-reading-publish-labels" style="color: #115272;"><strong>Published in The Gavel</strong></h6>
			  <p class="continue-reading-authors" style="color: #959595;">By Jane Delacruz</p>
			</div>
		  </div>
		</div>
	  </div>
	  
	  
	  <div class="featured-updates-container">
        <!-- content for the featured updates -->
		    <h2>Featured Updates</h2>
        <div class="ex-featured">
                <div class="example-featured">
                    <p><b>USaid.Gov</b><br>Through a USAID grant awarded to the Quezon City University, local government officials of Quezon City, youth council members, and leaders of local community organizations compl....</p>
                    <div class="img-featured mb-3">
                    <img src="../images/featured.png" alt="">
					<!-- <img src="../images/featured.png" alt=""> -->
                    <a href="">USAID Trains Quezon City Barangay Leaders to Impro...</a>
                    </div>
                </div>

                <div class="example-featured">
                    <p><b>USaid.Gov</b><br>Through a USAID grant awarded to the Quezon City University, local government officials of Quezon City, youth council members, and leaders of local community organizations compl....</p>
                    <div class="img-featured mb-3">
                    <img src="../images/featured.png" alt="">
					<!-- <img src="../images/featured.png" alt=""> -->
                    <a href="">USAID Trains Quezon City Barangay Leaders to Impro...</a>
                    </div>
                </div>

        </div>
		<button type="button" class="btn tbn-primary btn-md" id="show-more">Show more</button>
      </div>
	  <!-- Links to continue reading -->
	</section>
</div>

    <div class="footer" id="footer">
      <!-- footer will be display here by fetching reusable files -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="../JS/reusable-header.js"></script>
    <script src="../JS/user-dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>