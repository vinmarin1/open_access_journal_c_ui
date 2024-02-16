<?php 
require 'dbcon.php';
session_start();
$id = $_SESSION['id'];
$email = $_SESSION['email'];
$first_name = $_SESSION['first_name'];
$middle_name = $_SESSION['middle_name'];
$last_name = $_SESSION['last_name'];
$role = $_SESSION['role'];
$position = $_SESSION['position'];
$country = $_SESSION['country'];
$gender = $_SESSION['gender'];
$afiliations = $_SESSION['afiliations'];
$status = $_SESSION['status'];
$affix = $_SESSION['affix'];
$expertise = $_SESSION['expertise'];

$birthday = $_SESSION['birthday'];
$dateTime = new DateTime($birthday);
$formattedBirthday = $dateTime->format('F j, Y');

$date_added = $_SESSION['date_added'];
$dateAdded = new DateTime($date_added);
$formattedDateAdded = $dateAdded->format('F j, Y');

$orc_id = $_SESSION['orc_id'];
$bio = $_SESSION['bio'];
$expertise = $_SESSION['expertise'];



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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400&display=swap">
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
			<button class="btn tbn-primary btn-md" id="btn1" onclick="window.location.href='user-dashboard.php'">My Profile</button>
			<button class="btn tbn-primary btn-md" id="btn2" onclick="window.location.href='author-dashboard.php'">Manage Contribution</button>
		</div>
    </div>
    <div class="main">
		<div class="main-profile">
			<div class="profile-container">
				<div class="profile-sidebar">
					<!-- Profile Image -->
					<img src="../images/profile.jpg" alt="Profile Picture" class="profile-pic" id="profileImage">
					<input type="file" accept="image/*" style="display:none" id="fileInput">
					<button type="button" class="btn btn-secondary btn-sm"  onclick="openFileInput()"><i class="fa-solid fa-camera"></i></button>
					
					<!-- Modal for Image Preview and Confirmation -->
					<div id="imageModal" class="modal" style="display:none">
						<div class="modal-content mt-3" style="width: 30%; height: 55%; margin-left: auto; margin-right: auto;">
							<p class="h6 mt-2" style="text-align: center; magin: 0; border-bottom: 1px gray solid">Change Profile Picture</p>
							
							<img class="img-fluid mt-4" src="" alt="Selected Image" id="selectedImagePreview" style="height: 50%; width: 50%; border-radius: 60%; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; margin-left: auto; margin-right: auto">
							<div class="btn-change mt-5" style="width: 100%">
							<button type="button" class="btn btn-success btn-sm" style="width: 95%; display: block; margin-left: 10px" onclick="saveProfile()">Save</button>
							<button type="button" class="btn btn-secondary btn-sm mt-1" style="width: 95%; display: block; margin-left: 10px" onclick="cancelUpdate()">Cancel</button>
							</div>
							
						</div>
					</div>
				</div>
				<div class="profile-info">
					<div class="row">
						<!--<div class="points">
							<p><span class="label">PHP:</span> 1.00 / Credit</p>
						</div>-->
							<!-- User Info -->
						<div class="user-info">
							<div class="info-header">
							<h1>
								<?php
								if(isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true){
									$firstName = isset($_SESSION['first_name']) ? ucfirst($_SESSION['first_name']) : '';
									$middleName = isset($_SESSION['middle_name']) ? ' ' . ucfirst($_SESSION['middle_name']) : '';
									$lastName = isset($_SESSION['last_name']) ? ' ' . ucfirst($_SESSION['last_name']) : '';

									echo $firstName . $middleName . $lastName;
								}
								?>
							</h1>
								<i class="ri-edit-box-line" id="editIcon"></i>
							</div>
							<p class="role">
								<?php
								if(isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true){
									echo $role;
								}
								?>
							</p>
							<!-- <p class="subscription">You're subscribed to Package plan</p> -->
						</div>
					</div>
					    <!-- Popup Form -->
				
					<div class="popup-form" id="editForm">
						<div class="form-header">
							<h4>Edit Profile</h4>
							<span class="close-icon" id="closeIcon">&times;</span>
						</div>
						<form id="form" method="POST" action="update-user.php">		
							<div class="form-content">
								<!-- <div class="edit-profile-pic">
								
								
								
									<img src="../images/capstone1.png" alt="Profile Picture" class="profile-pic" id="profileImage">
									<button type="button" style="border: none" id="changeProfileBtn"><i class="fas fa-camera change-icon"></i></button>
									<input type="file" id="selectProfile" style="display: none" accept="image/*">


								</div> -->
								<!-- Personal Information -->
								<div class="form-section">
									<h4>Personal Information</h4>
									<hr>
									<div class="row-form">
										<div class="form-row">
											<label for="firstName">First Name:</label>
											<input type="text" id="firstName" name="firstName" class="text-box" value="<?php echo $first_name ?>" disabled>
										</div>
										<div class="form-row">
											<label for="middleName">Middle Name:</label>
											<input type="text" id="middleName" name="middleName" class="text-box"
											value="<?php echo $middle_name ?>" disabled>
										</div>
										<div class="form-row">
											<label for="lastName">Last Name:</label>
											<input type="text" id="lastName" name="lastName" class="text-box"
											value="<?php echo $last_name ?>" disabled>
										</div>
										<div class="form-row">
											<label for="affix">Affix:</label>
											<input type="text" id="affix" name="affix" class="text-box" value="<?php echo $affix ?>" disabled>
										</div>
										<div class="form-row">
											<label for="birthdate">Birth Date:</label>
											<input type="date" id="birthdate" name="birthdate" class="date-box"
											value="<?php echo $birthday ?>" disabled>
										</div>
										<div class="form-row">
											<label for="gender">Gender:</label>
											<select id="gender" name="gender" class="dropdown-box" disabled>
												<option value="<?php echo $gender?>"><?php echo $gender ?></option>
												<option value="Male">Male</option>
												<option value="Female">Female</option>
												
											</select>
										</div>
										<div class="form-row">
											<label for="status">Status:</label>
											<select id="status" name="status" class="dropdown-box" disabled>
												<option value="Single">Single</option>
												<option value="Married">Married</option>
												<option value="Divorced">Divorced</option>
												<option value="Widowed">Widowed</option>
											</select>
										</div>
										<div class="form-row">
											<label for="country">Country:</label>
											<select id="country" name="country" class="dropdown-box" disabled>
											</select>
										</div>
									</div>
									<!-- Add similar fields for Middle name, Last Name, Affix, Birth date, gender, status, country -->
								</div>

								<!-- Other Information -->
								<div class="form-section">
									<h4>Other Information</h4>
									<hr>
									<div class="row-form">
										<!-- <div class="form-row">
											<label for="email">E-mail:</label>
											<input type="email" id="email" name="email" class="other-text-box" value="<?php echo $email ?>" disabled>
										</div> -->
										<div class="form-row">
											<label for="orcid">ORCID:</label>
											<input type="text" id="orcid" name="orcid" class="other-text-box" pattern="\d{4}-\d{4}-\d{4}-\d{4}" placeholder="(e.g., xxxx-xxxx-xxxx-xxxx)" value="<?php echo $orc_id ?>" disabled>
										</div>
										<div class="form-row">
											<label for="affiliation">Affiliation:</label>
											<input type="text" id="affiliation" name="affiliation" class="other-text-box" value="<?php echo $afiliations ?>" disabled>
										</div>
										<div class="form-row">
											<label for="position">Position:</label>
											<input type="text" id="position" name="position" class="other-text-box" value="<?php echo $position ?>" disabled>
										</div>
									</div>
									<!-- Add similar fields for ORCID, Affiliation, Position -->
								</div>

								<!-- About me -->
								<div class="form-section">
									<h4>About me</h4>
									<hr>
									<label for="bio">Bio:</label>
									<textarea id="bio" name="bio" class="bio-textarea" placeholder="Enter your bio" disabled><?php echo $bio ?></textarea>
									
									<br><br><br>
									<label for="fieldofexpertise">Field of Expertise:</label>
									<div>
										<input type="text" id="fieldofexpertise" name="fieldofexpertise" class="text-box" disabled>
										<button class="btn tbn-primary btn-md" type="button" id="addExpertiseButton" disabled>Add</button>
									</div>
									<div id="keywordContainer">
										<?php
										if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
											
											$expertiseArray = explode(', ', $expertise);

											
											foreach ($expertiseArray as $expertiseItem) {
												echo '<span class="keyword">' . $expertiseItem . '</span>';
											}
										}
										?>
									</div>

								</div>
								

								<button type="button" class="btn btn-success btn-md" id="editBtn">Edit
									<span class="spinner-border spinner-border-sm" aria-hidden="true" style="display: none"></span>
								</button>
								<button type="button" class="btn btn-secondary btn-md" id="cancelBtn">Cancel
									<span class="spinner-border spinner-border-sm" aria-hidden="true" style="display: none"></span>
								</button>

								
								<!-- <input type="submit" class="btn btn-primary btn-md" id="saveButton" value="Save" disabled> -->
								<button type="submit" class="btn btn-primary btn-md" id="saveButton" value="Save" disabled>Save</button>
							</div>
						</form>
					</div>
				</form>
					<div class="balance-points">Community Heart:&nbsp;
					<?php
						$sqlPoints = "SELECT point_earned FROM user_points WHERE user_id = $id";

						$result = database_run($sqlPoints);

						if ($result !== false) {
							$totalPoints = 0;

							foreach ($result as $row) {
								$points = $row->point_earned;
								$totalPoints += $points;
							}

							echo  $totalPoints;
						} else {
							echo "No points found for the user.";
						}
					?><i id="heartIcon" class="fa-solid fa-heart" style="color: red; margin-left: 5px" title="Community Heart, for more info click it."></i>


					

					</div>

					<!-- <div class="profile-badge">
						<p class="recent-badges">Recent Badges</p>
						<div class="badge-box" style="background-image: url('../images/badge1.jpg');"></div>
						<div class="badge-box" style="background-image: url('../images/badge2.jpg');"></div>
						<div class="badge-box" style="background-image: url('../images/badge3.jpg');"></div>
						<div class="badge-box" style="background-image: url('../images/badge2.jpg');"></div>
						<div class="badge-box" style="background-image: url('../images/badge1.jpg');"></div>
					</div> -->
				</div>
				<hr class="vertical-line">

				<div class="profile-main">
					<!-- Detailed Info -->
					
					<div class="details">
						<div class="icon-container">
							<i class="ri-eye-line" id="toggleIcon"></i>
						</div>
						<p><span class="label">Position:</span> <span id="positionLabel">
						
							<?php
							if(isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true){
								echo $position;
							}
							?>
						</span></p>
						<p><span class="label">Gender</span> <span id="genderLabel">
						<?php
								if(isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true){
									echo $gender;
								}
							?>
						</span></p>
						<p><span class="label">Birthday:</span> <span id="birthdayLabel">
						<?php
								if(isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true){
									echo $formattedBirthday;
								}
							?>
						</span></p>
						<p><span class="label">Country:</span> <span id="countryLabel">
						<?php
							if(isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true){
								echo $country;
							}
							?>
						</span></p>
						<p><span class="label">ORCID:</span> <span id="orcidLabel">
						<?php
							if(isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true){
								echo $orc_id;
							}
							?>
						</span></p>
					</div>
				</div>
			</div>
			<!--   -->
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
						<div class="log-box">Join In Community Since
						<?php
							if(isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true){
								echo $formattedDateAdded;
							}
						?>
						</div>
						<div class="log-box">Author Since: <?php
							if(isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true){
								echo $formattedDateAdded;
							}
						?></div>
						<div class="log-box"> 
							

						<?php 
                        $sqlStartReviewDate = "SELECT date_issued FROM reviewer_assigned WHERE author_id = $id ORDER BY date_issued ASC LIMIT 1 " ;

                        $result = database_run($sqlStartReviewDate);

                        if ($result !== false) {
                            foreach ($result as $row) {

							$dateIssued = new DateTime($row->date_issued);
							$formattedDate = $dateIssued->format('F j, Y');

							echo '<p>Reviewer Since: ' . $formattedDate . '</p>';


                            }
                        } else {
                            echo "You are not reviewer Yet"; 
                        }
                        ?>


							
						</div>
					</div>
					<div id="info-container">
						<div class="info-box">
							<div class="bio-container">
								<h3>Bio </h3>
								<hr>
								<p>
								<?php
									if(isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true){
										echo $bio;
									}
								?>
								</p>
							</div>
						</div>
						<div class="info-box">
							<div class="expertise-container">
								<h3>Expertise </h3>
								<hr>
								<p>
								<?php
									if(isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true){
										echo $expertise;
									}
								?>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>


			<div id="Contributions" class="tabcontent">
				<div id="contribution-container">
					<div id="contribution-record-container">
						<div class="stats-section">
							<div class="stat-card top-card">
								<h2>Total Contributions</h2>
								<p>
								<?php 
									$sqlCountAritcle = "SELECT COUNT(*) as total_articles FROM article WHERE author_id = $id" ;

									$result = database_run($sqlCountAritcle);

									if ($result !== false && isset($result[0]->total_articles)) {
										$totalArticles = $result[0]->total_articles;
										echo $totalArticles;
									} else {
										echo "You are not a reviewer yet"; 
									}
								?>



								<span class="increase">
								<?php 
								$sqlCountAritcle = "SELECT COUNT(*) as total_articles FROM article WHERE author_id = $id" ;

								$result = database_run($sqlCountAritcle);

								if ($result !== false && isset($result[0]->total_articles)) {
									$totalArticles = $result[0]->total_articles;

									$percentageIncrease = 11;

								
									$increasedCount = $totalArticles * (1 + ($percentageIncrease / 100));

									echo $percentageIncrease .''. "%";
								} else {
									echo "You are not a reviewer yet"; 
								}
							?>

								</span></p>
							</div>
						</div>
						<div class="stats-section">
							<div class="stat-card top-card">
								<h2>Total Reviewed</h2>
								<p>
								<?php 
									$sqlReviewedArticles = "SELECT COUNT(*) as total_reviewed FROM reviewer_assigned  WHERE author_id = $id AND answer = 1" ;

									$result = database_run($sqlReviewedArticles);

									if ($result !== false && isset($result[0]->total_reviewed)) {
										$totalArticles = $result[0]->total_reviewed;
										echo $totalArticles;
									} else {
										echo "You are not a reviewer yet"; 
									}
								?>	
								<span class="increase">

								<?php 
								$sqlReviewedArticles = "SELECT COUNT(*) as total_reviewed FROM reviewer_assigned  WHERE author_id = $id AND answer = 1" ;

								$result = database_run($sqlReviewedArticles);

								if ($result !== false && isset($result[0]->total_reviewed)) {
									$totalArticles = $result[0]->total_reviewed;

									$percentageIncrease = 11;

								
									$increasedCount = $totalArticles * (1 + ($percentageIncrease / 100));

									echo $percentageIncrease .''. "%";
								} else {
									echo "You are not a reviewer yet"; 
								}
								?>
								
								</span></p>
							</div>
						</div> 
						<div class="stats-section">
							<div class="stat-card top-card">
								<h2>Total Submissions</h2>
								<p>
								<?php 
									$sqlCountAritcle = "SELECT COUNT(*) as total_articles FROM article WHERE author_id = $id" ;

									$result = database_run($sqlCountAritcle);

									if ($result !== false && isset($result[0]->total_articles)) {
										$totalArticles = $result[0]->total_articles;
										echo $totalArticles;
									} else {
										echo "You are not a reviewer yet"; 
									}
								?>
	
								<span class="increase">
								<?php 
								$sqlCountAritcle = "SELECT COUNT(*) as total_articles FROM article WHERE author_id = $id" ;

								$result = database_run($sqlCountAritcle);

								if ($result !== false && isset($result[0]->total_articles)) {
									$totalArticles = $result[0]->total_articles;

									$percentageIncrease = 11;

								
									$increasedCount = $totalArticles * (1 + ($percentageIncrease / 100));

									echo $percentageIncrease .''. "%";
								} else {
									echo "You are not a reviewer yet"; 
								}
								?>
								</span></p>
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
			</div>

			<div id="Rewards" class="tabcontent">
				<div id="rewards-container">
					<div id="badges-container">
						<h3>Badges</h3>
						<div class="badge-box-container">
							<div class="xp-container">
								<!-- XP Bar -->
								<!-- <div class="xp-bar">
									<div class="progress-bar">
										<div class="progress" style="width: 66.7%;"></div>
									</div>
									<span class="xp-label">8/12</span>
								</div> -->
								
							</div>
							<div class="badge-box" style="background-image: url('../images/badge1.jpg');"></div>
							<div class="badge-box" style="background-image: url('../images/badge2.jpg');"></div>
							<div class="badge-box" style="background-image: url('../images/badge3.jpg');"></div>
							<div class="badge-box" style="background-image: url('../images/badge3.jpg');"></div>
							<div class="badge-box" style="background-image: url('../images/badge2.jpg');"></div>
							<div class="badge-box" style="background-image: url('../images/badge1.jpg');"></div>
							<div class="badge-box" style="background-image: url('../images/badge1.jpg');"></div>
							<div class="badge-box" style="background-image: url('../images/badge2.jpg');"></div>
							<div class="badge-box" style="background-image: url('../images/badge3.jpg');"></div>
							<div class="badge-see-more">
								<!-- <button class="btn btn-primary btn-md btn-seemore" id="see-more">See more</button> -->
							</div>
						</div>	
					</div>
					<div class="popup-container" id="popup">
						<h6>Owned Badges</h6>
						<div class="badge-popup">
							<!-- Badges go here -->
							<div class="badge-box" style="background-image: url('../images/badge1.jpg');"></div>
							<div class="badge-box" style="background-image: url('../images/badge2.jpg');"></div>
							<div class="badge-box" style="background-image: url('../images/badge3.jpg');"></div>
							<div class="badge-box" style="background-image: url('../images/badge1.jpg');"></div>
						</div>
						<p>Click Badges to Learn More</p>
					</div>
					<div id="credit-history-container">
						<div class="credit-container">
							<div class="header-container">
								<h3>Achievements</h3>
								
							</div>
							<div class="sort-container d-flex flex-column gap-2">
								<!-- <div class="sort-header">
									<span class="sort-by-text" style="color: #0858a4;">Sort by</span>
									<span class="sort-icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
											<path fill="#e6e6e6" d="M11 7H1l5 7zm-2 7h10l-5-7z" />
										</svg>
									</span>
									<select id="sortby" name="sortby" class="sort-dropdown form-select form-select-sm px-8">
										<option value="" hidden>Recently added</option>
										<option value="title">Title</option>
										<option value="recently_added">Recently added</option>
										<option value="publication-date">Publication Date</option>
										<optgroup label="Popularity">
											<option value="popular">All</option>
											<option value="views">Views</option>
											<option value="downloads">Downloads</option>
											<option value="citations">Citations</option>
										</optgroup>
									</select>
								</div> -->
							</div>
							<div class="table-container">
								<table>
									<tbody>


									<?php
										$sqlAchievements = "
											(SELECT 'Published an Article' as action_engage, article.title, article.journal_id,NULL as status, user_points.date, user_points.point_earned
											FROM user_points
											JOIN article ON user_points.article_id = article.article_id
											WHERE user_points.action_engage = 'Published an Article' AND user_points.user_id = :user_id AND article.status = 1)
											
											UNION
											
											(SELECT 'Reviewed Article Published' as action_engage, article.title, article.journal_id, NULL as status, user_points.date, user_points.point_earned
											FROM user_points
											JOIN reviewer_assigned ON user_points.user_id = reviewer_assigned.author_id
											JOIN article ON reviewer_assigned.article_id = article.article_id
											WHERE article.status = 1 AND reviewer_assigned.accept = 1 AND reviewer_assigned.answer = 1 AND user_points.action_engage = 'Reviewed Article Published' AND user_points.user_id = :author_id)
											
											UNION
											
											(SELECT 'Submitted an Article' as action_engage, article.title, article.journal_id, NULL as status, user_points.date, user_points.point_earned
											FROM user_points
											JOIN article ON user_points.article_id = article.article_id
											WHERE user_points.action_engage = 'Submitted an Article' AND user_points.user_id = :user_id)
											
											UNION
											
											(SELECT 'Reviewed an Article' as action_engage, article.title, article.journal_id, NULL as status, user_points.date, user_points.point_earned
											FROM user_points
											JOIN reviewer_assigned ON user_points.user_id = reviewer_assigned.author_id
											JOIN article ON reviewer_assigned.article_id = article.article_id
											WHERE article.status = 4 AND reviewer_assigned.accept = 1 AND reviewer_assigned.answer = 1 AND user_points.action_engage = 'Reviewed an Article' AND user_points.user_id = :author_id)
											
											ORDER BY date DESC
										";

										$result = database_run($sqlAchievements, array('author_id' => $id, 'user_id' => $id));

										if ($result !== false) {
											foreach ($result as $row) {
												$journalMapping = [
													'1' => 'The Gavel',
													'2' => 'The Lamp',
													'3' => 'The Star',
												];
										
												echo '<tr>';
												echo '<td>' . $row->action_engage .'</td>';
												echo '<td>' . $journalMapping[$row->journal_id] .'</td>';
												echo '<td style="display: none">' . $row->title .'</td>';
												$formattedDateTime = date('F j, Y g:i:s A', strtotime($row->date));
												echo '<td>' . $formattedDateTime . '</td>';
												echo '<td style="color: green;">You earned ' . $row->point_earned . ' Community Heart</td>';
												echo '<td><button type="button" class="view-button" onclick="updateEngagementTitle(\'' . htmlspecialchars($row->title) . '\', \'' . $journalMapping[$row->journal_id] . '\')">View</button></td>';
												echo '</tr>';
											}
										}
										?>

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="published-articles">
            <div class="fluid-container">
                <div class="recommendation-article">
                	<h2>Your Published Articles</h2>
					<div class="articles-container">
						
					<?php 
						$sql = "SELECT article.article_id, article.title, article.author, article.abstract, journal.journal 
								FROM article 
								JOIN journal ON journal.journal_id = article.journal_id 
								WHERE article.author_id = $id AND article.status = 1";

						$result = database_run($sql);

						if ($result !== false) {
							foreach ($result as $row) {
								echo '<div class="article" data-article-id="' . $row->article_id . '">';
								echo '<p class="h6">' . $row->title . '</p>';
								echo '<div class="article-info">';
								echo '<p class="info" style="display="inline-block; width: auto">' . $row->journal . '</p>';
								echo '<span class="views" style="display="inline-block; width: auto"> 143</span>';
								echo '<p class="author">' .$row->author .  '</p>';
								echo '<p class="article-content">' . $row->abstract .'</p>';
								echo '</div>';
								echo '<button type="button" class="btn btn-primary btn-md btn-article" onclick="openArticleInNewTab(' . $row->article_id . ')" style=" border: 2px #115272 solid;
									background-color: transparent;
									border-radius: 20px;
									color: #115272;
									width: 100%;">Read Article</button>';
								echo '</div>';
							}
						} else {
							echo "<p>You don't have published article yet, want to published article? Click here <a href='ex_submit.php'>Submit Article</a></p>"; 
						}
					?>



						<!-- <div class="article">
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
						</div> -->
					</div>
                </div>
            </div>
		</section>
		<section class="flex-container">
			<div class="continue-reading-container">
				<h1> Continue Reading</h1>
				<div class="continue-reading-article-container" id="articleDetailsContainer">
					<!-- <div class="continue-reading-article-details">
						<h6 class="historyTitle" style="color: #115272;"><strong>Blockchain Beyond Cyptocurrency: Transforming Industries with Distributed Ledger Technology</strong></h6>
						<p class="historyAbstract" style="color: #454545;">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nemo sint facilis nihil possimus, illum ullam. Illo voluptatem totam repellendus voluptas. </p>
						<div class="continue-reading-keywords">

						</div>
					</div>
					<div class="continue-reading-article-stats">
						<div class="continue-reading-stats-container">
							<div class="continue-reading-view-download">
								<p class="continue-reading-stats-values historyViews" style="color: #115272;">99</p>
								<p class="continue-reading-stats-labels" style="color: #959595;">VIEWS</p>
							</div>
							<div class="continue-reading-view-downloads">
								<p class="continue-reading-stats-values historyDownloads" style="color: #115272;">99</p>
								<p class="continue-reading-stats-labels" style="color: #959595;">DOWNLOADS</p>
							</div>
						</div>
						<hr style="border-top: 1px solid #ccc; margin: 10px 0;">
						<div class="continue-reading-published-infos">
							<h6 class="continue-reading-publish-labels historyJournal" style="color: #115272;"><strong>Published in The Gavel</strong></h6>
							<p class="continue-reading-authors historyAuthor" style="color: #959595;">By Jane Delacruz</p>
						</div>
					</div> -->
				</div>
				
				<!-- <div class="continue-reading-article-container">
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
				</div> -->
			</div>
			
			
			<div class="featured-updates-container">
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
		</section>
	</div>


