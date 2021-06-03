<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
  </head>
  <body>
    <section class="abt">
      <header>
        <h2><a href="#" class="logo">SUDS AND DUDS</a></h2>
        <div class="navigation">
          <a href="home.php">Home</a>
          <a href="about.php">About</a>
          <a href="reservation.php">Reservation</a>
          <a href="index.php">logout</a>
        </div>
      </header>
      <center>
        <h2>SERVICES</h2>
          <div class="row">
            <div class="column">
              <h2>WASH</h2>
                <div class="gallery">
                  <img src="images/wash.jpg">
                    <div class="desc">Add a description of the image here</div>
                </div>
            </div>
            <div class="column">
              <h2>DRY</h2>
                <div class="gallery">
                  <img src="images/dry.jpg">
                    <div class="desc">Add a description of the image here</div>
                </div>
            </div>
            <div class="column">
              <h2>FOLD</h2>
                <div class="gallery">
                  <img src="images/dry.jpg">
                    <div class="desc">Add a description of the image here</div>
                </div>
            </div>
          </div>
      </center>
    </section>
  </body>

<footer>
      <div class="media-icons">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
      </div>
</footer>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
    }
 ?>
      