<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCU PUBLICATION | AUTHOR PROFILE</title>
    <link rel="stylesheet" href="../CSS/user-view.css">
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
            <h2>You're in Kyle's Profile</h2>
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
							<p class="role">Author</p>
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
						<p><span class="label">Position:</span> Student  </p>
						<p><span class="label">Gender:</span> Female   </p>
						<p><span class="label">Birthday:</span> 10/24/2002</p>
						<p><span class="label">Country:</span> Philippines</p>
						<p><span class="label">ORCID:</span> 048469754</p>
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