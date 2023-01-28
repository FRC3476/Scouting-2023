<title>Simple Match Form</title>
<html lang="en">

<?php include('navbar.php'); ?>

<body class="bg-body">
  <div class="container row-offcanvas row-offcanvas-left">
    <div class="well column col-lg-12 col-sm-12 col-xs-12" id="content">
      <div class="row pt-3 pb-3 mb-3">
      
        <!-- Left column -->
        <div class="col-lg-12 col-sm-12 col-xs-12 gx-3">
          <div class="card">
            <div class="card-header">Simple Match Form</div>
            <div class="card-body">
            
              <div id="alertPlaceholder"></div>
              
              <button id="submit" class="btn btn-primary">Submit</button>
            
              <div class="mb-3">
                <label for="scoutName" class="form-label">Scout Name</label>
                <input type="text" class="form-control" id="scoutName" aria-describedby="scoutName">
              </div>
              
              <div class="mb-3">
                <label for="matchNumber" class="form-label">Match Number</label>
                <input type="text" class="form-control" id="matchNumber" aria-describedby="matchNumber">
              </div>
              
              <div class="mb-3">
                <label for="teamNumber" class="form-label">Team Number</label>
                <input type="text" class="form-control" id="teamNumber" aria-describedby="teamNumber">
              </div>
              
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="autoMobility">
                <label class="form-check-label" for="autoMobility">
                  Team Exited Community In Auto?
                </label>
              </div>
              
              <div class="mb-3">
                <label for="autoConeLevel1" class="form-label">Auto Cone Level 1</label>
                <input type="text" class="form-control" id="autoConeLevel1" aria-describedby="autoConeLevel1">
              </div>
              
              <div class="mb-3">
                <label for="autoConeLevel2" class="form-label">Auto Cone Level 2</label>
                <input type="text" class="form-control" id="autoConeLevel2" aria-describedby="autoConeLevel2">
              </div>
              
              <div class="mb-3">
                <label for="autoConeLevel3" class="form-label">Auto Cone Level 3</label>
                <input type="text" class="form-control" id="autoConeLevel3" aria-describedby="autoConeLevel3">
              </div>
              
              <div class="mb-3">
                <label for="autoCubeLevel1" class="form-label">Auto Cube Level 1</label>
                <input type="text" class="form-control" id="autoCubeLevel1" aria-describedby="autoCubeLevel1">
              </div>
              
              <div class="mb-3">
                <label for="autoCubeLevel2" class="form-label">Auto Cube Level 2</label>
                <input type="text" class="form-control" id="autoCubeLevel2" aria-describedby="autoCubeLevel2">
              </div>
              
              <div class="mb-3">
                <label for="autoCubeLevel3" class="form-label">Auto Cube Level 3</label>
                <input type="text" class="form-control" id="autoCubeLevel3" aria-describedby="autoCubeLevel3">
              </div>
              
              <div class="mb-3">
                <label for="autoChargeStation" class="form-label">Auto Charge Station State</label>
                <select id="autoChargeStation" class="form-select" aria-label="Asd">
                  <option value="NONE" selected>Not on Charge Station</option>
                  <option value="DOCKED">Docking with Charge Station</option>
                  <option value="ENGAGED">Engaging with Charge Station</option>
                </select>
              </div>
              
                            <div class="mb-3">
                <label for="teleopConeLevel1" class="form-label">Teleop Cone Level 1</label>
                <input type="text" class="form-control" id="teleopConeLevel1" aria-describedby="teleopConeLevel1">
              </div>
              
              <div class="mb-3">
                <label for="teleopConeLevel2" class="form-label">Teleop Cone Level 2</label>
                <input type="text" class="form-control" id="teleopConeLevel2" aria-describedby="teleopConeLevel2">
              </div>
              
              <div class="mb-3">
                <label for="teleopConeLevel3" class="form-label">Teleop Cone Level 3</label>
                <input type="text" class="form-control" id="teleopConeLevel3" aria-describedby="teleopConeLevel3">
              </div>
              
              <div class="mb-3">
                <label for="teleopCubeLevel1" class="form-label">Teleop Cube Level 1</label>
                <input type="text" class="form-control" id="teleopCubeLevel1" aria-describedby="teleopCubeLevel1">
              </div>
              
              <div class="mb-3">
                <label for="teleopCubeLevel2" class="form-label">Teleop Cube Level 2</label>
                <input type="text" class="form-control" id="teleopCubeLevel2" aria-describedby="teleopCubeLevel2">
              </div>
              
              <div class="mb-3">
                <label for="teleopCubeLevel3" class="form-label">Teleop Cube Level 3</label>
                <input type="text" class="form-control" id="teleopCubeLevel3" aria-describedby="teleopCubeLevel3">
              </div>
              
              <div class="mb-3">
                <label for="teleopChargeStation" class="form-label">Teleop Charge Station State</label>
                <select id="teleopChargeStation" class="form-select" aria-label="Asd">
                  <option value="NONE" selected>Not on Charge Station</option>
                  <option value="DOCKED">Docking with Charge Station</option>
                  <option value="ENGAGED">Engaging with Charge Station</option>
                </select>
              </div>
              
              <div class="form-floating">
                <textarea class="form-control" placeholder="Canned" id="cannedComents"></textarea>
                <label for="cannedComents">Canned Comments</label>
              </div>
              
              
              <div class="form-floating">
              <textarea class="form-control" placeholder="Misc" id="miscComments"></textarea>
              <label for="miscComments">Misc Comments</label>
            </div>
              
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

