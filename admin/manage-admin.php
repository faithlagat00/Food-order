<?php include ("partials/menu.php"); ?>
<link rel = "stylesheet" href = "../css/table.css">
<div class = "main-content">
        <div class = "wrapper">
           
        <h1>Manage Admin</h1> 
        <br>
        <br>

          <?php 
             if(isset($_SESSION['add']))
           {
              echo $_SESSION['add']; //displaying session message
              unset($_SESSION['add']); //removing session message
           }
           if(isset($_SESSION['delete']))
           {
              echo $_SESSION['delete']; //displaying session message
              unset($_SESSION['delete']); //removing session message
           }
           if(isset($_SESSION['update']))
           {
              echo $_SESSION['update']; //displaying session message
              unset($_SESSION['update']); //removing session message
           }
           if(isset($_SESSION['user-not-found']))
           {
              echo $_SESSION['user-not-found']; //displaying session message
              unset($_SESSION['user-not-found']); //removing session message
           }
           if(isset($_SESSION['password-not-match']))
           {
              echo $_SESSION['password-not-match']; //displaying session message
              unset($_SESSION['password-not-match']); //removing session message
           }
           if(isset($_SESSION['change-password']))
           {
              echo $_SESSION['change-password']; //displaying session message
              unset($_SESSION['change-password']); //removing session message
           }
          ?>
           <br> 
           <br>
           <br>


        <a href= 'add-admin.php'><button style="background-color: blue; padding: 2px;">add admin </button></a>
         <br>
         <br>
         <br>
        <table class="tbl-full">
                <tr>
                        <th>S.N.</th>
                        <th>full name</th>
                        <th>username</th>
                        <th>actions</th>
                </tr>
                <?php
                //query to create all admin
                $sql = "SELECT*FROM tb_admin";
                //execute query
                $res = mysqli_query($con, $sql);
                //check whether the query is executed or not
                if($res==TRUE)
                {
                        //COUNT ROWS to check whether we have data in database or not
                        $count = mysqli_num_rows($res); //function to get all the rows in database

                        $sn = 1; //create a variable and assign the value

                        //check the number of rows
                        if ($count >0)
                        {
                                //we have data in database
                                while ($rows = mysqli_fetch_assoc($res)) 
                                {
                                        //using while loop to get all data from database
                                        //and while loop will run as long as we have data in database
                                        //get individual data
                                        $id=$rows['id'];
                                        $full_name=$rows['full_name'];
                                        $username=$rows['username'];

                                        //display the values in the table
                                        ?>
                                              <tr>
                                                        <td><?php echo $sn++?></td>
                                                        <td><?php echo $full_name?></td>
                                                        <td><?php echo $username?></td>
                                                        <td>
                                                        <a href= '<?php echo SITEURL; ?>admin/update-password.php?id= <?php echo $id; ?>'><button style="background-color: grey  ; padding: 2px;">change password</button></a>
                                                        <a href= '<?php echo SITEURL; ?>admin/update-admin.php?id= <?php echo $id; ?>'><button style="background-color: green; padding: 2px;">update admin</button></a>
                                                        <br>
                                                        <br>
                                                        <a href= '<?php echo SITEURL; ?>admin/delete-admin.php?id= <?php echo $id; ?>'><button style="background-color: firebrick; padding: 2px;"> delete admin </button></a>
                                                        </td>    
                                              </tr>

                                        <?php
                                }
                        }
                        else {
                               // we do not have data in database 
                        }
                                
                   }
                
                 ?>
                
        </table>

            
        </div>      
</div>
<?php include ("partials/footer.php"); ?>