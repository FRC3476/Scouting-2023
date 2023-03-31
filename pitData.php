  <title>Pit Data</title>
<html lang="en">

<?php include('navbar.php'); ?>

<body class="bg-body">
  <div class="container row-offcanvas row-offcanvas-left">
    <div class="well column col-lg-12 col-sm-12 col-xs-12" id="content">
      <div class="row pt-3 pb-3 mb-3">
      
        <!-- Left column -->
        <div class="col-lg-12 col-sm-12 col-xs-12 gx-3">
          <div class="card">
            <div class="card-body">

            <div class="table-responsive">
              <table id="datatable" class="table table-striped-columns table-hover sortable">
                <thead>
                  <tr>
                    <th scope="col">Number</th>
                    <th scope="col">Organization</th>
                    <th scope="col">Batteries</th>
                    <th scope="col">Chargers</th>
                    <th scope="col">Language</th>
					<th scope="col">Drivetrain Type</th>
                    <th scope="col">Robot Weight</th>
                    <th scope="col">Frame Perimeter</th>
                    <th scope="col">Comments</th>
                  </tr>
                </thead>
                <tbody id='tableBody'>
                 
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

function createRow(rowData){
  /*Create HTML row for data.
  
  Args:
    rowData: Dictionary of keys and values needed for row.
  
    Returns:
      HTML row for table.
  */
  var list_row = [`<tr>`,
                  `  <th scope="row">${rowData['pitTeamNumber']}</th>`,
                  `  <td>${rowData['disorganized']}</td>`,
                  `  <td>${rowData['numBatteries']}</td>`,
                  `  <td>${rowData['chargedBatteries']}</td>`,
                  `  <td>${rowData['codeLanguage']}</td>`,
                  `  <td>${rowData['drivetrainType']}</td>`,
                  `  <td>${rowData['autoPath']}</td>`,
                  `  <td>${rowData['framePerimeterDimensions']}</td>`,
                  `  <td>${rowData['pitComments']}</td>`,
                  `</tr>`];
  return list_row.join('')
}

function updateTable(data){
  /*Update table from API.
  
  Args:
    List of dictionaries of rows.
  */
  $('#tableBody').empty();
  for(var i = 0; i < data.length; ++i){
    var currentRow = data[i];
    $('#tableBody').append(createRow(currentRow));
  }
}

function loadData(){
  /* Loads data and populates table. */
  $.post("readAPI.php", {
    "readAllPitScoutData": true
  }, function(data) {
    data = JSON.parse(data);
    console.log(data);
    updateTable(data);
    var newTableObject = document.getElementById('datatable');
    sorttable.makeSortable(newTableObject);
  });
}

$(document).ready(function() {
  loadData();
});

</script>

</html>