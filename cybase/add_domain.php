<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<?php 
$course_obj = new course();
if (isset($_POST['adddomain']))
    $course_obj->create_new_domain($_POST);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" >
</head>
<style>
input[type=text], textarea {
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
		<h1>Add A Domain</h1>
		<form action="" method="post" autocomplete="off">
			<label>Enter Domain Name:</label>
			<input type="text" placeholder="Domain name" name="domain_name"  required >
			<label>Enter Domain Description:</label>
			<textarea rows="4" cols="50" type="text" placeholder="Enter The Description" name="domain_desc"  required ></textarea>
			<input type="submit" name="adddomain" value="Submit">
			</form>
		</div>
	</body>
	</html>