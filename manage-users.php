<?php 
session_start();
include "db_conn.php";
if(empty($_SESSION['id'])){
    header('Location: index.php');
}


 ?>
<!DOCTYPE html>
<html>
<title>Manage Users</title>
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
      <a href="manage-users.php" class="w3-bar-item w3-button current_page"><i class="fa fa-users w3-margin-right" style="font-size:20px"></i> MANAGE USERS</a>
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

<div class="w3-container w3-content w3-center bg-white py-5">
     
    <div d="main-content">
        <h2><i class="fa fa-users" style="margin-bottom: 32px;"></i> Manage Users</h2>

        <div class="row mb-5">
            <div class="col">
                <div class="card">
                    <div class="card-body fs-1">
                        <h5>Total Users</h5>
                        <span class="text-primary">
                            <i class="fa fa-users"></i> 
                                <span id="totUsers">XXXX</span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body fs-1">
                        <h5>Active Users</h5>
                        <span class="text-success">
                            <i class="fa fa-toggle-on"></i> 
                                <span id="totActUsers">XXXX</span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body fs-1">
                        <h5>Deactivated Users</h5>
                        <span class="text-danger">
                            <i class="fa fa-power-off"></i> 
                                <span id="totDeactUsers">XXXX</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Role</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Username</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php $fetchQuery = "SELECT * FROM users INNER JOIN user_role ON users.role_id = user_role.role_id WHERE users.role_id = 2";
          $result = mysqli_query($conn, $fetchQuery);
          if(mysqli_num_rows($result) > 0):
            while($row = mysqli_fetch_assoc($result)):
    ?>
                        <tr>
                            <th scope="row" style="text-transform: capitalize;"><?php echo $row['role']; ?></th>
                            <td style="text-transform: capitalize;"><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email_address']; ?></td>
                            <td><?php echo $row['user_name']; ?></td>
                            <td>
                                <?php if($row['status'] == 'Active'){ ?>
                                    <span class="badge bg-success">Active</span>
                                <?php } ?>
                                <?php if($row['status'] == 'Deactivated'){ ?>
                                    <span class="badge bg-warning text-dark">Deactivated</span>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if($row['status'] == 'Active'){ ?>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#deactModal<?php echo $row['user_id']; ?>">Deactivate</button>
                                <?php } ?>
                                <?php if($row['status'] == 'Deactivated'){ ?>
                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#reactivModal<?php echo $row['user_id']; ?>">Reactivate</button>
                                <?php } ?>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $row['user_id']; ?>">Delete</button>
                            </td>
                        </tr>

                <!-- DEACTIVATE MODAL -->
                <div class="modal fade" id="deactModal<?php echo $row['user_id']; ?>" tabindex="-1" aria-labelledby="deactLabel" aria-hidden="true">
                    <form method="POST" action="manage-users.php">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deactLabel"><i class="fa fa-user-times"></i> User Deactivation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-start">
                                Are you sure you want to deactivate this user?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" data-id="<?php echo $row['user_id']; ?>" class="btn btn-warning deactBtn">Deactivate</button>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- REACTIVATE MODAL -->
                <div class="modal fade" id="reactivModal<?php echo $row['user_id']; ?>" tabindex="-1" aria-labelledby="deactLabel" aria-hidden="true">
                    <form method="POST" action="manage-users.php">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deactLabel"><i class="fa fa-user"></i><i class="fa fa-check"></i> User Reactivation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-start">
                                Are you sure you want to reactivate this user?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" data-id="<?php echo $row['user_id']; ?>" class="btn btn-success reactivBtn">Reactivate</button>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- DELETE MODAL -->
                <div class="modal fade" id="deleteModal<?php echo $row['user_id']; ?>" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
                    <form method="POST" action="manage-users.php">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteLabel"><i class="fa fa-trash"></i> User Deletion</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-start">
                                Are you sure you want to delete this user?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" data-id="<?php echo $row['user_id']; ?>" class="btn btn-danger delBtn">Delete</button>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>
    <?php 
            endwhile;
        endif; 
    ?>
                    </tbody>
                </table>
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
