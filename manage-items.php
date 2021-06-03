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
      <a href="manage-items.php" class="w3-bar-item w3-button current_page"><i class="fa fa-list w3-margin-right" style="font-size:24px"></i>MANAGE ITEMS</a>
      <a href="manage-reservation.php" class="w3-bar-item w3-button"><i class="fa fa-book w3-margin-right" style="font-size:20px"></i> MANAGE RESERVATION</a>
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

<div class="w3-container w3-content w3-center bg-white py-5">
     
    <div d="main-content">
        <h2><i class="fa fa-list" style="margin-bottom: 32px;"></i> Manage Items</h2>

        <div class="row mb-5">
            <div class="col">
                <div class="card">
                    <div class="card-body fs-1">
                        <h5>Total Stocks</h5>
                        <span class="text-primary">
                            <i class="fas fa-clipboard-list"></i>
                                <span id="totStocksTxt">XXXX</span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body fs-1">
                        <h5>In Stocks</h5>
                        <span class="text-success">
                            <i class="fas fa-clipboard-check"></i> 
                                <span id="totInStocksTxt">XXXX</span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body fs-1">
                        <h5>Out of Stocks</h5>
                        <span class="text-danger">
                            <i class="fas fa-clipboard"></i> 
                                <span id="totOutOfStocksTxt">XXXX</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <nav>
        <button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#addNewProd">Add new Product</button>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="manage-item-tab nav-link active" data-id="1" id="recent-booking-tab" data-bs-toggle="tab" data-bs-target="#recent-booking" type="button" role="tab" aria-controls="recent-booking" aria-selected="true"><i class="fab fa-digital-ocean"></i> Detergent <span class="badge bg-success rounded">12</span></button>
                <button class="manage-item-tab nav-link" data-id="2" id="booking-history-tab" data-bs-toggle="tab" data-bs-target="#booking-history" type="button" role="tab" aria-controls="booking-history" aria-selected="false"><i class="fas fa-soap"></i> FabCon <span class="badge bg-primary rounded">12</span></button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <!-- ====================== DETERGENT ====================== -->
            <div class="tab-pane fade show active" id="recent-booking" role="tabpanel" aria-labelledby="nav-home-tab">
                <table class="table mt-5">
                    <thead>
                        <tr>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php $stmt = mysqli_query($conn, "SELECT * FROM product WHERE categ_id = 1");
                        if(mysqli_num_rows($stmt) > 0):
                            while($row = mysqli_fetch_assoc($stmt)):
                ?>
                                <tr>
                                    <td><?php echo $row['product_name']; ?></td>
                                    <td><?php echo $row['quantity']; ?></td>
                                    <td>
                                        <?php if($row['quantity'] > 0){?>
                                            <span class="badge bg-success">In-stock</span>
                                        <?php }?>
                                        <?php if($row['quantity'] == 0){?>
                                            <span class="badge bg-danger">Out-of-stock</span>
                                        <?php }?>
                                    </td>
                                    <td>
                                        <?php if($row['quantity'] >= 20){?>
                                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addQuantity<?php echo $row['product_id']; ?>"><i class="fa fa-plus"></i> Restock</button>
                                        <?php }?>
                                        <?php if($row['quantity'] < 20){?>
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"  data-bs-target="#addQuantity<?php echo $row['product_id']; ?>"><i class="fa fa-plus" data-bs-toggle="modal"></i> Restock</button>
                                        <?php }?>
                                    </td>
                                </tr>
 
                            <!-- ADD QUANTITY MODAL -->
                            <div class="modal fade" id="addQuantity<?php echo $row['product_id']; ?>" tabindex="-1" aria-labelledby="addQuantityProdLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addQuantityProdLabel"><i class="fa fa-plus-square"></i> Add Quantity</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <label for="">Product Name</label>
                                                <input type="text" class="form-control" value="<?php echo $row['product_name']; ?>" disabled>
                                            </div>
                                            <div class="col form-group mb-3">
                                                <label for="">Current Quantity</label>
                                                <input type="text" class="form-control" value="<?php echo $row['quantity']; ?>" disabled>
                                            </div>
                                            <div class="col form-group">
                                                <label for="">Add Quantity</label>
                                                <input type="number" class="form-control" placeholder="Enter Quantity" id="addQuanFld<?php echo $row['product_id']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="modal-footer">
                                        <span class="text-danger float-start" style="display: none;" id="addQuanModalerr<?php echo $row['product_id']; ?>">All fields are required!</span>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-success addQuantityBtn" data-id="<?php echo $row['product_id']; ?>">Add</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                                
                <?php       endwhile;
                        endif;
                ?>
                    </tbody>
                </table>
            </div>

             <!-- ====================== FAB CON ====================== -->
            <div class="tab-pane fade" id="booking-history" role="tabpanel" aria-labelledby="booking-history-tab">
                <table class="table mt-5">
                    <thead>
                        <tr>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $stmt = mysqli_query($conn, "SELECT * FROM product WHERE categ_id = 2");
                        if(mysqli_num_rows($stmt) > 0):
                            while($row = mysqli_fetch_assoc($stmt)):
                ?>
                                <tr>
                                    <td><?php echo $row['product_name']; ?></td>
                                    <td><?php echo $row['quantity']; ?></td>
                                    <td>
                                        <?php if($row['quantity'] > 0){?>
                                            <span class="badge bg-success">In-stock</span>
                                        <?php }?>
                                        <?php if($row['quantity'] == 0){?>
                                            <span class="badge bg-danger">Out-of-stock</span>
                                        <?php }?>
                                    </td>
                                    <td>
                                        <?php if($row['quantity'] >= 20){?>
                                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addQuantity<?php echo $row['product_id']; ?>"><i class="fa fa-plus"></i> Restock</button>
                                        <?php }?>
                                        <?php if($row['quantity'] < 20){?>
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"  data-bs-target="#addQuantity<?php echo $row['product_id']; ?>"><i class="fa fa-plus" data-bs-toggle="modal"></i> Restock</button>
                                        <?php }?>
                                    </td>
                                </tr>
 
                            <!-- ADD QUANTITY MODAL -->
                            <div class="modal fade" id="addQuantity<?php echo $row['product_id']; ?>" tabindex="-1" aria-labelledby="addQuantityProdLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addQuantityProdLabel"><i class="fa fa-plus-square"></i> Add Quantity</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <label for="">Product Name</label>
                                                <input type="text" class="form-control" value="<?php echo $row['product_name']; ?>" disabled>
                                            </div>
                                            <div class="col form-group mb-3">
                                                <label for="">Current Quantity</label>
                                                <input type="text" class="form-control" value="<?php echo $row['quantity']; ?>" disabled>
                                            </div>
                                            <div class="col form-group">
                                                <label for="">Add Quantity</label>
                                                <input type="number" class="form-control" placeholder="Enter Quantity" id="addQuanFld<?php echo $row['product_id']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="modal-footer">
                                        <span class="text-danger float-start" style="display: none;" id="addQuanModalerr<?php echo $row['product_id']; ?>">All fields are required!</span>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-success addQuantityBtn" data-id="<?php echo $row['product_id']; ?>">Add</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                                
                <?php       endwhile;
                        endif;
                ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
    
</div>




<!-- ADD NEW PRODUCT MODAL -->
<div class="modal fade" id="addNewProd" tabindex="-1" aria-labelledby="addNewProdLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addNewProdLabel"><i class="fa fa-plus-square"></i> Add New Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-start">
            <div class="form-group mb-3">
                <label for="">Product Name</label>
                <input type="text" class="form-control" placeholder="Enter Product name" id="prodName">
            </div>
            <div class="form-group">
                <label for="">Product Quantity</label>
                <input type="number" class="form-control" placeholder="Enter Product Quantity" id="prodQuantity">
            </div>
        </div>
        
        <div class="modal-footer">
            <span class="text-danger float-start" style="display: none;" id="addProdModalerr">All fields are required!</span>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" id="addNewProdBtn">Add</button>
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
