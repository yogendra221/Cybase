<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cybase-SignUp</title>
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" >
</head>
<body background="./assets/images/img1.jpg">
   <img src="./assets/images/cybase1.jpg" height=62 width=198 class="tlogo">
   <div class="login">
    <h1>Sign Up</h1>
    <form action="signup.php" method="post" autocomplete="off" >
        <?php include('errors.php'); ?>
        <label for="username">
            <i class="fas fa-user"></i>
        </label>
        <input type="text" name="username" placeholder="Username" required  >

        <label for="first_name"><b><i>FN</i></b> 
        </label>
        <input type="text" name="first_name" placeholder="First Name" required  >

        <label for="last_name"><b><i>LN</i></b>    
        </label>
        <input type="text" name="last_name" placeholder="Last Name" required  >


        <label for="email">
            <i class="fas fa-at"></i>
        </label>
        <input type="text" name="email" placeholder="Email" required  >


        <label for="password">
            <i class="fas fa-lock"></i>
        </label>               
        <input type="password" name="password_1" placeholder="Password" required autocomplete="off">


        <label for="password">
            <i class="fas fa-lock"></i>
        </label>
        <input type="password" name="password_2" placeholder="Confirm Password" required autocomplete="off">

        
        <button type="submit" class="btn" name="reg_user">Register</button>
        <div>
            <p><b>Already have an account? <a href="index.php">Sign In</a>.</b></p>
        </div>
    </form>
</div>
</body>
</html>