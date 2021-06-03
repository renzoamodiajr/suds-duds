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
      <a href="manage-reservation.php" class="w3-bar-item w3-button current_page"><i class="fa fa-book w3-margin-right" style="font-size:20px"></i> MANAGE RESERVATION</a>
      <a href="manage-users.php" class="w3-bar-item w3-button"><i class="fa fa-users w3-margin-right" style="font-size:20px"></i> MANAGE USERS</a>
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
        <h2><i class="fa fa-book" style="margin-bottom: 32px;"></i> Manage Booking</h2>

        <div class="row mb-5">
            <div class="col">
                <div class="card">
                    <div class="card-body fs-1">
                        <h6>Pending Reservation</h6>
                        <span class="text-success">
                            <i class="fa fa-clock-o"></i> 
                                <span id="totPendingRes">XX</span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body fs-1">
                        <h6>Total Reservation</h6>
                        <span class="text-primary">
                            <i class="fa fa-list"></i> 
                                <span id="totRes">XX</span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body fs-1">
                        <h6>Rejected Reservation</h6>
                        <span class="text-danger">
                            <i class="fa fa-times-circle"></i> 
                                <span id="totRejectedRes">XX</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="recent-booking-tab" data-bs-toggle="tab" data-bs-target="#recent-booking" type="button" role="tab" aria-controls="recent-booking" aria-selected="true"><i class="fa fa-clock-o"></i> Pending Reservations <span class="badge bg-success" id="totPenTab">XXX</span></button>
                <button class="nav-link" id="on-going-reservation-tab" data-bs-toggle="tab" data-bs-target="#on-going-reservation" type="button" role="tab" aria-controls="on-going-reservation" aria-selected="false"><i class="fa fa-list"></i> Reservation List <span class="badge bg-primary" id="totResTab">XXX</span></button>
                <button class="nav-link" id="reservation-history-tab" data-bs-toggle="tab" data-bs-target="#reservation-history" type="button" role="tab" aria-controls="reservation-history" aria-selected="false"><i class="fa fa-hourglass-half"></i> Reservation History</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <!-- ====================== PENDING BOOKING ====================== -->
            <div class="tab-pane fade show active" id="recent-booking" role="tabpanel" aria-labelledby="nav-home-tab">
            <?php $stmt = mysqli_query($conn, "SELECT * FROM reservation_info 
                                                INNER JOIN users ON reservation_info.user_id = users.user_id 
                                                INNER JOIN services ON reservation_info.srvc_id = services.srvc_id
                                                WHERE reservation_info.res_status = 'Pending' ORDER BY res_id DESC");
                  if(mysqli_num_rows($stmt) > 0):
                        while($row = mysqli_fetch_assoc($stmt)):
            ?>
                            <div class="bg-light p-5 rounded-lg m-3 text-start">
                                <span class="float-end" id="time_received"><?php echo $row['time_received'] ?></span>
                                <h4 style="text-transform: capitalize;"><?php echo $row['name'] ?></h4>
                                <table class="table table-borderless ps-5">
                                    <tr>
                                        <th width="300">Service Type:</th>
                                        <td id="srvcType"><?php echo $row['srvc_type'] ?></td>
                                    </tr>    
                                    <tr>
                                        <th width="300">Kilogram:</th>
                                        <td id="kg"><?php echo $row['kilo'] ?></td>
                                    </tr> 
                                    
                                    <tr>
                                        <th width="300">Detergent:</th>
                                        <td id="detrgntType"><?php echo $row['detergent_name'] ?> <?php echo $row['detertgent_qty'] ?>pcs</td>
                                    </tr> 
                                    <tr>
                                        <th width="300">FabCon:</th>
                                        <td id="fabConType"><?php echo $row['fabcon_name'] ?> <?php echo $row['fabcon_qty'] ?>pcs</td>
                                    </tr> 
                                    <tr>
                                        <th width="300">Date reserved:</th>
                                        <td id="dateRes"><?php echo $row['res_date'] ?> at <?php echo $row['res_hour'] ?></td>
                                    </tr> 
                                    <tr>
                                        <th width="300">Note:</th>
                                        <td id="note"><?php echo $row['note'] ?></td>
                                    </tr> 
                                    <tr>
                                        <th>Amount due:</th>
                                        <td id="amntDue">₱<?php echo $row['srvc_price'] ?></td>
                                    </tr>  
                                </table>
                                <a class="btn btn-primary btn-sm" href="#" role="button" data-bs-toggle="modal" data-bs-target="#acceptResModal<?php echo $row['res_id'] ?>">Accept</a>
                                <a class="btn btn-danger btn-sm" href="#" role="button" data-bs-toggle="modal" data-bs-target="#rejectResModal<?php echo $row['res_id'] ?>">Reject</a>
                            </div>

                            <!--===================================== ACCEPT RESERVATION MODAL =====================================-->
                            <div class="modal fade" id="acceptResModal<?php echo $row['res_id'] ?>" tabindex="-1" aria-labelledby="acceptResLabel" aria-hidden="true">
                               <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="acceptResLabel">Reservation Confirmation</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        Are you sure you want to accept <span class="badge bg-primary"><?php echo $row['name'] ?>'s</span> reservation? 
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary acceptResBtn" data-id="<?php echo $row['res_id'] ?>">Accept</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <!--===================================== REJECT RESERVATION MODAL =====================================-->
                            <div class="modal fade" id="rejectResModal<?php echo $row['res_id'] ?>" tabindex="-1" aria-labelledby="rejectResLabel" aria-hidden="true">
                               <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="rejectResLabel">Reservation Confirmation</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        Are you sure you want to reject <span class="badge bg-primary"><?php echo $row['name'] ?>'s</span> reservation? 
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-danger rejectResbtn" data-id="<?php echo $row['res_id'] ?>">Reject</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
            <?php       endwhile;
                    endif;
            ?>
            </div>

             <!-- ====================== ON-GOING RESERVATIONS ====================== -->
            <div class="tab-pane fade" id="on-going-reservation" role="tabpanel" aria-labelledby="on-going-reservation-tab">
                <div class="mt-4">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Type of Service</th>
                            <th scope="col">Detergent</th>
                            <th scope="col">FabCon</th>
                            <th scope="col">Date Reserved</th>
                            <th scope="col">Amount Due</th>
                            <th scope="col"><i class="fas fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $stmt2 = mysqli_query($conn, "SELECT * FROM reservation_info 
                                                INNER JOIN users ON reservation_info.user_id = users.user_id 
                                                INNER JOIN services ON reservation_info.srvc_id = services.srvc_id
                                                WHERE reservation_info.res_status = 'Accepted' AND res_date > '$currDate' ORDER BY res_id DESC");
                        if(mysqli_num_rows($stmt2) > 0):
                                while($row2 = mysqli_fetch_assoc($stmt2)):
                    ?>
                                <tr>
                                    <td><?php echo $row2['name'] ?></td>
                                    <td><?php echo $row2['srvc_type'] ?></td>
                            <?php if($row2['detergent_name'] == ""){?>
                                    <td> -- </td>
                            <?php }?>
                            <?php if($row2['fabcon_name'] == ""){?>
                                    <td> -- </td>
                            <?php }?>

                            <?php if($row2['detergent_name'] != ""){?>
                                    <td><?php echo $row2['detergent_name'] ?> (<?php echo $row2['detertgent_qty'] ?>pcs)</td>
                            <?php }?>
                            <?php if($row2['fabcon_name'] != ""){?>
                                    <td><?php echo $row2['fabcon_name'] ?> (<?php echo $row2['fabcon_qty'] ?>pcs)</td>
                            <?php }?>
                                    <td><?php echo $row2['res_date'] ?></td>
                                    <td>₱<?php echo $row2['srvc_price'] ?></td>
                            <?php if($row2['isPaid'] == "No"){?>
                                    <td><button class="btn btn-success btn-sm" data-res-id="<?php echo $row2['res_id'] ?>" id="paidBtn">Paid</button></td>
                            <?php }?>
                            <?php if($row2['isPaid'] == "Yes"){?>
                                    <td><i class="fas fa-check text-success"></i></td>
                            <?php }?>
                                    
                                </tr>


                     <?php       endwhile;
                        endif;
                    ?>
                        </tbody>
                    </table>
                </div>
            </div>

             <!-- ====================== RESERVATION HISTORY ====================== -->
             <div class="tab-pane fade" id="reservation-history" role="tabpanel" aria-labelledby="reservation-history-tab">
                <div class="mt-4">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Type of Service</th>
                            <th scope="col">Detergent</th>
                            <th scope="col">FabCon</th>
                            <th scope="col">Date Reserved</th>
                            <th scope="col">Note</th>
                            <th scope="col">Amount Due</th>
                            <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $stmt3 = mysqli_query($conn, "SELECT * FROM reservation_info 
                                                INNER JOIN users ON reservation_info.user_id = users.user_id 
                                                INNER JOIN services ON reservation_info.srvc_id = services.srvc_id
                                                WHERE res_date < '$currDate' ORDER BY res_id DESC");
                        if(mysqli_num_rows($stmt3) > 0):
                                while($row3 = mysqli_fetch_assoc($stmt3)):
                    ?>
                                <tr>
                                    <td><?php echo $row3['name'] ?></td>
                                    <td><?php echo $row3['srvc_type'] ?></td>
                            <?php if($row3['detergent_name'] == ""){?>
                                    <td> -- </td>
                            <?php }?>
                            <?php if($row3['fabcon_name'] == ""){?>
                                    <td> -- </td>
                            <?php }?>

                            <?php if($row3['detergent_name'] != ""){?>
                                    <td><?php echo $row3['detergent_name'] ?> <?php echo $row3['detertgent_qty'] ?>pcs</td>
                            <?php }?>
                            <?php if($row3['fabcon_name'] != ""){?>
                                    <td><?php echo $row3['fabcon_name'] ?> <?php echo $row3['fabcon_qty'] ?>pcs</td>
                            <?php }?>
                                    <td><?php echo $row3['res_date'] ?></td>
                                    <td><?php echo $row3['note'] ?></td>
                                    <td>₱<?php echo $row3['srvc_price'] ?></td>
                            <?php if($row3['res_status'] == "Accepted"){?>
                                    <td><span class="badge bg-success">Accepted</span></td>
                            <?php }?>
                            <?php if($row3['res_status'] == "Rejected"){?>
                                    <td><span class="badge bg-danger">Rejected</span></td>
                            <?php }?>
                                </tr>

                     <?php       endwhile;
                        endif;
                    ?>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>

        
    </div>
    
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
<script src="admin.js"></script>


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
