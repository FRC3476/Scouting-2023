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

                    <div id="errors"></div><br>
                    <div id="table"></div>
                    <script>
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
                                    var r = -1;
                                    var d = data.rows;
                                    for (var i = 0; i < d.length; i++) {
                                        if (d[i][0] == matchKey) return i;
                                    }
                                    return r;
                                }

                                //check for rows in tba, but not in scouting data
                                var errors = [];
                                for (var i = 0; i < keys.length; i++) {
                                    var check = getRowByMatchKey(keys[i]);
                                    if (check == -1) {
                                        let e = {};
                                        e.key = keys[i];
                                        e.text = " in TBA, but not in scouting data";
                                        if ((e.key.split("-")[0]+0) < 5000) errors.push(e);
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
                                        if ((e.key.split("-")[0]+0) < 5000) errors.push(e);
                                    }
                                }

                                //sort alphabetically by the matchKey.
                                //data that has the wrong match number will be indexed next to each other,
                                //which makes it easier to see in the errors
                                errors.sort(function (a, b) {
                                    return a.key.localeCompare(b.key);
                                });

                                //add error buttons
                                for (var i = 0; i < errors.length; i++) createError(errors[i].key + errors[i].text);
                            });
                    </script>
        </div>
      </div>
    </div>
  </div>
</body>
	<?php include("footer.php"); ?>

</html>