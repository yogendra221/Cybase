<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'cybase');

// REGISTER USER
if (isset($_POST['reg_user'])) {
// receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $first_name = mysqli_real_escape_string($db, $_POST['first_name']);
  $last_name = mysqli_real_escape_string($db, $_POST['last_name']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

// form validation: ensure that the form is correctly filled ...
// by adding (array_push()) corresponding error unto $errors array
  if ($password_1 != $password_2) {
    array_push($errors, "The two passwords do not match");
  }

// first check the database to make sure 
// a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM person WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

if ($user) { // if user exists
  if ($user['username'] === $username) {
    array_push($errors, "Username already exists");
  }

  if ($user['email'] === $email) {
    array_push($errors, "email already exists");
  }
}

// Finally, register user if there are no errors in the form
if (count($errors) == 0) {
	$password = $password_1;//encrypt the password before saving in the database

	$query = "INSERT INTO person (username, email, password,first_name,last_name,role) 
 VALUES('$username', '$email', '$password','$first_name','$last_name','users')";
 mysqli_query($db, $query);
 $_SESSION['username'] = $username;
 $_SESSION['success'] = "You are now logged in";
 header('location: index.php');
}
}


if (isset($_POST['login_user'])) {
  if ($stmt = $db->prepare('SELECT password,role FROM person WHERE username = ?')) {
// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
// Store the result so we can check if the account exists in the database.
    $stmt->store_result();
  }
  if ($stmt->num_rows > 0) {
    $stmt->bind_result($password,$role);
    $stmt->fetch();
// Account exists, now we verify the password.
// Note: remember to use password_hash in your registration file to store the hashed passwords.
    if ($_POST['password'] === $password) {
  // Verification success! User has loggedin!
  // Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
      session_regenerate_id();
      $_SESSION['loggedin'] = TRUE;
      $_SESSION['name'] = $_POST['username'];
      if($role=='users')
      {
        $_SESSION['home_page']='home.php';
       header('Location: home.php');
      }
     if($role=='admin')
     {
       $_SESSION['home_page']='admin.php';
       header('Location: admin.php');
     }
   } else {
    array_push($errors, "Wrong username/password combination");
    /*echo '<script type="text/javascript">alert("wrong username/password")</script>';*/
  }
} 
else{
//IF USER IS NOT PRESENT
 array_push($errors, "Username Not found. Try Creating New Account");
}
}


?>