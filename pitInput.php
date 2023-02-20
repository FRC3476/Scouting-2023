<html>
<?php include("navBar.php"); ?>

<head>
	<style>
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
</head>

<body class="bg-body">
	<div id="errorBox" class="modal">
		<div id="alert-template" class="modal-content">
			<span class="close" onclick="closeError(this)">&times;</span>
		</div>
	</div>
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
								<text class="form-label">Team Name: </text>
								<input type="text" class="form-control" id="pitTeamName" name="pitTeamName" placeholder=" ">
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
								<br><text class="form-label">How many working batteries did you bring?</text>
								<input type="text" class="form-control" id="numBatteries" name="numBatteries" placeholder=" ">
							</div>

							<div class="mb-3">
								<text class="form-label">How many batteries can you charge at once?</text>
								<input type="number" class="form-control" id="chargedBatteries" name="chargedBatteries" placeholder=" ">
								<br>
							</div>

							<div class="mb-3">
								<text class="form-label">What is your coding language?</text>
							</div>
							<select name="codeLanguage" id="codeLanguage">
								<option value="javascript">Java</option>
								<option value="python">C++</option>
								<option value="c++">LabVIEW</option>
								<option value="java">Other</option>
							</select>

							<div class="col-lg-2">
								<br><text class="form-label">Do you have an auto path? What is it?</text>
								<input type="text" class="form-control" id="autoPath" name="autoPath" placeholder=" ">
								<br>
							</div>

							<div class="col-lg-2">
								<br><text class="form-label">What are your frame perimeter dimensions with your bumper
									on?</text>
								<input type="text" class="form-control" id="framePerimeterDimensions" name="framePerimeterDimensions" placeholder=" ">
								<br>
							</div>

							<div class="col-lg-2">
								<br><text class="form-label">Other Comments:</text>
								<input type="text" class="form-control" id="pitComments" name="pitComments" placeholder=" ">
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
						}, function(success) {
							console.log(success);
							success = JSON.parse(success);
							if (success) {
								createSuccessAlert('Form Submitted. Clearing form.');
								clearForm();
							} else {
								createErrorAlert('Form submitted to server but failed to process. Please try again or contact admin.');
							}
						})
						.fail(function() {
							createErrorAlert('Form submitted but failure on server side. Please try again or contact admin.');
						});
				}
			}

			var error = document.getElementById("errorBox");

			window.onclick = function(event) {
				if (event.target == error) {
					error.style.display = "none";
				}
			}

			function closeError(button) {
				error.style.display = "none";
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
				var p = document.createElement("p");
				p.innerText = errorMessage;
				p.className = "error";
				createAlert(p);
			}

			function createSuccessAlert(successMessage) {
				var p = document.createElement("p");
				p.innerText = successMessage;
				p.className = "success";
				createAlert(p);
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
				if (!data['pitTeamName']) {
					createErrorAlert('Team name not valid.');
					valid = false;
				}

				return valid;
			}

			function clearForm() {
				$('#pitTeamName').val('');
				$('#pitTeamNumber').val('');
				$('#numBatteries').val('');
				$('#chargedBatteries').val('');
				$('#codeLanguage').val('Java');
				$('#autoPath').val('');
				$('#framePerimeterDimensions').val('');
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
				data['autoPath'] = $('#autoPath').val(); // Either form input or 0 if no form input
				data['framePerimeterDimensions'] = $('#framePerimeterDimensions').val(); // Either form input or 0 if no form input
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
		</style>

</html>