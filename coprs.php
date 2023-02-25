<title>COPRS</title>
<html lang="en">

<?php include('navbar.php'); ?>

<body class="bg-body">
  <div class="container row-offcanvas row-offcanvas-left">
    <div class="well column col-lg-12 col-sm-12 col-xs-12" id="content">
      <div class="row pt-3 pb-3 mb-3">
  
        <div class="input-group mb-3">
          <input id="eventCode" type="text" class="form-control" placeholder="Event Code" aria-label="eventCode">
          <button id="loadEvent" type="button" class="btn btn-primary">Load Event</button>
        </div>
      
        <!-- Left column -->
        <div class="col-lg-12 col-sm-12 col-xs-12 gx-3">
          <div class="card">
          <div class="card-header" id="cardHeader"></div>
            <div class="card-body">
    
            <div class="table-responsive">
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

function getKeyListFromDict(data){
  var out = [];
  for (let key in data){
    out.push(key);
  }
  return out;
}

function updateTable(data){
  /*Update table from API.
  
  Args:
    List of dictionaries of rows.
  */
  $('#tableKeys').empty();
  $('#tableData').empty();
  $('#cardHeader').html(data['eventCode']);
  var coprData = data['data'];
  var headers = null;
  for (let team in coprData){
    if (headers == null){
      headers = getKeyListFromDict(coprData[team]);
      $('#tableKeys').append(createHeaderRow(headers));
    }
    $('#tableData').append(createRow(headers, team, coprData[team]));
  }
  var newTableObject = document.getElementById('dataTable');
  sorttable.makeSortable(newTableObject);
}

function loadInputData(){
  /* Loads data using input event code and populate table. */
  $.post('tbaAPI.php', {
    'getCOPR': 1,
    'eventCode': $('#eventCode').val()
  }, function(data) {
    data = JSON.parse(data);
    console.log(data);
    updateTable(data);
  });
}

function loadDefaultData(){
  /* Load data from inbuilt event. */
  $.post('tbaAPI.php', {
    'getCOPR': 1
  }, function(data) {
    data = JSON.parse(data);
    console.log(data);
    updateTable(data);
  });
}

$(document).ready(function() {
  loadDefaultData();
});

$("#loadEvent").on('click', function(event) {
  loadInputData();
});

</script>

</html>