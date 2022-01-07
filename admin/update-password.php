<?php include ("partials/menu.php"); ?>
<div class = "main-content">
        <div class = "wrapper">
           
        <h1>change password</h1> 
        <br><br>

        <?php
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
        }
        ?>
        <form action="" method = "post" >
    <table>
        <tr>
            <td>current password: </td>
            <td><input type="password"name="current_password" placeholder= "current password"> </td>
        </tr> 
        <tr>
            <td>new password:</td>
            <td><input type="password"name="new_password" placeholder= "new password"></td>
        </tr>
        <tr>
            <td>confirm password:</td>
            <td><input type="password"name="confirm_password" placeholder= "confirm password"></td>
        </tr>
    
        <tr>
            <td colspan = "2">
                <input type="hidden" name='id' value='<?php echo $id; ?>'>
                <button><input type="submit" name ="submit" value = "change admin" > </button>
            </td>
        </tr>
    </table>
</form>
</div>
</div>

<?php
//check whether the submit button is clicked or not

if(isset($_POST["submit"]))
{
   // echo "clicked";

   //get data from form
$id = $_POST['id'];
$current_password = md5($_POST['current_password']);
$new_password = md5($_POST['new_password']);
$confirm_password = md5 ($_POST['confirm_password']);
   //check whether the user with current id and password exist or not
   $sql = "SELECT*FROM tb_admin WHERE  id = $id and password = '$current_password'";

   //execute the query
   $res = mysqli_query($con, $sql);

   if($res==TRUE)
   {
       //check whether data is available or not
       $count = mysqli_num_rows($res);

       if($count==1)
       {
           //user exist and password can be changed
           //echo "user found";
           //check whether the new password and confirm password match or not 
           if($new_password==$confirm_password)
           {
               //update the pasword
               $sql2="UPDATE tb_admin SET
               password = '$new_password' 
               where id= $id
               ";

               //execute query
               $res2 = mysqli_query($con, $sql2);

               //check whether the query is executed or not

               if($res2==TRUE)
               {
                   //DISPLAY success MESSAGE
                    //redirect to manage admin with error message
               $_SESSION["change-password"] = "password changed successfully";
               header('location:'. SITEURL. 'admin/manage-admin.php');
               }
               else {
                   //DISPLAY ERROR MESSAGE
                    //redirect to manage admin with error message
               $_SESSION["change-password"] = "failed to change password";
               header('location:'. SITEURL. 'admin/manage-admin.php');
               }
           }
           else {
               //redirect to manage admin with error message
               $_SESSION["password-not-match"] = "password not match";
               header('location:'. SITEURL. 'admin/manage-admin.php');

           }
       }
       else {
           //user does not exist, set message and redirect
           $_SESSION["user-not-found"] = "user not found";
           header('location:'. SITEURL. 'admin/manage-admin.php');
       }
   }
   //check whether the new and confirm password match or not
   //change password if all above is true
}
?>
<?php include ("partials/footer.php"); ?>