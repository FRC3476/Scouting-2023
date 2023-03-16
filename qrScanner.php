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
                <button id="submitData" type="button" class="btn btn-success">Upload Data</button>
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

var scannedData = {};
var scannedCount = 0;

function alertSuccessfulScan() {
  // try {window.navigator.vibrate(200);}
  // catch (exception) {}
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
  return dataList.length == 19;
}

function qrListToKey(dataObj) {
  return dataObj["matchNumber"] + "_" + dataObj["teamNumber"];
}

function addQrData(dataObj) {
  console.log(dataObj);
  var matchKey = qrListToKey(dataObj);
  if (!scannedData.hasOwnProperty(matchKey)){
    scannedData[matchKey] = dataObj;
    scannedCount++;
    $('#submitData').html(`Submit Data: ${scannedCount}`);
    var rows =
      [`<tr id='${matchKey}_row'>`,
      ` <td>${dataObj['scout']}</td>`,
      ` <td>${dataObj['matchNumber']}</td>`,
      ` <td>${dataObj['teamNumber']}</td>`,
      ` <td><button id='${matchKey}_delete' value='${matchKey}' type='button' class='btn btn-danger deleteRowButton'>Delete</button></td>`,
      `</tr>`].join('');
    $('#verificationTableBody').append(rows);
    $(`#${matchKey}_delete`).on('click', function(event){
      removeQrData($(this).val());
    });
  }
}

function removeQrData(dataKey) {
  console.log(dataKey);
  if (scannedData.hasOwnProperty(dataKey)) {
    delete scannedData[dataKey];
    --scannedCount;
    $("#submitData").html(`Submit Data: ${scannedCount}`);
    $(`#${dataKey}_row`).remove();
  }
}

function clearData(){
  $("#verificationTableBody").html("");
  scannedCount = 0;
  scannedData = {};
  $("#submitData").html(`Submit Data: ${scannedCount}`);
}

function submitData(){
  var dataList = []
  for (const [key, value] of Object.entries(scannedData)){
    dataList.push(value);
  }
  $.post('writeAPI.php', {
    'writeDataList': JSON.stringify(dataList)
  }, function(data){
    data = JSON.parse(data);
    if (data['success']){
      alert('Data Successfully Submitted! Clearing Data.')
      clearData();
    }
    else {
      alert('Data not submitted!');
    }
  })
}

function uncompressDataList(dataList){
  var out = {};
  out['scout'] = dataList[0];
  out['matchNumber'] = dataList[1];
  out['teamNumber'] = dataList[2];
  out['autoMobility'] = dataList[3];
  out['autoConeLevel1'] = dataList[4];
  out['autoConeLevel2'] = dataList[5];
  out['autoConeLevel3'] = dataList[6];
  out['autoCubeLevel1'] = dataList[7];
  out['autoCubeLevel2'] = dataList[8];
  out['autoCubeLevel3'] = dataList[9];
  out['autoChargeStation'] = dataList[10];
  out['teleopConeLevel1'] = dataList[11];
  out['teleopConeLevel2'] = dataList[12];
  out['teleopConeLevel3'] = dataList[13];
  out['teleopCubeLevel1'] = dataList[14];
  out['teleopCubeLevel2'] = dataList[15];
  out['teleopCubeLevel3'] = dataList[16];
  out['teleopChargeStation'] = dataList[17];
  out['cannedComments'] = dataList[18];
  out['textComments'] = '';
  return out;
}

function scanCamera(reader, id) {
  reader.decodeFromInputVideoDeviceContinuously(id, 'camera', (result, err) => {
    if (result) {
      console.log(result.text);
      var dataList = JSON.parse(result.text);
      console.log(dataList);
      console.log("scanCamera: dataList = "+dataList);
      if (validateQrList(dataList)) {
        console.log('valid');
        var uncompressedList = uncompressDataList(dataList);
        alertSuccessfulScan();
	      addQrData(uncompressedList);
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

$('#submitData').on('click', function(){
  submitData();
});

</script>

</html>