<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<?php 
$course_obj = new course();
if (isset($_POST['addprovider']))
    $course_obj->create_new_provider($_POST);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin</title>
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
	<div class="editmenu">
		<h1>Add A Provider</h1>
		<form action="" method="post" autocomplete="off">
			<label>Enter Provider Name:</label>
			<input type="text" placeholder="Provider name" name="provider_name"  required >
      <label>Enter Provider Contact:</label>
      <input type="text" placeholder="Provider Contact" name="provider_contact"  required >
      <label>Enter Provider Website:</label>
      <input type="text" placeholder="Provider Website" name="provider_website"  required >
			<input type="submit" name="addprovider" value="Submit">
			</form>
		</div>
	</body>
	</html>