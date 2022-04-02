<?php 
    session_start();
    $conn=mysqli_connect('localhost','root','','kushal');
    if($conn){
        $company=$_SESSION['cmpname'];
        $query="SELECT jobtitle,about_us,jobrespons,qualification FROM `companies` WHERE cname='$company' ";
        if(mysqli_query($conn,$query)){
          $result= mysqli_query($conn,$query);
          $comp=mysqli_fetch_all($result,MYSQLI_ASSOC);
         // echo $comp[0]['jobtitle'];
          //print_r($comp);
        }
    }  
     if(isset($_POST['view'])){
        $_SESSION['compname']=$_POST['cname'];
        header('Location:applicants.php');
     }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../student/info-page.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="../student/footer.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Company-Details</title>
</head>
<body>
    <!-- Company name
    Job Title
    Job Desc
    Responsibility
    Qualifications -->
<header>
    <nav class="nav__container">
        <div class="logo_nav"><h2>INTERNFLIX</h2></div>
        <div class="hamburger__container">
            <div class="hamburger__btn">

            </div>
        </div>
        <ul class="nav__items">
            <li><a class="list" href="#">Home</a></li>
            <li><a class="list" href="#">About</a></li>
            <li><a class="list btn2" href="#">Add opportunity</a></li>
            <li><a class="list" href="../student/logout.php">Logout</a></li>
        </ul>
    </nav>
    <ul class="drop__down hide__dropdown">
        <li><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Add opportunity</a></li>
        <li><a  href="../student/logout.php">Logout</a></li>
    </ul>
</header>

    <div class="container">
        <div class="logo">
        <img src="../images/<?php echo $company?>.png" alt="" class="img">
        </div>

        <div class="job__title">
            <span class="title"><?php echo $comp[0]['jobtitle'];?></span>
        </div>
        
        <div class="content__container">
            <span class="content__title">About Us</span><br>
            <span  class="content"><?php echo $comp[0]['about_us'];?></span>
        </div>

        <div class="content__container">
            <span class="content__title">Responsibilities</span><br>
            <span class="content"><?php echo $comp[0]['jobrespons'];?></span>
        </div>

        <div class="content__container">
            <span class="content__title">Qualifications</span><br>
            <span class="content"><?php echo $comp[0]['qualification'];?></span>
        </div>
        <div class="content__container">
            <form action="" method="POST">
                <input type="hidden" name="cname" value=<?php echo $company?> >
                <input type="submit" name="view" class="apply__btn" value="View Applicants">
            </form>
        </div>

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
          <p class="footer-legal">Copyright Async Squad<sup>&copy;</sup></p>
        </div>
      </div>
    </footer>
    <script src="navbar.js"></script>
</body>
</html>