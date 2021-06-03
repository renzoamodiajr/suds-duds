<?php 
session_start();
if(empty($_SESSION['id'])){
    header('Location: index.php');
}


 ?>
<!DOCTYPE html>
<html>
<title>RESERVATION</title>
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
</style>

</head>


<body class="w3-content" style="max-width:1200px; background: url(images/jajaa.jpg); background-size: cover;background-attachment: fixed;">

  <input type="hidden" value="<?php echo $_SESSION['id']; ?>" id="userID">

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
<div class="w3-content w3-white w3-card-4" style="max-width:2000px;" id="home">


  <!-- The Reservation Section -->
  <div class="w3-dark-gray" id="reservation">
    <div class="w3-container w3-content w3-padding-64" style="max-width:800px">
      <h2 class="w3-wide w3-center">RESERVATION</h2>
      <p class="w3-opacity w3-center"><strong>BOOK</strong><i> YOUR LAUNDRY</i></p><br>

      <div class="w3-row-padding w3-padding-32" style="margin:0 -16px">
        <div class="w3-third w3-margin-bottom">
          <img src="images/wash1.jpg" style="width:100%;" class="w3-hover-opacity">
          <div class="w3-container w3-white">
            <p><b>Wash Only</b></p>
            <button class="w3-button w3-black w3-margin-bottom" id="washOnly" onclick="document.getElementById('ticketModal').style.display='block'">Select</button>
          </div>
        </div>
        <div class="w3-third w3-margin-bottom">
          <img src="images/dry1.jpg" style="width:100%" class="w3-hover-opacity">
          <div class="w3-container w3-white">
            <p><b>Dry Only</b></p>
            <button class="w3-button w3-black w3-margin-bottom" onclick="document.getElementById('dryModal').style.display='block'">Select</button>
          </div>
        </div>
        <div class="w3-third w3-margin-bottom">
          <img src="images/washdry.jpg" style="width:100%" class="w3-hover-opacity">
          <div class="w3-container w3-white">
            <p class="fw-bold">Wash & Dry</p>
            <button class="w3-button w3-black w3-margin-bottom" data-modal-form="Wash & Dry" id="washDryBtn" onclick="document.getElementById('ticketModal').style.display='block'">Select</button>
          </div>
        </div>
      </div>
    </div>
  </div>



  <!-- Ticket Modal -->
  <div id="ticketModal" class="w3-modal" style="padding-top: 17px;">
    <div class="w3-modal-content w3-animate-top w3-card-4">
      <header class="w3-container w3-teal w3-center w3-padding-32"> 
        <span onclick="document.getElementById('ticketModal').style.display='none'" 
       class="w3-button w3-teal w3-xlarge w3-display-topright">×</span>
        <h2 class="w3-wide"><i class="fa fa-suitcase w3-margin-right"></i>Details</h2>
      </header>
      <div class="w3-container my-5">
        <form id="washDryForm">
              <input type="hidden" id="srvcType">
              <h2 class="text-center" id="modalFormTitle">Wash-only form</h2>      
              <div class="row justify-content-center">
                <div class="col-md-8 mb-4 inptbox full">
                  <label for="kilo">Select Kilo <span class="text-danger">*</span></label>
                          <select id="washDryKilo" class="form-select">
                              <option value="">Select Kilo</option>
                              <option value="1">1kg</option>
                              <option value="2">2kg</option>
                              <option value="3">3kg</option>
                              <option value="4">4kg</option>
                              <option value="5">5kg</option>
                              <option value="6">6kg</option>
                              <option value="7">7kg</option>
                              <option value="8">8kg</option>
                        </select>
                  </div>
              </div>
              <div class="row justify-content-center">
                  <div class="col-md-8 mb-4 inptbox full">
                      <div class="row">
                        <div class="col">
                          <label for="kilo">Select Detergent <span class="text-primary">(optional)</span></label>
                            <select class="form-select selItem" id="selDetergent">
                              <!-- AUTO POPULATE CODE WILL DO -->
                          </select>
                        </div>
                        <div class="col">
                          <label for="kilo">Quanty</label>
                          <input type="number" class="form-control" placeholder="Enter quantity" id="detergentQty" disabled>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="row justify-content-center">
                  <div class="col-md-8 mb-4 inptbox full">
                      <div class="row">
                        <div class="col">
                          <label for="kilo">Select FabCon <span class="text-primary">(optional)</span></label>
                            <select class="form-select selItem" id="selFabCon">
                                <!-- AUTO POPULATE CODE WILL DO -->
                            </select>
                        </div>
                        <div class="col">
                          <label for="kilo">Quanty:</label>
                          <input type="number" class="form-control" placeholder="Enter quantity" id="fabConQty" disabled>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="row justify-content-center">
                  <div class="col-md-8 mb-4 inptbox full">
                      <div class="row">
                        <div class="col">
                            <label for="kilo">Reservation Date <span class="text-danger">*</span></label>
                            <input type="text" class="form-control datepicker selDate" placeholder="Choose date" id="washDryResDate" autocomplete="off">
                        </div>
                        <div class="col">
                          <label for="kilo">Time of Arrival <span class="text-danger">*</span></label>
                          <select id="washDryResTime" class="form-select" disabled>
                                <option value="">Select time</option>
                                <option value="08:00 am">08:00 am</option>
                                <option value="08:00 am">09:00 am</option>
                                <option value="10:00 am">10:00 am</option>
                                <option value="11:00 am">11:00 am</option>
                                <option value="12:00 pm">12:00 pm</option>
                                <option value="01:00 pm">01:00 pm</option>
                                <option value="02:00 pm">02:00 pm</option>
                                <option value="03:00 pm">03:00 pm</option>
                                <option value="04:00 pm">04:00 pm</option>
                          </select>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="row justify-content-center">
                  <div class="col-md-8 mb-4 inptbox full">
                      <div class="row">
                        <div class="col">
                          <label for="kilo">Enter a phone number <span class="text-danger">*</span></label>
                          <input type="text" class="form-control"  id="washDryPN" name="phone" placeholder="0123-456-7891" >
                        </div>
                      </div>
                  </div>
              </div>  
              <div class="row justify-content-center">
                  <div class="col-md-8 mb-4 inptbox full">
                      <div class="row mb-2">
                        <div class="col">
                          <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="washDryNote" style="height: 100px"></textarea>
                            <label for="floatingTextarea2">Note <span class="text-primary">(optional)</span></label>
                          </div>
                        </div>
                      </div>
                    <span class="text-danger pt-5 errMsg" style="display: none;">Fields with asterisk are required!</span>
                  </div>
              </div>    
          </form>
          <button class="w3-button w3-block w3-teal w3-padding-16 w3-section w3-right" id="submitWashDryBtn">SUBMIT <i class="fa fa-check"></i></button>
          <button class="w3-button w3-red w3-section" onclick="document.getElementById('ticketModal').style.display='none'">Close <i class="fa fa-remove"></i></button>
        <p class="w3-right">Need <a href="#" class="w3-text-blue">help?</a></p>
      </div>
    </div>
  </div>



