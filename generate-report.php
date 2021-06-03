<?php 
session_start();
include "db_conn.php";
if(empty($_SESSION['id'])){
    header('Location: index.php');
}
date_default_timezone_set('Asia/Manila');
$currDate = date('m/d/Y');

 ?>
<!DOCTYPE html>
<html>
<title>Manage Resrvation</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<link rel="stylesheet" href="style-custom.css">
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

</style>

  <!-- Sidebar/menu -->
  <nav class="w3-sidebar w3-card-4 w3-bar-block w3-theme-14 w3-collapse w3-top" style="z-index:3;width:274px" id="mySidebar">
    <div class="w3-container w3-display-container w3-padding-16" id="logo">
      <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
      <a href="home.php"><img src="images/logo.png"></a>
    </div>
  
    <div class="w3-padding-64 w3-large w3-text-grey" style="font-weight:bold">
      <a href="dashboard.php" class="w3-bar-item w3-button"><i class="fas fa-tachometer-alt w3-margin-right" style="font-size:24px"></i>DASHBOARD</a>
      <a href="manage-items.php" class="w3-bar-item w3-button"><i class="fa fa-list w3-margin-right" style="font-size:24px"></i>MANAGE ITEMS</a>
      <a href="manage-reservation.php" class="w3-bar-item w3-button"><i class="fa fa-book w3-margin-right" style="font-size:20px"></i> MANAGE RESERVATION</a>
      <a href="manage-users.php" class="w3-bar-item w3-button"><i class="fa fa-users w3-margin-right" style="font-size:20px"></i> MANAGE USERS</a>
      <a href="generate-report.php" class="w3-bar-item w3-button current_page"><i class="fas fa-line-chart w3-margin-right" style="font-size:20px"></i> GENERATE REPORT</a>
      <a href="logout.php" class="w3-bar-item w3-button"><i class="fa fa-power-off w3-margin-right" style="font-size:24px"></i>LOGOUT</a>
    </div>
  </nav>

<!-- Top menu on small screens -->
<header class="w3-bar w3-top w3-hide-large w3-dark-gray w3-xlarge"> 
  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-24 w3-right" onclick="w3_open()"><i class="fa fa-bars"></i></a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<body class="w3-content w3-sand" style="max-width:1350px">
<!-- !PAGE CONTENT! -->

<div class="w3-container w3-content w3-center bg-white py-5" style="max-width:800px">
     
    <div id="main-content">
        <h2><i class="fa fa-line-chart" style="margin-bottom: 32px;"></i> Generate Report</h2>

            <div class="text-start">
                    <div class="col-md-3 form-group mb-3 me-auto ms-auto">
                        <label for="">Select Type:</label>
                        <select class="form-select" name="" id="reportType">
                            <option value="" selected>-- Select --</option>
                            <option value="Weekly">Weekly</option>
                            <option value="Monthly">Monthly</option>
                            <option value="Yearly">Yearly</option>
                        </select>
                    </div>
                    <div class="">
                        <label for="">Month</label>
                        <select class="form-select" name="" id="reportType">
                            <option value="" selected>-- Select --</option>
                            <option value="Weekly">Weekly</option>
                            <option value="Monthly">Monthly</option>
                            <option value="Yearly">Yearly</option>
                        </select>
                    </div>
                <div class="col mt-5">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <canvas id="reportChart" width="200" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       
    </div>
    
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="admin.js"></script>
<script src="chart.js"></script>


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

</body>
</html>
