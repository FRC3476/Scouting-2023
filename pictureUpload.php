<html>
<?php include("navBar.php"); ?>

<body>
    <style>
        #overallForm {
            font-size: 15px;
            display: inline-block;
        }
    </style>

    <body class="bg-body">
        <div class="container row-offcanvas row-offcanvas-left">
            <div class="well column col-lg-12 col-sm-12 col-xs-12" id="content">
                <div class="row pt-3 pb-3 mb-3">


                    <div class="col-lg-12 col-sm-12 col-xs-12 gx-3">
                        <div class="card">
                            <div class="card-header">Pit Scout Picture Upload</div>
                            <div class="card-body">
                                <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
                                    
                                    <a href='pitCheck.php'>
                                        <button class="btn btn-primary">
                                            Pit Check
                                        </button>
                                    </a>
                                    <a href='pitInput.php'>
                                        <button class="btn btn-primary">
                                            Pit Scout Form
                                        </button>
                                    </a>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <text class="col-lg-2 control-label">Team Number: </text>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="teamNumber"
                                                    name="teamNumber" placeholder=" ">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-lg-12 col-sm-12 col-xs-12">
                                            Select images to upload:
                                            <input type="file" name="fileToUpload" multiple id="fileToUpload">
                                            <input id="PitScouting" type="submit" class="btn btn-primary"
                                                value="Submit Data" onclick="">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
        <?php include("footer.php"); ?>
Pit Check
<html>
<?php include("navBar.php"); ?>

<head>

	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="bootstrap-material-design-master/dist/css/ripples.min.css" rel="stylesheet">
	<link href="bootstrap-material-design-master/dist/css/material-wfont.min.css" rel="stylesheet">
	<script src="jquery-1.11.2.min.js"></script>
	<script src="sorttable.js"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1">


</head>

<body class="bg-body">
	<div class="container row-offcanvas row-offcanvas-left">
		<div class="well column col-lg-12 col-sm-12 col-xs-12" id="content">
			<div class="row pt-3 pb-3 mb-3">


				<div class="col-lg-12 col-sm-12 col-xs-12 gx-3">
					<div class="card">
						<div class="card-header">Pit Check</div>
						<div class="card-body">
							<a href='pictureUpload.php'>
								<button class="btn btn-primary">
									Picture Upload
								</button>
							</a>
							<a href='pitInput.php'>
								<button class="btn btn-primary">
									Pit Input
								</button>
							</a>

			<table class="sortable table table-hover" id="RawData">
				<tr>
					<th>Team Number</th>
					<th>Pit Scouted?</th>
					<th>Picture Taken?</th>		
				</tr>
				<tr>
					<td>team number</td>
					<td><select name="pitScoutedDropDown" id="pitScoutedDropDown">
								<option value="yes">Yes</option>
								<option value="no">No</option>
							</select></td>
							<td><select name="pictureTakenDropDown" id="pictureTakenDropDown">
								<option value="yes">Yes</option>
								<option value="no">No</option>
							</select></td>
				</tr>
        
		</div>
	</div>
</body>
<?php include("footer.php") ?>