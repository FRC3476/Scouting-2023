<title>Simple Match Form</title>
<html lang="en">

<?php include('navbar.php'); ?>

<body class="bg-body">
    <div class="card bg-light" style="margin: 25px; padding: 10px">
        <div class="card-header">Match View</div>
        <div class="card-header">Match: 1</div>

        <div class="card-body">
            <div style="display: flex; align-items: center; justify-content: space-around;">
                <div>
                    <label for="teamSelection" class="form-label">Team</label>
                    <select id="teamSelection" class="form-select" aria-label="Select Team">
                        <option value="" selected>Select Team</option>
                        <option value="Blue1">Blue Team 1</option>
                        <option value="Blue2">Blue Team 2</option>
                        <option value="Blue3">Blue Team 3</option>
                        <option value="Red1">Red Team 1</option>
                        <option value="Red2">Red Team 2</option>
                        <option value="Red3">Red Team 3</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <!-- Auto -->
                    <table class="table  table-bordered" style="text-align: center;">
                        <thead>
                            <tr>
                                <th scope="col" colspan="3" style="text-align: center;">Charging Station (Auto)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkNoneAuto" disabled>
                                        <label class="form-check-label" for="checkNoneAuto" style="opacity: 1;">
                                            None
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkUnbalancedAuto" disabled>
                                        <label class="form-check-label" for="checkUnbalancedAuto" style="opacity: 1;">
                                            Unbalanced
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkBalancedAuto" checked disabled>
                                        <label class="form-check-label" for="checkBalancedAuto" style="opacity: 1;">
                                            Balanced
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Teleop -->
                    <table class="table table-bordered" style="text-align: center;">
                        <thead>
                            <tr>
                                <th scope="col" colspan="3" style="text-align: center;">Charging Station (Teleop)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkNoneTeleop" disabled>
                                        <label class="form-check-label" for="checkNoneTeleop" style="opacity: 1;">
                                            None
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkUnbalancedTeleop" checked disabled>
                                        <label class="form-check-label" for="checkUnbalancedTeleop" style="opacity: 1;">
                                            Unbalanced
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkBalancedTeleop" disabled>
                                        <label class="form-check-label" for="checkBalancedTeleop" style="opacity: 1;">
                                            Balanced
                                        </label>
                                    </div>
                                </td>


                            </tr>

                        </tbody>
                    </table>

                    <table class="table table-bordered" style="text-align: center;">
                        <thead>
                            <tr>
                                <th scope="col" colspan="3">

                                    <label class="form-check-label" for="checkMobility" style="opacity: 1;">
                                        Mobility?
                                    </label>
                                    <input class="form-check-input" type="checkbox" value="" id="checkMobility" checked disabled>
                                </th>
                                <th scope="col" colspan="3" style="text-align: center;">
                                    <label class="form-check-label" for="checkDefense" style="opacity: 1;">
                                        Defense?
                                    </label>
                                    <input class="form-check-input" type="checkbox" value="" id="checkDefense" checked disabled>
                                </th>
                                <th scope="col" colspan="3" style="text-align: center;">
                                    <label class="form-check-label" for="checkDNP" style="opacity: 1;">
                                        DNP?
                                    </label>
                                    <input class="form-check-input" type="checkbox" value="" id="checkDNP" disabled>
                                </th>
                            </tr>
                        </thead>

                    </table>
                </div>

                <div class="col-md-4">
                    <table class="table table-bordered" style="text-align: center;">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align: center;"></th>
                                <th scope="col" style="text-align: center;">Cube</th>
                                <th scope="col" style="text-align: center;">Cone</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Level 1
                                </td>

                                <td>
                                    1
                                </td>

                                <td>
                                    2
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Level 2
                                </td>
                                <td>
                                    1
                                </td>
                                <td>
                                    1
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Level 3
                                </td>
                                <td>
                                    2
                                </td>
                                <td>
                                    3
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <canvas id="myChart"></canvas>

                </div>
            </div>
        </div>



    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',

            data: {

                labels: ["Level 1", "Level 2", "Level 3"],
                datasets: [{
                        label: "Cones",
                        fillColor: "blue",
                        data: [1, 1, 1]
                    },
                    {
                        label: "Cubes",
                        fillColor: "red",
                        data: [2, 1, 3]
                    },

                ]
            },
            options: {
                barValueSpacing: 1,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 3,
                    }
                }
            }
        });
    </script>

</body>

<?php include("footer.php"); ?>


</html>