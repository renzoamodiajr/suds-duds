<?php 
session_start();
if(empty($_SESSION['id'])){
  header('Location: index.php');
}

 ?>
<!DOCTYPE html>
<html>
<title>HOME</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
.w3-sidebar a {
  font-family: "Roboto", sans-serif
}
body,h1,h2,h3,h4,h5,h6,.w3-wide {
  font-family: "Montserrat", sans-serif;
}
*{
box-sizing: border-box;
}
.w3-main{margin-top: -27px;}
</style>
<input type="text" value="<?php echo $_SESSION['id']; ?>" id="userID">

  <!-- Sidebar/menu -->
  <nav class="w3-sidebar w3-card-4 w3-bar-block w3-theme-14 w3-collapse w3-top" style="z-index:3;width:250px;background: url(images/ja.jpg);background-attachment: fixed;" id="mySidebar">
    <div class="w3-container w3-display-container w3-padding-16">
      <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
      <a href="home.php"><img src="images/logo.png"></a>
    </div>
  
    <div class="w3-padding-64 w3-large w3-text-white" style="font-weight:bold">
      <a href="#home" class="w3-bar-item w3-button"><i class="fa fa-home w3-margin-right" style="font-size:24px"></i>HOME</a>
      <a href="reservation.php" class="w3-bar-item w3-button"><i class="fa fa-newspaper-o w3-margin-right" style="font-size:20px"></i>RESERVATION</a>
      <a href="tracker.php" class="w3-bar-item w3-button"><i class="fa fa-crosshairs w3-margin-right" style="font-size:20px"></i>TRACKER</a>
      <a href="#contact" class="w3-bar-item w3-button"><i class="fa fa-phone-square w3-margin-right" style="font-size:24px"></i>CONTACT</a>
      <a href="logout.php" class="w3-bar-item w3-button"><i class="fa fa-power-off w3-margin-right" style="font-size:24px"></i>LOGOUT</a>
    </div>
  </nav>

<!-- Top menu on small screens -->
<header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge"> 
  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-24 w3-right" onclick="w3_open()"><i class="fa fa-bars"></i></a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<body class="w3-content" style="max-width:1200px;background: url(images/jajaa.jpg); background-size: cover;background-attachment: fixed;">
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:250px">
  
<!-- Page content -->
<div class="w3-content w3-sand w3-card-4" style="max-width:2000px;" id="home">
  <!-- Automatic Slideshow Images--> 
  <div class="mySlides w3-display-container w3-center">
    <img src="images/header.jpg" style="width:100%; height: 10%;">
  </div>
  
<div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="about">
    <h2 class="w3-wide">WELCOME TO SUDS AND DUDS</h2>
    <p class="w3-opacity"><h2 style="text-transform:capitalize"><?php echo $_SESSION['name']; ?></h2></p>
    <p class="w3-justify">Clothing, linens, towels, cleaning rags, reusable diapers – laundry has a way of piling up. The often-dreaded chore is one of the ways we help maintain a clean and healthy household, but with the current COVID-19 pandemic and cold and flu season right around the corner, is a standard wash enough?<br>
    The soiled laundry in our hampers can be contaminated with all sorts of germs, from bodily fluids to food debris, all of which can be a source of pathogenic bacteria, fungi and viruses. Environmental microbiologists and public health researchers at the University of Arizona recently held a workshop with a panel of laundry cleaning and sanitization experts to review the current knowledge and science surrounding laundry best practices.  .</p>

    <div class="w3-row w3-padding-32">
      <div class="w3-third">
    
        <img src="images/11.jpg" class="w3-round w3-margin-bottom" style="width:60%">
      </div>
      <div class="w3-third">
      
        <img src="images/22.jpg" class="w3-round w3-margin-bottom" style="width:60%">
      </div>
      <div class="w3-third">
      
        <img src="images/33.jpg" class="w3-round" style="width:60%">
      </div>
    </div>
  </div>
</div>

  <!-- Footer -->
  <footer class="w3-padding-64 w3-light-grey w3-small w3-center" id="footer">
    <div class="w3-row-padding">
      <div class="w3-col s4">
        <h4 id="contact">Contact</h4>
        <p>Questions? Go ahead.</p>
        <form action="/action_page.php" target="_blank">
          <p><input class="w3-input w3-border" type="text" placeholder="Name" name="Name" required></p>
          <p><input class="w3-input w3-border" type="text" placeholder="Email" name="Email" required></p>
          <p><input class="w3-input w3-border" type="text" placeholder="Subject" name="Subject" required></p>
          <p><input class="w3-input w3-border" type="text" placeholder="Message" name="Message" required></p>
          <button type="submit" class="w3-button w3-block w3-dark-gray">Send</button>
        </form>
      </div>

      <div class="w3-col s4">
        <h4>About</h4>
        <p><a href="#">About us</a></p>
        <p><a href="#">We're hiring</a></p>
        <p><a href="#">Support</a></p>
        <p><a href="#">Find store</a></p>
        <p><a href="#">Help</a></p>
      </div>

      <div class="w3-col s4 w3-justify">
        <h4>SUDS AND DUDS</h4>
        <p><i class="fa fa-fw fa-map-marker"></i> Makati City</p>
        <p><i class="fa fa-fw fa-phone"></i> 0044123123</p>
        <p><i class="fa fa-fw fa-envelope"></i> ex@mail.com</p>
        <br>
      </div>
    </div>
  </footer>
 
  <script>
// Accordion 
function myAccFunc() {
  var x = document.getElementById("demoAcc");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else {
    x.className = x.className.replace(" w3-show", "");
  }
}

// Click on the "Jeans" link on page load to open the accordion for demo purposes
document.getElementById("myBtn").click();


// Open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
}



</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="users.js"></script>
</body>
</html>
