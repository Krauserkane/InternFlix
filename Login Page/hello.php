<?php
 $username_error=$email_error=$password_error=$confirm_password_error="";
 $flag=1;
 $username=$email=$password="";
 if(isset($_POST['submit'])){
    if(empty($_POST['username'])){
        $username_error= "username not set";
        $flag=0;
    }
    else{
      $username=$_POST['username'];
    }
    if(empty($_POST['email'])){
        $email_error= "Please enter email";
        $flag=0;
    }
    else{
      $email=$_POST['email'];
    }
    if(empty($_POST['password'])){
        $password_error= "Please enter your password";
        $flag=0;
    }
    else{
      $password=$_POST['password'];
    }
    if(empty($_POST['confirmPassword'])){
        $confirm_password_error="Please re-enter your password";
        $flag=0;
    }
}
$cred=1;
if($flag && isset($_POST['submit'])){
  if(!preg_match('/^[a-zA-Z\s]+$/',$username)){
    $username_error="Username must contain letters and spaces only";
    $cred=0;
  }
  if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $email_error="Email must be a valid email address";
    $cred=0;
  }
  if(!preg_match('/^[a-zA-Z\s]+$/',$password)){
    $password_error="Password must contain letters only";
    $cred=0;
  }
  if($_POST['confirmPassword']!=$password){
    $confirm_password_error='Password do not match';
    $cred=0;
  }
}

if($flag && $cred && isset($_POST['submit'])){
  $conn=mysqli_connect('localhost','root','','kushal');
  if(!$conn){
    echo "Connect error".mysqli_connect_error();
  }
  else{
        //Checking Wheter a value is already present in the database or not

        $usernameQuery="SELECT * FROM `users` WHERE Username='$username'";
        $emailQuery="SELECT * FROM `users` WHERE Email='$email'";
        
        $check1=mysqli_query($conn,$usernameQuery);
        $check2=mysqli_query($conn,$emailQuery);

        $dbCheck=1;
        if($check1->num_rows>0){
          $username_error="This username is already Taken";
          $dbCheck=0;
        }
        if($check2->num_rows>0){
          $email_error="Email is already Registered";
          $dbCheck=0;
        }
        if($dbCheck){
          $insertQuery="INSERT INTO users (Username,Email,password) VALUES ('$username','$email','$password')";
          $insertCheck=mysqli_query($conn,$insertQuery);
          session_start();
          $_SESSION['username']=$_POST['username'];
          header('Location:../student/student.php');
        }
       

    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="signup.css">
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <title>Document</title>
</head>
<body>
  <!-- ###################### BACKGROUND SVGs ###################### -->
  <img class="background__img" src="../Assets/IMG/login_backgroung.svg" alt="background1">
  <img class="img__2" src="../Assets/IMG/wave.svg" alt="background2">
  <img class="img__2__top" src="../Assets/IMG/wave.svg" alt="background2">

  <!-- ###################### LOGIN BLOCK ###################### -->
  <div class="login__container">    
    <form action="" method="POST">
      <h1 class="signup__text">Sign Up</h1>
      <div class="input-div one">
        <div class="i">
          <i class="fas fa-user"></i>
        </div>
        <div class="div">
          <label for="">Username</label><br>
          <input class="input" type="text" name="username" >
          <div class="red-color">
            <?php echo $username_error;?>
          </div>
        </div>
      </div>
      <div class="input-div two">
        <div class="i"> 
          <i class="fas fa-envelope"></i>
        </div>
        <div class="div">
          <label for="">Email</label><br>
          <input class="input" type="text" name="email">
          <div class="red-color">
            <?php echo $email_error ;?>
          </div>
        </div>
      </div>
      <div class="input-div three">
        <div class="i"> 
          <i class="fas fa-lock"></i>
        </div>
        <div class="div">
          <label for="">Password</label><br>
          <input class="input" type="password" name="password">
          <div class="red-color">
            <?php echo $password_error ;?>
          </div>
        </div>
      </div>
      <div class="input-div four">
        <div class="i"> 
          <i class="fas fa-lock"></i>
        </div>
        <div class="div">
          <label for="">Confirm Password</label><br>
          <input class="input" type="password" name="confirmPassword">
          <div class="red-color">
            <?php echo $confirm_password_error ;?>
          </div>
        </div>
      </div>
      <input class="btn" type="submit" name="submit">
      <div class="signin_link">
        Already a memeber?<br><button class="login__btn"><a href="login_page.php">Sign in</a></button>
      </div>
    </form>
  </div> 
  <script src="main.js"></script>
</body>
</html>