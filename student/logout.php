<?php 
    session_start();
    session_unset();
    session_destroy();
    header('Location:../Login Page/login_page.php')
?>