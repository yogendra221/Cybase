<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cybase-SignIn</title>
	<link rel="stylesheet" href="./assets/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" >
</head>
<body  background="./assets/images/img2.jpg">
	<img src="./assets/images/cybase1.jpg" height=62 width=198 class="tlogo">
	<div class="login">
		<h1>Sign In</h1>
		<form action="index.php" method="post" autocomplete="off">
			<?php include('errors.php'); ?>
			<label for="username">
				<i class="fas fa-user"></i>
			</label>
			<input type="text" name="username" placeholder="Username" id="username" required >
			<label for="password">
				<i class="fas fa-lock"></i>
			</label>
			<input type="password" name="password" placeholder="Password" id="password" required autocomplete="off">
			<button type="submit" class="btn" name="login_user">Login</button>
			<div>
				<p><b>New to Cybase? <a href="signup.php">Sign Up</a>.</b></p>
			</div>
		</form>
	</div>
</body>
</html>