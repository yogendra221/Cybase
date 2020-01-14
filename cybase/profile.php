<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit();
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'cybase';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT password, email, first_name, last_name,role FROM person WHERE username = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('s', $_SESSION['name']);
$stmt->execute();
$stmt->bind_result($password, $email,$first_name,$last_name,$role);
$stmt->fetch();
$stmt->close();
$stmt1 = $con->prepare('SELECT created_on FROM join_person WHERE username = ?');
$stmt1->bind_param('s', $_SESSION['name']);
$stmt1->execute();
$stmt1->bind_result($created_on);
$stmt1->fetch();
$stmt1->close();
if(isset($_POST['delete_user'])){
	$stmt = $con->prepare('DELETE FROM person WHERE username = ?');
	$stmt->bind_param('s', $_SESSION['name']);
	$stmt->execute();
	header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?=$_SESSION['name']?>-Profile</title>
	<link href="./assets/style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>
 <style>
 		.opt{
		text-decoration: none;
		background-color: red;
		color: white;
		border-radius: 10px;
		padding: 10px;
	}
 </style>
<body class="loggedin">
	<nav class="navtop">
		<div>
			<h1><a href=<?=$_SESSION['home_page']?>>Cybase</a></h1>
			<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
			<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
		</div>
	</nav>
	<div class="content">
		<h2>Profile Page</h2>
		<div style="margin: 25px 0;padding: 25px;">
			<h1 style="text-align: right;font-weight: normal;margin: 0;float: right;"><b>Created On : </b><?php echo $created_on?></h1>
			<p style="font-weight: bold">Your account details are below:</p>
			<table >
				<tr>
					<td>Username:</td>
					<td><?=$_SESSION['name']?></td>
				</tr>
				<tr>
					<td>First Name:</td>
					<td><?=$first_name?></td>
				</tr>
				<tr>
					<td>Last Name:</td>
					<td><?=$last_name?></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><?=$password?></td>
				</tr>
				<tr>
					<td>Email:</td>
					<td><?=$email?></td>
				</tr>
				<tr>
					<td><br></td>
				</tr>
				<tr>
					<td><form action="" method="post" autocomplete="off">
						<?php if($role==='users') {
						?>
						<button class="opt" value="submit" name="delete_user"><i class="fas fa-trash "></i> Remove Account</button>
					<?php } ?>
					</td>
					</form>
				</tr>
			</table>
		</div>
	</div>
</body>
</html>