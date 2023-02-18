<title>Scouting</title>
<html lang="en">

<?php include('navbar.php'); ?>

<body class="bg-body">
  <div class="container row-offcanvas row-offcanvas-left">
    <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
  
    <span class="badge rounded-pill text-bg-primary cannedComments">Slow Drive</span>
    <span class="badge rounded-pill text-bg-primary cannedComments">Fast Drive</span>
    <span class="badge rounded-pill text-bg-primary cannedComments">Good Defense</span>
    <span class="badge rounded-pill text-bg-primary cannedComments">Bad Defense</span>

    <br><br>

    <button id="submit type="button" class="submit btn btn-primary">Submit</button>
    </div>
  </div>
</body>

<?php include("footer.php"); ?>

</html>

<script>

  function getCannedComments(){
    /* Return list of canned comments based on if they have the 'selected' class. */
    var comments = [];
    $('.selected').each(function(i, obj) {  // Iterates through each object with element 'selected'.
      comments.push($(this).text()); // this returns to the current element with class 'selected'.
    });
    return comments;
  }

  // Binds all HTML dom objects with class 'cannedComments' to run the function when clicked
  $('.cannedComments').on('click', function(event){
    var isSelected = $(this).hasClass('selected'); // Check if clicked badge has 'selected' class.
    if (isSelected) {
      // If previously selected, remove the class and make primary.
      $(this).removeClass('text-bg-success selected');
      $(this).addClass('text-bg-primary');
    }
    else {
      // If not selected, make selected and add class + change color.
      $(this).removeClass('text-bg-primary');
      $(this).addClass('text-bg-success selected');
    }
  });

  // Create alert when submit is pressed.
  $('.submit').on('click', function(event){
    alert(getCannedComments());
  });

</script>