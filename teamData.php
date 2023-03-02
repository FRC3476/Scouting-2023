<title>Team Data</title>
<html lang="en">

<?php include('navbar.php');?>


<body class="bg-body">
    <div class="container row-offcanvas row-offcanvas-left">
        <div class="well column col-lg-12 col-sm-12 col-xs-12" id="content">
            <div class="row pt-3 pb-3 mb-3">
                <div class="input-group mb-3">
                    <input id="teamNumber" type="text" class="form-control" placeholder="Enter Team Number">
                    <button id="readAllTeamMatchData" type="button" class="btn btn-primary" onclick="readAllTeamMatchData()">Load Team Data</button>
                </div>

                <div class="col-lg-12 col-sm-12 col-xs-12 gx-3">
                    <div class="card">
                        <div class="card-header">Team Data</div>
                        <div class="card-body">

                            <div id="alertPlaceholder"></div>

                            <h1>Team <!--API call to get Team Number--> - <!--Team Name call from PitScoutTable--></h1> 
                           
                            <canvas id="dataChart" width="300" height="250"></canvas>

                            <div id="dataCharts" class="carousel slide" data-interval="false">
                                <script>
                                    // data = API call to get the the cones scored
                                    new Chart("conesChart", {
                                    type: "scatter",
                                    data: {
                                        datasets: [{
                                        pointRadius: 4,
                                        pointBackgroundColor: "rgb(222, 169, 24)",
                                        data: xyValues
                                        }]
                                    },
                                    options: {
                                        legend: {display: false},
                                        scales: {
                                        xAxes: [{ticks: {min: 1, max:80}}],
                                        yAxes: [{ticks: {min: 0, max:20}}],
                                        }
                                    }
                                    });

                                    // data = API call to get the the cones scored
                                    new Chart("cubesChart", {
                                    type: "scatter",
                                    data: {
                                        datasets: [{
                                        pointRadius: 4,
                                        pointBackgroundColor: "rgb(159, 43, 104)",
                                        data: xyValues
                                        }]
                                    },
                                    options: {
                                        legend: {display: false},
                                        scales: {
                                        xAxes: [{ticks: {min: 1, max:80}}],
                                        yAxes: [{ticks: {min: 0, max:20}}],
                                        }
                                    }
                                    });

                                    // data = API call to get the the cones scored
                                    new Chart("chargePortChart", {
                                    type: "scatter",
                                    data: {
                                        datasets: [{
                                        pointRadius: 4,
                                        pointBackgroundColor: "rgb(0,0,255)",
                                        data: xyValues
                                        }]
                                    },
                                    options: {
                                        legend: {display: false},
                                        scales: {
                                        xAxes: [{ticks: {min: 1, max:80}}],
                                        yAxes: [{ticks: {min: 0, max:3}}],
                                        }
                                    }
                                    });
                                </script>
                            </div>

                            <div id="myCarousel" class="carousel slide" data-interval="false">
                                <div class="carousel-indicators">
                                    <!--Call to get the pictures for each team-->
                                </div>
                            </div>

                            <div id="matchDisplayTable" class="table-responsive">
                                <table id="dataTable" class="table table-striped table-hover sortable">
                                    <thead>
                                    <tr id="tableKeys">
                                    </tr>
                                    </thead>
                                    <tbody id="tableData">
                                    </tbody>
                                </table>
                            </div>

                            <div id="pitDisplayTable" class="table-responsive">
                                <table id="dataTable" class="table table-striped table-hover sortable">
                                    <thead>
                                    <tr id="tableKeys">
                                    </tr>
                                    </thead>
                                    <tbody id="tableData">
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

<script>
    function createRow(headers, team, rowData){
    /*Create HTML row for data.
    
    Args:
        rowData: Dictionary of keys and values needed for row.
    
        Returns:
        HTML row for table.
    */
    var list_row = []
    list_row.push('<tr>');
    list_row.push(`  <td scope="row">${team}</td>`);
    for (var i = 0; i != headers.length; i++){
        list_row.push(`  <td scope="row">${rowData[headers[i]]}</td>`);
    }
    list_row.push('</tr>');
    return list_row.join('')
    }

    function createHeaderRow(headers){
    var list_row = [];
    list_row.push('  <th scope="col">Team</th>');
    for (var i = 0; i != headers.length; i++){
        list_row.push(`  <th scope="col">${headers[i]}</th>`);
    }
    return list_row.join('')
    }

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

    function getSingleTeamElement(){
        console.log('hi');
        for(var i = 0;i < data.length; ++i)[
            console.log(data[i]['matchNumber']),
        ]
        console.log('did we make it');
    }

    function updateTable(data){
        /*Update table from API.
        
        Args:
            List of dictionaries of rows.
        */
        console.log('hi');
        $('#tableKeys').empty();
        $('#tableData').empty();
        $('#cardHeader').html(data['teamNumber']);
        console.log('hi');
        var coprData = data['data'];
        var headers = null;
        for (let team in coprData){
            if (headers == null){
            headers = getKeyListFromDict(coprData[team]);
            $('#tableKeys').append(createHeaderRow(headers));
            }
            $('#tableData').append(createRow(headers, team, readAllTeamMatchData[team]));
        }
        var newTableObject = document.getElementById('dataTable');
        sorttable.makeSortable(newTableObject);
        console.log('hi');
    }
</script>
</html>