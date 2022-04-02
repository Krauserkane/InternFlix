<?php 
    
    session_start();
    $conn=mysqli_connect('localhost','root','','kushal');
    if($conn){  
        $user=$_SESSION['username'];
        $query="SELECT cname,jobtitle FROM `companies` ";
        $result=mysqli_query($conn,$query);
        $comp=mysqli_fetch_all($result,MYSQLI_ASSOC);
        
        $query2="SELECT company_name FROM `students` WHERE name='$user'";
        $res=mysqli_query($conn,$query2);
        if($res){
            $arr=mysqli_fetch_all($res,MYSQLI_ASSOC);
            $arrr=array("");
            foreach($arr as $a){
                array_push($arrr,$a['company_name']);
            }   
            $_SESSION['applied']=$arrr;     
        }  
        else{
            echo mysqli_error($conn);
        }
        
    }
    if(isset($_POST['more-info'])){
        $_SESSION['cmpname']=$_POST['compname'];
        header('Location:info-page.php');
    }
    if(isset($_POST['applyNow'])){
      $conn=mysqli_connect('localhost','root','','kushal');
      $firstname=$_POST['fname'];
      $company=$_POST['cname'];
      $lastname=$_POST['lname'];
      $email=$_POST['apply_email'];
      $number=$_POST['number'];
      $gender=$_POST['gender'];
      $insert1="INSERT INTO `students` values ('$user','$company')";
      mysqli_query($conn,$insert1);
      $nem=$_FILES['file']['name'];
    $type=$_FILES['file']['type'];
    $data=addslashes(file_get_contents($_FILES['file']['tmp_name']));
    $insertquery2="INSERT INTO `student_info` values('$firstname','$lastname','$company','$email','$number','$gender','$type','$data')";
    if(mysqli_query($conn,$insertquery2)){
      //echo "ok";
      header("Location:student.php");
    }
    else{
      echo mysqli_error($conn);
    } 
             
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
    <title>Kushal</title>
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
       
       <!-- ########### APPLICATION FORM ########### -->
       <div class="form__bigcontainer">

<div class="form__container">
    <div class="close">+</div>
    <div class="title">Application</div>
    <div class="content">
      <form action="#" method="POST" enctype="multipart/form-data">
        <div class="user-details">
        <div class="input-box">
            <span class="details">Enter Company Name</span>
            <input type="text" placeholder="Company" name="cname" required>
          </div>
          <div class="input-box">
            <span class="details">First Name</span>
            <input type="text" placeholder="Firstname" name="fname" required>
          </div>
          <div class="input-box">
            <span class="details">Last Name</span>
            <input type="text" placeholder="Lastname" name="lname" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" placeholder="Enter your email" name="apply_email" required>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" placeholder="Enter your number" name="number" required>
          </div>
          <div class="input-box">
            <label class="cv details" for="cv">Upload Your CV</label>
            <input type="file" name="file" id="cv"  >
          </div>
        </div>
        <div class="gender-details">
          <input type="radio" name="gender" value="male" id="dot-1">
          <input type="radio" name="gender" value="male" id="dot-2">
          <input type="radio" name="gender" value="others" id="dot-3">
          <span class="gender-title">Gender</span>
          <div class="category">
            <label for="dot-1">
            <span class="dot one"></span>
            <span class="gender">Male</span>
          </label>
          <label for="dot-2">
            <span class="dot two"></span>
            <span class="gender">Female</span>
          </label>
          <label for="dot-3">
            <span class="dot three"></span>
            <span class="gender">Prefer not to say</span>
            </label>
          </div>
        </div>
        <div class="button">
          <input type="submit" value="Apply Now!" name="applyNow">
        </div>
      </form>
    </div>
  </div>
</div>

    <div class="container">
        <?php foreach($comp as $companies) { if(in_array($companies['cname'],$arrr)) continue;?>
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
           
              <form action="" method="POST">
                
              </form>
          
            <form action="" method="POST">
            <input type="hidden" name="compname" value=<?php echo $companies['cname'];?>>
              <input type="submit" name="applynow" value="ApplyNow" class="btn2">
              
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
    <script src="cards.js"></script>
    <script src="navbar.js"></script>
</body>
</html>