<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<?php 
$course_obj = new course();
if (isset($_POST['addcourse']))
    $course_obj->create_new_course($_POST);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" >
</head>
<style>
input[type=text], select {
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
		<h1>Add A Course</h1>
		<form action="" method="post" autocomplete="off">
			<label>Enter Course Name:</label>
			<input type="text" placeholder="Course name" name="course_name"  required >
			<label>Enter Duration:</label>
			<input type="text" placeholder="Duration" name="duration"  required >
			<label>Enter Link:</label>
			<input type="text" placeholder="Link/URL" name="link" required >
			<label>Select Provider Name</label>
			<select name="provider_filter">
				<option selected="selected" disabled="disabled" value="select" required>--Select-A-Provider--</option>
				<?php
				$provider_list = $course_obj->provider_list();
				if ($provider_list->num_rows > 0) {
					while ($row = $provider_list->fetch_assoc()) {
						?>
						<option value="<?php echo $row["provider_name"] ?>"><?php echo $row["provider_name"] ?></option>
						<?php
					}
				}
				?>
			</select> 
			<label>Select Domain Name</label>
			<select name="domain_filter">
				<option selected="selected" disabled="disabled" value="select" required>--Select-A-Domain--</option>
				<?php
				$provider_list = $course_obj->domain_list();
				if ($provider_list->num_rows > 0) {
					while ($row = $provider_list->fetch_assoc()) {
						?>
						<option value="<?php echo $row["domain_name"] ?>"><?php echo $row["domain_name"] ?></option>
						<?php
					}
				}
				?>
				</select> 
			<input type="submit" name="addcourse" value="Submit">
			</form>
		</div>
	</body>
	</html>