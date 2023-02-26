<title>Team Data</title>
<html lang="en">

<?php include('navbar.php'); 
require('dbHandler.php') ?>


<body class="bg-body">
    <div class="container row-offcanvas row-offcanvas-left">
        <div class="well column col-lg-12 col-sm-12 col-xs-12" id="content">
            <div class="row pt-3 pb-3 mb-3">
                <div class="col-lg-12 col-sm-12 col-xs-12 gx-3">
                    <div class="card">
                        <div class="card-header">Team Data</div>
                        <div class="card-body">

                            <div id="alertPlaceholder"></div>

                            <div class="mb-3">
                                <label for="teamNumber" class="form-label">Enter Team Number</label>
                                <input type="text" class="form-control" id="teamNumber" aria-describedby="teamNumber">
                            </div>

                            <div class="col-md-3">
                                <button id="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    function submitTeamNumber(){
        console.log('hi');
    }
    $("#submit").on('click', function(event) {
        submitTeamNumber();
    });
</script>

</html>