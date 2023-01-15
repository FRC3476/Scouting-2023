<html lang="en" class="full-height">
<?php
include('header.php');
include('navBar.php');
?>
<script src="js/bootstrap.min.js"></script>

<style>
    /* TEMPLATE STYLES */
    .flex-center {
        color: #fff;
    }

    .intro-1 {
        background: url("dug.png")no-repeat center center;
        background-size: cover;
    }

    .navbar .btn-group .dropdown-menu a:hover {
        color: #000 !important;
    }

    .navbar .btn-group .dropdown-menu a:active {

        color: #fff !important;
    }
</style>

<body style="background-color:#008080">
    <header>
        <!--Intro Section-->
        <section class="view intro-1 hm-black-strong">
            <div style="background-color: rgba(0,0,0,.3);" class="full-bg-img flex-center">
                <div class="container">
                    <div class="col-lg-2 mb-r">
                        <a href="teamScoutForm.php" class="btn btn-warning">Team Info</a>
                    </div>
                    <div class="col-lg-2 mb-r">
                        <a href="robotScoutForm.php" class="btn btn-warning">Pit Scouting</a>
                    </div>
                    <div class="col-lg-2 mb-r">
                        <a href="matchScoutForm.php" class="btn btn-warning">Match Scouting</a>
                    </div>
                    <div class="col-lg-2 mb-r">
                        <a href="matchResultForm.php" class="btn btn-warning">Match Result</a>
                    </div>
                </div>
            </div>
        </section>
    </header>
    <!-- Main container-->
    <div class="container">
        <div class="divider-new pt-5">
            <h2 style="color:White;"><b>Other Pages<b></h2>
        </div> 

        <!--Section: Best features-->
        <section id="best-features">
            <div class="row pt-3">
            </div>
        </section> 
        <!--/Section: Best features-->

    </div>
    <!--/ Main container-->
    <?php
    include("footer.php");
    ?>
    <!-- Animations init-->
    <script>
        new WOW().init();
    </script>

</body>

</html>