<?php 
session_start();
$course_id=$_REQUEST['courseID'];
include './class/function.php';
$course_obj = new course();
$course_desc=$course_obj->course_desc($course_id);
$c_row = $course_desc->fetch_assoc();
$domain_desc=$course_obj->domain_desc($course_id);
$d_row = $domain_desc->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $c_row['course_name'];?></title>
	<link href="./assets/style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>
<style>
#menu {
margin-top: 20px;
margin-bottom: 20px;
  width: 100%;
}

#menu td {
  border: 1px solid #ddd;
  padding: 8px;

}
#menu tr:nth-child(even){background-color: #f2f2f2;}

#menu tr:hover {background-color: #ddd;font-weight: bold;}
</style>
</style>
<body class="loggedin">
	<nav class="navtop">
		<div>
			<h1><a href=<?=$_SESSION['home_page']?>>Cybase</a></h1>
			<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
			<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
		</div>
	</nav>
	<div class="course_content">
		<h2><?php echo $c_row["course_name"] ?></h2>
		<div style="width: 49%; float:left; height:auto; margin:auto;margin-right: 1%;">
		<h2>Overview</h2>
		<h1 style="margin: 25px;padding-left: 10px;font-size: 18px;font-weight: normal;"><?php echo $d_row["domain_description"] ?></h1>
	</div>
	<div style="width: 49%; float:right; height:auto; margin:auto;margin-left: 1%;">
		<table id="menu" style="width: 100% ;table-layout: fixed;">
			<tr>
			<img src="./assets/images/img3.jpeg" style="margin:0px;width: 100%;height: auto;">
			</tr>
			<tr>
				<a style="margin-top: 20px;" target="_blank" class="goto_btn" href=<?php echo $c_row["link"] ?>>Goto Course <span class="fas fa-share"></span></a>
			</tr>
			<tr>
				<td>Domain Name</td>
				<td><?php echo $c_row["domain_name"] ?></td>
			</tr>
			<tr>
				<td>Provider Name</td>
				<td><?php echo $c_row["provider_name"] ?></td>
			</tr>
			<tr>
				<td>Duration</td>
				<td><?php echo $c_row["duration"] ?></td>
			</tr>
			<tr>
				<td>Language</td>
				<td>English</td>
			</tr>
			<tr>
				<td>Session</td>
				<td>Self-Paced</td>
			</tr>
			<tr>
				<td>Certificate</td>
				<td>Certificate Available</td>
			</tr>
		</table>
		<a style="width: 25%;background-color: #1aad00;margin-bottom: 20px;" class="goto_btn" href="review.php?courseID=<?php echo $course_id?>">Write Review <span class="fas fa-star checked"></span></a>
	</div>

	 <div style="width: 49%; float:left; height:auto; margin-top:20px;margin-right: 1%;;">	 	
            <?php
             $review_list=$course_obj->showReview($course_id);
            if ($review_list->num_rows > 0) {?>
            	<h2>Reviews</h2>
                <?php while ($row = $review_list->fetch_assoc()) {
                    ?>
                                    <ul style="list-style-type:none;"> 
                                        <li><i class="fas fa-user" style="font-size:20px;"></i>&nbsp  <?php echo ucfirst($row["username"]) ?></li>        	             
                                        <li>
                                            <?php if ($row["rating"]===0) {?>
                                            <span class="fas fa-star "></span>
                                            <span class="fas fa-star "></span>
                                            <span class="fas fa-star "></span>
                                            <span class="fas fa-star "></span>
                                            <span class="fas fa-star "></span>
                                        <?php }
                                        for ($x = 1; $x <=round($row["rating"]); $x++){?>
                                            <span class="fas fa-star checked"></span>
                                        <?php }?>
                                        <?php
                                        for ($x = round($row["rating"]); $x < 5; $x++){?>
                                            <span class="fas fa-star "></span>
                                        <?php }?>
                                        (<?php echo ($row["rating"])?>)
                                        </li>  
                                        <li>Description: <?php echo $row["description"] ?></li>                                                                         
                                    </ul>

                    <?php
                }
            }
            ?>
        </div>
	</div>
</body>
</html>