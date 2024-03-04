<?php 
require 'dbcon.php';
session_start();

if (!isset($_SESSION['LOGGED_IN']) || $_SESSION['LOGGED_IN'] !== true) {
	header('Location: ./login.php');
	exit();
  }

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
  <link rel="stylesheet" href="../CSS/index.css">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400&display=swap">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
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
			if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
				$sqlSelectName = "SELECT first_name, middle_name, last_name FROM author WHERE author_id = :author_id";
			
				$result = database_run($sqlSelectName, array(':author_id' => $id));

				if ($result) {
					
					if (count($result) > 0) {
						$user = $result[0];
						$firstName = $user->first_name;
						$middleName = $user->middle_name;
						$lastName = $user->last_name;

						echo "$firstName $middleName $lastName";
					} else {
						echo "User not found.";
					}
				} else {
					echo "Unable to fetch user info.";
				}
			}
			?>
			</h3>
			<h4 id="liveData">
			
			</h4>
		</div>
		<!-- <div>
			<button class="btn tbn-primary btn-md" id="btn1" onclick="window.location.href='user-dashboard.php'">My Profile</button>
			<button class="btn tbn-primary btn-md" id="btn2" onclick="window.location.href='author-dashboard.php'">Manage Articles</button>
		</div> -->
    </div>
    <div class="main">
		<section >
			<div class="profile-container">
				<div class="profile-sidebar">
			
					<!-- <img src="../images/profile.jpg" alt="Profile Picture" class="profile-pic" id="profileImage">
					<input type="file" accept="image/*" style="display:none" id="fileInput">
					<button type="button" class="btn btn-secondary btn-sm"  onclick="openFileInput()"><i class="fa-solid fa-camera"></i></button> -->
					<?php
					if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
						$sqlSelectProfile = "SELECT profile_pic FROM author WHERE author_id = :author_id";

						$result = database_run($sqlSelectProfile, array(':author_id' => $id));

						if ($result) {
							if (count($result) > 0) {
								$user = $result[0];
								$profilePic = $user->profile_pic;

								
								if (empty($profilePic)) {
									$profilePic = "../images/profile.jpg";
								}


								echo '<div>';
								echo '<img src="' . htmlspecialchars($profilePic) . '" alt="Profile Picture" class="profile-pic" id="profileImage">';
								echo '<input type="file" accept="image/*" style="display:none" id="fileInput" name="fileInput">';
								echo '<button type="button" class="btn btn-secondary btn-sm" onclick="openFileInput()" style="margin-left: 15px"><i class="fa-solid fa-camera"></i></button>';
								echo '</div>';
							} else {
								echo "User not found.";
							}
						} else {
							echo "Unable to fetch profile picture.";
						}
					}
					?>


					<!-- Modal for Image Preview and Confirmation -->
					<div id="imageModal" class="modal" style="display:none">
						<div class="modal-content mt-3" style="width: 30%; height: 55%; margin-left: auto; margin-right: auto;">
							<p class="h6 mt-2" style="text-align: center; magin: 0; border-bottom: 1px gray solid">Change Profile Picture</p>
							
							<img class="img-fluid mt-4" src="" alt="Selected Image" id="selectedImagePreview" style="height: 50%; width: 50%; border-radius: 60%; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; margin-left: auto; margin-right: auto">
							<div class="btn-change mt-5" style="width: 100%">
							<button type="button" class="btn btn-success btn-sm" style="width: 95%; display: block; margin-left: 10px;" onclick="saveProfile()">Save</button>
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
							if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
								$sqlSelectName = "SELECT first_name, middle_name, last_name, affix, birth_date, gender, marital_status, country, orc_id, afiliations, position, bio, field_of_expertise FROM author WHERE author_id = :author_id";

								$result = database_run($sqlSelectName, array(':author_id' => $id));

								if ($result) {
									if (count($result) > 0) {
										$user = $result[0];
										$firstName = $user->first_name;
										$middleName = $user->middle_name;
										$lastName = $user->last_name;
										$affix = $user->affix;
										$birthDate = $user->birth_date;
										$gender = $user->gender;
										$maritalStatus = $user->marital_status;
										$country = $user->country;
										$orcId = $user->orc_id;
										$afiliations = $user->afiliations;
										$position = $user->position;
										$bio = $user->bio;
										$field_of_expertise = $user->field_of_expertise;

										$profileFields = array($firstName, $middleName, $lastName, $affix, $birthDate, $gender, $maritalStatus, $country, $orcId, $afiliations, $position, $bio, $field_of_expertise);
										$completedFields = count(array_filter($profileFields, function($field) { return !empty($field); }));
										$totalFields = count($profileFields);

										$fullName = "$firstName $middleName $lastName";
										$percentageCompletion = ($completedFields / $totalFields) * 100;
										echo "$firstName $middleName $lastName";



										echo "<p style='color: #004e98'>". round($percentageCompletion, 2) . "% complete</p>";
									} else {
										echo "User not found.";
									}
								} else {
									echo "Unable to fetch user info.";
								}
							}
							?>

							</h1>
								<!-- <i class="ri-edit-box-line" id="editIcon" style="color: green solid"></i> -->
								<div class="other-action">
