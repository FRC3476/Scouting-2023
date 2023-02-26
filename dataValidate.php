<html>

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

<body>
    <h1>Data Validation Page</h1>
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

                //get all the matches that we have
                let matches = {};
                for (var r in data.rows) {
                    matches[data.rows[r][orderBy]] = 6;
                }
                //subtract from each match number per row.
                //should result in all rows in matches[] being 0,
                //because all 6 teams per match were found.
                for (var r in data.rows) {
                    matches[data.rows[r][orderBy]]--;
                }

                //function which returns the row number for the first row with a matchNum
                function getRow(matchNum) {
                    var result = -1;
                    for (var i in data.rows) {
                        if (data.rows[i][orderBy] == matchNum) return i;
                    }
                    return result;
                }

                //add in the "MISSING" rows for data that is missing
                for (var m in matches) {
                    for (var i = 0; i < matches[m]; i++) {
                        var temp = [m, "MISSING"];
                        data.rows.splice(getRow(m), 0, temp);
                    }
                }

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

                //get the data from TBA
                var teams = httpRequest("/tbaAPI.php?getTeamList=1");
                if (!teams) createError("Error with TBA API");
                teams = JSON.parse(teams);

                // handle errors found
                for (var r in data.rows) {
                    //if there are more than 6 rows for a match
                    if (matches[data.rows[r][orderBy]] < 0) {
                        createError(`Match #${data.rows[r][orderBy]} has more than 6 scouting inputs`);
                    }

                    //if a team is not found in the event at all
                    var team = data.rows[r][3];
                    var found = false;
                    for (var t in teams) {
                        if (teams[t] == team) {
                            found = true;
                            break;
                        }
                    }
                    //if(team not in event and row is not a "MISSING" row)
                    if (!found && data.rows[r][1] != "MISSING") createError("Team " + team + " not in Event in match " + data.rows[r][orderBy]);

                }
            });
    </script>
</body>

</html>