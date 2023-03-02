<title>Match Data</title>
<html lang="en">

<?php include('navbar.php'); ?>

<body class="bg-body">
  <div class="container row-offcanvas row-offcanvas-left">
    <div class="well column col-lg-12 col-sm-12 col-xs-12" id="content">
      <div class="row pt-3 pb-3 mb-3">
      
        <!-- Left column -->
        <div class="col-lg-12 col-sm-12 col-xs-12 gx-3">
          <div class="card">
            <div class="card-body">

              <div class="row">
                <select id="cameraSelect" class="form-select form-select mb-3" aria-label=".form-select-lg example">
                </select>
              </div>

              <br>

              <div class="row pt-3 pb-3 mb-3">
                <div id="interactive" class="viewport">
                  <video autoplay="true" id="camera">
                </div>
              </div>

              <br>

              <div class="table-responsive">
                <table id='verificationTable' class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">Scouter</th>
                      <th scope="col">Match</th>
                      <th scope="col">Team</th>
                      <th scope="col">Delete</th>
                    </tr>
                  </thead>
                  <tbody id='verificationTableBody'>
                  </tbody>
                </table>
              </div>
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

<?php include("footer.php"); ?>

<script type="text/javascript" src="js/zxing.min.js"></script>

<script>

function alertSuccessfulScan() {
  try {window.navigator.vibrate(200);}
  catch (exception) {}
  $("#content").addClass("bg-success");
  var timeoutFunction = setTimeout(function () { $("#content").removeClass("bg-success"); }, 500);
}


function setDefaultDeviceID(id) {
  localStorage.setItem("cameraDefaultID", id);
}

function getDefaultDeviceID(id) {
  var defaultId = localStorage.getItem("cameraDefaultID");
  if (defaultId == null) {
    return id;
  }
  return defaultId;
}

function validateQrList(dataList) {
  /* Do more validation. */
  return true;
}

function addQrData(dataObj) {

}

function scanCamera(reader, id) {
  reader.decodeFromInputVideoDeviceContinuously(id, 'camera', (result, err) => {
    if (result) {
      console.log(result.text);
      return;
      var dataList = JSON.parse(result.text);
      console.log("scanCamera: dataList = "+dataList);
      if (validateQrList(dataList)) {
        alertSuccessfulScan();
	      addQrData(dataList);
      }
      else {
        alert("Error! Check QR code.");
      }
    }
  });
}

function createCameraSelect(reader) {
  reader.getVideoInputDevices().then((videoInputDevices) => {

    // Creates drop down menu to switch between cameras
    var initial_id = null;
    if (videoInputDevices.length >= 1) {
      videoInputDevices.forEach((element) => {
        if (initial_id == null) {
          initial_id = element.deviceId;
        }
        $("#cameraSelect").append($('<option>', { value: element.deviceId, text: element.label }));
      });
    }

    // Creates default camera scanner based on saved data
    scanCamera(reader, getDefaultDeviceID(initial_id));

    // Binds drop down on change to select new camera when necessary
    $("#cameraSelect").change(function () {
      var selCamID = $("#cameraSelect").val();
      scanCamera(reader, selCamID);
      setDefaultDeviceID(selCamID);
    });
  });
}

$(document).ready(function () {
  const reader = new ZXing.BrowserQRCodeReader();
  createCameraSelect(reader);
});

</script>

</html>