<?php include("header.php"); ?>

<!-- Image and text -->
<nav class="navbar navbar-expand-lg navbar-dark orange" role="navigation">
  <a class="navbar-brand" href="#">
    <img src="images/Logo.png" height="40" class="d-inline-block align-top" alt="">

  </a>
  <div class="container">
    <!-- Drop down button for small screens -->
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <!-- Left justified logo/text -->
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php" style="color:Black;">
        Scouting 2023
      </a>
    </div>
    <!-- What goes under the drop down button/rest of navbar -->
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-left">
        <li><a href="admin.php" style="color:Black;">Admin</a></li>
      </ul>
    </div> 
  </div>
</nav>