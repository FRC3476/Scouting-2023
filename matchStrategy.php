<html>

<head>
    <style>
        .grid-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: repeat(3, 1fr);
            grid-auto-rows: minmax(100px, auto);
            grid-gap: 20px;
            justify-items: center;
            align-items: center;
        }

        .grid-item {
            background-color: #ddd;
            border: 1px solid #aaa;
            padding: 20px;
        }
    </style>
</head>

<body>
    <?php include('navbar.php'); ?>
    <script>
        var allMatchData;

        function keywords(team) {
            //get all comments by match
            var temp = [];
            for (var i in allMatchData) {
                const match = allMatchData[i];
                if (match.teamNumber == team) temp.push(match.textComments.split("."));
            }
            //get all comment phrases by seperating comment string by periods
            var comments = [];
            for (var i in temp) {
                for (var j in temp[i])
                    if (temp[i][j] != "") comments.push(temp[i][j].trim());
            }
            const counts = {};

            // Loop through the array and count the number of times each comment appears
            for (let i = 0; i < comments.length; i++) {
                const comment = comments[i];
                counts[comment] = (counts[comment] || 0) + 1;
            }

            // Convert the counts object into an array of objects with comment and count fields
            const result = Object.keys(counts).map(comment => ({
                comment,
                count: counts[comment]
            }));
            result.sort((a, b) => b.count - a.count);
            console.log(result);
        }

        function getTeamData(team) {
            var result = [];
            for (var i in allMatchData) {
                if (allMatchData[i].teamNumber == team)
                    result.push(allMatchData[i]);
            }
            let totals = {};
            var fields = [
                "autoMobility",
                "autoConeLevel1",
                "autoConeLevel2",
                "autoConeLevel3",
                "autoCubeLevel1",
                "autoCubeLevel2",
                "autoCubeLevel3",
                "teleopConeLevel1",
                "teleopConeLevel2",
                "teleopConeLevel3",
                "teleopCubeLevel1",
                "teleopCubeLevel2",
                "teleopCubeLevel3",
            ];
            for (var i in fields) totals[fields[i]] = 0;
            //divide by result.length
            for (var i in result) {
                const row = result[i];
                for (var i in fields) totals[fields[i]] += row[fields[i]];
            }
            for (var i in fields) totals[fields[i]] /= result.length;
            totals.teamNumber = result[0].teamNumber;
            totals["textComments"] = result[0].textComments;
            return totals
        }

        function createTeamDisplay(data) {
            console.log(data);
            var main = document.createElement("div");
            main.innerHTML = document.getElementById("teamTemplate").innerHTML;

            function setField(name, value) {
                main.getElementsByClassName(name)[0].innerHTML = value;
            }
            var autoCone = `${data.autoConeLevel1}<br>${data.autoConeLevel2}<br>${data.autoConeLevel3}`;
            var autoCube = `${data.autoCubeLevel1}<br>${data.autoCubeLevel2}<br>${data.autoCubeLevel3}`;
            var teleopCone = `${data.teleopConeLevel1}<br>${data.teleopConeLevel2}<br>${data.teleopConeLevel3}`;
            var teleopCube = `${data.teleopCubeLevel1}<br>${data.teleopCubeLevel2}<br>${data.teleopCubeLevel3}`;
            setField("teamNumber", `Team #${data.teamNumber}`)
            setField("comments", data.textComments)
            setField("autoCone", autoCone);
            setField("autoCube", autoCube);
            setField("teleCone", teleopCone);
            setField("teleCube", teleopCube);
            return main;
        }

        function loadData(str) {
            var teams = str.split(",");
            for (var i in teams) teams[i] = teams[i].trim();
            for (var i in teams) {
                    var div = "team" + teams[i];
                    console.log(div);
                    document.getElementById(div).appendChild(createTeamDisplay(getTeamData(teams[i])));
                }
        }
    </script>
    <div><input id="teams" type="text" placeholder="1, 2, 3, 4, 5, 6"><button onclick="loadData(document.getElementById('teams').value)">Get Match</button></div>
    <div class="grid-container">
        <div id="teamTemplate" hidden>
            <h2 class="teamNumber"></h2>
            <table>
                <tr>
                    <th>Level</th>
                    <th>Auto Cone</th>
                    <th>Auto Cube</th>
                    <th>Teleop Cone</th>
                    <th>Teleop Cube</th>
                </tr>
                <tr>
                    <th>Top<br>Med<br>Low</th>
                    <th class="autoCone"></th>
                    <th class="autoCube"></th>
                    <th class="teleCone"></th>
                    <th class="teleCube"></th>
                </tr>
            </table>
            <h3>Comments:</h3>
            <div class="comments"></div>
        </div>
        <div id="team1" class="grid-item"></div>
        <div id="team4" class="grid-item"></div>
        <div id="team2" class="grid-item"></div>
        <div id="team5" class="grid-item"></div>
        <div id="team3" class="grid-item"></div>
        <div id="team6" class="grid-item"></div>
    </div>
    <script>
        fetch("./readAPI.php?readAllMatchData=1").then(response => response.json())
            .then((data) => {
                allMatchData = data;
            });
    </script>
    <?php include('footer.php'); ?>
</body>

</html>