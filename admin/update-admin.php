<?php include ("partials/menu.php"); ?>
<div class = "main-content">
        <div class = "wrapper">
<h1>Update Admin</h1>
<br>
<br>
<?php 
//get the id of selected admin
$id = $_GET["id"];
//create sql query to get the details
$sql = "SELECT*FROM tb_admin WHERE id=$id";
//execute query
$res = mysqli_query($con, $sql);
//check whether the query is executed
if($res==TRUE)
{
    //check whether data is available or not
    $count = mysqli_num_rows($res);
    //check whether we have admin data or not
    if($count==1)
    {
        //get details
        //echo "admin available";
        $rows = mysqli_fetch_assoc($res);

        $full_name=$rows['full_name'];
        $username=$rows['username'];
    }
    else {
        //redirect to manage admin page
        header('location:'. SITEURL. 'admin/manage-admin.php');
    }
}

?>
<form action="" method = "post" >
    <table>
        <tr>
            <td>full name</td>
            <td><input type="text"name="full_name" value= "<?php echo $full_name; ?>"> </td>
        </tr> 
        <tr>
            <td>username</td>
            <td><input type="text"name="username" value= "<?php echo $username; ?>"></td>
        </tr>
    
        <tr>
            <td colspan = "2">
                <button><input type="hidden" name='id' value='<?php echo $id; ?>'></button>
                <button><input type="submit" name ="submit" value = "update admin" > </button>
            </td>
        </tr>
    </table>
</form>
</div>
</div>
 <?php
 //check whether the submit button is clicked or not
 if(isset($_POST['submit']))
 {
    // echo 'button clicked';
    //get all the value from form to update
   $id = $_POST['id'];
    $full_name=$_POST['full_name'];
   $username=$_POST['username'];

   //create sql query to update admin
   $sql= "UPDATE tb_admin SET 
   full_name= '$full_name',
   username='$username' 
   WHERE id='$id'
   ";

   //execute the query
   $res = mysqli_query($con, $sql);

   //check whether the query is executed successfully or not
   if ($res==TRUE)
   {
     //QUERY executed and admin updated
     $_SESSION["update"] = "admin updated successfully";
     //redirect page to manage admin
     header('location:'. SITEURL. 'admin/manage-admin.php');
   }
   else {
      // failed to update admin
      $_SESSION["update"] = "failed to update admin";
      //redirect page to add admin
      header('location:'. SITEURL. 'admin/manage-admin.php');
   }
 }
 ?>

<?php include ("partials/footer.php"); ?>