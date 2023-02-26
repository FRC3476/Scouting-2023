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
            <div class="card-header">Match Form</div>
            <div class="card-body">

              <div id="alertPlaceholder"></div>

              <ul class="nav nav-tabs" id="matchTabs" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login-tab-pane" type="button" role="tab" aria-controls="login-tab-pane" aria-selected="true">Log-in</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="auto-tab" data-bs-toggle="tab" data-bs-target="#auto-tab-pane" type="button" role="tab" aria-controls="auto-tab-pane" aria-selected="false">Auto Scouting</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="teleop-tab" data-bs-toggle="tab" data-bs-target="#teleop-tab-pane" type="button" role="tab" aria-controls="teleop-tab-pane" aria-selected="false">Teleop Scouting</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="teleop-tab" data-bs-toggle="tab" data-bs-target="#endgame-tab-pane" type="button" role="tab" aria-controls="endgame-tab-pane" aria-selected="false">Endgame</button>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <!--Login Tab-->
                <div class="tab-pane fade show active" id="login-tab-pane" role="tabpanel" aria-labelledby="login-tab" tabindex="0">
                  <br>
                  <br>
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
                </div>

                <!--Auto Scouting-->
                <div class="tab-pane fade" id="auto-tab-pane" role="tabpanel" aria-labelledby="auto-tab" tabindex="0">
                  <br>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="autoMobility">
                    <label class="form-check-label" for="autoMobility">
                      Mobility Completed?
                    </label>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-5">
                      <h2 style="text-align: center"> Cone </h2>
                      <button class="disable-dbl-tap-zoom-yellow" type="button" onClick="updateAConeUpper()" id="bigFont">Top <a id="buttonAConeUpper" class="enlargedtext"></a></button>
                      <br>
                      <button class="disable-dbl-tap-zoom-yellow" type="button" onClick="updateAConeMid()" id="bigFont">Middle <a id="buttonAConeMid" class="enlargedtext"></a></button>
                      <br>
                      <button class="disable-dbl-tap-zoom-yellow" type="button" onClick="updateAConeLower()" id="bigFont">Bottom <a id="buttonAConeLower" class="enlargedtext"></a></button>
                      <br>
                    </div>
                    <div class="col-md-5">
                      <h2 style="text-align: center"> Cube </h2>
                      <button class="disable-dbl-tap-zoom-purple" type="button" onClick="updateACubeUpper()" id="bigFont">Top <a id="buttonACubeUpper" class="enlargedtext"></a></button>
                      <br>
                      <button class="disable-dbl-tap-zoom-purple" type="button" onClick="updateACubeMid()" id="bigFont">Middle <a id="buttonACubeMid" class="enlargedtext"></a></button>
                      <br>
                      <button class="disable-dbl-tap-zoom-purple" type="button" onClick="updateACubeLower()" id="bigFont">Bottom <a id="buttonACubeLower" class="enlargedtext"></a></button>
                      <br>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <br>
                    <button class="disable-dbl-tap-zoom-danger" type="button" onClick="makeIncrementFalse()" id="bigFont">Subtract: <a id="negativeAIncrementButton" class="enlargedtext"></a></button>
                  </div>
                  <br>
                  <div class="mb-3">
                    <label for="autoChargeStation" class="form-label">Auto Charge Station State</label>
                    <select id="autoChargeStation" class="form-select" aria-label="Asd">
                      <option value="NONE" selected>Not on Charge Station</option>
                      <option value="DOCKED">Docking with Charge Station</option>
                      <option value="ENGAGED">Engaging with Charge Station</option>
                    </select>
                  </div>
                </div>

                <!--Teleop Scouting-->
                <div class="tab-pane fade" id="teleop-tab-pane" role="tabpanel" aria-labelledby="teleop-tab" tabindex="0">
                  <br>
                  <br>
                  <div class="row">
                    <div class="col-md-5">
                      <h2 style="text-align: center"> Cone </h2>
                      <button class="disable-dbl-tap-zoom-yellow" type="button" onClick="updateTConeUpper()" id="bigFont">Top <a id="buttonTConeUpper" class="enlargedtext"></a></button>
                      <br>
                      <button class="disable-dbl-tap-zoom-yellow" type="button" onClick="updateTConeMid()" id="bigFont">Middle <a id="buttonTConeMid" class="enlargedtext"></a></button>
                      <br>
                      <button class="disable-dbl-tap-zoom-yellow" type="button" onClick="updateTConeLower()" id="bigFont">Bottom <a id="buttonTConeLower" class="enlargedtext"></a></button>
                      <br>
                    </div>
                    <br>
                    <div class="col-md-5">
                      <h2 style="text-align: center"> Cube </h2>
                      <button class="disable-dbl-tap-zoom-purple" type="button" onClick="updateTCubeUpper()" id="bigFont">Top <a id="buttonTCubeUpper" class="enlargedtext"></a></button>
                      <br>
                      <button class="disable-dbl-tap-zoom-purple" type="button" onClick="updateTCubeMid()" id="bigFont">Middle <a id="buttonTCubeMid" class="enlargedtext"></a></button>
                      <br>
                      <button class="disable-dbl-tap-zoom-purple" type="button" onClick="updateTCubeLower()" id="bigFont">Bottom <a id="buttonTCubeLower" class="enlargedtext"></a></button>
                    </div>
                  </div>
                  <div class="center">
                    <br>
                    <button class="disable-dbl-tap-zoom-danger" type="button" onClick="makeTIncrementFalse()" id="bigFont">Subtract: <a id="negativeTIncrementButton" class="enlargedtext"></a></button>
                  </div>
                </div>
                <!--Endgame Scouting-->
                <div class="tab-pane fade" id="endgame-tab-pane" role="tabpanel" aria-labelledby="endgame-tab" tabindex="0">
                  <br>
                  <div class="mb-3">
                    <label for="teleopChargeStation" class="form-label">Teleop Charge Station State</label>
                    <select id="teleopChargeStation" class="form-select" aria-label="Asd">
                      <option value="NONE" selected>Not on Charge Station</option>
                      <option value="DOCKED">Docking with Charge Station</option>
                      <option value="ENGAGED">Engaging with Charge Station</option>
                    </select>
                  </div>
                  <br>
                  <a>Comments</a>
                  <div class="col-md-12">
                    <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="cannedComments">
                      <span class="badge rounded-pill text-bg-primary cannedComments">Slow Drive</span>
                      <span class="badge rounded-pill text-bg-primary cannedComments">Fast Drive</span>
                      <span class="badge rounded-pill text-bg-primary cannedComments">Good Defense</span>
                      <span class="badge rounded-pill text-bg-primary cannedComments">Bad Defense</span>
                      <span class="badge rounded-pill text-bg-primary cannedComments">Fast Cycle</span>
                      <span class="badge rounded-pill text-bg-primary cannedComments">Slow Cycle</span>
                      <span class="badge rounded-pill text-bg-primary cannedComments">Tipped</span>
                      <span class="badge rounded-pill text-bg-primary cannedComments">Drops Game Pieces</span>
                      <span class="badge rounded-pill text-bg-primary cannedComments">Bad Driving</span>
                      <span class="badge rounded-pill text-bg-primary cannedComments">Good Driving</span>
                      <span class="badge rounded-pill text-bg-primary cannedComments">Stuck on Charge Station</span>
                      <span class="badge rounded-pill text-bg-primary cannedComments">Can Pick Up Fallen Cones</span>
                      <span class="badge rounded-pill text-bg-primary cannedComments">Good Defense</span>
                      <span class="badge rounded-pill text-bg-primary cannedComments">Bad Defense</span>
                      <span class="badge rounded-pill text-bg-primary cannedComments">Can Balance in Auto</span>
                      <span class="badge rounded-pill text-bg-primary cannedComments">Floor Pickup</span>
                      <span class="badge rounded-pill text-bg-primary cannedComments">Human Player Pick</span>
                      <span class="badge rounded-pill text-bg-primary cannedComments">DNP</span>
                      <br><br>
                    </div>
                    <br>
                    <div class="form-floating">
                      <textarea class="form-control" placeholder="Misc" id="miscComments"></textarea>
                      <label for="miscComments">Comments</label>
                    </div>
                    <br>
                    <div class="col-md-3">
                      <button id="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </div>
                </div>
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
  // Var
  aConeLower = 0;
  aConeMid = 0;
  aConeUpper = 0;
  aCubeLower = 0;
  aCubeMid = 0;
  aCubeUpper = 0;

  tConeLower = 0;
  tConeMid = 0;
  tConeUpper = 0;
  tCubeLower = 0;
  tCubeMid = 0;
  tCubeUpper = 0;

  isIncrement = true;
  makeIncrementTrue();

  // Auto Functions
  function updateAConeLower() {
    if (isIncrement == true) {
      aConeLower++;
    } else {
      if (aConeLower != 0) {
        aConeLower--;
        makeIncrementTrue();
      } else {
        makeIncrementTrue();
      }
    }
    document.getElementById("buttonAConeLower").innerHTML = aConeLower;
    console.log(aConeLower);
  }

  function updateAConeMid() {
    if (isIncrement == true) {
      aConeMid++;
    } else {
      if (aConeMid != 0) {
        aConeMid--;
        makeIncrementTrue();
      } else {
        makeIncrementTrue();
      }
    }
    document.getElementById("buttonAConeMid").innerHTML = aConeMid;
    console.log(aConeMid);
  }

  function updateAConeUpper() {
    if (isIncrement == true) {
      aConeUpper++;
    } else {
      if (aConeUpper != 0) {
        aConeUpper--;
        makeIncrementTrue();
      } else {
        makeIncrementTrue();
      }
    }
    document.getElementById("buttonAConeUpper").innerHTML = aConeUpper;
    console.log(aConeUpper);
  }

  function updateACubeLower() {
    if (isIncrement == true) {
      aCubeLower++;
    } else {
      if (aCubeLower != 0) {
        aCubeLower--;
        makeIncrementTrue();
      } else {
        makeIncrementTrue();
      }
    }
    document.getElementById("buttonACubeLower").innerHTML = aCubeLower;
    console.log(aCubeLower);
  }

  function updateACubeMid() {
    if (isIncrement == true) {
      aCubeMid++;
    } else {
      if (aCubeMid != 0) {
        aCubeMid--;
        makeIncrementTrue();
      } else {
        makeIncrementTrue();
      }
    }
    document.getElementById("buttonACubeMid").innerHTML = aCubeMid;
    console.log(aCubeMid);
  }

  function updateACubeUpper() {
    if (isIncrement == true) {
      aCubeUpper++;
    } else {
      if (aCubeUpper != 0) {
        aCubeUpper--;
        makeIncrementTrue();
      } else {
        makeIncrementTrue();
      }
    }
    document.getElementById("buttonACubeUpper").innerHTML = aCubeUpper;
    console.log(aCubeUpper);
  }
  // Teleop Functions
  function updateTConeLower() {
    if (isIncrement == true) {
      tConeLower++;
    } else {
      if (tConeLower != 0) {
        tConeLower--;
        makeTIncrementTrue();
      } else {
        makeTIncrementTrue();
      }
    }
    document.getElementById("buttonTConeLower").innerHTML = tConeLower;
    console.log(tConeLower);
  }

  function updateTConeMid() {
    if (isIncrement == true) {
      tConeMid++;
    } else {
      if (tConeMid != 0) {
        tConeMid--;
        makeTIncrementTrue();
      } else {
        makeTIncrementTrue();
      }
    }
    document.getElementById("buttonTConeMid").innerHTML = tConeMid;
    console.log(tConeMid);
  }

  function updateTConeUpper() {
    if (isIncrement == true) {
      tConeUpper++;
    } else {
      if (tConeUpper != 0) {
        tConeUpper--;
        makeTIncrementTrue();
      } else {
        makeTIncrementTrue();
      }
    }
    document.getElementById("buttonTConeUpper").innerHTML = tConeUpper;
    console.log(tConeUpper);
  }

  function updateTCubeLower() {
    if (isIncrement == true) {
      tCubeLower++;
    } else {
      if (tCubeLower != 0) {
        tCubeLower--;
        makeTIncrementTrue();
      } else {
        makeTIncrementTrue();
      }
    }
    document.getElementById("buttonTCubeLower").innerHTML = tCubeLower;
    console.log(tCubeLower);
  }

  function updateTCubeMid() {
    if (isIncrement == true) {
      tCubeMid++;
    } else {
      if (tCubeMid != 0) {
        tCubeMid--;
        makeTIncrementTrue();
      } else {
        makeTIncrementTrue();
      }
    }
    document.getElementById("buttonTCubeMid").innerHTML = tCubeMid;
    console.log(tCubeMid);
  }

  function updateTCubeUpper() {
    if (isIncrement == true) {
      tCubeUpper++;
    } else {
      if (tCubeUpper != 0) {
        tCubeUpper--;
        makeTIncrementTrue();
      } else {
        makeTIncrementTrue();
      }
    }
    document.getElementById("buttonTCubeUpper").innerHTML = tCubeUpper;
    console.log(tCubeUpper);
  }
  // Increment Functions
  function makeIncrementFalse() {
    isIncrement = false;
    document.getElementById("negativeAIncrementButton").innerHTML = -1;
  }

  function makeIncrementTrue() {
    isIncrement = true;
    document.getElementById("negativeAIncrementButton").innerHTML = 1;
  }

  function makeTIncrementFalse() {
    isIncrement = false;
    document.getElementById("negativeTIncrementButton").innerHTML = -1;
  }

  function makeTIncrementTrue() {
    isIncrement = true;
    document.getElementById("negativeTIncrementButton").innerHTML = 1;
  }


  // Comment Functions
  function getCannedComments() {
    /* Return list of canned comments based on if they have the 'selected' class. */
    var comments = [];
    $('.selected').each(function(i, obj) { // Iterates through each object with element 'selected'.
      comments.push($(this).text()); // this returns to the current element with class 'selected'.
    });
    return comments.toString();
  }

  // Binds all HTML dom objects with class 'cannedComments' to run the function when clicked
  $('.cannedComments').on('click', function(event) {
    var isSelected = $(this).hasClass('selected'); // Check if clicked badge has 'selected' class.
    if (isSelected) {
      // If previously selected, remove the class and make primary.
      $(this).removeClass('text-bg-success selected');
      $(this).addClass('text-bg-primary');
    } else {
      // If not selected, make selected and add class + change color.
      $(this).removeClass('text-bg-primary');
      $(this).addClass('text-bg-success selected');
    }
  });


  // Backend Functions
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

  function getMatchFormData() {
    /* Gets values from HTML form and formats as dictionary. */
    var data = {};
    data['scout'] = $('#scoutName').val();
    data['matchNumber'] = parseInt($('#matchNumber').val());
    data['teamNumber'] = parseInt($('#teamNumber').val());
    var mobile = $('#autoMobility').is(':checked');
    //data['autoMobility'] needs to be an integer when not checked.
    if (!mobile) mobile = 0;
    data['autoMobility'] = mobile;
    data['autoConeLevel1'] = aConeLower; // Either form input or 0 if no form input
    data['autoConeLevel2'] = aConeMid; // Either form input or 0 if no form input
    data['autoConeLevel3'] = aConeUpper; // Either form input or 0 if no form input
    data['autoCubeLevel1'] = aCubeLower; // Either form input or 0 if no form input
    data['autoCubeLevel2'] = aCubeMid; // Either form input or 0 if no form input
    data['autoCubeLevel3'] = aCubeUpper; // Either form input or 0 if no form input
    data['autoChargeStation'] = $('#autoChargeStation').val();
    data['teleopConeLevel1'] = tConeLower; // Either form input or 0 if no form input
    data['teleopConeLevel2'] = tConeMid; // Either form input or 0 if no form input
    data['teleopConeLevel3'] = tConeUpper; // Either form input or 0 if no form input
    data['teleopCubeLevel1'] = tCubeLower; // Either form input or 0 if no form input
    data['teleopCubeLevel2'] = tCubeMid; // Either form input or 0 if no form input
    data['teleopCubeLevel3'] = tCubeUpper; // Either form input or 0 if no form input
    data['teleopChargeStation'] = $('#teleopChargeStation').val();
    data['cannedComments'] = getCannedComments();
    data['textComments'] = $('#miscComments').val();
    return data;
  }

  function validateFormData(data) {
    /* Return false and send error if not valid form data.
    
    Args:
      data: dictionary of values from form.
    */
    var valid = true;
    if (data['scout'] == '') {
      createErrorAlert('Scout name empty.');
      valid = false;
    }
    if (!data['matchNumber']) {
      createErrorAlert('Match number not valid.');
      valid = false;
    }
    if (!data['teamNumber']) {
      createErrorAlert('Team number not valid.');
      valid = false;
    }
    return valid;
  }

  function clearForm() {
    $('#scoutName').val('');
    $('#matchNumber').val('');
    $('#teamNumber').val('');
    $('#autoMobility').prop('checked', false);
    $('#buttonAConeLower').val('0');
    $('#buttonAConeMid').val('0');
    $('#buttonAConeUpper').val('0');
    $('#buttonACubeLower').val('0');
    $('#buttonACubeMid').val('0');
    $('#buttonACubeUpper').val('0');
    $('#autoChargeStation').val('NONE');
    $('#buttonTConeLower').val('0');
    $('#buttonTConeMid').val('0');
    $('#buttonTConeUpper').val('0');
    $('#buttonTCubeLower').val('0');
    $('#buttonTCubeMid').val('0');
    $('#buttonTCubeUpper').val('0');
    $('#teleopChargeStation').val('NONE');
    $('#cannedComents').val('');
    $('#miscComments').val('');
  }

  function submitData() {
    /* Gets data from form, validates it, and creates appropriate error messages. 

    Returns:
      True if successful, false if not.
    */
    clearAlerts();
    var data = getMatchFormData();
    console.log(data);
    var validData = validateFormData(data);
    if (validData) {
      // Create POST request.
      $.post("writeAPI.php", {
          "writeSingleMatchData": JSON.stringify(data)
        }, function(data) {
          data = JSON.parse(data);
          console.log(data);
          const success = data["success"];
          if (success) {
            createSuccessAlert('Form Submitted. Clearing form.');
            location.reload();
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

  $("#submit").on('click', function(event) {
    submitData();
  });
</script>
<style>
  .disable-dbl-tap-zoom-purple {
    touch-action: manipulation;
    background-color: rgb(159, 43, 104);
    color: white;
    border: 2px solid black;
    font-family: Helvetica;
    font-weight: bold;
    /*To get rid of weird 3D affect in some browsers*/
    border: solid rgb(159, 43, 104);
    height: 100px;
    width: 500px;
  }

  .disable-dbl-tap-zoom-yellow {
    touch-action: manipulation;
    background-color: rgb(222, 169, 24);
    color: white;
    border-radius: 2px solid black;
    font-family: Helvetica;
    font-weight: bold;
    /*To get rid of weird 3D affect in some browsers*/
    border: solid rgb(222, 169, 24);
    height: 100px;
    width: 500px;
  }

  .disable-dbl-tap-zoom-danger {
    touch-action: manipulation;
    background-color: rgb(245, 108, 108);
    color: white;
    border-radius: 2px;
    font-family: Helvetica;
    margin-left: 250px;
    font-weight: bold;
    /*To get rid of weird 3D affect in some browsers*/
    border: solid rgb(245, 108, 108);
    height: 50px;
    width: 500px;
  }
</style>

</html>