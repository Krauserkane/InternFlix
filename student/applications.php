<?php 
    session_start();
    $user=$_SESSION['username'];
    $conn=mysqli_connect('localhost','root','','kushal');
    $apply=$_SESSION['applied'];

    if(isset($_POST['more-info'])){
        $_SESSION['cmpname']=$_POST['compname'];
        header('Location:info-page.php');
    }
    if(isset($_POST['cv'])){
         
        $_SESSION['cmpname']=$_POST['compname'];
        header('Location:show_cv.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="student1.css">
    <link rel="stylesheet" href="form.css">
   <link rel="stylesheet" href="navbar.css">
   <link rel="stylesheet" href="footer.css">
   <link rel="stylesheet" href="cards.css">
   <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Document</title>
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
            <li><a class="list" href="student.php">Home</a></li>
            <li><a class="list" href="#">Contact us</a></li>
            <li><a class="list " href="applications.php">My Applications</a></li>
            <li><a class="list" href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <ul class="drop__down hide__dropdown">
            <li><a class="list" href="student.php">Home</a></li>
            <li><a class="list" href="#">Contact us</a></li>
            <li><a class="list " href="applications.php">My Applications</a></li>
            <li><a class="list" href="logout.php">Logout</a></li>
    </ul>
</header>

    <div class="container">
        <?php foreach($apply as $name) 
        
            {
                $query="SELECT cname,jobtitle FROM `companies` where cname='$name'";
                $result=mysqli_query($conn,$query);
                if(!$result)continue;
                $cmp=mysqli_fetch_all($result,MYSQLI_ASSOC);
                foreach($cmp as $companies){
        
        ?>
       <div class="cards">
        <div class="image">
        <img src="../images/<?php echo $companies['cname']?>.png" alt="" class="img">
        </div>
        <div class="title"><h3><?php echo $companies['jobtitle'] ?></h3></div>
        <div class="buttons">
           
            <form action="" method="POST">
                <input type="submit" name="more-info" value="More-info" class="btn" >
                <input type="hidden" name="compname" value=<?php echo $companies['cname'];?>>
            </form>
           
              
          
            <form  target="_blank" method="POST">
              <input type="hidden" name="compname" value=<?php echo $companies['cname'];?>>
              <input type="submit" name="cv" value="View Cv" class="btn2">
              
            </form>
        </div>
       </div>      
        <?php }} ?>
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