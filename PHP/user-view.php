<?php
require 'dbcon.php';
session_start();


if (!isset($_SESSION['LOGGED_IN']) || $_SESSION['LOGGED_IN'] !== true) {
	header('Location: ./login.php');
	exit();
  }

  $orcid = isset($_GET['orcid']) ? $_GET['orcid'] : '';



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('./meta.php'); ?>
    <title>QCU PUBLICATION | AUTHOR PROFILE</title>
    <link rel="stylesheet" href="../CSS/user-view.css">
    <link rel="stylesheet" href="../CSS/index.css">
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
            <p>Dashboard / Author</p>
            <h2>
                You're in 
                <?php 
               
                $result = database_run("SELECT first_name FROM author WHERE orc_id = :orc_id", array('orc_id' => $orcid));
                
                if ($result !== false && !empty($result)) {
                    $first_name = $result[0]->first_name;
                    echo "$first_name's Profile";
                } else {
                    echo "";
                }
                ?>
            </h2>

            
    
        </div>
    </div>
    <section class="main">
        <div class="main-profile">
			<div class="profile-container">
				<div class="profile-sidebar">
					<!-- Profile Image -->
					
                    <?php
                    

                    
                    $sqlGetProfilePic = "SELECT profile_pic FROM author WHERE orc_id = :orc_id";
                    $params = array(':orc_id' => $orcid);
                    $result = database_run($sqlGetProfilePic, $params);
                    
                    if ($result !== false && !empty($result[0]->profile_pic)) {
                        $profilePicPath = $result[0]->profile_pic;
                    
                        echo '<img src="' . $profilePicPath . '" alt="Profile Picture" style="width: 150px; height: 150px">';
                    } else {
                        
                        echo '<img src="../images/profile.jpg" alt="Profile Picture" class="profile-pic" style="width: 150px; height: 150px">';
                    }
                    ?>
				</div>
				<div class="profile-info">
					<div class="row">
						<!--<div class="points">
							<p><span class="label">PHP:</span> 1.00 / Credit</p>
						</div>-->
							<!-- User Info -->
						<div class="user-info">
							<h1>
                                <?php 
                
                                    $result = database_run("SELECT first_name FROM author WHERE orc_id = :orc_id", array('orc_id' => $orcid));
                                    
                                    if ($result !== false && !empty($result)) {
                                        $first_name = $result[0]->first_name;
                                        echo "$first_name's Profile";
                                    } else {
                                        echo "Profile not found.";
                                    }
                                ?>
                            </h1>
							<p class="role">
                            <?php 
               
                                $result = database_run("SELECT role FROM author WHERE orc_id = :orc_id", array('orc_id' => $orcid));
                                
                                if ($result !== false && !empty($result)) {
                                    $role = $result[0]->role;
                                    echo $role;
                                } else {
                                    echo "";
                                }
                            ?>
                            </p>
							<!-- <p class="subscription">You're subscribed to Package plan</p> -->
						</div>
					</div>
					<!-- Action Buttons -->

					<div class="profile-badge">
                        <p class="recent-badges">Recent Badges</p>
						<div class="badge-box" style="background-image: url('../images/badge1.jpg');"></div>
						<div class="badge-box" style="background-image: url('../images/badge2.jpg');"></div>
						<div class="badge-box" style="background-image: url('../images/badge3.jpg');"></div>
						<div class="badge-box" style="background-image: url('../images/badge2.jpg');"></div>
						<div class="badge-box" style="background-image: url('../images/badge1.jpg');"></div>
					</div>
				</div>
				<hr class="vertical-line">

				<div class="profile-main">
					<!-- Detailed Info -->
					<div class="details">
						<p><span class="label">Position:</span>
                            <?php 
                
                                $result = database_run("SELECT position FROM author WHERE orc_id = :orc_id", array('orc_id' => $orcid));
                                
                                if ($result !== false && !empty($result)) {
                                    $position = $result[0]->position;
                                    echo $position;
                                } else {
                                    echo "";
                                }
                            ?>
                        </p>
						<p><span class="label">Gender:</span>
                        <?php 
                
                            $result = database_run("SELECT gender FROM author WHERE orc_id = :orc_id", array('orc_id' => $orcid));
                            
                            if ($result !== false && !empty($result)) {
                                $gender = $result[0]->gender;
                                echo $gender;
                            } else {
                                echo "";
                            }
                        ?>
                                
                        </p>
						<p><span class="label">Birthday:</span>
                        <?php 
                
                            $result = database_run("SELECT birth_date FROM author WHERE orc_id = :orc_id", array('orc_id' => $orcid));
                            
                            if ($result !== false && !empty($result)) {
                                $birth_date = $result[0]->birth_date;
                                echo $birth_date;
                            } else {
                                echo "";
                            }
                        ?>
                        </p>
						<p><span class="label">Country:</span>
                        <?php 
                
                            $result = database_run("SELECT country FROM author WHERE orc_id = :orc_id", array('orc_id' => $orcid));
                            
                            if ($result !== false && !empty($result)) {
                                $country = $result[0]->country;
                                echo $country;
                            } else {
                                echo "";
                            }
                        ?>
                        </p>
						<p><span class="label">ORCID:</span>
                        <?php 
                
                            $result = database_run("SELECT orc_id FROM author WHERE orc_id = :orc_id", array('orc_id' => $orcid));
                            
                            if ($result !== false && !empty($result)) {
                                $orc_id = $result[0]->orc_id;
                                echo $orc_id;
                            } else {
                                echo "";
                            }
                        ?>
                        </p>
					</div>
				</div>
			</div>
		</div>
        <section class="expertise">
			<!-- Expertise info here -->
			<div class="tab">
				<button class="tablinks" onclick="openTab(event, 'About')" id="defaultOpen">About</button>
				<button class="tablinks" onclick="openTab(event, 'PublishedArticles')">Published Articles</button>
			</div>


			<div id="About" class="tabcontent" style="display: block;">
				<div id="about-container">
					<div id="logrecord-container">
						<div class="log-box">Joined in community since
                        <?php
                        $result = database_run("SELECT date_added FROM author WHERE orc_id = :orc_id", array('orc_id' => $orcid));

                        if ($result !== false && !empty($result)) {
                            $date_added = $result[0]->date_added;

                            $formattedDate = date("F j, Y", strtotime($date_added));
                            
                            echo $formattedDate;
                        } else {
                            echo "error";
                        }
                        ?>

                        </div>
						<div class="log-box">
                        <?php
                            $result = database_run("SELECT MIN(article.date_added) AS oldest_date FROM article JOIN author ON article.author_id = author.author_id WHERE author.orc_id = :orc_id", array('orc_id' => $orcid));

                            if ($result !== false && !empty($result)) {
                                $oldestDate = $result[0]->oldest_date;

                            
                                $formattedDate = date("F j, Y", strtotime($oldestDate));
                                
                                echo "Author since: $formattedDate";
                            } else {
                                echo "This author has not submitted any article yet";
                            }
                        ?>

                        </div>
						<div class="log-box">
                        <?php
                            $result = database_run("SELECT MIN(date_issued) AS oldest_date FROM reviewer_assigned JOIN author ON reviewer_assigned.author_id = author.author_id WHERE author.orc_id = :orc_id", array('orc_id' => $orcid));

                            if ($result !== false && !empty($result) && !empty($result[0]->oldest_date)) {
                                $oldestDate = $result[0]->oldest_date;

                                $formattedDate = date("F j, Y", strtotime($oldestDate));
                                
                                echo "Reviewer since:  $formattedDate ";
                            } else {
                                echo 'This author has not reviewed any article yet';
                            }
                        ?>

                        </div>
					</div>
					<div id="info-container">
						<div class="info-box">
							<div class="bio-container">
								<p>Bio </p>
								<hr>
								<p>
                                <?php 
                
                                    $result = database_run("SELECT bio FROM author WHERE orc_id = :orc_id", array('orc_id' => $orcid));
                                    
                                    if ($result !== false && !empty($result)) {
                                        $bio = $result[0]->bio;
                                        echo $bio;
                                    } else {
                                        echo "error";
                                    }
                                ?>
								</p>
							</div>
						</div>
						<div class="info-box">
							<div class="expertise-container">
								<p>Expertise </p>
								<hr>
								<p>
                                <?php 
                
                                    $result = database_run("SELECT field_of_expertise FROM author WHERE orc_id = :orc_id", array('orc_id' => $orcid));
                                    
                                    if ($result !== false && !empty($result)) {
                                        $field_of_expertise = $result[0]->field_of_expertise;
                                        echo $field_of_expertise;
                                    } else {
                                        echo "error";
                                    }
                                ?>  
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
            <div id="PublishedArticles" class="tabcontent">
                <div class="published-articles">
                    <div class="stats-main">
                        <div class="stats-container">
                            <div class="stat">
                                <div class="stats-values">15</div>
                                <div class="stats-labels">Views</div>
                            </div>
                            <div class="stat">
                                <div class="stats-values">58</div>
                                <div class="stats-labels">Downloads</div>
                            </div>
                            <div class="stat">
                                <div class="stats-values">24</div>
                                <div class="stats-labels">Citations</div>
                            </div>
                            <div class="stat">
                                <div class="stats-values">89</div>
                                <div class="stats-labels">Hearts</div>
                            </div>
                        </div>
                        <div class="stat search-container">
                            <input type="text" placeholder="Search">
                        </div>
                    </div>

                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Publish Date</th>
                                    <th>Journal</th>
                                    <th><center>Action</center></th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="no-data-message" style="display: none;">
                                    <td colspan="6">No records found</td>
                                </tr>
                                <tr>
                                    <td style="color: #285581">Blockchain Beyond Cryptocurrency: Transforming...</td>
                                    <td>May 31, 2015</td>
                                    <td>The Star</td>
                                    <td><center>...</center></td>
                                </tr>
                                <tr>
                                    <td style="color: #285581">Industries with Distributed Ledger Technology</td>
                                    <td>October 24, 2018</td>
                                    <td>The Star</td>
                                    <td><center>...</center></td>
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            
		</section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="../JS/reusable-header.js"></script>
    <script src="../JS/user-view.js"></script>
</body>
</html>