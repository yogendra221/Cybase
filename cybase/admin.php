<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit();
}
include './class/function.php';
$selected='';
if(!empty($_REQUEST['selected'])){
	$selected=$_REQUEST['selected'];
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin</title>
	<link href="./assets/style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>
<style>
	.mainmenu, .submenu {
		list-style: none;
		padding: 0;
		margin: 0;
	}
	.mainmenu a {
		display: block;
		font-weight: bolder;
		text-decoration: none;
		padding: 15px;
		background-color: #2f3947;
		color: #eaebed;
	}
	.mainmenu a:hover {
		color: #eaebed;
	}
	.mainmenu li:hover .submenu {
		display: block;
		max-height: 100%;
	}
	.submenu a {
		background-color: #eaebed;
		color: #2f3947;


	}
	.submenu a:hover {

		background-color: #666;
		color: #eaebed;  
	}
	.submenu {
		overflow: hidden;
		max-height: 0;
	}
	.opt{
		text-decoration: none;
		font-weight: bold;
		background-color: blue;
		color: white;
		border-radius: 10px;
		padding: 10px;
		font-weight: 20px;
	}

	</style>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Cybase</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div style="width: 17%; float:left;margin-right: 1%;margin-top: 20px;">
			<nav class="navigation">
				<ul class="mainmenu" style="border: 5px solid #2f3947;">
					<li><a href="">Course</a>
						<ul class="submenu">
							<li><a href="admin.php?selected=new_course">Add a new Course</a></li>
							<li><a href="admin.php?selected=update_remove_course">Update or Delete Course</a></li>
						</ul>
					</li>
					<li><a href="">Domain</a>
						<ul class="submenu">
							<li><a href="admin.php?selected=new_domain">Add a new Domain</a></li>
							<li><a href="admin.php?selected=update_remove_domain">Update or Delete Domain</a></li>
						</ul>
					</li>
					<li><a href="">Provider</a>
						<ul class="submenu">
							<li><a href="admin.php?selected=new_provider">Add a new Provider</a></li>
							<li><a href="admin.php?selected=update_remove_provider">Update or Delete Provider</a></li>
						</ul>
					</li>
				</ul>
			</nav>
		</div> 
		<div class="content" style="width: 80%;float:right; height:auto;margin-left: 1%;margin-right: 1%;">
			<p style="padding: 20px;margin-top: 30px;">Welcome back , <?=$_SESSION['name']?>!</p>
			<?php 
			if($selected==='new_course')
				include('add_course.php');

			if($selected==='new_domain')
				include('add_domain.php');

			if($selected==='new_provider')
				include('add_provider.php');
			if($selected==='update_remove_course')
			{
				?>
				<h2>Course List</h2>
				<?php
				$course_obj = new course();
				$course_list=$course_obj->course_list();				
				if ($course_list->num_rows > 0) {
					while ($row = $course_list->fetch_assoc()) {
						?>
						<ul style="list-style-type:none;" class="menu">
							<li>
								<table class="dropdown-menu" style="width: 100% ;table-layout: fixed;">
									<thead>
										<th style="width: 60%"></th>
										<th style="width: 20%"></th>
										<th style="width: 20%"></th>
									</thead>

									<td>
										<ul style="list-style-type:none;"> 
											<li><h1 style="font-size: 22px;font-weight: bold;padding: 0;margin: 0;"><?php echo $row["course_name"] ?></h1></li>              
											<?php /**      <li><a target="_blank" class="li_name" href=<?php echo $row["link"] ?>><?php echo $row["course_name"] ?></a></li>   **/?>       
											<li>
												<table>
													<td>on<i><b> <?php echo $row["domain_name"] ?></b></i></td>
													<td>via.<i><b> <?php echo $row["provider_name"] ?></b></i></td>
												</table>
											</li>
											<li><i class="fa fa-clock"></i> <?php echo $row["duration"] ?></li>  
											<br>         	              
										</ul>
									</td>
									<td style="align-content: center;">			
										<a href="update_course.php?courseID=<?php echo $row['course_id']?>" class="opt"><i class="fas fa-edit "></i> Update</a>
									</td>
									<td style="align-content: center;">			
										<a href="remove_course.php?courseID=<?php echo $row['course_id']?>" class="opt" style="background-color: red;"><i class="fas fa-trash "></i> Remove</a>
									</td>											
								</table>
							</li>
						</ul>

						<?php
					}
				}
			}

			if($selected==='update_remove_domain')
			{
				?>
				<h2>Domain List</h2>
				<?php
				$course_obj = new course();
				$domain_list=$course_obj->domain_list();				
				if ($domain_list->num_rows > 0) {
					while ($row = $domain_list->fetch_assoc()) {
						?>
						<ul style="list-style-type:none;" class="menu">
							<li>
								<table class="dropdown-menu" style="width: 100% ;table-layout: fixed;">
									<thead>
										<th style="width: 60%"></th>
										<th style="width: 20%"></th>
										<th style="width: 20%"></th>
									</thead>
									<td><h1 style="font-size: 20px;"><?php echo $row["domain_name"] ?></h1></td>									
									<td style="align-content: center;">			
										<a href="update_domain.php?domain_name=<?php echo $row['domain_name']?>" class="opt"><i class="fas fa-edit "></i> Update</a>
									</td>
									<td style="align-content: center;">			
										<a href="remove_domain.php?domain=<?php echo $row['domain_name']?>" class="opt" style="background-color: red;"><i class="fas fa-trash "></i> Remove</a>
									</td>											
								</table>
							</li>
						</ul>

						<?php
					}
				}
			}
			if($selected==='update_remove_provider')
			{
				?>
				<h2>Provider List</h2>
				<?php
				$course_obj = new course();
				$provider_list=$course_obj->provider_list();				
				if ($provider_list->num_rows > 0) {
					while ($row = $provider_list->fetch_assoc()) {
						?>
						<ul style="list-style-type:none;" class="menu">
							<li>
								<table class="dropdown-menu" style="width: 100% ;table-layout: fixed;">
									<thead>
										<th style="width: 60%"></th>
										<th style="width: 20%"></th>
										<th style="width: 20%"></th>
									</thead>

									<td>
										<ul style="list-style-type:none;"> 
											<li><h1 style="font-size: 20px;margin: 0;padding: auto;"><?php echo $row["provider_name"] ?></h1></li>
											<li><b>Contact: </b><?php echo $row["contact"] ?></li>									
											<li><b>Website: </b><?php echo $row["website"] ?></li>
											<br>         	              
										</ul>
									</td>
									<td style="align-content: center;">			
										<a href="update_provider.php?provider_name=<?php echo $row['provider_name']?>" class="opt"><i class="fas fa-edit "></i> Update</a>
									</td>
									<td style="align-content: center;">			
										<a href="remove_provider.php?provider=<?php echo $row['provider_name']?>" class="opt" style="background-color: red;"><i class="fas fa-trash "></i> Remove</a>
									</td>											
								</table>
							</li>
						</ul>

						<?php
					}
				}
			}

			?>
		</div>
	</body>
	</html>