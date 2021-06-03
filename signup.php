<!DOCTYPE html>
<html>
<head>
	<title>SIGN UP</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body class="bdy" style="background: url(images/jaja.jpg); background-size: cover;">
	<form class="form1" action="signup-check.php" method="post">
		<h2>SUDS AND DUDS<br>SIGN UP</h2>
			<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

     	<?php if (isset($_GET['success'])) { ?>
               <p class="success"><?php echo $_GET['success']; ?></p>
          <?php } ?>

		<label>Name</label>

		<div class="inptbox">
			<?php if (isset($_GET['name'])) { ?>
			<input class="int" type="text" name="name" placeholder="Name" value="<?php echo $_GET['name']; ?>"><br>
          <?php }else{ ?>
               <input type="text" 
                      name="name" 
                      placeholder="Name"><br>
          <?php }?>

		</div>
		<br>

		<label>Email</label>
		<div class="inptbox">
			<?php if (isset($_GET['name'])) { ?>
			<input class="int" type="email" name="email_add" placeholder="Email Address" value="<?php echo $_GET['email_add']; ?>"><br>
          <?php }else{ ?>
               <input type="email" 
                      name="email_add" 
                      placeholder="Email Address"><br>
          <?php }?>

		</div>
		<br>

		<label>User Name</label>
		<div class="inptbox">
			<?php if (isset($_GET['uname'])) { ?>
			<input class="int" type="text" name="uname" placeholder="User Name" value="<?php echo $_GET['uname']; ?>"><br>
          <?php }else{ ?>
               <input type="text" 
                      name="uname" 
                      placeholder="User Name"><br>
          <?php }?>
		</div>
		<br>
		<label>Password</label>
		<div class="inptbox">
			<input class="int" type="password" name="password" placeholder="Password">
		</div>
		<label>Confirm Password</label>
		<div class="inptbox">
			<input class="int" type="password" name="re_password"placeholder="Confirm Password">
		</div>
		<br>

		<button type="submit">Sign Up</button>
		<a href="index.php" class="ca">Already have an account?</a>
		
	</form>
</body>
</html>