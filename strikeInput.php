<html>
<?php include("navbar.php"); ?>

<body class="bg-body">
	<div class="container row-offcanvas row-offcanvas-left">
		<div class="well column col-lg-12 col-sm-12 col-xs-12" id="content">
			<div class="row pt-3 pb-3 mb-3">


				<div class="col-lg-12 col-sm-12 col-xs-12 gx-3">
					<div class="card">
						<div class="card-header">Strike Scout Form</div>
						<div class="card-body">

							<div id="alertPlaceholder"></div>

							<div class="mb-3">
								<text class="form-label">Team Number: </text>
								<input type="text" class="form-control" id="strikeTeamNumber" name="strikeTeamNumber" placeholder=" ">
							</div>

							<div class="mb-3">
								<br><text class="form-label">Vibe Check:</text>
							</div>
							<select name="vibes" id="vibes">
								<option value="bad">1- Bad Vibes</option>
								<option value="neutral">3 - Neutral Vibes</option>
								<option value="great">5 - Great Vibes</option>
							</select>
							
							<div class="mb-3">
								<br><text class="form-label">Bumper Check:</text>
							</div>
							<select name="bumpers" id="bumpers">
								<option value="bad">1- Bad Quality/Mounting</option>
								<option value="average">3 - Average Quality/Mounting</option>
								<option value="great">5 - Great Quality/Mounting</option>
							</select>
							
							<div class="mb-3">
								<br><text class="form-label">Mechanical Robustness:</text>
							</div>
							<select name="mechRobustness" id="mechRobustness">
								<option value="poor">1- Poor</option>
								<option value="average">3 - Average</option>
								<option value="good">5 - Good</option>
							</select>
							
							<div class="mb-3">
								<br><text class="form-label">Electrical Robustness:</text>
							</div>
							<select name="elecRobustness" id="elecRobustness">
								<option value="poor">1- Poor</option>
								<option value="average">3 - Average</option>
								<option value="good">5 - Good</option>
							</select>

							<div class="mb-3">
								<br><text class="form-label">Other Comments:</text>
								<input type="text" class="form-control" id="strikeComments" name="strikeComments" placeholder="Comments">
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
				var data = getstrikeInputData();
				console.log(data);
				var validData = validateFormData(data);
				if (validData) {
					// Create POST request.
					$.post("writeAPI.php", {
							"writeStrikeScoutData": JSON.stringify(data)
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
				if (!data['strikeTeamNumber']) {
					createErrorAlert('Team number not valid.');
					valid = false;
				}

				return valid;
			}

			function clearForm() {
				$('#strikeTeamNumber').val('');
				$('#vibes').val('bad');
				$('#bumpers').val('bad');
				$('#mechRobustness').val('poor');
				$('#elecRobustness').val('poor');
				$('#strikeComments').val('');
			}

			function getstrikeInputData() {
				/* Gets values from HTML form and formats as dictionary. */
				var data = {};
				data['strikeTeamNumber'] = $('#strikeTeamNumber').val();
				data['vibes'] = $('#vibes').val();
				data['bumpers'] = $('#bumpers').val();
				data['mechRobustness'] = $('#mechRobustness').val(); // Either form input or 0 if no form input
				data['elecRobustness'] = $('#elecRobustness').val(); // Either form input or 0 if no form input
				data['strikeComments'] = $('#strikeComments').val() || ""; // Either form input or 0 if no form input
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