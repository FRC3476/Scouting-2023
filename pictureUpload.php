<html>
<?php include("navBar.php"); ?>
<?php
$target_dir = "uploads/";
$target_file = $target_dir . $_POST["teamNumber"] . "." . time() . "." . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["teamNumber"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "<script>alert('The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded');</script>";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>
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
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <text class="col-lg-2 control-label">Team Number: </text>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" id="teamNumber" name="teamNumber" placeholder=" ">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-lg-12 col-sm-12 col-xs-12">
                                        Select images to upload:
                                        <input type="file" name="fileToUpload" multiple id="fileToUpload">
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