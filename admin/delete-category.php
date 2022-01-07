<?php
//include constant.php
include ("../config/constant.php");
  //get the id of the category to be deleted
 $id = $_GET["id"];

//create sql query to delete category
$sql = "DELETE FROM tb_category WHERE id = $id";
//execute query
$res = mysqli_query($con, $sql);
//check whether the query executed successfully or not
if($res==TRUE)
{
    //query executed succcessfully and category deleted
  //  echo "category deleted";
  //create session variable to display message
  $_SESSION['delete'] = "category deleted successfully";
  //redirect to manage category page
  header('location:'. SITEURL. 'admin/manage-category.php');
}
else
{
    //failed to delete category
   // echo "failed to delete category";
   $_SESSION['delete'] = "failed to delete category, try again later";
   //redirect to manage category page
   header('location:'. SITEURL. 'admin/manage-category.php');
}
  //redirect to manage category page with message(success/error)
?>