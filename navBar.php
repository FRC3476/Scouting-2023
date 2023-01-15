<?php include("header.php"); ?>

<!-- Image and text -->
<nav class="navbar navbar-expand-lg navbar-dark orange" role="navigation">
	<a class="navbar-brand" href="#">
		<img src="images/Logo.png" height="40" class="d-inline-block align-top" alt="">

	</a>
	<div class="container">
		<!-- Drop down button for small screens -->
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<!-- Left justified logo/text -->
		<div class="navbar-header">
			<a class="navbar-brand" href="index.php" style="color:Black;">
				Scouting 2023
			</a>
		</div>
		<!-- What goes under the drop down button/rest of navbar -->
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-left">
				<li><a href="robotScoutForm.php" style="color:Black;">Pit Scouting</a></li>
				<li><a href="pictureUpload.php" style="color:Black;">Picture Upload</a></li>
				<li><a href="matchScoutForm.php" style="color:Black;">Match Scouting</a></li>
				<li><a href="leadScoutForm.php" style="color:Black;">Lead Scout</a></li>
				<li><a href="teamRankerForm.php" style="color:Black;">Team Ranker</a></li>
				<li><a href="matchResultForm.php" style="color:Black;">API Refresh</a></li>

				<li class="dropdown">
					<a class="dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="color:Black;">Checks<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="pitCheck.php" style="color:Black;">Pit Check</a></li>
						<li><a href="dataCompletion.php" style="color:Black;">Data Completion</a></li>
						<li><a href="dataValidation.php" style="color:Black;">Data Validation</a></li>
					</ul>
					</a>
				</li>

				<li class="dropdown">
					<a class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="color:Black;">Bets<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="betForm.php" style="color:Black;">Bet</a></li>
						<li><a href="betRanking.php" style="color:Black;">Bet Ranking</a></li>
					</ul>
					</a>
				</li>

			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?php
				if (isset($_SESSION["userIDCookie"])) {
					echo ('<li class="dropdown">
                                <a data-target="#" class="dropdown-toggle" data-toggle="dropdown">' . $_SESSION["userIDCookie"] . '<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                <li><a href="javascript:void(0)">Action</a></li>
                                <li class="divider"></li>
                                <li><a href="logout.php">Logout</a></li>
                                </ul>
                                </ul>
                                </li>');
					echo (" <script>
								$(document).ready(function(){
								$('.dropdown-toggle').dropdown();
								});
							</script>'");
				}
				?>
			</ul>
		</div> 
	</div>
</nav>

<script>
	$(document).ready(function() {
		$.material.init();
	});
</script>
