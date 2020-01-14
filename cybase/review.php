<?php
session_start();
include './class/function.php';
$course_id=$_REQUEST['courseID'];
$course_obj = new course();
if (isset($_POST['add_review'])){
    $course_obj->add_review($_POST,$course_id,$_SESSION['name']);

}

?>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cybase-Review</title>
	<link rel="stylesheet" href="./assets/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" >
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
</head>
<style>
	div.stars {
		width: 270px;
		display: inline-block;
	}
	input.star { display: none; }

	label.star {
		float: right;
		padding: 10px;
		font-size: 36px;
		color: #444;
		transition: all .2s;
	}

	input.star:checked ~ label.star:before {
		content: '\f005';
		color: orange;
		transition: all .25s;
	}
	input.star-1:checked ~ label.star:before { color: #F62; }


	label.star:before {
		content: '\f006';
		font-family: FontAwesome;
	}
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
<body class="loggedin">
	<nav class="navtop">
		<div>
			<h1><a href="course_details.php?courseID=<?php echo $_REQUEST['courseID']?>">Cybase</a></h1>
			<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
			<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
		</div>
	</nav>
	<div class="content" style="width: 90%;margin: 0 auto;">
	<div class="editmenu">
		<h1 style="font-size: 25px;">Review</h1>
		<form action="<?php $course_obj->call_setavg_proc($course_id);?>" method="post" autocomplete="off">
			<label>Enter Rating</label><br>
			<div class="stars">
				<input class="star star-5" id="star-5" type="radio" name="star" value="5" />
				<label class="star star-5" for="star-5"></label>
				<input class="star star-4" id="star-4" type="radio" name="star" value="4" />
				<label class="star star-4" for="star-4"></label>
				<input class="star star-3" id="star-3" type="radio" name="star" value="3" />
				<label class="star star-3" for="star-3"></label>
				<input class="star star-2" id="star-2" type="radio" name="star" value="2" />
				<label class="star star-2" for="star-2"></label>
				<input class="star star-1" id="star-1" type="radio" name="star" value="1" />
				<label class="star star-1" for="star-1"></label>
			</div>
			<br>
			<label>Enter Domain Description:</label>
			<textarea rows="4" cols="50" type="text" placeholder="Enter The Description" name="review_desc"  required ></textarea>
			<input type="submit" name="add_review" value="Submit">
		</form>
	</div>
</div>
</div>
</body>
</html>