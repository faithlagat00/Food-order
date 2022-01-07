<?php include ("../config/constant.php") ?>
<html>
    <head>
        <title> Login - food order system</title>
        <link rel = "stylesheet" href = "../css/admin.css">
    </head>
    <body>
         <div class = "login">
            <h1 class ="text-center">login</h1>

            <br><br>

            <?php 
             if(isset($_SESSION['login']))
           {
              echo $_SESSION['login']; //displaying session message
              unset($_SESSION['login']); //removing session message
           }
           if(isset($_SESSION['no-login-message']))
           {
              echo $_SESSION['no-login-message']; //displaying session message
              unset($_SESSION['no-login-message']); //removing session message
           }
           ?>
           <br><br>
            <form action=""method = "post" class= "text-center"><br><br>
                username: <br>
                <input type="text" name = 'username' placeholder= 'enter user name'><br><br>
                password: <br>
                <input type="password" name = 'password' placeholder= 'enter password'><br><br>

                <button><input type="submit" name = 'submit' value= 'login'></button>

            </form><br><br>

            <p class ="text-center">created by <a href="#"> faith lagat</a></p>
         </div>

    </body>

</html>
<?php
//check whether the submit button is clicked or not
if(isset($_POST['submit']))
{
    //process for login
    //get the data for login form
    $username =mysqli_real_escape_string($con,$_POST["username"]);
    $password =mysqli_real_escape_string($con, md5($_POST["password"]));

    //sql to check whether the user with username and password exist or not
    $sql ="SELECT*FROM tb_admin where username = '$username' and password = '$password'";

    //execute query
    $res = mysqli_query($con, $sql);

    //count rows to check whether the user exist or not
    $count = mysqli_num_rows($res);

    if($count==1)
    {
        //user available and login success
        $_SESSION["login"] = "login successful";
        $_SESSION["user"] = $username; //check whether the user is logged in or not and logout will unset it
        //redirect page to home page
        header('location:'. SITEURL. 'admin/index.php');
    }
    else {
        //user not available and login failed
        $_SESSION["login"] = "username/password did not match";
        //redirect page to home page
        header('location:'. SITEURL. 'admin/login.php'); 
      
    }
}
?>