<div class="container-fluid mt-5" id="certContainerHead" style="display: none">
    <div class="cert-container d-flex justify-content-center align-items-center">
        <img class="img-fluid" id="cert1" src="../images/Bg-cert" alt="cert">
		<div class="cert-category">
			<p class="h2" id="category"></p>
			<p class="h6" id="awardee">This Certificate is Awarded to</p>
			<p class="h1" id="awardeeName">
				<?php 
				echo $first_name . ' ' . $middle_name . ' ' . $last_name	
				?>
			</p>
			<p class="h6" id="engagement">For participating in the peer review process for the article entitled:</p>
			<p class="h3" id="engagementTitle"></p>
		</div>
    </div>
</div>



	


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script src="../JS/reusable-header.js"></script>
    <script src="../JS/user-dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	
	<script>
	


function openArticleInNewTab(articleId) {
        window.open(`../PHP/article-details.php?articleId=${articleId}`, '_blank');
    }
  const apiURL = "https://web-production-cecc.up.railway.app/api/recommendations/";

  // Assuming you have the author_id stored in a PHP variable $id
  const authorId = <?php echo $_SESSION['id']; ?>;

  // Make a GET request to the API endpoint
  fetch(`${apiURL}${authorId}`)
    .then(response => response.json())
    .then(data => {
      // Get the details of the first 3 articles from the history
      const latestArticleDetails = data.history.slice(0, 3);

      // Update the container with the latest article details
      const articleDetailsContainer = document.getElementById('articleDetailsContainer');
      articleDetailsContainer.innerHTML = latestArticleDetails.map(article => {
        return `
          <div class="continue-reading-article-container" data-article-id="${article.article_id}">
            <div class="continue-reading-article-details">
              <h6 class="historyTitle" style="color: #115272;"><strong>${article.title}</strong></h6>
              <p class="historyAbstract" style="color: #454545;">${article.abstract}</p>
              <div class="continue-reading-keywords"></div>
            </div>
			<div class="continue-reading-article-stats">
								<div class="continue-reading-stats-container">
									<div class="continue-reading-view-download">
										<p class="continue-reading-stats-values historyViews" style="color: #115272;">${article.user_interactions}</p>
										<p class="continue-reading-stats-labels" style="color: #959595;">VIEWS</p>
									</div>
									<div class="continue-reading-view-downloads">
										<p class="continue-reading-stats-values historyDownloads" style="color: #115272;">${article.user_interactions}</p>
										<p class="continue-reading-stats-labels" style="color: #959595;">DOWNLOADS</p>
									</div>
								</div>
								<hr style="border-top: 1px solid #ccc; margin: 10px 0;">
								<div class="continue-reading-published-infos">
									<h6 class="continue-reading-publish-labels historyJournal" style="color: #115272;"><strong>Published in ${article.journal}</strong></h6>
									<p class="continue-reading-authors historyAuthor" style="color: #959595;">By ${article.author}</p>
								</div>
							</div>
          </div>
        `;
      }).join('');

      // Add click event listener to each article container
      const articleContainers = document.querySelectorAll('.continue-reading-article-container');
      articleContainers.forEach(container => {
        container.addEventListener('click', function() {
          const articleId = this.getAttribute('data-article-id');
          window.open(`../PHP/article-details.php?articleId=${articleId}`, '_blank');
        });
      });
    })
    .catch(error => {
      console.error('Error fetching data:', error);
    });

	document.addEventListener('DOMContentLoaded', function () {
  const countrySelect = document.getElementById('country');
  countrySelect.disabled = true;


  fetch('https://restcountries.com/v3.1/all')
      .then(response => response.json())
      .then(data => {
       
          if (data.find(country => country.name.common === '<?php echo $country ?>')) {
              const userCountryOption = document.createElement('option');
              userCountryOption.value = '<?php echo $country ?>';
              userCountryOption.textContent = '<?php echo $country ?>';
              countrySelect.appendChild(userCountryOption);
          }

      
          data.forEach(country => {
              const option = document.createElement('option');
              option.value = country.name.common;
              option.textContent = country.name.common;
              countrySelect.appendChild(option);
          });

         
      })
      .catch(error => console.error('Error fetching countries:', error));
});


