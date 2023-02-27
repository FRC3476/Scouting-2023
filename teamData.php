<title>Team Data</title>
<html lang="en">

<?php include('navbar.php');?>


<body class="bg-body">
    <div class="container row-offcanvas row-offcanvas-left">
        <div class="well column col-lg-12 col-sm-12 col-xs-12" id="content">
            <div class="row pt-3 pb-3 mb-3">
                <div class="col-lg-12 col-sm-12 col-xs-12 gx-3">
                    <div class="card">
                        <div class="card-header">Team Data</div>
                        <div class="card-body">

                            <div id="alertPlaceholder"></div>

                            <div class="input-group mb-3">
                                <input id="teamNumber" type="text" class="form-control" placeholder="Enter Team Number">
                                <button id="teamMatchData" type="button" class="btn btn-primary" onclick="readAllTeamMatchData()">Load Team Data</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    function readAllTeamMatchData(){
        console.log('hi');
        console.log('#teamNumber');
        $.get('readAPI.php', {
            'readAllTeamMatchData' : $('#teamNumber').val()

        }, function(data) {
            data = JSON.parse(data);
            console.log(data);
        });
    }
</script>
</html>