<!----DRY ONLY MODAL---->
  <div id="dryModal" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-4">
      <header class="w3-container w3-teal w3-center w3-padding-32"> 
        <span onclick="document.getElementById('dryModal').style.display='none'" 
       class="w3-button w3-teal w3-xlarge w3-display-topright">×</span>
        <h2 class="w3-wide"><i class="fa fa-suitcase w3-margin-right"></i>Details</h2>
      </header>
      <div class="w3-container my-5">
        <h2 class="text-center">Dry-only form</h2>
          <form id="dryOnlyForm">
            <div class="row justify-content-center">
                <div class="col-md-8 mb-4 inptbox full">
                  <label for="kilo">Select Kilo <span class="text-danger">*</span></label>
                          <select id="dryKilo" class="form-select" name="cars">
                              <option value="">Select Kilo</option>
                              <option value="1">1kg</option>
                              <option value="2">2kg</option>
                              <option value="3">3kg</option>
                              <option value="4">4kg</option>
                              <option value="5">5kg</option>
                              <option value="6">6kg</option>
                              <option value="7">7kg</option>
                              <option value="8">8kg</option>
                        </select>
                  </div>
              </div>
              <div class="row justify-content-center">
                  <div class="col-md-8 mb-4 inptbox full">
                      <div class="row">
                        <div class="col">
                          <label for="kilo">Reservation Date <span class="text-danger">*</span></label>
                           <input type="text" id="dryResDate" class="form-control datepicker selDate" placeholder="Choose date">
                        </div>
                        <div class="col">
                          <label for="kilo">Time of Arrival <span class="text-danger">*</span></label>
                            <select id="dryResTime" class="form-select" disabled>
                                  <option value="">Select time</option>
                                  <option value="08:00 am">08:00 am</option>
                                  <option value="08:00 am">09:00 am</option>
                                  <option value="10:00 am">10:00 am</option>
                                  <option value="11:00 am">11:00 am</option>
                                  <option value="12:00 pm">12:00 pm</option>
                                  <option value="01:00 pm">01:00 pm</option>
                                  <option value="02:00 pm">02:00 pm</option>
                                  <option value="03:00 pm">03:00 pm</option>
                                  <option value="04:00 pm">04:00 pm</option>
                            </select>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="row justify-content-center">
                  <div class="col-md-8 mb-4 inptbox full">
                      <div class="row">
                        <div class="col">
                          <label for="kilo">Enter a phone number <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="dryPN" name="phone" placeholder="0123-456-7891" >
                        </div>
                      </div>
                  </div>
              </div>  
              <div class="row justify-content-center">
                  <div class="col-md-8 mb-4 inptbox full">
                      <div class="row">
                        <div class="col">
                          <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="dryNote" style="height: 100px"></textarea>
                            <label for="floatingTextarea2">Note <span class="text-primary">(optional)</span></label>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>    
          </form>
          <button class="w3-button w3-block w3-teal w3-padding-16 w3-section w3-right" id="submitDryBtn">SUBMIT <i class="fa fa-check"></i></button>
          <button class="w3-button w3-red w3-section" onclick="document.getElementById('dryModal').style.display='none'">Close <i class="fa fa-remove"></i></button>
        <p class="w3-right">Need <a href="#" class="w3-text-blue">help?</a></p>
      </div>
    </div>
  </div>
  
  <div class="w3-padding-64 w3-light-grey w3-small w3-center " id="footer">
    <div class="w3-row-padding">
      <div class="w3-col s4" >
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
