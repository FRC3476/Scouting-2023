<title>Lead Scout Data</title>
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
                    <th scope="col">Match</th>
                    <th scope="col">Rank 1</th>
                    <th scope="col">Rank 2</th>
                    <th scope="col">Rank 3</th>
                    <th scope="col">Rank 5</th>
                    <th scope="col">Rank 5</th>
                    <th scope="col">Rank 6</th>
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
                  `  <th scope="row">${rowData['matchNum']}</th>`,
                  `  <td>${rowData['team1']}</td>`,
                  `  <td>${rowData['team2']}</td>`,
                  `  <td>${rowData['team3']}</td>`,
                  `  <td>${rowData['team4']}</td>`,
                  `  <td>${rowData['team5']}</td>`,
                  `  <td>${rowData['team6']}</td>`,
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
    "readAllLSData": true
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