<?php 
session_start();
include "db_conn.php";
if(empty($_SESSION['id'])){
    header('Location: index.php');
}

date_default_timezone_set('Asia/Manila');

 ?>
<!DOCTYPE html>
<html>
<title>TRACKER</title>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
 
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
 
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
.has-error{border-color: #fe8686;box-shadow: 0 0 0 0.25rem rgb(253 13 13 / 25%);}

.w3-main{margin-top: -27px;}
/* PRINT */

@media screen {
    #printSection{
        display: none;
    }
  }

@page { size: auto;  margin: 0mm;}

@media print {

  html, body {
    height:100%; 
    overflow: hidden;
    zoom: 130%;
    align-items: center;
    margin: auto;
    vertical-align: middle;
  }
  body * {
    visibility:hidden;
  }
 
  #printSection, #printSection *{
    visibility:visible;
  }

  #printSection {
    align-items: center;
    margin: auto;
    left:0;
    right:0;
    position: absolute;
    padding: 110px 0 0 60px;
    bottom: 0;
    top:20px;
  	vertical-align: middle;
  }
 
}
</style>

</head>


<body class="w3-content" style="max-width:1200px;background: url(images/jajaa.jpg); background-size: cover;background-attachment: fixed;">

  <input type="text" value="<?php echo $_SESSION['id']; ?>" id="userID">

  <!-- Sidebar/menu -->
  <nav class="w3-sidebar w3-card-4 w3-bar-block w3-theme-14 w3-collapse w3-top" style="z-index:3;width:250px;background: url(images/ja.jpg);background-attachment: fixed;" id="mySidebar">
    <div class="w3-container w3-display-container w3-padding-16">
      <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
      <a href="home.php"><img src="images/logo.png"></a>
    </div>
  
    <div class="w3-padding-64 w3-large w3-text-white" style="font-weight:bold">
      <a href="home.php" class="w3-bar-item w3-button"><i class="fa fa-home w3-margin-right" style="font-size:24px"></i>HOME</a>
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


<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:250px">
  
<!-- Page content -->
<div class="w3-content w3-white w3-card-4" style="max-width:2000px;">


  <!-- The Reservation Section -->
  <div class="w3-dark-gray" id="reservation">
    <div class="w3-container w3-content w3-padding-64" style="max-width:800px">
      <h2 class="w3-wide w3-center">RESERVATION HISTORY</h2>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Reservation Date</th>
                                <th scope="col">Status</th>
                                <th scope="col"><i class="fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php 
                            $userID = $_SESSION["id"];
                            $currDate = date('m/d/Y');
                            $stmt = mysqli_query($conn, "SELECT * FROM reservation_info INNER JOIN services ON reservation_info.srvc_id = services.srvc_id WHERE user_id = '$userID' ORDER BY res_id DESC"); 
                            if(mysqli_num_rows($stmt) > 0):
                                while($row = mysqli_fetch_assoc($stmt)):
                        ?>
                                <tr>
                                    <th><?php echo $row['res_date'] ?></th>
                                    <td>
                                        <?php if($row['res_date'] >= $currDate && $row['res_status'] == 'Pending'){ ?>
                                            <i class="fas fa-hourglass-half text-success"></i> Pending 
                                        <?php } ?>
                                        <?php if($row['res_date'] >= $currDate && $row['res_status'] == 'Accepted'){ ?>
                                            <i class="fas fa-arrow-up text-success"></i> On-going 
                                        <?php } ?>
                                        <?php if($row['res_status'] == 'Rejected'){ ?>
                                            <i class="fas fa-times text-danger"></i> Rejected
                                        <?php } ?>
                                        <?php if($row['res_date'] < $currDate && $row['res_status'] == 'Accepted'){ ?>
                                            <i class="fas fa-check text-danger"></i> Finished
                                        <?php } ?>
                                    </td>
                                    <td><button class="btn btn-primary btn-sm viewResInfo" data-id="<?php echo $row['res_id']; ?>" onclick="document.getElementById('ticketModal').style.display='block'">View</button></td>
                                </tr>
                        <?php endwhile;
                            endif;
                        ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>


  <div id="ticketModal" class="w3-modal" style="padding-top: 17px;overflow: hidden;">
    <div class="w3-modal-content w3-animate-top w3-card-4">
      <header class="w3-container w3-teal w3-center w3-padding-32"> 
        <span onclick="document.getElementById('ticketModal').style.display='none'" 
       class="w3-button w3-teal w3-xlarge w3-display-topright">×</span>
        <h2 class="w3-wide"><i class="fa fa-suitcase w3-margin-right"></i>Details</h2>
      </header>
        <div class="w3-container my-5 pb-5" style="background:#fff">
              <div class="col-md-8 me-auto ms-auto pb-5">
                  <div id="resInfoCon">
                      <div class="row mb-3">
                          <div class="col" style="font-weight:bold">Service Type:</div>  
                          <div class="col" id="srvcType">XXX</div>  
                      </div>
                      <div class="row mb-3">
                        <div class="col" style="font-weight:bold">Kilogram:</div>
                        <div class="col" id="kg">XXX</div>
                      </div>
                      <div class="row mb-3">
                        <div class="col" style="font-weight:bold">Detergent:</div>
                        <div class="col" id="detrgntType">XXX</div>
                      </div>
                      <div class="row mb-3">
                        <div class="col" style="font-weight:bold">FabCon:</div>
                        <div class="col" id="fabConType">XXXX</div>
                      </div>
                      <div class="row mb-3">
                        <div class="col" style="font-weight:bold">Date reserved:</div>
                        <div class="col" id="dateRes">XXX</div>
                      </div>
                      <div class="row mb-3">
                        <div class="col" style="font-weight:bold">Note:</div>
                        <div class="col" id="notee">XXX</div>
                        </div>
                      <div class="row mb-3">
                        <div class="col" style="font-weight:bold">Status:</div>
                        <div class="col" id="stats"><i class="fas fa-check text-success"></i> XXX</div>
                      </div>
                      <div class="row mb-3">
                        <div class="col" style="font-weight:bold">Amount due:</div>
                        <div class="col" id="amntPaid">XXXX</div>
                      </div>
                  </div>
                  <button class="btn btn-primary float-end" id="downloadPDF" style="display:none"><i class="fas fa-download"></i> Download PDF file</button>
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

  <div class="w3-dark-gray w3-center w3-padding-24"><i class="fa fa-facebook-official w3-hover-opacity w3-large"></i>
        <i class="fa fa-instagram w3-hover-opacity w3-large"></i>
        <i class="fa fa-snapchat w3-hover-opacity w3-large"></i>
        <i class="fa fa-pinterest-p w3-hover-opacity w3-large"></i>
        <i class="fa fa-twitter w3-hover-opacity w3-large"></i>
        <i class="fa fa-linkedin w3-hover-opacity w3-large"></i>
  </div>

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
