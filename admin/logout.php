<?php
//include contant.php for url
include("../config/constant.php");
//destroy the session
session_destroy(); //unset $_session and user
//redirect to login page
header('location:'.SITEURL.'admin/login.php');
?>