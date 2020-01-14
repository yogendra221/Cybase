<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<?php 
include './class/function.php';
$course_obj = new course();
$provider_desc=$course_obj->provider_description($_REQUEST['provider_name']);
$row = $provider_desc->fetch_assoc();
if (isset($_POST['updateprovider']))
    $course_obj->update_provider($_POST,$_REQUEST['provider_name']);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin</title>
  <link href="./assets/style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" >
</head>
<style>
input[type=text] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 20%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;

}

.editmenu {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>
<body>
      <nav class="navtop">
    <div>
      <h1><a href="admin.php">Cybase</a></h1>
    </div>
  </nav>
	<div class="editmenu">
		<h1>Update Provider</h1>
		<form action="" method="post" autocomplete="off">
			<label>Enter Provider Name:</label>
			<input type="text" value="<?php echo $row["provider_name"] ?>" name="provider_name" readonly>
			<label>Enter Contact:</label>
			<input type="text" value="<?php echo $row["contact"] ?>"   name="contact"  required >
			<label>Enter Website:</label>
			<input type="text" value="<?php echo $row["website"] ?>" name="website" required >
			<input type="submit" name="updateprovider" value="Submit">
			</form>
		</div>
	</body>
	</html>