<?php
require_once('SQLFunctions.php');
 session_start();
/*if there is no Currnet Navigation set, default to the first on on the list based on order*/
 if(!isset($_SESSION['CurNav']))
 {
    echo "CurNav Not Set <br>";/*this is a testing comment*/
    $sql="SELECT Nav_ID ,Display_Order ,Nav_Title FROM Nav
          ORDER BY Display_Order ,Nav_Title LIMIT 1";

  $link = connectDB();
  /*run query, assign the session variable*/
   if ($result = mysqli_query($link,$sql)){
     while ($row = mysqli_fetch_array($result)) {
        $_SESSION['CurNav'] = $row[0];
     }
   }
 mysqli_close ( $link );
}
  /*Set $CurNav variable to the value of the CurNav session variable*/
  $CurNav = $_SESSION['CurNav'];
  /*Simlar to CRUD, logging out the users that haven't been active in the last 10 mins*/
  if(isset($_SESSION['user_id']))
  {
    if ($_SESSION['timeout'] + 10 * 60 < time()) {
    /* session timed out */
    header("Location: Logout.php");
    } else {
        $_SESSION['timeout'] = time();
       /*For convinience, adding a button to get back to the AdminInxed.php page*/
        echo "<a href='AdminIndex.php'><button>Admin Menu</button></a>";
     }
  }
?>
<html lang="en">

  <head>
  <style type="text/css">
     .NavMenu div {
        float:left;
      }
    .NavMenu {
          float: right;
        position: relative;
       left: -50%;
      }
    .NavMenu > .child {
       position: relative;
       left: 50%;
       }
     input[type=submit] {
       text-transform: uppercase;
       font-weight: 400;
       letter-spacing: 3px;
       margin:5px;
       margin-top: 20px;
      }
</style>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $siteTitle; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/business-casual.css" rel="stylesheet">

  </head>

  <body>

    <div class="tagline-upper text-center text-heading text-shadow text-white mt-5 d-none d-lg-block"><?php echo $siteBrand; ?></div>
    <div class="tagline-lower text-center text-expanded text-shadow text-uppercase text-white mb-5 d-none d-lg-block"><?php echo $siteAddress; ?></div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-faded py-lg-4">
      <div class="container">
        <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="#">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

      <div class="collapse navbar-collapse" id="navbarResponsive">

        <ul class="navbar-nav mx-auto">
          <?php
            /*Query Navigation*/
            $sql= "SELECT Nav_Title ,Nav_ID FROM Nav
                  ORDER BY Display_Order ,Nav_Title";
            /*echo '<br>sql :'.$sql;*/
            $link = connectDB();
           /*Pull in our custom CSS using div class*/
            echo "<div class='NavMenu'>";
            echo "<div class='child'>";
            if ($result = mysqli_query($link,$sql)){
            /*Each row returned will get it's own div with a form contained in it.
            They will act as dynamic buttons sending the user to UpdateCurNav.php*/
           while ($row = mysqli_fetch_array($result)) {
             echo "<div> <form action='UpdateCurNav.php' method='post'>
                   <input type='submit' class='btn' name='submit' value='{$row[0]}'>
                   <input type='hidden' name='NewNav' value='{$row[1]}'>
                   </form>
                    </div>";
           }
          }
          echo "</div>" ;
          echo "</div>" ;
        /*Close database connection*/
         mysqli_close ( $link );
        ?>
      <!---      <li class="nav-item active px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="index.php">

              </a>
            </li>
           <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="about.html">About</a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="blog.html">Blog</a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="contact.html">Contact</a>
            </li> -->

          </ul>
        </div>
      </div>
    </nav>

    <div class="container">

      <div class="bg-faded p-4 my-4">
        <!-- Image Carousel -->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid w-100" src="img/slide-1.jpg" alt="">
              <div class="carousel-caption d-none d-md-block">
                <h3 class="text-shadow">First Slide</h3>
                <p class="text-shadow">This is the caption for the first slide.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid w-100" src="img/slide-2.jpg" alt="">
              <div class="carousel-caption d-none d-md-block">
                <h3 class="text-shadow">Second Slide</h3>
                <p class="text-shadow">This is the caption for the second slide.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid w-100" src="img/slide-3.jpg" alt="">
              <div class="carousel-caption d-none d-md-block">
                <h3 class="text-shadow">Third Slide</h3>
                <p class="text-shadow">This is the caption for the third slide.</p>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        <!-- Welcome Message -->
        <div class="text-center mt-4">
          <div class="text-heading text-muted text-lg">Welcome To</div>
          <h1 class="my-2"><?php echo $siteShortTitle; ?></h1>
          <div class="text-heading text-muted text-lg">By
            <strong>Start Bootstrap</strong>
          </div>
        </div>
      </div>

    <!--  <div class="bg-faded p-4 my-4">
        <hr class="divider">
        <h2 class="text-center text-lg text-uppercase my-0">Build a website
          <strong>worth visitng</strong>
        </h2>
        <hr class="divider">
        <img class="img-fluid float-left mr-4 d-none d-lg-block" src="img/intro-pic.jpg" alt="">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam soluta dolore voluptatem, deleniti dignissimos excepturi veritatis cum hic sunt perferendis ipsum perspiciatis nam officiis sequi atque enim ut! Velit, consectetur.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam pariatur perspiciatis reprehenderit illo et vitae iste provident debitis quos corporis saepe deserunt ad, officia, minima natus molestias assumenda nisi velit?</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit totam libero expedita magni est delectus pariatur aut, aperiam eveniet velit cum possimus, autem voluptas. Eum qui ut quasi voluptate blanditiis?</p>
      </div>

      <div class="bg-faded p-4 my-4">
        <hr class="divider">
        <h2 class="text-center text-lg text-uppercase my-0">Beautiful boxes to
          <strong>showcase your content</strong>
        </h2>
        <hr class="divider">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam soluta dolore voluptatem, deleniti dignissimos excepturi veritatis cum hic sunt perferendis ipsum perspiciatis nam officiis sequi atque enim ut! Velit, consectetur.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam pariatur perspiciatis reprehenderit illo et vitae iste provident debitis quos corporis saepe deserunt ad, officia, minima natus molestias assumenda nisi velit?</p>
      </div>

    </div> -->
    <?php
      /*Query Content for the Current Navigation*/
      $sql="SELECT ContentTitle ,Content
            FROM Content WHERE Nav_ID = ".$CurNav."
            ORDER BY Display_Order";
      /*echo '<br>sql :'.$sql;*/
      $link = connectDB();
    /*Execute the query, for each row returned, display a box with the results of the content in it.*/
     if ($result = mysqli_query($link,$sql)){
      while ($row = mysqli_fetch_array($result)) {
          echo "<div class='row'>";
          echo " <div class='box'>";
          echo "<div class='col-lg-12'>";
          echo "<hr><h2 class='intro-text text-center'><strong>{$row[0]}</strong></h2><hr>";
          echo "<p>{$row[1]}</p>";
          echo "</div>";
          echo "</div>";
          echo "</div>";
      }
     }
    /*Close database connection*/
    mysqli_close ( $link );
  ?>
</div>
    <!-- /.container -->

    <footer class="bg-faded text-center py-5">
      <div class="container">
        <p class="m-0"><?php echo $siteFooter; ?></p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

  </body>

</html>