document.addEventListener('DOMContentLoaded', function () {
    // Attach click event listener to all elements with class 'view-button'
    var viewButtons = document.querySelectorAll('.view-button');
    viewButtons.forEach(function (button) {
      button.addEventListener('click', function () {
        // Find the corresponding achievement row
        var achievementRow = button.closest('tr');
        
        // Get the action_engage and title values
        var actionEngage = achievementRow.querySelector('td:first-child').textContent.trim();
        var title = achievementRow.querySelector('td:nth-child(3)').textContent.trim();

    
        if (actionEngage === 'Submitted an Article') {
       
          var userId = <?php echo $id; ?>;

        
        //   alert('Viewing article for "Submitted an Article" achievement\nTitle: ' + title);

			Swal.fire({
		
			html: "<p style='font-weight: bold'>You got 1 Community heart because you submitted an article</p>" + "<p>Title: " + title + "</p>",
			imageUrl: "../images/qcu-bg.jpg",
			imageWidth: 400,
			imageHeight: 200,
			imageAlt: "Custom image"
			});

        
        }else if(actionEngage === 'Reviewed Article Published'){
			Swal.fire({
	
			html: "<p style='font-weight: bold'>You got 3 Community heart because the article you reviewed was published</p>" + "<p>Title: " + title + "</p>" + "<br>" + "<button type='button' onclick='downloadCertificate()'>Download Cert</button>",
			imageUrl: "../images/qcu-bg.jpg",
			imageWidth: 400,
			imageHeight: 200,
			imageAlt: "Custom image"
			});
		}else if(actionEngage === 'Published an Article'){
			Swal.fire({
	
			html: "<p style='font-weight: bold'>You got 3 Community heart because you've successfully published an article</p>" + "<p>Title: " +  title + "</p>",
			imageUrl: "../images/qcu-bg.jpg",
			imageWidth: 400,
			imageHeight: 200,
			imageAlt: "Custom image"
			});
		}else if(actionEngage === 'Reviewed an Article'){
			Swal.fire({
	
			html: "<p style='font-weight: bold'>You got 1 Community heart because you help us published an article</p>" + "<p>Title: " + title + "</p>",
			imageUrl: "../images/qcu-bg.jpg",
			imageWidth: 400,
			imageHeight: 200,
			imageAlt: "Custom image"
			});
		}
      });
    });
  });
	

  function updateEngagementTitle(title, journalId) {
    document.getElementById("engagementTitle").innerHTML = title;
    document.getElementById("category").innerHTML = 'Journal of ' + journalId;
}


	function downloadCertificate() {
    // Get the certificate container by ID
    var certificateContainer = document.getElementById('certContainerHead');

    // Use html2canvas to capture the content as an image
    html2canvas(certificateContainer).then(function(canvas) {
        // Convert the canvas to a data URL
        var dataUrl = canvas.toDataURL('image/png');

        // Create a link element
        var link = document.createElement('a');

        // Set the download attribute and the href with the data URL
        link.download = 'certificate.png';
        link.href = dataUrl;

        // Trigger a click on the link to start the download
        link.click();
    });
}

</script>

</body>

</html>