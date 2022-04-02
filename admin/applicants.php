<?php 
    session_start();
    $conn=mysqli_connect('localhost','root','','kushal');
    $cname= $_SESSION['compname'];
    $query="SELECT firstname,lastname,email,number,gender,cv from `student_info` where company='$cname'";
    $result=mysqli_query($conn,$query);
    $details=mysqli_fetch_all($result,MYSQLI_ASSOC);
    if(isset($_POST['cv'])){
        $_SESSION['uname']=$_POST['name'];
      header('Location:show.php');
    }    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicants</title>
    <link rel="stylesheet" href="applicants.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="../student/footer.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>
<body>
<header>
    <nav class="nav__container">
        <div class="logo_nav"><h2>INTERNFLIX</h2></div>
        <div class="hamburger__container">
            <div class="hamburger__btn">

            </div>
        </div>
        <ul class="nav__items">
            <li><a class="list" href="admin.php">Home</a></li>
            <li><a class="list" href="#">About</a></li>
            <li><a class="list btn2" href="#">Add opportunity</a></li>
            <li><a class="list"  href="../student/logout.php">Logout</a></li>
        </ul>
    </nav>
    <ul class="drop__down hide__dropdown">
        <li><a  href="admin.php">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Add opportunity</a></li>
        <li><a  href="../student/logout.php">Logout</a></li>
    </ul>
</header>
    <div class="company__img">
    <img src="../images/<?php echo $cname?>.png" alt="" class="img">
    </div>
    
    <div class="title">
        Total Applicants: <?php echo $result->num_rows;?> 
    </div>
    <div class="main-container">
    <?php foreach($details as $student) {?>
    <div class="applicant__container">
        <div class="applicant__info">
            <ul>
                <li><?php echo $student['firstname'];?></li>
                <li><?php echo $student['lastname'];?></li>
                <li><?php echo $student['email'];?></li>
                <li><?php echo $student['gender'];?></li>
                <li><?php echo $student['number'];?></li>
            </ul>
        </div>
        <div class="view__cv">
            <form action="" target="_blank" method="POST">
                <input type="hidden" name="name" value=<?php echo $student['firstname'];?>>
                <input type="submit" value="VIEW CV" name="cv">
            </form>
        </div>
    </div>
   <?php }?>

    </div>
    
   <footer class="footer">
      <div class="footer__container">
        <div class="footer__row">
          <div class="footer__col">
            <h4>this website</h4>
            <ul>
              <li><a href="#">about us</a></li>
              <li><a href="applications.php">applications</a></li> 
              <li><a href="#">dashboard</a></li>
            </ul>
          </div>
          
          <div class="footer__col">
            <h4>contact us</h4>
            <div class="social__links">
              <a href="https://github.com/Sam777726"><i class="uil uil-github"></i></a>
              <a href="mailto:samyak.shah054@nmims.edu.in"><i class="uil uil-envelope"></i></a> 
              <a href="https://www.linkedin.com/in/shah-samyak/"><i class="uil uil-linkedin"></i></a>
              <a href="tel:+918866060122"><i class="uil uil-phone"></i></a>
            </div>
          </div>
          <p class="footer-legal">Copyright Async Squad<sup>&copy;</sup>.</p>
        </div>
      </div>
    </footer>
   <script src="navbar.js"></script>
</body>
</html>