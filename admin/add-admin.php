<?php include('partials/menu.php'); ?>
<div class = "main-content">
        <div class = "wrapper">
<h1>Add Admin</h1>
<br>
<br>
<?php 
  if(isset($_SESSION['add'])) //checking whether the session is set or not
  {
     echo $_SESSION['add']; //displaying session message
     unset($_SESSION['add']); //removing session message
  }
?>

<form action="" method = "post" >
    <table>
        <tr>
            <td>full name</td>
            <td><input type="text"name="full_name" placeholder= "enter your name"> </td>
        </tr>
        <tr>
            <td>username</td>
            <td><input type="text"name="username" placeholder= "your username"></td>
        </tr>
        <tr>
            <td>password</td>
            <td><input type="password"name="password" placeholder= "your password"></td>
        </tr>
        <tr>
            <td colspan = "2">
                <button><input type="submit" name ="submit" value = "add admin" > </button>
            </td>
        </tr>
    </table>

</form>
</div>
</div>


<?php include('partials/footer.php'); ?>

<?php
//process the value from form and save it in database
//check whether the submit button is clicked or not

if(isset($_POST["submit"]))
{
       //button clicked
       //echo "button clicked";
       //get the value from form
    $full_name = $_POST["full_name"];
    $username = $_POST["username"];
    $password = MD5($_POST["password"]); //password encryption with md5

    //sql query to save the data into the database
    $sql = "INSERT INTO tb_admin SET
    full_name ='$full_name',
    username ='$username',
    password ='$password'
    ";
   
  //executing query and saving data into database
    $res = mysqli_query($con, $sql) or die (mysqli_error());

    //check whether data (query is executed) is inserted or not and display appropriate message
    if ($res==true)
    {
        //data inserted
        //echo "data inserted";
        //create a session variable to display message
        $_SESSION["add"] = "admin added successfully";
        //redirect page to manage admin
        header('location:'. SITEURL. 'admin/manage-admin.php');
    }
    else
    {
        //failed to insert data
       //echo "failed to insert data";
       //create a session variable to display message
       $_SESSION["add"] = "failed to add admin";
       //redirect page to add admin
       header('location:'. SITEURL. 'admin/add-admin.php');
    }
} 

?>