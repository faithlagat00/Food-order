<?php
//include constant.php
include ("../config/constant.php");
  //get the id of the food to be deleted
 $id = $_GET["id"];

//create sql query to delete food
$sql = "DELETE FROM tb_foods WHERE id = $id";
//execute query
$res = mysqli_query($con, $sql);
//check whether the query executed successfully or not
if($res==TRUE)
{
    //query executed succcessfully and food deleted
  //  echo "food deleted";
  //create session variable to display message
  $_SESSION['delete'] = "food deleted successfully";
  //redirect to manage food page
  header('location:'. SITEURL. 'admin/manage-food.php');
}
else
{
    //failed to delete food
   // echo "failed to delete food";
   $_SESSION['delete'] = "failed to delete food, try again later";
   //redirect to manage food page
   header('location:'. SITEURL. 'admin/manage-food.php');
}
  //redirect to manage food page with message(success/error)
?>