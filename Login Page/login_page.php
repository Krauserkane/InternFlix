<?php
    $username=$password="";
    $error="";
    $flag=1;
    if(isset($_POST['LogIn'])){
        if(empty($_POST['username'])){
            $username_error= "username not set";
            $flag=0;
        }
        else{
            $username=$_POST['username'];
        }
        if(empty($_POST['password'])){
            $password_error= "Please enter your password";
            $flag=0;
        }
        else{
          $password=$_POST['password'];
        }
    }
    $cred=1;
    if($flag && isset($_POST['LogIn'])){
      $conn=mysqli_connect('localhost','root','','kushal');
      if(!preg_match('/^[a-zA-Z\s]+$/',$username)){
        $username_error="Username must contain letters and spaces only";
        $cred=0;
      }
      if(!preg_match('/^[a-zA-Z\s]+$/',$password)){
        $password_error="Password must contain letters only";
        $cred=0;
      } 
    }

    if($flag && $cred && isset($_POST['LogIn'])){
        $validQuery="SELECT * FROM `users` WHERE Username='$username' and password='$password'";
        if(mysqli_query($conn,$validQuery) && mysqli_query($conn,$validQuery)->num_rows>0){
          session_start();
          $_SESSION['username']=$_POST['username'];
          header('Location:../student/student.php');
        }
        else{
          $error="Username and Password donot match";
        }

    } 

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="login.css">
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
      <h1 class="signup__text">Log In</h1>
      <div class="input-div one">
        <div class="i">
          <i class="fas fa-user"></i>
        </div>
        <div class="div">
          <label for="">Username</label><br>
          <input class="input" type="text" name="username">
        </div>
      </div>
      <div class="input-div three">
        <div class="i"> 
          <i class="fas fa-lock"></i>
        </div>
        <div class="div">
          <label for="">Password</label><br>
          <input class="input" type="password" name="password">
        </div>
      </div>
    <div class="red-color">
      <?php echo $error ;?>
    </div>
      <input class="btn" type="submit" name="LogIn">
      <div class="signin_link">
        New member?<br><button class="login__btn"><a href="hello.php">Sign Up</a></button>
      </div>
    </form>
  </div> 
  <script src="main.js"></script>
</body>
</html>