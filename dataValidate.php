<html>
<?php include("navbar.php"); ?>

<head>
    <title>Data Validation Page</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body class="bg-body">
    <div class="container row-offcanvas row-offcanvas-left">
        <div class="well column col-lg-12 col-sm-12 col-xs-12" id="content">
            <div class="row pt-3 pb-3 mb-3">

                <!-- Left column -->
                <div class="col-lg-12 col-sm-12 col-xs-12 gx-3">
                    <div class="card">
                        <div class="card-header">Data Validation Page</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="matchNumber" class="form-label">Match Number</label>
                                <input autocomplete="off" type="number" min="0" name="matchNumber" class="form-control" id="matchNumber" aria-describedby="matchNumber" onchange="getByMatch()" value=0>
                            </div>
                            <div id="errors"></div><br>
                            <div id="table"></div>
                            <div id="display"></div>
                            <script>
                                var robots;
                                var newData;

                                // function getByKey(matchKey) {
                                //     for (var i = 0; i < robots.length; i++) {
                                //         if (robots[i].key == matchKey) return i;
                                //     }
                                //     return -1;
                                // }

                                // function getTotal() {
                                //     var match = document.getElementById("matchNumber").value;
                                //     var display = document.getElementById("display").getElementsByTagName("table")[0];

                                //     var rows = display.getElementsByTagName("tr");

                                //     var blueAuto = 0;
                                //     var blueTele = 0;
                                //     var redAuto = 0;
                                //     var redTele = 0;

                                //     for (var i = 1; i < rows.length; i++) {
                                //         var col = rows[i].getElementsByTagName("td");
                                //         if (col[i].bgColor == "blue") {
                                //             var r = getByKey(col[0].innerText);
                                //             if (r > -1) {
                                //                 r = robots[r];
                                //                 blueAuto += r.auto.total;
                                //                 blueTele += r.tele.total;
                                //             }
                                //         }
                                //         if (col[i].bgColor == "red") {
                                //             var r = getByKey(col[0].innerText);
                                //             if (r > -1) {
                                //                 r = robots[r];
                                //                 redAuto += r.auto.total;
                                //                 redTele += r.tele.total;
                                //             }
                                //         }
                                //     }
                                //     var actualBlue = sortTable(newData, match, "blue");
                                //     var actualRed = sortTable(newData, match, "red");
                                //     blueAutoDif = actualBlue.auto.total - blueAuto;
                                //     blueTeleDif = actualBlue.tele.total - blueTele;
                                //     redAutoDif = actualRed.auto.total - redAuto;
                                //     redTeleDif = actualRed.tele.total - redTele;
                                //     if (blueAutoDif != 0) createError(`blueAutoDif tba/scouting = ${actualBlue.auto.total}/${blueAuto}`);
                                //     if (blueTeleDif != 0) createError(`blueTeleDif tba/scouting = ${actualBlue.tele.total}/${blueTele}`);
                                //     if (redAutoDif != 0) createError(`redAutoDif tba/scouting = ${actualRed.auto.total}/${redAuto}`);
                                //     if (redTeleDif != 0) createError(`redTeleDif tba/scouting = ${actualRed.tele.total}/${redTele}`);
                                // }

                                function getByMatch() {
                                    var match = document.getElementById("matchNumber").value;
                                    var display = document.getElementById("display");
                                    var table = document.getElementById("table");
                                    var errors = document.getElementById("errors");

                                    if (match == 0) {
                                        table.hidden = false;
                                        display.hidden = true;
                                        errors.innerText = "";
                                    }
                                    if (match < 0) {
                                        return;
                                    }
                                    table.hidden = true;
                                    var data = table.getElementsByTagName("table")[0].getElementsByTagName("tr");
                                    var result = document.createElement("table");
                                    result.innerHTML += data[0].outerHTML;
                                    errors.innerText = "";

                                    redAutoConeB = 0;
                                    redAutoConeBAct = 0;
                                    redAutoConeM = 0;
                                    redAutoConeMAct = 0;
                                    redAutoConeT = 0;
                                    redAutoConeTAct = 0;
                                    redAutoCubeB = 0;
                                    redAutoCubeBAct = 0;
                                    redAutoCubeM = 0;
                                    redAutoCubeMAct = 0;
                                    redAutoCubeT = 0;
                                    redAutoCubeTAct = 0;

                                    redTeleConeB = 0;
                                    redTeleConeBAct = 0;
                                    redTeleConeM = 0;
                                    redTeleConeMAct = 0;
                                    redTeleConeT = 0;
                                    redTeleConeTAct = 0;
                                    redTeleCubeB = 0;
                                    redTeleCubeBAct = 0;
                                    redTeleCubeM = 0;
                                    redTeleCubeMAct = 0;
                                    redTeleCubeT = 0;
                                    redTeleCubeTAct = 0;

                                    blueAutoConeB = 0;
                                    blueAutoConeBAct = 0;
                                    blueAutoConeM = 0;
                                    blueAutoConeMAct = 0;
                                    blueAutoConeT = 0;
                                    blueAutoConeTAct = 0;
                                    blueAutoCubeB = 0;
                                    blueAutoCubeBAct = 0;
                                    blueAutoCubeM = 0;
                                    blueAutoCubeMAct = 0;
                                    blueAutoCubeT = 0;
                                    blueAutoCubeTAct = 0;

                                    blueTeleConeB = 0;
                                    blueTeleConeBAct = 0;
                                    blueTeleConeM = 0;
                                    blueTeleConeMAct = 0;
                                    blueTeleConeT = 0;
                                    blueTeleConeTAct = 0;
                                    blueTeleCubeB = 0;
                                    blueTeleCubeBAct = 0;
                                    blueTeleCubeM = 0;
                                    blueTeleCubeMAct = 0;
                                    blueTeleCubeT = 0;
                                    blueTeleCubeTAct = 0;

                                    for (var i = 1; i < data.length; i++) {
                                        if (match == 0 || data[i].getElementsByTagName("td")[2].innerText == match) {
                                            var text = data[i].outerHTML;
                                            var rows = data[i].getElementsByTagName("td");
                                            result.innerHTML += text;

                                            if(data[i].getElementsByTagName("td")[3].bgColor == "red"){
                                                redAutoConeB += parseInt(data[i].getElementsByTagName("td")[5].innerText.split("-")[0]);
                                                redAutoConeM += parseInt(data[i].getElementsByTagName("td")[6].innerText.split("-")[0]);
                                                redAutoConeT += parseInt(data[i].getElementsByTagName("td")[7].innerText.split("-")[0]);
                                                redAutoCubeB += parseInt(data[i].getElementsByTagName("td")[8].innerText.split("-")[0]);
                                                redAutoCubeM += parseInt(data[i].getElementsByTagName("td")[9].innerText.split("-")[0]);
                                                redAutoCubeT += parseInt(data[i].getElementsByTagName("td")[10].innerText.split("-")[0]);

                                                redAutoConeBAct = parseInt(data[i].getElementsByTagName("td")[5].innerText.split("-")[1]);
                                                redAutoConeMAct = parseInt(data[i].getElementsByTagName("td")[6].innerText.split("-")[1]);
                                                redAutoConeTAct = parseInt(data[i].getElementsByTagName("td")[7].innerText.split("-")[1]);
                                                redAutoCubeBAct = parseInt(data[i].getElementsByTagName("td")[8].innerText.split("-")[1]);
                                                redAutoCubeMAct = parseInt(data[i].getElementsByTagName("td")[9].innerText.split("-")[1]);
                                                redAutoCubeTAct = parseInt(data[i].getElementsByTagName("td")[10].innerText.split("-")[1]);

                                                redTeleConeB += parseInt(data[i].getElementsByTagName("td")[12].innerText.split("-")[0]);
                                                redTeleConeM += parseInt(data[i].getElementsByTagName("td")[13].innerText.split("-")[0]);
                                                redTeleConeT += parseInt(data[i].getElementsByTagName("td")[14].innerText.split("-")[0]);
                                                redTeleCubeB += parseInt(data[i].getElementsByTagName("td")[15].innerText.split("-")[0]);
                                                redTeleCubeM += parseInt(data[i].getElementsByTagName("td")[16].innerText.split("-")[0]);
                                                redTeleCubeT += parseInt(data[i].getElementsByTagName("td")[17].innerText.split("-")[0]);

                                                redTeleConeBAct = parseInt(data[i].getElementsByTagName("td")[12].innerText.split("-")[1]);
                                                redTeleConeMAct = parseInt(data[i].getElementsByTagName("td")[13].innerText.split("-")[1]);
                                                redTeleConeTAct = parseInt(data[i].getElementsByTagName("td")[14].innerText.split("-")[1]);
                                                redTeleCubeBAct = parseInt(data[i].getElementsByTagName("td")[15].innerText.split("-")[1]);
                                                redTeleCubeMAct = parseInt(data[i].getElementsByTagName("td")[16].innerText.split("-")[1]);
                                                redTeleCubeTAct = parseInt(data[i].getElementsByTagName("td")[17].innerText.split("-")[1]);
                                            }

                                            if(data[i].getElementsByTagName("td")[3].bgColor == "blue"){
                                                blueAutoConeB += parseInt(data[i].getElementsByTagName("td")[5].innerText.split("-")[0]);
                                                blueAutoConeM += parseInt(data[i].getElementsByTagName("td")[6].innerText.split("-")[0]);
                                                blueAutoConeT += parseInt(data[i].getElementsByTagName("td")[7].innerText.split("-")[0]);
                                                blueAutoCubeB += parseInt(data[i].getElementsByTagName("td")[8].innerText.split("-")[0]);
                                                blueAutoCubeM += parseInt(data[i].getElementsByTagName("td")[9].innerText.split("-")[0]);
                                                blueAutoCubeT += parseInt(data[i].getElementsByTagName("td")[10].innerText.split("-")[0]);

                                                blueAutoConeBAct = parseInt(data[i].getElementsByTagName("td")[5].innerText.split("-")[1]);
                                                blueAutoConeMAct = parseInt(data[i].getElementsByTagName("td")[6].innerText.split("-")[1]);
                                                blueAutoConeTAct = parseInt(data[i].getElementsByTagName("td")[7].innerText.split("-")[1]);
                                                blueAutoCubeBAct = parseInt(data[i].getElementsByTagName("td")[8].innerText.split("-")[1]);
                                                blueAutoCubeMAct = parseInt(data[i].getElementsByTagName("td")[9].innerText.split("-")[1]);
                                                blueAutoCubeTAct = parseInt(data[i].getElementsByTagName("td")[10].innerText.split("-")[1]);

                                                blueTeleConeB += parseInt(data[i].getElementsByTagName("td")[12].innerText.split("-")[0]);
                                                blueTeleConeM += parseInt(data[i].getElementsByTagName("td")[13].innerText.split("-")[0]);
                                                blueTeleConeT += parseInt(data[i].getElementsByTagName("td")[14].innerText.split("-")[0]);
                                                blueTeleCubeB += parseInt(data[i].getElementsByTagName("td")[15].innerText.split("-")[0]);
                                                blueTeleCubeM += parseInt(data[i].getElementsByTagName("td")[16].innerText.split("-")[0]);
                                                blueTeleCubeT += parseInt(data[i].getElementsByTagName("td")[17].innerText.split("-")[0]);

                                                blueTeleConeBAct = parseInt(data[i].getElementsByTagName("td")[12].innerText.split("-")[1]);
                                                blueTeleConeMAct = parseInt(data[i].getElementsByTagName("td")[13].innerText.split("-")[1]);
                                                blueTeleConeTAct = parseInt(data[i].getElementsByTagName("td")[14].innerText.split("-")[1]);
                                                blueTeleCubeBAct = parseInt(data[i].getElementsByTagName("td")[15].innerText.split("-")[1]);
                                                blueTeleCubeMAct = parseInt(data[i].getElementsByTagName("td")[16].innerText.split("-")[1]);
                                                blueTeleCubeTAct = parseInt(data[i].getElementsByTagName("td")[17].innerText.split("-")[1]);
                                            }
                                        }
                                    }
                                    var rows = result.getElementsByTagName("tr").length;
                                    if (match != 0 && rows != 7) createError(`Row Number Error: There are ${rows-1} rows instead of 6`);
                                    display.hidden = false;
                                    display.innerText = "";
                                    display.appendChild(result);

                                    if(redAutoConeB != redAutoConeBAct){
                                        createError(`Red Auto Cone B Error, Over by ${redAutoConeB - redAutoConeBAct}`);
                                    }
                                    if(redAutoConeM != redAutoConeMAct){
                                        createError(`Red Auto Cone M Error, Over by ${redAutoConeM - redAutoConeMAct}`);
                                    }
                                    if(redAutoConeT != redAutoConeTAct){
                                        createError(`Red Auto Cone T Error, Over by ${redAutoConeT - redAutoConeTAct}`);
                                    }
                                    if(redAutoCubeB != redAutoCubeBAct){
                                        createError(`Red Auto Cube B Error, Over by ${redAutoCubeB - redAutoCubeBAct}`);
                                    }
                                    if(redAutoCubeM != redAutoCubeMAct){
                                        createError(`Red Auto Cube M Error, Over by ${redAutoCubeM - redAutoCubeMAct}`);
                                    }
                                    if(redAutoCubeT != redAutoCubeTAct){
                                        createError(`Red Auto Cube T Error, Over by ${redAutoCubeT - redAutoCubeTAct}`);
                                    }
                                    
                                    if(redTeleConeB != redTeleConeBAct){
                                        createError(`Red Tele Cone B Error, Over by ${redTeleConeB - redTeleConeBAct}`);
                                    }
                                    if(redTeleConeM != redTeleConeMAct){
                                        createError(`Red Tele Cone M Error, Over by ${redTeleConeM - redTeleConeMAct}`);
                                    }
                                    if(redTeleConeT != redTeleConeTAct){
                                        createError(`Red Tele Cone T Error, Over by ${redTeleConeT - redTeleConeTAct}`);
                                    }
                                    if(redTeleCubeB != redTeleCubeBAct){
                                        createError(`Red Tele Cube B Error, Over by ${redTeleCubeB - redTeleCubeBAct}`);
                                    }
                                    if(redTeleCubeM != redTeleCubeMAct){
                                        createError(`Red Tele Cube M Error, Over by ${redTeleCubeM - redTeleCubeMAct}`);
                                    }
                                    if(redTeleCubeT != redTeleCubeTAct){
                                        createError(`Red Tele Cube T Error, Over by ${redTeleCubeT - redTeleCubeTAct}`);
                                    }

                                    if(blueAutoConeB != blueAutoConeBAct){
                                        createError(`Blue Auto Cone B Error, Over by ${blueAutoConeB - blueAutoConeBAct}`);
                                    }
                                    if(blueAutoConeM != blueAutoConeMAct){
                                        createError(`Blue Auto Cone M Error, Over by ${blueAutoConeM - blueAutoConeMAct}`);
                                    }
                                    if(blueAutoConeT != blueAutoConeTAct){
                                        createError(`Blue Auto Cone T Error, Over by ${blueAutoConeT - blueAutoConeTAct}`);
                                    }
                                    if(blueAutoCubeB != blueAutoCubeBAct){
                                        createError(`Blue Auto Cube B Error, Over by ${blueAutoCubeB - blueAutoCubeBAct}`);
                                    }
                                    if(blueAutoCubeM != blueAutoCubeMAct){
                                        createError(`Blue Auto Cube M Error, Over by ${blueAutoCubeM - blueAutoCubeMAct}`);
                                    }
                                    if(blueAutoCubeT != blueAutoCubeTAct){
                                        createError(`Blue Auto Cube T Error, Over by ${blueAutoCubeT - blueAutoCubeTAct}`);
                                    }
                                    
                                    if(blueTeleConeB != blueTeleConeBAct){
                                        createError(`Blue Tele Cone B Error, Over by ${blueTeleConeB - blueTeleConeBAct}`);
                                    }
                                    if(blueTeleConeM != blueTeleConeMAct){
                                        createError(`Blue Tele Cone M Error, Over by ${blueTeleConeM - blueTeleConeMAct}`);
                                    }
                                    if(blueTeleConeT != blueTeleConeTAct){
                                        createError(`Blue Tele Cone T Error, Over by ${blueTeleConeT - blueTeleConeTAct}`);
                                    }
                                    if(blueTeleCubeB != blueTeleCubeBAct){
                                        createError(`Blue Tele Cube B Error, Over by ${blueTeleCubeB - blueTeleCubeBAct}`);
                                    }
                                    if(blueTeleCubeM != blueTeleCubeMAct){
                                        createError(`Blue Tele Cube M Error, Over by ${blueTeleCubeM - blueTeleCubeMAct}`);
                                    }
                                    if(blueTeleCubeT != blueTeleCubeTAct){
                                        createError(`Blue Tele Cube T Error, Over by ${blueTeleCubeT - blueTeleCubeTAct}`);
                                    }
                                }

                                //function which adds an error button
                                //(clicking the button deletes itself)
                                //they are appended to the "error" <div> at the top of the page
                                function createError(str) {
                                    var div = document.createElement("div");
                                    var box = document.getElementById("errors");
                                    var button = document.createElement("button");
                                    button.innerText = str;
                                    button.onclick = function() {
                                        //this.parentElement.remove();
                                    }
                                    div.appendChild(button);
                                    div.appendChild(document.createElement("br"));
                                    box.appendChild(div);
                                }

                                //get JSON data from ./readAPI.php
                                fetch('./readAPI.php', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/x-www-form-urlencoded'
                                        },
                                        body: 'readAllMatchData=1'
                                    }).then(response => response.json())
                                    .then((raw) => {
                                        let data = {};
                                        data.headers = Object.keys(raw[0]); //column labels
                                        orderBy = data.headers.indexOf("matchNumber"); //item by which rows are ordered
                                        data.rows = [];

                                        //reformat the data for the table rows
                                        for (var row = 0; row < raw.length; row++) {
                                            var temp = [];
                                            for (var col = 0; col < data.headers.length; col++) {
                                                temp.push(raw[row][data.headers[col]]);
                                            }
                                            data.rows.push(temp);
                                        }

                                        //order the rows by match number
                                        data.rows.sort(function(a, b) {
                                            return a[orderBy] - b[orderBy]
                                        });

                                        //create the table that shows the data (HTML)
                                        function createTable() {
                                            var table = document.createElement("table");
                                            var headers = document.createElement("tr");
                                            //create the first row with all the column labels
                                            for (var i = 0; i < data.headers.length; i++) {
                                                var temp = document.createElement("th");
                                                temp.innerText = data.headers[i];
                                                headers.appendChild(temp);
                                            }

                                            //add the row of column labels to the table element
                                            table.appendChild(headers);

                                            //add all the rows of data to the table
                                            for (var r = 0; r < data.rows.length; r++) {
                                                var row = document.createElement("tr");
                                                for (var c = 0; c < data.rows[r].length; c++) {
                                                    var column = document.createElement("td");

                                                    column.innerText = data.rows[r][c];
                                                    row.appendChild(column);
                                                }
                                                table.appendChild(row);
                                            }
                                            return table;
                                        }
                                        //execute the function
                                        document.getElementById("table").appendChild(createTable());

                                        //http request function (sync)
                                        function httpRequest(adr) {
                                            var xhttp = new XMLHttpRequest();
                                            xhttp.open("GET", adr, false);
                                            xhttp.send();
                                            return xhttp.responseText;
                                        }

                                        //
                                        // HANDLE ERRORS
                                        // cross reference data from TBA and flag data as:
                                        // true if checks out (exists in both TBA and scouting data)
                                        // false if it exists in the scouting data, but not in the tba data, or vice versa
                                        //

                                        //get the team numbers of teams in a match
                                        function getTeamsInMatch(data) {
                                            data = data.response;
                                            var keys = [];
                                            //search through all rows of data
                                            for (var i = 0; i < data.length; i++) {
                                                //make sure to check if the comp_level is a qualifier
                                                if (data[i].comp_level == "qm") {
                                                    //this might need some optimization lol
                                                    function iterate(arr) {
                                                        for (var j = 0; j < arr.length; j++) {
                                                            var temp = arr[j];
                                                            //convert the team number to the matchKey format
                                                            temp = temp.substring(3, temp.length);
                                                            temp = data[i].match_number + "-" + temp;
                                                            keys.push(temp);
                                                        }
                                                    }
                                                    iterate(data[i].alliances.blue.dq_team_keys);
                                                    iterate(data[i].alliances.blue.surrogate_team_keys);
                                                    iterate(data[i].alliances.blue.team_keys);
                                                    iterate(data[i].alliances.red.dq_team_keys);
                                                    iterate(data[i].alliances.red.surrogate_team_keys);
                                                    iterate(data[i].alliances.red.team_keys);
                                                }
                                            }
                                            return keys;
                                        }

                                        //get data for all matches of the current event
                                        //the event code is set in the config file
                                        var tba_data = httpRequest("./tbaAPI.php?getMatchList=1");
                                        tba_data = JSON.parse(tba_data);
                                        var keys = getTeamsInMatch(tba_data);

                                        //find a row by its matchKey, by returning its index in data.rows
                                        function getRowByMatchKey(matchKey) {
                                            var d = data.rows;
                                            for (var i = 0; i < d.length; i++) {
                                                if (d[i][0] == matchKey) return i;
                                            }
                                            return -1;
                                        }

                                        //check for rows in tba, but not in scouting data
                                        var errors = [];
                                        for (var i = 0; i < keys.length; i++) {
                                            var check = getRowByMatchKey(keys[i]);
                                            if (check == -1) {
                                                let e = {};
                                                e.key = keys[i];
                                                e.text = " in TBA, but not in scouting data";
                                                if ((e.key.split("-")[0] + 0) < 5000) errors.push(e);
                                            }
                                        }

                                        //check for rows in scouting data, but not in tba
                                        for (var i = 0; i < data.rows.length; i++) {
                                            var key = data.rows[i][0];
                                            var check = keys.indexOf(key);
                                            if (check == -1) {
                                                let e = {};
                                                e.key = key;
                                                e.text = " in scouting data, but not in TBA";
                                                if ((e.key.split("-")[0] + 0) < 5000) errors.push(e);
                                            }
                                        }

                                        //sort alphabetically by the matchKey.
                                        //data that has the wrong match number will be indexed next to each other,
                                        //which makes it easier to see in the errors
                                        errors.sort(function(a, b) {
                                            return a.key.localeCompare(b.key);
                                        });

                                        //add error buttons
                                        //for (var i = 0; i < errors.length; i++) createError(errors[i].key + errors[i].text);
                                        createError(`${errors.length} data discrepancy errors`);
                                        //
                                        // VERIFY MATCH DATA
                                        //

                                        var matchData = [];

                                        for (var i = 0; i < tba_data.response.length; i++) {
                                            var arr = tba_data.response;
                                            if (arr[i].comp_level == "qm") {
                                                matchData.push(arr[i]);
                                            }
                                        }
                                        matchData.sort(function(a, b) {
                                            return a.match_number - b.match_number;
                                        });

                                        //criteria to check:
                                        //automobility for each robot
                                        //auto charge station for each robot
                                        //teleop charge station

                                        //teleop game piece count
                                        //auto game piece

                                        var tbaRobots = [];
                                        for (var i = 0; i < matchData.length; i++) {
                                            var blue = matchData[i].alliances.blue.team_keys;
                                            var red = matchData[i].alliances.red.team_keys;
                                            for (var b in blue) {
                                                var r = {};
                                                r.team = blue[b].substring(3, blue[b].length);
                                                r.match = i;
                                                r.num = parseInt(b) + 1;
                                                r.alliance = "blue";
                                                tbaRobots.push(r);
                                            }
                                            for (var re in red) {
                                                var r = {};
                                                r.team = red[re].substring(3, red[re].length);
                                                r.match = i;
                                                r.num = parseInt(re) + 1;
                                                r.alliance = "red";
                                                tbaRobots.push(r);
                                            }
                                        }

                                        var autoErrors = 0;
                                        var chargeErrors = 0;
                                        var teleErrors = 0;
                                        for (var i = 0; i < tbaRobots.length; i++) {
                                            var robot = tbaRobots[i];
                                            var score = matchData[robot.match].score_breakdown;
                                            robot.autoMobile = score[robot.alliance][`mobilityRobot${robot.num}`] == "Yes";
                                            var auto = score[robot.alliance][`autoChargeStationRobot${robot.num}`];
                                            robot.autoCharge = auto == "Docked" || auto == "Park";
                                            var tele = score[robot.alliance][`endGameChargeStationRobot${robot.num}`];
                                            robot.teleCharge = tele == "Docked" || tele == "Park";
                                            robot.key = `${robot.match+1}-${robot.team}`;

                                            var row = getRowByMatchKey(robot.key);
                                            if (row > -1) {
                                                var table = document.getElementsByTagName("table")[0].getElementsByTagName("tr")[row + 1].getElementsByTagName("td");
                                                var local = data.rows[row];
                                                
                                                if (robot.alliance == "blue"){
                                                    table[3].bgColor = "blue";
                                                    table[5].innerText += "-" + matchData[robot.match].score_breakdown["blue"][`autoCommunity`].B.filter(x => x === "Cone").length
                                                    table[6].innerText += "-" + matchData[robot.match].score_breakdown["blue"][`autoCommunity`].M.filter(x => x === "Cone").length
                                                    table[7].innerText += "-" + matchData[robot.match].score_breakdown["blue"][`autoCommunity`].T.filter(x => x === "Cone").length
                                                    table[8].innerText += "-" + matchData[robot.match].score_breakdown["blue"][`autoCommunity`].B.filter(x => x === "Cube").length
                                                    table[9].innerText += "-" + matchData[robot.match].score_breakdown["blue"][`autoCommunity`].M.filter(x => x === "Cube").length
                                                    table[10].innerText += "-" + matchData[robot.match].score_breakdown["blue"][`autoCommunity`].T.filter(x => x === "Cube").length

                                                    table[12].innerText += "-" + matchData[robot.match].score_breakdown["blue"][`teleopCommunity`].B.filter(x => x === "Cone").length
                                                    table[13].innerText += "-" + matchData[robot.match].score_breakdown["blue"][`teleopCommunity`].M.filter(x => x === "Cone").length
                                                    table[14].innerText += "-" + matchData[robot.match].score_breakdown["blue"][`teleopCommunity`].T.filter(x => x === "Cone").length
                                                    table[15].innerText += "-" + matchData[robot.match].score_breakdown["blue"][`teleopCommunity`].B.filter(x => x === "Cube").length
                                                    table[16].innerText += "-" + matchData[robot.match].score_breakdown["blue"][`teleopCommunity`].M.filter(x => x === "Cube").length
                                                    table[17].innerText += "-" + matchData[robot.match].score_breakdown["blue"][`teleopCommunity`].T.filter(x => x === "Cube").length
                                                }
                                                if (robot.alliance == "red"){
                                                    table[3].bgColor = "red";
                                                    table[5].innerText += "-" + matchData[robot.match].score_breakdown["red"][`autoCommunity`].B.filter(x => x === "Cone").length
                                                    table[6].innerText += "-" + matchData[robot.match].score_breakdown["red"][`autoCommunity`].M.filter(x => x === "Cone").length
                                                    table[7].innerText += "-" + matchData[robot.match].score_breakdown["red"][`autoCommunity`].T.filter(x => x === "Cone").length
                                                    table[8].innerText += "-" + matchData[robot.match].score_breakdown["red"][`autoCommunity`].B.filter(x => x === "Cube").length
                                                    table[9].innerText += "-" + matchData[robot.match].score_breakdown["red"][`autoCommunity`].M.filter(x => x === "Cube").length
                                                    table[10].innerText += "-" + matchData[robot.match].score_breakdown["red"][`autoCommunity`].T.filter(x => x === "Cube").length

                                                    table[12].innerText += "-" + matchData[robot.match].score_breakdown["red"][`teleopCommunity`].B.filter(x => x === "Cone").length
                                                    table[13].innerText += "-" + matchData[robot.match].score_breakdown["red"][`teleopCommunity`].M.filter(x => x === "Cone").length
                                                    table[14].innerText += "-" + matchData[robot.match].score_breakdown["red"][`teleopCommunity`].T.filter(x => x === "Cone").length
                                                    table[15].innerText += "-" + matchData[robot.match].score_breakdown["red"][`teleopCommunity`].B.filter(x => x === "Cube").length
                                                    table[16].innerText += "-" + matchData[robot.match].score_breakdown["red"][`teleopCommunity`].M.filter(x => x === "Cube").length
                                                    table[17].innerText += "-" + matchData[robot.match].score_breakdown["red"][`teleopCommunity`].T.filter(x => x === "Cube").length
                                                }

                                                var autoMobile = (robot.autoMobile) == (local[4] == 1);
                                                var autoCharge = (robot.autoCharge) == (local[11] != "NONE");
                                                var teleCharge = (robot.teleCharge) == (local[18] != "NONE");
                                                if (!autoMobile) {
                                                    table[4].bgColor = "orange";
                                                    table[4].innerText += "-" + (robot.autoMobile ? 1:0);
                                                    autoErrors++;
                                                }
                                                if (!autoCharge) {
                                                    table[11].bgColor = "orange";
                                                    table[11].innerText += " - ERROR";
                                                    chargeErrors++;
                                                }
                                                if (!teleCharge) {
                                                    table[18].bgColor = "orange";
                                                    table[18].innerText += " - ERROR";
                                                    teleErrors++;
                                                }
                                                //collect data for the game pieces comparison later
                                                // var auto = {};

                                                // auto.B = {};
                                                // auto.B.cubes = local[8];
                                                // auto.B.cones = local[5];

                                                // auto.M = {};
                                                // auto.M.cubes = local[9];
                                                // auto.M.cones = local[6];

                                                // auto.T = {};
                                                // auto.T.cubes = local[10];
                                                // auto.T.cones = local[7];

                                                // var tele = {};

                                                // tele.B = {};
                                                // tele.B.cubes = local[15];
                                                // tele.B.cones = local[12];

                                                // tele.M = {};
                                                // tele.M.cubes = local[16];
                                                // tele.M.cones = local[13];

                                                // tele.T = {};
                                                // tele.T.cubes = local[17];
                                                // tele.T.cones = local[14];

                                                // auto.total = 0;
                                                // for (var x = 5; x < 11; x++) auto.total += local[x];

                                                // tele.total = 0;
                                                // for (var x = 12; x < 18; x++) tele.total += local[x];

                                                // robot.auto = auto;
                                                // robot.tele = tele;
                                            }
                                        }
                                        createError(`${autoErrors} autoMobility Errors`);
                                        createError(`${chargeErrors} autoChargeStation Errors`);
                                        createError(`${teleErrors} teleopChargeStation Errors`);

                                        //check game pieces
                                        console.log(data.rows);
                                        console.log(matchData);
                                        console.log(tbaRobots);

                                        //console.log(tbaRobots[0].auto);
                                        //console.log(sortTable(1, "blue").auto);
                                        robots = tbaRobots;
                                        newData = matchData;
                                    });

                                // function sortTable(matchData, matchNum, alliance) {
                                //     var result = {};
                                //     var data = matchData[matchNum - 1].score_breakdown[alliance];

                                //     function totals(arr) {
                                //         var cubes = 0;
                                //         var cones = 0;
                                //         for (var i = 0; i < arr.length; i++) {
                                //             if (arr[i] == "Cone") cones++;
                                //             else if (arr[i] == "Cube") cubes++;
                                //         }
                                //         var result = {};
                                //         result.cubes = cubes;
                                //         result.cones = cones;
                                //         return result;
                                //     }

                                //     function levels(obj) {
                                //         var result = {};
                                //         result.B = totals(obj.B);
                                //         result.M = totals(obj.M);
                                //         result.T = totals(obj.T);
                                //         result.total = result.B.cones + result.M.cones + result.T.cones;
                                //         result.total += result.B.cubes + result.M.cubes + result.T.cubes;
                                //         return result;
                                //     }
                                //     result.auto = levels(data.autoCommunity);
                                //     result.tele = levels(data.teleopCommunity);
                                //     return result;
                                // }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
</body>
<?php include("footer.php"); ?>

</html>