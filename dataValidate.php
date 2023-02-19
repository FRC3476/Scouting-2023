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
                body: 'readAllMatchData'
            }).then(response => response.json())
            .then((raw) => {
                let data = {};
                data.headers = Object.keys(raw[0]);
                orderBy = data.headers.indexOf("matchNumber"); //item by which rows are ordered
                data.rows = [];
                for (var row = 0; row < raw.length; row++) {
                    var temp = [];
                    for (var col = 0; col < data.headers.length; col++) {
                        temp.push(raw[row][data.headers[col]]);
                    }
                    data.rows.push(temp);
                }

                data.rows.sort(function(a, b) {
                    return a[orderBy] - b[orderBy]
                });

                //check if rows are missing
                let matches = {};
                for (var r in data.rows) {
                    matches[data.rows[r][orderBy]] = 6;
                }
                for (var r in data.rows) {
                    matches[data.rows[r][orderBy]]--;
                }

                function getRow(matchNum) {
                    var result = -1;
                    for (var i in data.rows) {
                        if (data.rows[i][orderBy] == matchNum) return i;
                    }
                    return result;
                }

                for (var m in matches) {
                    for (var i = 0; i < matches[m]; i++) {
                        var temp = [m, "MISSING"];
                        data.rows.splice(getRow(m), 0, temp);
                    }
                }
                //console.log(data.rows);

                //create table
                function createTable() {
                    var table = document.createElement("table");
                    var headers = document.createElement("tr");
                    for (var i = 0; i < data.headers.length; i++) {
                        var temp = document.createElement("th");
                        temp.innerText = data.headers[i];
                        headers.appendChild(temp);
                    }

                    table.appendChild(headers);

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
                document.getElementById("table").appendChild(createTable());

                //figure out if there is data missing
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

                function httpRequest(adr) {
                    var xhttp = new XMLHttpRequest();
                    xhttp.open("GET", adr, false);
                    xhttp.send();
                    return xhttp.responseText;
                }

                var teams = httpRequest("/tbaAPI.php?getTeamList=1");
                if (!teams) createError("Error with TBA API");
                teams = JSON.parse(teams);


                for (var r in data.rows) {
                    if (matches[data.rows[r][orderBy]] < 0) {
                        createError(`Match #${data.rows[r][orderBy]} has more than 6 scouting inputs`);
                    }

                    var team = data.rows[r][3];
                    var found = false;
                    for (var t in teams) {
                        if (teams[t] == team) {
                            found = true;
                            break;
                        }
                    }
                    if (!found && data.rows[r][1] != "MISSING") createError("Team " + team + " not in Event in match " + data.rows[r][orderBy]);

                }
            });
    </script>
</body>

</html>