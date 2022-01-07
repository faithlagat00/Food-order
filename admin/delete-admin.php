<?php
//include constant.php
include ("../config/constant.php");
  //get the id of the admin to be deleted
 $id = $_GET["id"];

//create sql query to delete admin
$sql = "DELETE FROM tb_admin WHERE id = $id";
//execute query
$res = mysqli_query($con, $sql);
//check whether the query executed successfully or not
if($res==TRUE)
{
    //query executed succcessfully and admin deleted
  //  echo "admin deleted";
  //create session variable to display message
  $_SESSION['delete'] = "admin deleted successfully";
  //redirect to manage admin page
  header('location:'. SITEURL. 'admin/manage-admin.php');
}
else
{
    //failed to delete admin
   // echo "failed to delete admin";
   $_SESSION['delete'] = "failed to delete admin, try again later";
   //redirect to manage admin page
   header('location:'. SITEURL. 'admin/manage-admin.php');
}
  //redirect to manage admin page with message(success/error)
?>