<html>
<?php include("navBar.php"); ?>


<body class="bg-body">
	<div class="container row-offcanvas row-offcanvas-left">
		<div class="well column col-lg-12 col-sm-12 col-xs-12" id="content">
			<div class="row pt-3 pb-3 mb-3">


				<div class="col-lg-12 col-sm-12 col-xs-12 gx-3">
					<div class="card">
						<div class="card-header">Pit Scout Form</div>
						<div class="card-body">


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
								<input type="text" class="form-control" id="pitTeamNumber" name="pitTeamNumber"
									placeholder=" ">
							</div>

							<div class="mb-3">
								<text class="form-label">Team Name: </text>
								<input type="text" class="form-control" id="pitTeamName" name="pitTeamName"
									placeholder=" ">
							</div>

							<div class="mb-3">
								<text class="form-label">Pit organization</text>
							</div>
							<div class="col-lg-10">
								<input type="radio" id="disorganized" name="organization" value="disorganized">
								<label for="disorganized">1 - Disorganized</label><br>
								<input type="radio" id="average" name="organization" value="average">
								<label for="disorganized">3 - Average</label><br>
								<input type="radio" id="pristine" name="organization" value="pristine">
								<label for="disorganized">5 - Pristine</label><br>
							</div>

							<div class="mb-3">
								<br><text class="form-label">How many working batteries did you bring?</text>
								<input type="text" class="form-control" id="numBatteries" name="numBatteries"
									placeholder=" ">
							</div>

							<div class="mb-3">
								<text class="form-label">How many batteries can you charge at once?</text>
								<input type="number" class="form-control" id="chargedBatteries" name="chargedBatteries"
									placeholder=" ">
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
								<input type="text" class="form-control" id="framePerimeterDimensions"
									name="framePerimeterDimensions" placeholder=" ">
								<br>
							</div>

							<div class="col-lg-2">
								<br><text class="form-label">Other Comments:</text>
								<input type="text" class="form-control" id="pitComments" name="pitComments"
									placeholder=" ">
								<br>
							</div>

							<div class="col-lg-12 col-sm-12 col-xs-12">
								<input id="PitScouting" type="submit" class="btn btn-primary" value="Submit Data"
									onclick="">

							</div>
							<br>
						</div>
					</div>
				</div>
			</div>

		</div>




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





		<?php include("footer.php"); ?>

		<script>

			

function createErrorAlert(errorMessage) {
				/* Creats a Error alert. 
				
				Args:
				  successMessage: String of message to send.
				*/
				var alertValue = [`<div class="alert alert-danger alert-dismissible" role="alert">`,
					`  <div>${errorMessage}</div>`,
					`  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>`,
					`</div>`].join('');
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
					`</div>`].join('');
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
				$('#pitTeamNumber').val('');
				$('#numBatteries').val('');
				$('#chargedBatteries').val('');
				$('#codeLanguage').val('Java');
				$('#autoPath').val('');
				$('#framePerimeterDimensions').val('');
				$('#pitComments').val('');
			}
			


			function getpitInputData() {
				/* Gets values from HTML form and formats as dictionary. */
				var data = {};
				data['pitTeamName'] = $('#pitTeamName').val();
				data['pitTeamNumber'] = parseInt($('#pitTeamNumber').val());
				data['numBatteries'] = parseInt($('#numBatteries').val());
				data['chargedBatteries'] = parseInt($('#chargedBatteries').val()) || 0; // Either form input or 0 if no form input
				data['codeLanguage'] = parseInt($('#codeLanguage').val()) || 0; // Either form input or 0 if no form input
				data['autoPath'] = parseInt($('#autoPath').val()) || 0; // Either form input or 0 if no form input
				data['framePerimeterDimensions'] = parseInt($('#framePerimeterDimensions').val()) || 0; // Either form input or 0 if no form input
				data['pitComments'] = parseInt($('#pitComments').val()) || 0; // Either form input or 0 if no form input
				return data;
			}
			console.log(pitTeamName);

		</script>

</html>