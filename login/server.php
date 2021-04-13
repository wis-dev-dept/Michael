<?php
session_start();

// initializing variables

$errors = array(); 

// connect to the database
$db = mysqli_connect("localhost", "root", "", "dbbarber");
// LOGIN USER
if (isset($_POST['login_user'])) {
  $Email = mysqli_real_escape_string($db, $_POST["email"]);
  $Password = mysqli_real_escape_string($db, $_POST["password"]);

  if (empty($Email)) {
  	array_push($errors, "Email is required");
  }
  if (empty($Password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  //$password = password_hash($Password,PASSWORD_DEFAULT);
  	$query = "SELECT * FROM tbcustomer WHERE Email='$Email' AND Password='$Password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['email'] = $Email;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location:../index.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

?>