<?php include ("partials/menu.php"); ?>
<link rel = "stylesheet" href = "../css/table.css">
<div class = "main-content">
        <div class = "wrapper">
           
        <h1>Manage category</h1>
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
           if(isset($_SESSION['no-category-found']))
           {
              echo $_SESSION['no-category-found']; //displaying session message
              unset($_SESSION['no-category-found']); //removing session message
           }

           if(isset($_SESSION['update']))
           {
              echo $_SESSION['update']; //displaying session message
              unset($_SESSION['update']); //removing session message
           }
           if(isset($_SESSION['upload']))
           {
              echo $_SESSION['upload']; //displaying session message
              unset($_SESSION['upload']); //removing session message
           }
           if(isset($_SESSION['failed-remove']))
           {
              echo $_SESSION['failed-remove']; //displaying session message
              unset($_SESSION['failed-remove']); //removing session message
           }
          
    ?>
    <br><br>
        <a href= '<?php echo SITEURL; ?>admin/add-category.php'><button style="background-color: blue; padding: 2px;">add category</button></a>
         <br>
         <br>
         <br>
        <table class="tbl-full">
                <tr>
                        <th>S.N.</th>
                        <th>title</th>
                        <th>image</th>
                        <th>featured</th>
                        <th>active</th>
                        <th>actions</th>
                </tr>

                <?php
                //query to create all category
                $sql = "SELECT*FROM tb_category";
                //execute query
                $res = mysqli_query($con, $sql);
                 //COUNT ROWS to check whether we have data in database or not
                  $count = mysqli_num_rows($res); //function to get all the rows in database

                  $sn = 1; //create a variable and assign the value
                   //check the number of rows
                        if ($count >0)
                        {
                                //we have data in database
                                //get the data and display
                                while ($rows = mysqli_fetch_assoc($res)) 
                                {
                                        $id=$rows['id'];
                                        $title=$rows['title'];
                                        $image_name =  $rows['image_name'];
                                        $featured=$rows['featured'];
                                        $active=$rows['active'];
                                        ?>
                                              <tr>
                                                        <td><?php echo $sn++;?></td>
                                                        <td><?php echo $title;?></td>

                                                        <td>
                                                                <?php 
                                                                //check whether image name is available or no
                                                                if($image_name!='')
                                                                {
                                                                        //display image
                                                                        ?>

                                                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width = '100px'>

                                                                        <?php
                                                                }
                                                                else
                                                                 {
                                                                        //display message
                                                                     echo "image not added";
                                                                }
                                                                ?>

                                                        </td>

                                                        <td><?php echo $featured; ?></td>
                                                        <td><?php echo $active; ?></td>

                                                        <td>
                                                        <a href= '<?php echo SITEURL; ?>admin/update-category.php?id= <?php echo $id; ?>'><button style="background-color: green; padding: 2px;">update category</button></a>
                                                        <br>
                                                        <br>
                                                        <a href= '<?php echo SITEURL; ?>admin/delete-category.php?id= <?php echo $id; ?>'><button style="background-color: firebrick; padding: 2px;"> delete category </button></a>
                                                        </td>     
                                              </tr>

                                        <?php
                                }
                                 
                                
                         }
                        else {
                               // we do not have data in database 
                                //we will display the message inside table
                               ?>

                                 <tr>
                                         <td colspan ='6'>no category added</td>
                                 </tr>
                                 <?php
                        }
                
                 ?>
             
        </table>
</div>
</div>


<?php include ("partials/footer.php"); ?>