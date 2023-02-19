<html>
<?php include("navBar.php"); ?>

<style>
    #overallForm {
        font-size: 15px;
        display: inline-block;
    }
</style>

<body class="bg-body">
    <script>
        function submitButton() {
            
        }
        </script>
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
                                <form action="javascript:void(0);" method="post" enctype="multipart/form-data">
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