<!-- 									
									<label id="editIcon" style="cursor: pointer; color: green"><span style="padding-right: 5px; font-size: 12px; font-family: Arial, Helvetica, sans-serif;
									">Edit</span><i class="fa-solid fa-pen-to-square" style="color: green"></i></label>
									<br> -->

									<!-- <label id="supportIcon" style="cursor: pointer; color: green"><span style="padding-right: 5px; font-size: 12px; font-family: Arial, Helvetica, sans-serif;
									">Support</span><i class="fa-solid fa-hand-holding-heart"></i></label> -->

									<button type="button" id="editIcon" class="btn btn-success btn-sm" style="width: 100px">Edit<i class="fa-solid fa-pen-to-square"  style="margin-left: 5px"></i></button>
									<br>
						
								
									

									
								
								</div>
							

							</div>
							<p class="role">
								<?php
								if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
									$sqlSelectName = "SELECT role FROM author WHERE author_id = :author_id";
								
									$result = database_run($sqlSelectName, array(':author_id' => $id));

									if ($result) {
										
										if (count($result) > 0) {
											$user = $result[0];
											$role = $user->role;
											

											echo "$role";
										} else {
											echo "Can't identify user role.";
										}
									} else {
										echo "Unable to fetch user role.";
									}
								}
								?>
							</p>
							<!-- <p class="subscription">You're subscribed to Package plan</p> -->
						</div>
					</div>
					    <!-- Popup Form -->
				
					<div class="popup-form" id="editForm">
						<div class="form-header">
							<span>Edit Profile</span>
							<button type="button" class="btn btn-outline-light" id="saveButton">Save</button>
							<button type="button" class="btn btn-outline-light" id="cancelBtn">Cancel</button>
							<!-- <span class="close-icon" id="closeIcon">&times;</span> -->
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
									<h5>Personal Information</h5>
									<hr>
									<div class="row-form">
										<div class="form-row">
											<label for="firstName">First Name: <span class="requiredFilled" style="color: red">*</span></label>
											<?php
											if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
												$sqlSelectName = "SELECT first_name FROM author WHERE author_id = :author_id";
											
												$result = database_run($sqlSelectName, array(':author_id' => $id));

												if ($result) {
													
													if (count($result) > 0) {
														$user = $result[0];
														$firstName = $user->first_name;
													
														echo '<input type="text" id="firstName" name="firstName" class="text-box" value="' . $firstName . '" >';

										
													} else {
														echo "User not found.";
													}
												} else {
													echo "Unable to fetch user info.";
												}
											}
											?>
										
										</div>
										<div class="form-row">
											<label for="middleName">Middle Name: (Optional)</label>
											<?php
											if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
												$sqlSelectName = "SELECT middle_name FROM author WHERE author_id = :author_id";
											
												$result = database_run($sqlSelectName, array(':author_id' => $id));

												if ($result) {
													
													if (count($result) > 0) {
														$user = $result[0];
														$middle_name = $user->middle_name;
													
														echo '<input type="text" id="middleName" name="middleName" class="text-box"
														value="' . $middle_name . '" >';
													
										
													} else {
														echo "User not found.";
													}
												} else {
													echo "Unable to fetch user info.";
												}
											}
											?>
						
										
										</div>
										<div class="form-row">
											<label for="lastName">Last Name: <span class="requiredFilled" style="color: red">*</span></label>
											<?php
											if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
												$sqlSelectName = "SELECT last_name FROM author WHERE author_id = :author_id";
											
												$result = database_run($sqlSelectName, array(':author_id' => $id));

												if ($result) {
													
													if (count($result) > 0) {
														$user = $result[0];
														$last_name = $user->last_name;
													
														echo '<input type="text" id="lastName" name="lastName" class="text-box"
														value="' . $last_name . '" >';
													
														
										
													} else {
														echo "User not found.";
													}
												} else {
													echo "Unable to fetch user info.";
												}
											}
											?>
						
											
										</div>
										<div class="form-row">
											<label for="affix">Affix: (Optional)</label>
											<?php
											if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
												$sqlSelectName = "SELECT affix FROM author WHERE author_id = :author_id";
											
												$result = database_run($sqlSelectName, array(':author_id' => $id));

												if ($result) {
													
													if (count($result) > 0) {
														$user = $result[0];
														$affix = $user->affix;
													
														echo '<input type="text" id="affix" name="affix" class="text-box"
														value="' . $affix . '" >';
													
														
										
													} else {
														echo "User not found.";
													}
												} else {
													echo "Unable to fetch user info.";
												}
											}
											?>
											
										</div>
										<div class="form-row">
											<label for="birthdate">Birth Date: <span class="requiredFilled" style="color: red">*</span></label>
										
											<?php
												if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
													$sqlSelectName = "SELECT birth_date FROM author WHERE author_id = :author_id";

													$result = database_run($sqlSelectName, array(':author_id' => $id));

													if ($result) {
														if (count($result) > 0) {
															$user = $result[0];
															$birth_date = $user->birth_date;

															// Output the selected option based on the user's gender
															echo '<input type="date" id="birthdate" name="birthdate" class="date-box" value="' . $birth_date . '" >';

														} else {
															echo "User not found.";
														}
													} else {
														echo "Unable to fetch user info.";
													}
												}
												?>
										</div>
										<div class="form-row">
											<label for="gender">Gender: <span class="requiredFilled" style="color: red">*</span></label>
											<select id="gender" name="gender" class="dropdown-box" >
												<?php
												if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
													$sqlSelectName = "SELECT gender FROM author WHERE author_id = :author_id";

													$result = database_run($sqlSelectName, array(':author_id' => $id));

													if ($result) {
														if (count($result) > 0) {
															$user = $result[0];
															$gender = $user->gender;

															// Output the selected option based on the user's gender
															echo '<option value="' . $gender . '" selected>' . $gender . '</option>';
														} else {
															echo "User not found.";
														}
													} else {
														echo "Unable to fetch user info.";
													}
												}
												?>
												<option value="Male">Male</option>
												<option value="Female">Female</option>
											</select>

										</div>
										<div class="form-row">
											<label for="status">Status: <span class="requiredFilled" style="color: red">*</span></label>
											<select id="status" name="status" class="dropdown-box" >
											
												<?php
												if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
													$sqlSelectName = "SELECT marital_status FROM author WHERE author_id = :author_id";

													$result = database_run($sqlSelectName, array(':author_id' => $id));

													if ($result) {
														if (count($result) > 0) {
															$user = $result[0];
															$marital_status = $user->marital_status;

															// Output the selected option based on the user's gender
															echo '<option value="' . $marital_status . '" selected>' . $marital_status . '</option>';
														} else {
															echo "User not found.";
														}
													} else {
														echo "Unable to fetch user info.";
													}
												}
												?>
												<option value="Single">Single</option>
												<option value="Married">Married</option>
												<option value="Divorced">Divorced</option>
												<option value="Widowed">Widowed</option>
											</select>
										</div>
										<div class="form-row">
											<label for="country">Country: <span class="requiredFilled" style="color: red">*</span></label>
											<select id="country" name="country" class="dropdown-box" >
											</select>
										</div>
									</div>
									<!-- Add similar fields for Middle name, Last Name, Affix, Birth date, gender, status, country -->
								</div>

								<!-- Other Information -->
								<div class="form-section">
									<h5>Other Information</h5>
									<hr>
									<div class="row-form">
										<!-- <div class="form-row">
											<label for="email">E-mail:</label>
											<input type="email" id="email" name="email" class="other-text-box" value="<?php echo $email ?>" >
										</div> -->
										<div class="form-row">
											<label for="orcid">ORCID: <span class="requiredFilled" style="color: red">*</span></label>
											<?php
											if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
												$sqlSelectName = "SELECT orc_id FROM author WHERE author_id = :author_id";
											
												$result = database_run($sqlSelectName, array(':author_id' => $id));

												if ($result) {
													
													if (count($result) > 0) {
														$user = $result[0];
														$orc_id = $user->orc_id;
													
														echo '<input type="text"  id="orcid" name="orcid" class="other-text-box" pattern="\d{4}-\d{4}-\d{4}-\d{4}" placeholder="(e.g., xxxx-xxxx-xxxx-xxxx)"
														value="' . $orc_id . '" readonly>';
													
														
										
													} else {
														echo "User not found.";
													}
												} else {
													echo "Unable to fetch user info.";
												}
											}
											?>
										
										</div>
										<div class="form-row">
											<label for="affiliation">Affiliation: <span class="requiredFilled" style="color: red">*</span></label>
											<?php
											if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
												$sqlSelectName = "SELECT afiliations FROM author WHERE author_id = :author_id";
											
												$result = database_run($sqlSelectName, array(':author_id' => $id));

												if ($result) {
													
													if (count($result) > 0) {
														$user = $result[0];
														$afiliations = $user->afiliations;
													
														echo '<input type="text" id="affiliation" name="affiliation" class="other-text-box"
														value="' . $afiliations . '" >';
													
														
										
													} else {
														echo "User not found.";
													}
												} else {
													echo "Unable to fetch user info.";
												}
											}
											?>
											
										</div>
										<div class="form-row">
											<label for="position">Position: <span class="requiredFilled" style="color: red">*</span></label>
											<?php
											if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
												$sqlSelectName = "SELECT position FROM author WHERE author_id = :author_id";
											
												$result = database_run($sqlSelectName, array(':author_id' => $id));

												if ($result) {
													
													if (count($result) > 0) {
														$user = $result[0];
														$position = $user->position;
													
														echo '<input type="text" id="position" name="position" class="other-text-box"
														value="' . $position . '" >';
													
														
										
													} else {
														echo "User not found.";
													}
												} else {
													echo "Unable to fetch user info.";
												}
											}
											?>
										
										</div>
									</div>
									<!-- Add similar fields for ORCID, Affiliation, Position -->
								</div>

								<!-- About me -->
								<div class="form-section">
									<h4>About me</h4>
									<hr>
									<label for="bio">Bio: (Optional)</label>
										<?php
										if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
											$sqlSelectName = "SELECT bio FROM author WHERE author_id = :author_id";

											$result = database_run($sqlSelectName, array(':author_id' => $id));

											if ($result) {
												if (count($result) > 0) {
													$user = $result[0];
													$bio = $user->bio;

													echo '<textarea id="bio" name="bio" class="bio-textarea" placeholder="Enter your bio" >' . $bio . '</textarea>';
												} else {
													echo "User not found.";
												}
											} else {
												echo "Unable to fetch user info.";
											}
										}
										?>

									
									<br><br><br>
									<label for="fieldofexpertise">Field of Expertise: <span class="requiredFilled" style="color: red">*</span></label>
									<div>
										<input type="text" id="fieldofexpertise" name="fieldofexpertise" class="text-box">
										<button class="btn tbn-primary btn-md" type="button" id="addExpertiseButton">Add</button>
									</div>
									<div id="keywordContainer">

										<?php
											if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
												$sqlSelectName = "SELECT field_of_expertise FROM author WHERE author_id = :author_id";
											
												$result = database_run($sqlSelectName, array(':author_id' => $id));

												if ($result) {
													if (count($result) > 0) {
														$user = $result[0];
														$field_of_expertise = $user->field_of_expertise;
												
														if (!empty($field_of_expertise)) {
															$expertiseArray = explode(', ', $field_of_expertise);
												
															foreach ($expertiseArray as $expertiseItem) {
																echo '<span class="keyword" contenteditable="true" id="expertise" name="expertise">' . htmlspecialchars($expertiseItem) . '</span>';
															}
														}
													} else {
														echo '';
													}
												}
												 else {
													echo "Unable to fetch user info.";
												}
											}
											?>
									</div>
									<input type="hidden" id="expertiseData" name="expertiseData" value="">

								</div>
								

								<!-- <button type="button" class="btn btn-success btn-md" id="editBtn">Edit
									<span class="spinner-border spinner-border-sm" aria-hidden="true" style="display: none"></span>
								</button>
								<button type="button" class="btn btn-secondary btn-md" id="cancelBtn">Cancel
									<span class="spinner-border spinner-border-sm" aria-hidden="true" style="display: none"></span>
								</button> -->

								
								<!-- <input type="submit" class="btn btn-primary btn-md" id="saveButton" value="Save" disabled> -->
								<!-- <button type="submit" class="btn btn-primary btn-md" id="saveButton" value="Save" disabled>Save</button> -->
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
						} 
					?>
					

					

					</div>
					<div class="supportPoints" style="font-weight: bold; margin-top: -15px; margin-bottom: 10px">Support Points:
					
					<?php
					$sqlPoints = "SELECT points FROM support_points WHERE user_id = $id";

					$result = database_run($sqlPoints);

					if ($result !== false) {
						$row = $result[0];
						$totalPoints = $row->points;
						echo $totalPoints;
					}
					?>

					</div>
					<button class="btn  btn-md text-white" id="btn1" onclick="window.location.href='author-dashboard.php'">Manage Articles</button>
					

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
							if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
								$sqlSelectName = "SELECT position FROM author WHERE author_id = :author_id";
							
								$result = database_run($sqlSelectName, array(':author_id' => $id));

								if ($result) {
									
									if (count($result) > 0) {
										$user = $result[0];
										$position = $user->position;
									
										echo $position;
									
										
						
									} else {
										echo "User not found.";
									}
								} else {
									echo "Unable to fetch user info.";
								}
							}
							?>
						</span></p>
						<p><span class="label">Gender</span> <span id="genderLabel">
						<?php
							if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
								$sqlSelectName = "SELECT gender FROM author WHERE author_id = :author_id";
							
								$result = database_run($sqlSelectName, array(':author_id' => $id));

								if ($result) {
									
									if (count($result) > 0) {
										$user = $result[0];
										$gender = $user->gender;
									
										echo $gender;
									
										
						
									} else {
										echo "User not found.";
									}
								} else {
									echo "Unable to fetch user info.";
								}
							}
							?>
						</span></p>
						<p><span class="label">Birthday:</span> <span id="birthdayLabel">
							<?php
							if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
								$sqlSelectName = "SELECT birth_date FROM author WHERE author_id = :author_id";

								$result = database_run($sqlSelectName, array(':author_id' => $id));

								if ($result) {
									if (count($result) > 0) {
										$user = $result[0];
										$birth_date = $user->birth_date;

										if ($birth_date !== NULL) {
										
											$formatted_birth_date = date('F j, Y', strtotime($birth_date));
											echo $formatted_birth_date;
										} else {
											echo ""; 
										}
									} else {
										echo "User not found.";
									}
								} else {
									echo "Unable to fetch user info.";
								}
							}
							?>
						</span></p>

						<p><span class="label">Country:</span> <span id="countryLabel">
						<?php
							if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
								$sqlSelectName = "SELECT country FROM author WHERE author_id = :author_id";
							
								$result = database_run($sqlSelectName, array(':author_id' => $id));

								if ($result) {
									
									if (count($result) > 0) {
										$user = $result[0];
										$country = $user->country;
									
										echo $country;
									
										
						
									} else {
										echo "User not found.";
									}
								} else {
									echo "Unable to fetch user info.";
								}
							}
							?>
						</span></p>
						<p><span class="label">ORCID:</span> <span id="orcidLabel">
							<?php
							if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
								$sqlSelectName = "SELECT orc_id FROM author WHERE author_id = :author_id";
							
								$result = database_run($sqlSelectName, array(':author_id' => $id));

								if ($result) {
									
									if (count($result) > 0) {
										$user = $result[0];
										$orc_id = $user->orc_id;
									
										echo $orc_id;
									
										
						
									} else {
										echo "User not found.";
									}
								} else {
									echo "Unable to fetch user info.";
								}
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
						if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
							$sqlSelectName = "SELECT date_added FROM author WHERE author_id = :author_id";

							$result = database_run($sqlSelectName, array(':author_id' => $id));

							if ($result) {
								if (count($result) > 0) {
									$user = $result[0];
									$date_added = $user->date_added;

									// Format the date as a string (assuming $birth_date is in 'YYYY-MM-DD' format)
									$formatted_date_addedd = date('F j, Y', strtotime($date_added));

									echo $formatted_date_addedd;
								} else {
									echo "User not found.";
								}
							} else {
								echo "Unable to fetch user info.";
							}
						}
						?>
						</div>
						<div class="log-box">
							<?php
							if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
								$sqlSelectName = "SELECT date_added FROM article WHERE author_id = :author_id ORDER BY date_added ASC LIMIT 1 ";

								$result = database_run($sqlSelectName, array(':author_id' => $id));

								if ($result) {
									if (count($result) > 0) {
										$user = $result[0];
										$date_added = $user->date_added;

										$formatted_date_added = date('F j, Y', strtotime($date_added));

										echo 'Author Since: ' . $formatted_date_added;
									} else {
										echo "You did not submit any articles yet.";
									}
								} else {
									echo "You did not submit any articles yet.";
								}
							}
							?>

						</div>
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
								<span>Bio </span>
								<!-- <hr> -->
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
								<span>Expertise </span>
								<!-- <hr> -->
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
							<?php
							if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
								$sqlSelectName = "SELECT title FROM article WHERE author_id = :author_id";

								$result = database_run($sqlSelectName, array(':author_id' => $id));
 
								$sqlReviewed = "SELECT article_id FROM reviewer_assigned WHERE author_id = :author_id AND accept = 1 AND answer = 1";

								$resultReviewed = database_run($sqlReviewed, array(':author_id' => $id));

								$sqlDonation = "SELECT user_id FROM user_points WHERE user_id = :user_id AND action_engage = 'Donation'";

								$resultDonation = database_run($sqlDonation, array(':user_id' => $id));


								if ($result && $resultReviewed && $resultDonation) {
									if (count($result) === 1 && count($resultReviewed) === 1 && count($resultDonation) === 1) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/first_publication_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/first_review_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/first_donation_badges.png\');"></div>';


									}elseif (count($result) === 2 && count($resultReviewed) === 1 && count($resultDonation) === 1) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/second_publication_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/first_review_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/first_donation_badges.png\');"></div>';
										


									}elseif (count($result) === 1 && count($resultReviewed) === 2 && count($resultDonation) === 1) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/first_publication_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/second_review_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/first_donation_badges.png\');"></div>';
										


									}elseif (count($result) === 1 && count($resultReviewed) === 1 && count($resultDonation) === 2) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/first_publication_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/first_review_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/second_donation_badges.png\');"></div>';
										


									}elseif (count($result) === 2 && count($resultReviewed) === 2 && count($resultDonation) === 1) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/second_publication_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/second_review_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/first_donation_badges.png\');"></div>';
										


									}elseif (count($result) === 1 && count($resultReviewed) === 2 && count($resultDonation) === 2) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/first_publication_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/second_review_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/second_donation_badges.png\');"></div>';
										


									}elseif (count($result) === 2 && count($resultReviewed) === 1 && count($resultDonation) === 2) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/second_publication_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/first_review_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/second_donation_badges.png\');"></div>';


									}elseif (count($result) === 2 && count($resultReviewed) === 2 && count($resultDonation) === 2) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/second_publication_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/second_review_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/second_donation_badges.png\');"></div>';


									}elseif (count($result) >= 3 && count($resultReviewed) === 1 && count($resultDonation) === 1) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/third_publication_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/first_review_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/first_donation_badges.png\');"></div>';


									}elseif (count($result) >= 3 && count($resultReviewed) >= 3 && count($resultDonation) === 1) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/third_publication_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/third_publication_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/first_donation_badges.png\');"></div>';


									}elseif (count($result) === 1 && count($resultReviewed) >= 3 && count($resultDonation) >= 3) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/first_publication_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/third_publication_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/third_donation_badges.png\');"></div>';


									}elseif (count($result) >= 3 && count($resultReviewed) === 1 && count($resultDonation) >= 3) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/third_publication_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/first_review_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/third_donation_badges.png\');"></div>';


									}elseif (count($result) >= 3 && count($resultReviewed) === 2 && count($resultDonation) === 2) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/third_publication_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/second_review_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/second_donation_badges.png\');"></div>';


									}elseif (count($result) >= 3 && count($resultReviewed) >= 3 && count($resultDonation) === 2) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/third_publication_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/thirdd_review_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/second_donation_badges.png\');"></div>';


									}elseif (count($result) === 2 && count($resultReviewed) >= 3 && count($resultDonation) >= 3) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/second_publication_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/thirdd_review_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/third_donation_badges.png\');"></div>';


									}elseif (count($result) >= 3 && count($resultReviewed) === 2 && count($resultDonation) >= 3) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/third_publication_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/second_publication_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/third_donation_badges.png\');"></div>';


									}elseif (count($result) === 2 && count($resultReviewed) >= 3 && count($resultDonation) === 2) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/second_publication_badges.png\');"></div>';
									
										echo '<div class="badge-box" style="background-image: url(\'../images/thirdd_review_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/second_donation_badges.png\');"></div>';


									}elseif (count($result) === 2 && count($resultReviewed) === 2 && count($resultDonation) >= 3) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/second_publication_badges.png\');"></div>';
									
										echo '<div class="badge-box" style="background-image: url(\'../images/second_review_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/third_donation_badges.png\');"></div>';


									}elseif (count($result) >= 3 && count($resultReviewed) >= 3 && count($resultDonation) >= 3) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/third_publication_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/thirdd_review_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/third_donation_badges.png\');"></div>';


									} else{
										
										echo 'Something went wrong. Please be patiend we will fixed it in no time';
									}
								}elseif($result){
									if (count($result) === 1) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/first_publication_badges.png\');"></div>';

									}elseif(count($result) === 2) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/second_publication_badges.png\');"></div>';

									}elseif(count($result) >= 3) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/third_publication_badges.png\');"></div>';

									}
								} elseif($resultReviewed){
									if (count($resultReviewed) === 1) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/first_review_badges.png\');"></div>';

									}elseif(count($resultReviewed) === 2) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/second_publication_badges.png\');"></div>';

									}elseif(count($resultReviewed) >= 3) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/thirdd_review_badges.png\');"></div>';

									}
								}elseif($resultDonation){
									if (count($resultDonation) === 1) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/first_donation_badges.png\');"></div>';

									}if (count($resultDonation) === 2) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/first_donation_badges.png\');"></div>';

									}if (count($resultDonation) >= 3) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/third_donation_badges.png\');"></div>';

									}
								}elseif($result && $resultReviewed){
									if (count($result) === 1 && count($resultReviewed) === 1) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/first_publication_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/first_review_badges.png\');"></div>';

									}if (count($result) === 2 && count($resultReviewed) === 2) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/second_publication_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/second_review_badges.png\');"></div>';

									}if (count($result) === 3 && count($resultReviewed) === 3) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/third_publication_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/thirdd_review_badges.png\');"></div>';

									}
								}elseif($resultReviewed && $resultDonation){
									if (count($resultReviewed) === 1 && count($resultDonation) === 1) {
										
									
										echo '<div class="badge-box" style="background-image: url(\'../images/first_review_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/first_donation_badges.png\');"></div>';

									}if (count($resultReviewed) === 2 && count($resultDonation) === 2) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/second_review_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/second_donation_badges.png\');"></div>';

									}if (count($resultReviewed) === 3 && count($resultDonation) === 3) {
																
										echo '<div class="badge-box" style="background-image: url(\'../images/thirdd_review_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/third_donation_badges.png\');"></div>';

									}
								}elseif($result && $resultDonation){
									if (count($result) === 1 && count($resultDonation) === 1) {
										
									
										echo '<div class="badge-box" style="background-image: url(\'../images/first_review_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/first_donation_badges.png\');"></div>';

									}if (count($result) === 2 && count($resultDonation) === 2) {
										
										echo '<div class="badge-box" style="background-image: url(\'../images/second_publication_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/second_donation_badges.png\');"></div>';

									}if (count($result) === 3 && count($resultDonation) === 3) {
																
										echo '<div class="badge-box" style="background-image: url(\'../images/third_publication_badges.png\');"></div>';
										echo '<div class="badge-box" style="background-image: url(\'../images/third_donation_badges.png\');"></div>';

									}
								}else {
									echo "You have no badges yet";
								}
							}
							?>


										
							<!-- <div class="badge-box" style="background-image: url('../images/badge1.jpg');"></div>
							<div class="badge-box" style="background-image: url('../images/badge2.jpg');"></div>
							<div class="badge-box" style="background-image: url('../images/badge3.jpg');"></div>
							<div class="badge-box" style="background-image: url('../images/badge3.jpg');"></div>
							<div class="badge-box" style="background-image: url('../images/badge2.jpg');"></div>
							<div class="badge-box" style="background-image: url('../images/badge1.jpg');"></div>
							<div class="badge-box" style="background-image: url('../images/badge1.jpg');"></div>
							<div class="badge-box" style="background-image: url('../images/badge2.jpg');"></div>
							<div class="badge-box" style="background-image: url('../images/badge3.jpg');"></div>
							<div class="badge-see-more"> -->
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
											WHERE reviewer_assigned.accept = 1 AND reviewer_assigned.answer = 1 AND user_points.action_engage = 'Reviewed an Article' AND user_points.user_id = :author_id)
											
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
										}else{
											echo '<p style="margin-left: 50px; padding-top: 20px">You have no Achievements yet</p>';
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
            <!-- <div class="fluid-container"> -->
                <div>
                	<h4>Your Published Articles</h4>
					<div class="articles-container">
						
					<?php 
						$sql = "SELECT article.article_id, article.title, article.author, article.abstract, journal.journal 
								FROM article 
								JOIN journal ON journal.journal_id = article.journal_id 
								WHERE article.author_id = $id AND article.status = 1";

						$result = database_run($sql);

						$sqlSelectProfile = "SELECT first_name, middle_name, last_name, birth_date, gender, marital_status, orc_id, afiliations, position, field_of_expertise FROM author WHERE author_id = :author_id";

						$resultProfile = database_run($sqlSelectProfile, array(':author_id' => $id));

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
						}elseif ($resultProfile) {
							if (count($resultProfile) > 0) {
								$userProfile = $resultProfile[0];
	  
								// Check for the presence of all required fields
								$requiredFields = ['first_name', 'middle_name', 'last_name', 'birth_date', 'gender', 'marital_status', 'orc_id', 'afiliations', 'position', 'field_of_expertise'];
	  
								$profileComplete = true;
								foreach ($requiredFields as $field) {
									if (empty($userProfile->$field)) {
										$profileComplete = false;
										break;
									}
								}
								if ($profileComplete) {
									echo "<p>You don't have published article yet, want to published article? Click here <a href='ex_submit.php'>Submit an Article</a></p>"; 
							  } else {
								echo "<p>You don't have published article yet, want to published article? Click here <a href='#' id='link'>Submit Article</a></p>"; 
								  echo "<script>
										  document.getElementById('link').addEventListener('click', function(event){
											  Swal.fire({
												  icon: 'warning',
												  text: 'Please complete the required data in your profile details before submitting a paper'
											  });
										  });
										</script>";
							  }                        
							} else {
								echo "User not found.";
							}
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
						</div> -->

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
                <!-- </div> -->
            </div>
		</section>
		<section>
			<h4> Continue Reading</h4>
			<div  id="articleDetailsContainer">
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
				</div> 
				-->
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
		</section>
			
			
			<!-- <div class="featured-updates-container">
				<h2>Featured Updates</h2>
				<div class="ex-featured">
					<div class="example-featured">
						<p><b>USaid.Gov</b><br>Through a USAID grant awarded to the Quezon City University, local government officials of Quezon City, youth council members, and leaders of local community organizations compl....</p>
						<div class="img-featured mb-3">
							<img src="../images/featured.png" alt="">
							<a href="">USAID Trains Quezon City Barangay Leaders to Impro...</a>
						</div>
					</div>

					<div class="example-featured">
						<p><b>USaid.Gov</b><br>Through a USAID grant awarded to the Quezon City University, local government officials of Quezon City, youth council members, and leaders of local community organizations compl....</p>
						<div class="img-featured mb-3">
							<img src="../images/featured.png" alt="">
							<a href="">USAID Trains Quezon City Barangay Leaders to Impro...</a>
						</div>
					</div>
				</div>
				<button type="button" class="btn tbn-primary btn-md" id="show-more">Show more</button>
			</div> -->
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
			<p class="h6" id="engagement">For participating in the peer review process for the article titled:</p>
			<p class="h3" id="engagementTitle"></p>
		</div>
    </div>
</div>

<div class="container-fluid mt-5" id="certPublishedHead" style="display: none">
    <div class="cert-container d-flex justify-content-center align-items-center">
        <img class="img-fluid" id="cert2" src="../images/author-cert.jpg" alt="cert" style="width: 800px;
		height: 500px;
		">
		<div class="cert-category-published" style="position: absolute;">
			<p class="h2" id="categoryPublished" style="  
			font-weight: bold;
			text-align: center;
			font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
			font-style: italic;"></p>
			<p class="h6" id="awardeePublished" style="
			font-family: 'Times New Roman', Times, serif;
			font-weight: bold;
			margin-left: 80px;
			margin-top: 25px;">This Certificate is Awarded to</p>
			<p class="h1" id="awardeeNamePublished" style="    
			text-align: center;
			font-family: 'Dancing Script', cursive;
			font-weight: bold;
			font-style: italic;
			font-size: 50px;">
				<?php 
				echo $first_name . ' ' . $middle_name . ' ' . $last_name	
				?>
			</p>
			<p class="h6" id="engagementPublished" style="    
			font-family: 'Times New Roman', Times, serif;
			font-weight: bold;
			margin-left: 80px;">For successfully publishing the article titled:</p>
			<p class="h3" id="engagementTitlePublished" style="
			font-weight: bold;
			text-align: center;
			font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
			font-style: italic;
			width: 720px;"></p>
		</div>
    </div>
</div>
<div id="loadingOverlay">
    <div id="loadingSpinner"></div>
</div>



	


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script src="jquery-3.7.1.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script src="../JS/reusable-header.js"></script>
    <script src="../JS/user-dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	
	<script>
	

function saveProfile() {
  const fileInput = document.getElementById('fileInput');
  const profileImage = document.getElementById('profileImage');
  const imageModal = document.getElementById('imageModal');
  const selectedImagePreview = document.getElementById('selectedImagePreview');
  const id = <?php echo $id; ?>; // Assuming $id is available in your PHP script

  // Check if a new image is selected
  if (fileInput.files.length > 0) {
    // Prepare FormData to send file data
    const formData = new FormData();
    formData.append('file', fileInput.files[0]);
    formData.append('id', id);

    // Use AJAX to send the file to user-profile.php for processing
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../PHP/user-profile.php', true);

    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Update profile picture on success
        profileImage.src = selectedImagePreview.src;
        imageModal.style.display = 'none';

        Swal.fire({
          icon: 'success',
          text: 'Change profile picture successfully',
          showConfirmButton: true
        });
      }
    };

    xhr.send(formData);
  } else {
    // No new image selected, just close the modal
    imageModal.style.display = 'none';
  }
}


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
              <p class="historyAbstract" style="color: #454545;">${article.abstract.slice(0,150)}</p>
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
//   countrySelect.disabled = true;


  fetch('https://restcountries.com/v3.1/all')
      .then(response => response.json())
      .then(data => {
       
          if (data.find(country => country.name.common === '<?php
							if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
								$sqlSelectName = "SELECT country FROM author WHERE author_id = :author_id";
							
								$result = database_run($sqlSelectName, array(':author_id' => $id));

								if ($result) {
									
									if (count($result) > 0) {
										$user = $result[0];
										$country = $user->country;
									
										echo $country;
									
										
						
									} else {
										echo "User not found.";
									}
								} else {
									echo "Unable to fetch user info.";
								}
							}
							?>')) {
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


document.getElementById('cancelBtn').addEventListener('click', function(event){
    const editForm = document.getElementById('editForm');
    const firstNameInput = document.getElementById('firstName');
	const middleName = document.getElementById('middleName');
	const lastName = document.getElementById('lastName');
	const affix = document.getElementById('affix');
	const birthdate = document.getElementById('birthdate');
	const gender = document.getElementById('gender');
	const status = document.getElementById('status');
	const country = document.getElementById('country');
	// const email = document.getElementById('email');
	const orcid = document.getElementById('orcid');
	const affiliation = document.getElementById('affiliation');
	const position = document.getElementById('position');
	const bio = document.getElementById('bio');
	

  
	editForm.style.display = 'none';

    firstNameInput.value = "<?php echo htmlspecialchars($firstName); ?>";
	middleName.value = "<?php echo htmlspecialchars($middle_name); ?>";
	lastName.value = "<?php echo htmlspecialchars($last_name); ?>";
	affix.value = "<?php echo htmlspecialchars($affix); ?>";
	birthdate.value = "<?php echo htmlspecialchars($birthday); ?>";
	gender.value = "<?php echo htmlspecialchars($gender); ?>";
	status.value = "<?php echo htmlspecialchars($marital_status); ?>";
	country.value = "<?php echo htmlspecialchars($country); ?>";
	orcid.value = "<?php echo htmlspecialchars($orc_id); ?>";
	affiliation.value = "<?php echo htmlspecialchars($afiliations); ?>";
	position.value = "<?php echo htmlspecialchars($position); ?>";
	bio.value = "<?php echo htmlspecialchars($bio); ?>";
	
	



 
});



document.addEventListener('DOMContentLoaded', function () {
    // Attach click event listener to all elements with class 'view-button'
    var viewButtons = document.querySelectorAll('.view-button');
    const reviewerCert = document.getElementById('certContainerHead');
	const authorCert = document.getElementById('certPublishedHead');


    viewButtons.forEach(function (button) {
        button.addEventListener('click', function () {

            reviewerCert.style.display = 'block';
			authorCert.style.display = 'block';

            // Find the corresponding achievement row
            var achievementRow = button.closest('tr');
            
            // Get the action_engage and title values
            var actionEngage = achievementRow.querySelector('td:first-child').textContent.trim();
            var title = achievementRow.querySelector('td:nth-child(3)').textContent.trim();

            if (actionEngage === 'Submitted an Article') {
                Swal.fire({
                    html: "<p style='font-weight: bold'>You got 1 Community heart because you submitted an article</p>" + "<p>Title: " + title + "</p>",
                    imageUrl: "../images/qcu-bg.jpg",
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: "Custom image",
                    didClose: function () {
                        // This will be executed when the Swal modal is closed
                        reviewerCert.style.display = 'none';
						authorCert.style.display = 'block';

                    }
                });
            } else if (actionEngage === 'Reviewed Article Published') {
                Swal.fire({
                    html: "<p style='font-weight: bold'>You got 3 Community heart because the article you reviewed was published</p>" + "<p>Title: " + title + "</p>" + "<br>" + "<button type='button' onclick='downloadCertificate()'>Download Cert</button>",
                    imageUrl: "../images/qcu-bg.jpg",
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: "Custom image",
                    didClose: function () {
                        reviewerCert.style.display = 'none';
						authorCert.style.display = 'block';
                    }
                });
            } else if (actionEngage === 'Published an Article') {
                Swal.fire({
                    html: "<p style='font-weight: bold'>You got 3 Community heart because you've successfully published an article</p>" + "<p>Title: " +  title + "</p>" + "<br>" + "<button type='button' onclick='downloadCertificatePublished()'>Download Cert</button>",
                    imageUrl: "../images/qcu-bg.jpg",
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: "Custom image",
                    didClose: function () {
                        reviewerCert.style.display = 'none';
						authorCert.style.display = 'block';
                    }
                });
            } else if (actionEngage === 'Reviewed an Article') {
                Swal.fire({
                    html: "<p style='font-weight: bold'>You got 1 Community heart because you help us published an article</p>" + "<p>Title: " + title + "</p>",
                    imageUrl: "../images/qcu-bg.jpg",
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: "Custom image",
                    didClose: function () {
                        reviewerCert.style.display = 'none';
						authorCert.style.display = 'block';
                    }
                });
            }
        });
    });
});

function updateEngagementTitle(title, journalId) {
    document.getElementById("engagementTitle").innerHTML = title;
    document.getElementById("category").innerHTML = 'Journal of ' + journalId;

	document.getElementById("engagementTitlePublished").innerHTML = title;
    document.getElementById("categoryPublished").innerHTML = 'Journal of ' + journalId;
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

function downloadCertificatePublished() {
    // Get the certificate container by ID
    var certificateContainerPublished = document.getElementById('certPublishedHead');

    // Use html2canvas to capture the content as an image
    html2canvas(certificateContainerPublished).then(function(canvas) {
        // Convert the canvas to a data URL
        var dataUrl = canvas.toDataURL('image/png');

        // Create a link element
        var link = document.createElement('a');

        // Set the download attribute and the href with the data URL
        link.download = 'certificatePublished.png';
        link.href = dataUrl;

        // Trigger a click on the link to start the download
        link.click();
    });

	
}


$(document).ready(function () {
        $('#searchUser').on('input', function () {
            var searchData = $(this).val();
            if (searchData.length > 0) {
                $.ajax({
                    type: 'POST',
                    url: '../PHP/search.php',
                    data: {searchData: searchData},
                    success: function (response) {
                        $('#userList').html(response);
                    }
                });
            } else {
                $('#userList').empty();
            }
        });
    });


</script>

</body>

</html>