<?php include("footer.php"); ?>

<script>

  function createErrorAlert(errorMessage){
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

  function createSuccessAlert(successMessage){
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

  function clearAlerts(){
    /* Clears all allerts in the placeholder. */
    $('#alertPlaceholder').empty();
  }

  function getMatchFormData(){
    /* Gets values from HTML form and formats as dictionary. */
    var data = {};
    data['scout'] = $('#scoutName').val();
    data['matchNumber'] = parseInt($('#matchNumber').val());
    data['teamNumber'] = parseInt($('#teamNumber').val());
    data['autoMobility'] = parseInt($('#autoMobility').is(':checked')) || 0;
    data['autoConeLevel1'] = parseInt($('#autoConeLevel1').val()) || 0; // Either form input or 0 if no form input
    data['autoConeLevel2'] = parseInt($('#autoConeLevel2').val()) || 0; // Either form input or 0 if no form input
    data['autoConeLevel3'] = parseInt($('#autoConeLevel3').val()) || 0; // Either form input or 0 if no form input
    data['autoCubeLevel1'] = parseInt($('#autoCubeLevel1').val()) || 0; // Either form input or 0 if no form input
    data['autoCubeLevel2'] = parseInt($('#autoCubeLevel2').val()) || 0; // Either form input or 0 if no form input
    data['autoCubeLevel3'] = parseInt($('#autoCubeLevel3').val()) || 0; // Either form input or 0 if no form input
    data['autoChargeStation'] = $('#autoChargeStation').val();
    data['teleopConeLevel1'] = parseInt($('#teleopConeLevel1').val()) || 0; // Either form input or 0 if no form input
    data['teleopConeLevel2'] = parseInt($('#teleopConeLevel2').val()) || 0; // Either form input or 0 if no form input
    data['teleopConeLevel3'] = parseInt($('#teleopConeLevel3').val()) || 0; // Either form input or 0 if no form input
    data['teleopCubeLevel1'] = parseInt($('#teleopCubeLevel1').val()) || 0; // Either form input or 0 if no form input
    data['teleopCubeLevel2'] = parseInt($('#teleopCubeLevel2').val()) || 0; // Either form input or 0 if no form input
    data['teleopCubeLevel3'] = parseInt($('#teleopCubeLevel3').val()) || 0; // Either form input or 0 if no form input
    data['teleopChargeStation'] = $('#teleopChargeStation').val();
    data['cannedComments'] = $('#cannedComents').val();
    data['textComments'] = $('#miscComments').val();
    return data;
  }

  function validateFormData(data){
    /* Return false and send error if not valid form data.
    
    Args:
      data: dictionary of values from form.
    */
    var valid = true;
    if (data['scout'] == ''){
      createErrorAlert('Scout name empty.');
      valid = false;
    }
    if (! data['matchNumber']){
      createErrorAlert('Match number not valid.');
      valid = false;
    }
    if (! data['teamNumber']){
      createErrorAlert('Team number not valid.');
      valid = false;
    }
    return valid;
  }

  function clearForm(){
    $('#matchNumber').val('');
    $('#teamNumber').val('');
    $('#autoMobility').prop('checked', false);
    $('#autoConeLevel1').val('');
    $('#autoConeLevel2').val('');
    $('#autoConeLevel3').val('');
    $('#autoCubeLevel1').val('');
    $('#autoCubeLevel2').val('');
    $('#autoCubeLevel3').val('');
    $('#autoChargeStation').val('NONE');
    $('#teleopConeLevel1').val('');
    $('#teleopConeLevel2').val('');
    $('#teleopConeLevel3').val('');
    $('#teleopCubeLevel1').val('');
    $('#teleopCubeLevel2').val('');
    $('#teleopCubeLevel3').val('');
    $('#teleopChargeStation').val('NONE');
    $('#cannedComents').val('');
    $('#miscComments').val('');
  }

  function submitData(){
    /* Gets data from form, validates it, and creates appropriate error messages. 

    Returns:
      True if successful, false if not.
    */
    clearAlerts();
    var data = getMatchFormData();
    var validData = validateFormData(data);
    if (validData){
      // Create POST request.
      $.post("writeAPI.php", {
        "writeSingleMatchData": JSON.stringify(data)
      }, function(success) {
        success = JSON.parse(success);
        if (success){
          createSuccessAlert('Form Submitted. Clearing form.');
          clearForm();
        }
        else {
          createErrorAlert('Form submitted to server but failed to process. Please try again or contact admin.');
        }
      })
      .fail(function (){
        createErrorAlert('Form submitted but failure on server side. Please try again or contact admin.');
      });
    }
  }

  $("#submit").on('click', function(event) {
    submitData();
  });

</script>

</html>