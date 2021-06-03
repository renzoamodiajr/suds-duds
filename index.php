<!DOCTYPE html>
<html>
<head>
    <title>LOGIN</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="bdy" style="background: url(images/jaja.jpg); background-size: cover;">
<form class="form1" action="login.php" method="post">
    <h2>SUDS AND DUDS<br>LOGIN</h2>
    <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
    <label>User Name</label>
    <div class="inptbox">
        <input class="int" type="text" name="uname" placeholder="User Name"><br>
    </div>
        <label>Password</label>
    <div class="inptbox">
        <input class="int" type="password" name="password" placeholder="Password"><br>
    </div>
        <button type="submit">Login</button>
          <a href="signup.php" class="ca">Create an account</a></form>
</body>
</html>