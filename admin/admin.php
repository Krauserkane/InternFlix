<?php 
    session_start();
    $conn=mysqli_connect('localhost','root','','kushal');
    if($conn){
        $query="SELECT cname,jobtitle FROM `companies` ";
        $result=mysqli_query($conn,$query);
        $comp=mysqli_fetch_all($result,MYSQLI_ASSOC);
    }
    if(isset($_POST['more-info'])){
        $_SESSION['cmpname']=$_POST['compname'];
        header('Location:info-page.php');
    }
    if(isset($_POST['hire'])){
        $cmp_name= $_POST['company_name'];
        $jobtitle= $_POST['jobtitle'];
        $about= $_POST['about'];
        $jobrespons= $_POST['jobrespons'];
        $jobquali= $_POST['jobquali'];
        $query="INSERT INTO `companies` (cname,jobtitle,about_us,qualification,jobrespons)VALUES ('$cmp_name','$jobtitle','$about','$jobquali','$jobrespons')";
        if(!mysqli_query($conn,$query)){
          echo("Error description: " . mysqli_error($conn));
        }
        else{
          header("Location:admin.php");
        }
        
    }
    
    if(isset($_POST['viewApplicants'])){
      $_SESSION['compname']=$_POST['compname'];
      
      header('Location:applicants.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cards.css">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="navbar.css ">
    <link rel="stylesheet" href="../student/footer.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Cards</title>
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
            <li><a class="list"  href="admin.php">Home</a></li>
            <li><a class="list" href="#">About</a></li>
            <li><a class="list btn2" href="#">Add opportunity</a></li>
            <li><a class="list" href="../student/logout.php">Logout</a></li>
        </ul>
    </nav>
    <ul class="drop__down hide__dropdown">
        <li><a  href="admin.php">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Add opportunity</a></li>
        <li><a  href="../student/logout.php">Logout</a></li>
    </ul>
</header>

    <!-- ########### APPLICATION FORM ########### -->
    <div class="form__bigcontainer">

        <div class="form__container">
            <div class="close">+</div>
            <div class="title">Application</div>
            <div class="content">
              <form action="#" method="POST">
                <div class="user-details">
                  <div class="input-box">
                    <span class="details">Company Name</span>
                    <input type="text" name="company_name" placeholder="Company name" required>
                  </div>
                  <div class="input-box">
                    <span class="details">Job/Internship Role</span>
                    <input type="text" name="jobtitle" placeholder="Job/Internship Role" required>
                  </div>
                  <div class="input-box">
                    <span class="details">About</span>
                    <!-- <input type="text" placeholder="Company Description" required> -->
                    <textarea name="about" id="" cols="40" rows="10" placeholder="About"></textarea>
                  </div>
                  <div class="input-box">
                    <span class="details">Job Responsibilities</span>
                    <input type="text" name="jobrespons" placeholder="Job Requirements" required>
                  </div>
                  <div class="input-box">
                    <span class="details">Required Qualifications</span>
                    <input type="text" name="jobquali" placeholder="Job Qualifications" required>
                  </div>
                  
                </div>
                <div class="button">
                  <input type="submit" value="Start Hiring!" name="hire"> 
                </div>
              </form>
            </div>
          </div>
    </div>


    <!-- ########### CARDS ###########   -->
    <div class="container">
        <?php foreach($comp as $companies) { ?>
       <div class="cards">
        <div class="image">
        <img src="../images/<?php echo $companies['cname']?>.png" alt="" class="img">
        </div>
        <div class="title"><h3><?php echo $companies['jobtitle'] ?></h3></div>
        <div class="buttons">
           
            <form action="" method="POST">
                <input type="submit" name="more-info" value="More-info" class="btn">
                <input type="hidden" name="compname" value=<?php echo $companies['cname'];?>>
            </form>

          
            <form action="#" method="POST">
            <input type="submit" name="viewApplicants" value="View Applicants" class="btn">
                <input type="hidden" name="compname" value=<?php echo $companies['cname'];?>>
              
            </form>
        </div>
       </div>      
        <?php } ?>
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
    <script src="application_form.js"></script>
</body>
</html>