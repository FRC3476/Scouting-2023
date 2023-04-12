<html>
<?php include("navbar.php"); ?>
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
                <div id="alertPlaceholder"></div>
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
                                <form action="writeAPI.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <text class="col-lg-2 control-label">Team Number: </text>
                                        <div class="col-lg-10">
                                            <input type="number" class="form-control" id="teamNumber" name="teamNumber" placeholder=" " required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-lg-12 col-sm-12 col-xs-12">
                                        Select images to upload:
                                        <input type="file" name="fileToUpload" multiple id="fileToUpload" required>
                                        <input type="text" name="pitPictureUpload" value="1" hidden>
                                        <input id="PitScouting" type="submit" class="btn btn-primary" value="Submit Data" onclick="">
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
</body>

</html>

<script>

function createErrorAlert(errorMessage) {
    var alertValue = [`<div class="alert alert-danger alert-dismissible" role="alert">`,
      `  <div>${errorMessage}</div>`,
      `  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>`,
      `</div>`
    ].join('');
    $('#alertPlaceholder').append(alertValue);
  }

  function createSuccessAlert(successMessage) {
    var alertValue = [`<div class="alert alert-success alert-dismissible" role="alert">`,
      `  <div>${successMessage}</div>`,
      `  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>`,
      `</div>`
    ].join('');
    $('#alertPlaceholder').append(alertValue);
  }


function loadStatus(){
    const url = new URLSearchParams(window.location.search);
    if (url.has('message')){ // Check if message exists.
        var message = url.get("message");
        message = JSON.parse(message);
        if (message["success"]){
            createSuccessAlert(message['error']);
        }
        else{
            createErrorAlert(message['error']);
        }
    }
    
}

$(document).ready(function() {
  loadStatus();
});

</script>