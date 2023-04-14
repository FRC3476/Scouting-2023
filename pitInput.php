<html>
<?php include("navbar.php"); ?>

<body class="bg-body">
	<div class="container row-offcanvas row-offcanvas-left">
		<div class="well column col-lg-12 col-sm-12 col-xs-12" id="content">
			<div class="row pt-3 pb-3 mb-3">


				<div class="col-lg-12 col-sm-12 col-xs-12 gx-3">
					<div class="card">
						<div class="card-header">Pit Scout Form</div>
						<div class="card-body">

							<div id="alertPlaceholder"></div>

							<a href='pitCheck.php'>
								<button class="btn btn-primary">
									Pit Check
								</button>
							</a>
							<a href='pictureUpload.php'>
								<button class="btn btn-primary">
									Picture Upload
								</button>
							</a>

							<div class="mb-3">
								<text class="form-label">Team Number: </text>
								<input type="text" class="form-control" id="pitTeamNumber" name="pitTeamNumber" placeholder=" ">
							</div>

							<div class="mb-3">
								<text class="form-label">Pit organization</text>
							</div>
							<select name="organized" id="disorganized">
								<option value="disorganized">1- Disorganized</option>
								<option value="average">3 - Average</option>
								<option value="pristine">5 - Pristine</option>
							</select>

							<div class="mb-3">
								<br><text class="form-label">How many robot batteries does the team have?</text>
								<input type="text" class="form-control" id="numBatteries" name="numBatteries" placeholder=" ">
							</div>

							<div class="mb-3">
								<text class="form-label">How many chargers does the team have for robot batteries?</text>
								<input type="number" class="form-control" id="chargedBatteries" name="chargedBatteries" placeholder=" ">
							</div>

							<div class="mb-3">
								<br><text class="form-label">What is your coding language?</text>
							</div>
							<select name="codeLanguage" id="codeLanguage">
								<option value="Java">Java</option>
								<option value="C++">C++</option>
								<option value="LabvVIEW">LabVIEW</option>
								<option value="Python">Python</option>
								<option value="Other">Other</option>
								<br>
							</select>
							  
							<div class="mb-3">
								<br><text class="form-label">What is your drivetrain type?</text>
							</div>
							<select name="drivetrainType" id="drivetrainType">
								<option value="Swerve">Swerve</option>
								<option value="Tank">Tank</option>
								<option value="Mecanum">Mecanum</option>
								<option value="Other">Other</option>
								<br>
							</select>

							<div class="mb-3">
								<br><text class="form-label">Auto Path</text>
								<input type="text" class="form-control" id="autoPath" name="autoPath" placeholder=" ">
							</div>

							<div class="mb-3">
								<br><text class="form-label">What are your frame perimeter dimensions without your bumper on?</text>
									<div style="display: table-cell"><input type="text" class="form-control" id="framePerimeterDimensionsLength" name="framePerimeterDimensionsLength" placeholder="Frame Length (inches)"></div>
									<div style="display: table-cell"><input type="text" class="form-control" id="framePerimeterDimensionsWidth" name="framePerimeterDimensionsWidth" placeholder="Frame Width (inches)"></div>
								<br>
							</div>

							<div class="mb-3">
								<text class="form-label">Other Comments:</text>
								<input type="text" class="form-control" id="pitComments" name="pitComments" placeholder="Comments">
								<br>
							</div>

							<div class="col-lg-12 col-sm-12 col-xs-12">
								<input id="submit" type="submit" class="btn btn-primary" value="Submit Data" onclick="">
							</div>
							<br>
						</div>
					</div>
				</div>
			</div>

		</div>

		<?php include("footer.php"); ?>

		<script>
			function submitData() {
				/* Gets data from form, validates it, and creates appropriate error messages. 

				Returns:
				True if successful, false if not.
				*/
				clearAlerts();
				var data = getpitInputData();
				console.log(data);
				var validData = validateFormData(data);
				if (validData) {
					// Create POST request.
					$.post("writeAPI.php", {
							"writePitScoutData": JSON.stringify(data)
						}, function(data) {
							data = JSON.parse(data);
							console.log(data);
							if (data["success"]) {
								createSuccessAlert('Form Submitted. Clearing form.');
								clearForm();
							} else {
								createErrorAlert('Form submitted to server but failed to process. Please try again or contact admin.');
								createErrorAlert(JSON.stringify(data["error"]));
							}
						})
						.fail(function() {
							createErrorAlert('Form submitted but failure on server side. Please try again or contact admin.');
						});
				}
			}
			function createAlert(p) {
				var template = document.getElementById("alert-template");
				if (p.className == "error") template.style = "background-color: #ff6e6e;";
				else template.style = "background-color: #6eff70;";
				template.hidden = false;
				template.appendChild(p);
				error.innerText = "";  
				error.appendChild(template);
				error.style.display = "block";
			}

			function createErrorAlert(errorMessage) {
				/* Creats a Error alert. 
				
				Args:
					successMessage: String of message to send.
				*/
				var alertValue = [`<div class="alert alert-danger alert-dismissible" role="alert">`,
					`  <div>${errorMessage}</div>`,
					`  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>`,
					`</div>`
				].join('');
				$('#alertPlaceholder').append(alertValue);
			}

			function createSuccessAlert(successMessage) {
				/* Creats a success alert. 
				
				Args:
					successMessage: String of message to send.
				*/
				var alertValue = [`<div class="alert alert-success alert-dismissible" role="alert">`,
					`  <div>${successMessage}</div>`,
					`  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>`,
					`</div>`
				].join('');
				$('#alertPlaceholder').append(alertValue);
			}

			function clearAlerts() {
				/* Clears all allerts in the placeholder. */
				$('#alertPlaceholder').empty();
			}

			function validateFormData(data) {
				/* Return false and send error if not valid form data.
				
				Args:
				  data: dictionary of values from form.
				*/
				var valid = true;
				if (!data['pitTeamNumber']) {
					createErrorAlert('Team number not valid.');
					valid = false;
				}

				return valid;
			}

			function clearForm() {
				$('#pitTeamName').val('');
				$('#numBatteries').val('');
				$('#chargedBatteries').val('');
				$('#codeLanguage').val('Java');
				$('#drivetrainType').val('Swerve');
				$('#autoPath').val('');
				$('#framePerimeterDimensions').val('');
				$('#framePerimeterDimensionsLength').val('');
				$('#framePerimeterDimensionsWidth').val('');
				$('#pitComments').val('');
				$('#disorganized').val('');
			}

			function getpitInputData() {
				/* Gets values from HTML form and formats as dictionary. */
				var data = {};
				data['pitTeamNumber'] = $('#pitTeamNumber').val();
				data['pitTeamName'] = $('#pitTeamName').val();
				data['disorganized'] = $('#disorganized').val();
				data['numBatteries'] = parseInt($('#numBatteries').val()) || 0;
				data['chargedBatteries'] = parseInt($('#chargedBatteries').val()) || 0; // Either form input or 0 if no form input
				data['codeLanguage'] = $('#codeLanguage').val(); // Either form input or 0 if no form input
				data['drivetrainType'] = $('#drivetrainType').val(); // Either form input or 0 if no form input
				data['autoPath'] = $('#autoPath').val(); // Either form input or 0 if no form input
				var frame = "";
				var frameLength = $('#framePerimeterDimensionsLength').val();
				var frameWidth = $('#framePerimeterDimensionsWidth').val();
				if (frameLength || frameWidth) frame = `${frameLength} X ${frameWidth}`;
				data['framePerimeterDimensions'] = frame;
				//data['framePerimeterDimensions'] = $('#framePerimeterDimensions').val(); // Either form input or 0 if no form input
				data['pitComments'] = $('#pitComments').val() || ""; // Either form input or 0 if no form input
				return data;
			}

			$("#submit").on('click', function(event) {
				submitData();
			});
		</script>


		<style>
			/* The container */
			.container2 {
				display: inline-block;
				position: relative;
				cursor: pointer;
				font-size: 22px;
				bottom: 10px;
				-webkit-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				user-select: none;
			}

			/* Hide the browser's default checkbox */
			.container2 input {
				position: absolute;
				opacity: 0;
				cursor: pointer;
				height: 0;
				width: 0;
				margin-left: 100%;

			}

			/* Create a custom checkbox */
			.checkmark {
				position: absolute;
				top: 0;
				left: 0;
				height: 25px;
				width: 25px;
				background-color: #eee;
				border-radius: 5px;
			}

			.container:hover input~.checkmark {
				background-color: orange;
			}

			.container2 input:checked~.checkmark {
				background-color: rgb(15, 129, 120);
			}

			/* Create the checkmark/indicator (hidden when not checked) */
			.checkmark:after {
				content: "";
				position: absolute;
				display: none;
			}

			/* Show the checkmark when checked */
			.container2 input:checked~.checkmark:after {
				display: block;
			}

			/* Style the checkmark/indicator */
			.container2 .checkmark:after {
				left: 9px;
				top: 5px;
				width: 5px;
				height: 10px;
				border: solid white;
				border-width: 0 3px 3px 0;
				-webkit-transform: rotate(45deg);
				-ms-transform: rotate(45deg);
				transform: rotate(45deg);
			}
			.modal {
				display: none;
				/* Hidden by default */
				position: fixed;
				/* Stay in place */
				z-index: 1;
				/* Sit on top */
				padding-top: 100px;
				/* Location of the box */
				left: 0;
				top: 0;
				width: 100%;
				/* Full width */
				height: 100%;
				/* Full height */
				overflow: auto;
				/* Enable scroll if needed */
				background-color: rgb(0, 0, 0);
				/* Fallback color */
				background-color: rgba(0, 0, 0, 0.4);
				/* Black w/ opacity */
			}

			/* Modal Content */
			.modal-content {
				background-color: #fefefe;
				margin: auto;
				padding: 20px;
				border: 1px solid #888;
				width: 80%;
			}

			/* The Close Button */
			.close {
				color: #aaaaaa;
				float: right;
				font-size: 28px;
				font-weight: bold;
			}

			.close:hover,
			.close:focus {
				color: #000;
				text-decoration: none;
				cursor: pointer;
			}
		</style>

</html>