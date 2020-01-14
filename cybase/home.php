<?php
session_start();
include './class/function.php';
$course_obj = new course();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cybase</title>
    <link href="./assets/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>
<body class="loggedin">
    <nav class="navtop">
        <div>
            <h1>Cybase</h1>
            <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
        </div>
    </nav>

    <div class="content">
        <p style="padding: 20px">Welcome back, <?php echo $_SESSION['name'] ?>!</p>
        <h2>List of Courses Available:</h2>
    </div>
    <div style="width: 90%;margin: 0 auto;">
        <form action="<?php $course_list=$course_obj->course_list();?>" method="post">
            <div class="sort" style="width: 24%; float:left; height:auto; margin:auto;margin-right: 1%;">
                <div>
                    <div>
                        <h1><i class="fas fa-sort"></i> Sort</h1>
                        <ul style="list-style-type:none;" class="radio_buttons">
                            <li><label><input type="radio" placeholder="" name="sort" value= "relevance" onclick="this.form.submit()" checked><i class=" fas fa-sort "></i> Relevance<br></label></li>
                            <li><label><input type="radio" name="sort" value= "name_asc" onclick="this.form.submit()"><i class=" fas fa-sort-alpha-down "></i> Name(A-Z)<br></label></li>
                            <li><label><input type="radio" name="sort" value= "name_des" onclick="this.form.submit()"><i class="fas fa-sort-alpha-up"></i> Name(Z-A)<br></label></li>
                            <li><label><input type="radio" name="sort" value= "review_des" onclick="this.form.submit()"><i class="fas fa-sort-amount-down"></i> Review(Highest first)<br></label></li>
                            <li><label><input type="radio" name="sort" value= "review_asc" onclick="this.form.submit()"><i class="  fas fa-sort-amount-up"></i> Review(Lowest first)<br></label></li>
                        </ul>
                    </div>
                    <div class="sort_menu">
                        <h1><i class="fas fa-filter"></i> Filter</h1>

                        <select name="provider_filter">
                            <option selected="selected" value="select">--Select-A-Provider--</option>
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
                        <select name="domain_filter">
                            <option selected="selected" value="select">--Select-A-Domain--</option>
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
                    </div>
                </div>
            </div>
        </form>
        <div class="content" style="max-height: 450px; width: 75%; float:right; margin: auto;overflow-x:hidden; overflow-y:scroll;">
            <?php
            if ($course_list->num_rows > 0) {
                while ($row = $course_list->fetch_assoc()) {
                    ?>
                    <ul style="list-style-type:none;" class="menu">
                        <li>
                            <table class="dropdown-menu" style="width: 100% ;table-layout: fixed;">
                                <thead>
                                    <th style="width: 60%"></th>
                                    <th style="width: 40%"></th>
                                </thead>

                                <td>
                                    <ul style="list-style-type:none;"> 
                                        <li><a class="li_name" href="course_details.php?courseID=<?php echo $row['course_id']?>"><?php echo $row["course_name"] ?></a></li>              
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
                                    <ul style="list-style-type:none;" class="rating"> 
                                        <li>Average Rating : <?php if($row["avg_rate"]==0)echo "No Rating";else echo number_format((float)$row["avg_rate"], 2, '.', '');?></li>
                                        <li>
                                            <?php if ($row["avg_rate"]==0) {?>

                                        <?php }
                                        else{
                                        for ($x = 1; $x <=round($row["avg_rate"]); $x++){?>
                                            <span class="fas fa-star checked"></span>
                                        <?php }?>
                                        <?php
                                        for ($x = round($row["avg_rate"]); $x < 5; $x++){?>
                                            <span class="fas fa-star "></span>
                                        <?php }}?>

                                        </li>
                                        <li>Reviews : <?php if($row["count"]==0)echo "No Reviews";else echo $row["count"]?></li>
                                    </ul>
                                </td>
                            </table>
                        </li>
                    </ul>

                    <?php
                }
            }
            ?>
        </div>
    </div>

</body>
</html>