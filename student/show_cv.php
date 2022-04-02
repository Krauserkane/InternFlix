<?php 
session_start();
$conn=mysqli_connect('localhost','root','','kushal');
$user=$_SESSION['username'];
$comp=$_SESSION['cmpname'];
    $query="SELECT * from `student_info` where firstname='$user' and company='$comp'";
    if(mysqli_query($conn,$query)){
       $result=mysqli_query($conn,$query);
       $arr=mysqli_fetch_all($result,MYSQLI_ASSOC);
       header('Content-type: application/pdf');
       echo $arr[0]['cv'];
      
    }
    else{
        echo mysqli_error($conn);
    }
?>