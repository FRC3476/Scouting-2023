<html>
<?php include("navbar.php"); ?>


<body class="bg-body">
	<div class="container row-offcanvas row-offcanvas-left">
		<div class="well column col-lg-12 col-sm-12 col-xs-12" id="content">
			<div class="row pt-3 pb-3 mb-3">


				<div class="col-lg-12 col-sm-12 col-xs-12 gx-3">
					<div class="card">
						<div class="card-header">Lead Scout Form</div>
						<div class="card-body">

							<div id="alertPlaceholder"></div>


							<div class="mb-3">
								<text class="form-label">Match Number</text>
								<input type="text" class="form-control" id="matchNum" name="matchNum" placeholder=" ">
							</div>
							<div class="mb-3">
								<text class="form-label">Team 1</text>
								<input type="text" class="form-control" id="team1" name="team1" placeholder=" ">
							</div>

							<div class="mb-3">
								<text class="form-label">Team 2</text>
								<input type="text" class="form-control" id="team2" name="team2" placeholder=" ">
							</div>

							<div class="mb-3">
								<text class="form-label">Team 3</text>
								<input type="text" class="form-control" id="team3" name="team3" placeholder=" ">
							</div>
							<div class="mb-3">
								<text class="form-label">Team 4</text>
								<input type="text" class="form-control" id="team4" name="team4" placeholder=" ">
							</div>
							<div class="mb-3">
								<text class="form-label">Team 5</text>
								<input type="text" class="form-control" id="team5" name="team5" placeholder=" ">
							</div>
							<div class="mb-3">
								<text class="form-label">Team 6</text>
								<input type="text" class="form-control" id="team6" name="team6" placeholder=" ">
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
				var data = getLeadScoutFormData();
				console.log(data);
				var validData = validateFormData(data);
				if (validData) {
					// Create POST request.
					$.post("writeAPI.php", {
						"writeLSData": JSON.stringify(data)
					}, function (data) {
						data = JSON.parse(data);
						if (data["success"]) {
							createSuccessAlert('Form Submitted. Clearing form.');
							location.reload();
						}
						else {
							createErrorAlert('Form submitted to server but failed to process. Please try again or contact admin.');
							createErrorAlert(JSON.stringify(data["error"]));
						}
					})
						.fail(function () {
							createErrorAlert('Form submitted but failure on server side. Please try again or contact admin.');
						});
				}
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
				if (data) {
					createErrorAlert('Missing data');
					valid = true;



				}
				return valid;
			}

			function clearForm() {
				$('#matchNum').val('');
				$('#team1').val('');
				$('#team2').val('');
				$('#team3').val('');
				$('#team4').val('');
				$('#team5').val('');
				$('#team6').val('');
			}

			function getLeadScoutFormData() {
				/* Gets values from HTML form and formats as dictionary. */
				var data = {};
				data['matchNum'] = parseInt($('#matchNum').val());
				data['team1'] = parseInt($('#team1').val());
				data['team2'] = parseInt($('#team2').val());
				data['team3'] = parseInt($('#team3').val());
				data['team4'] = parseInt($('#team4').val());;
				data['team5'] = parseInt($('#team5').val());;
				data['team6'] = parseInt($('#team6').val());;
				return data;
			}

			$("#submit").on('click', function (event) {
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