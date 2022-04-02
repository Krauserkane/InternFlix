<?php 
    session_start();
    $user= $_SESSION['uname'];
    $conn=mysqli_connect('localhost','root','','kushal');
    $query="SELECT * from `student_info` where firstname='$user'";
    if(mysqli_query($conn,$query)){
       $result=mysqli_query($conn,$query);
       $arr=mysqli_fetch_all($result,MYSQLI_ASSOC);
       header('Content-type: application/pdf');
       echo $arr[0]['cv'];
     //  echo "oks";
    }
?>