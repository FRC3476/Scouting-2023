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

                                function getByKey(matchKey) {
                                    for (var i = 0; i < robots.length; i++) {
                                        if (robots[i].key == matchKey) return i;
                                    }
                                    return -1;
                                }

                                function getTotal() {
                                    var match = document.getElementById("matchNumber").value;
                                    var display = document.getElementById("display").getElementsByTagName("table")[0];

                                    var rows = display.getElementsByTagName("tr");

                                    var blueAuto = 0;
                                    var blueTele = 0;
                                    var redAuto = 0;
                                    var redTele = 0;

                                    for (var i = 1; i < rows.length; i++) {
                                        var col = rows[i].getElementsByTagName("td");
                                        if (col[i].bgColor == "blue") {
                                            var r = getByKey(col[0].innerText);
                                            if (r > -1) {
                                                r = robots[r];
                                                blueAuto += r.auto.total;
                                                blueTele += r.tele.total;
                                            }
                                        }
                                        if (col[i].bgColor == "red") {
                                            var r = getByKey(col[0].innerText);
                                            if (r > -1) {
                                                r = robots[r];
                                                redAuto += r.auto.total;
                                                redTele += r.tele.total;
                                            }
                                        }
                                    }
                                    var actualBlue = sortTable(newData, match, "blue");
                                    var actualRed = sortTable(newData, match, "red");
                                    blueAutoDif = actualBlue.auto.total - blueAuto;
                                    blueTeleDif = actualBlue.tele.total - blueTele;
                                    redAutoDif = actualRed.auto.total - redAuto;
                                    redTeleDif = actualRed.tele.total - redTele;
                                    if (blueAutoDif != 0) createError(`blueAutoDif tba/scouting = ${actualBlue.auto.total}/${blueAuto}`);
                                    if (blueTeleDif != 0) createError(`blueTeleDif tba/scouting = ${actualBlue.tele.total}/${blueTele}`);
                                    if (redAutoDif != 0) createError(`redAutoDif tba/scouting = ${actualRed.auto.total}/${redAuto}`);
                                    if (redTeleDif != 0) createError(`redTeleDif tba/scouting = ${actualRed.tele.total}/${redTele}`);
                                }

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
                                    for (var i = 1; i < data.length; i++) {
                                        if (match == 0 || data[i].getElementsByTagName("td")[2].innerText == match) {
                                            var text = data[i].outerHTML;
                                            var rows = data[i].getElementsByTagName("td");
                                            if (text.indexOf("$AME") > -1) createError(`AutoMobility Error for Team ${rows[0].textContent}`);
                                            if (text.indexOf("$ACE") > -1) createError(`AutoChargeStation Error for Team${rows[0].textContent}`);
                                            if (text.indexOf("$TCE") > -1) createError(`TeleopChargeStation Error for Team ${rows[0].textContent}`);
                                            result.innerHTML += text;
                                        }
                                    }
                                    var rows = result.getElementsByTagName("tr").length;
                                    if (match != 0 && rows != 7) createError(`Row Number Error: There are ${rows-1} rows instead of 6`);
                                    display.hidden = false;
                                    display.innerText = "";
                                    display.appendChild(result);
                                    getTotal();
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
                                        this.parentElement.remove();
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
                                                if (robot.alliance == "blue") table[3].bgColor = "blue";
                                                if (robot.alliance == "red") table[3].bgColor = "red";
                                                var autoMobile = (robot.autoMobile) == (local[4] == 1);
                                                var autoCharge = (robot.autoCharge) == (local[11] != "NONE");
                                                var teleCharge = (robot.teleCharge) == (local[18] != "NONE");
                                                if (!autoMobile) {
                                                    table[4].bgColor = "red";
                                                    table[4].innerText += " $AME";
                                                    autoErrors++;
                                                }
                                                if (!autoCharge) {
                                                    table[11].bgColor = "red";
                                                    table[11].innerText += " $ACE";
                                                    chargeErrors++;
                                                }
                                                if (!teleCharge) {
                                                    table[18].bgColor = "red";
                                                    table[18].innerText += " $TCE";
                                                    teleErrors++;
                                                }
                                                //collect data for the game pieces comparison later
                                                var auto = {};

                                                auto.B = {};
                                                auto.B.cubes = local[8];
                                                auto.B.cones = local[5];

                                                auto.M = {};
                                                auto.M.cubes = local[9];
                                                auto.M.cones = local[6];

                                                auto.T = {};
                                                auto.T.cubes = local[10];
                                                auto.T.cones = local[7];

                                                var tele = {};

                                                tele.B = {};
                                                tele.B.cubes = local[15];
                                                tele.B.cones = local[12];

                                                tele.M = {};
                                                tele.M.cubes = local[16];
                                                tele.M.cones = local[13];

                                                tele.T = {};
                                                tele.T.cubes = local[17];
                                                tele.T.cones = local[14];

                                                auto.total = 0;
                                                for (var x = 5; x < 11; x++) auto.total += local[x];

                                                tele.total = 0;
                                                for (var x = 12; x < 18; x++) tele.total += local[x];

                                                robot.auto = auto;
                                                robot.tele = tele;
                                            }
                                        }
                                        createError(`${autoErrors} autoMobility Errors`);
                                        createError(`${chargeErrors} autoChargeStation Errors`);
                                        createError(`${teleErrors} teleopChargeStation Errors`);
                                        createError(`Game piece errors only work for individual matches`);

                                        //check game pieces
                                        console.log(data.rows);
                                        console.log(matchData);
                                        console.log(tbaRobots);

                                        //console.log(tbaRobots[0].auto);
                                        //console.log(sortTable(1, "blue").auto);
                                        robots = tbaRobots;
                                        newData = matchData;
                                    });

                                function sortTable(matchData, matchNum, alliance) {
                                    var result = {};
                                    var data = matchData[matchNum - 1].score_breakdown[alliance];

                                    function totals(arr) {
                                        var cubes = 0;
                                        var cones = 0;
                                        for (var i = 0; i < arr.length; i++) {
                                            if (arr[i] == "Cone") cones++;
                                            else if (arr[i] == "Cube") cubes++;
                                        }
                                        var result = {};
                                        result.cubes = cubes;
                                        result.cones = cones;
                                        return result;
                                    }

                                    function levels(obj) {
                                        var result = {};
                                        result.B = totals(obj.B);
                                        result.M = totals(obj.M);
                                        result.T = totals(obj.T);
                                        result.total = result.B.cones + result.M.cones + result.T.cones;
                                        result.total += result.B.cubes + result.M.cubes + result.T.cubes;
                                        return result;
                                    }
                                    result.auto = levels(data.autoCommunity);
                                    result.tele = levels(data.teleopCommunity);
                                    return result;
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
</body>
<?php include("footer.php"); ?>

</html>