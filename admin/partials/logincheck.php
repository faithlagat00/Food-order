<?php
       //authorization - access control
       //check whether the user is logged in or not
       if(!isset($_SESSION['user'])) //if user session is not set
       {
             //user not logged in
             $_SESSION['no-login-message'] = 'please login to access admin panel';
              //redirect to login page with message
              header('location:'.SITEURL.'admin/login.php');
       }
?>