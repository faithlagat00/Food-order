<?php include ("partials/menu.php"); ?>
<div class = "main-content">
        <div class = "wrapper">
<h1>Update food</h1>
<br>
<br>
<?php 
//check whether the id is set or not
if(isset($_GET['id']))
{
//get the id of selected category
$id = $_GET["id"];
//create sql query to get the details
$sql = "SELECT*FROM tb_foods WHERE id=$id";
//execute query
$res = mysqli_query($con, $sql);
    
        //get value based on query executed
        
        $rows = mysqli_fetch_assoc($res);
        //get individual value
        $title=$rows['title'];
        $description=$rows['description'];
        $price=$rows['price'];
        $current_image =$rows['image_name'];
        $current_category =$rows ['category_id'];
        $featured=$rows['featured'];
        $active=$rows['active'];
        
    
}
else {
    //redirect to manage food
    header('location:'. SITEURL. 'admin/manage-food.php');
}

?>
<form action="" method = "POST" enctype= "multipart/form-data">
    <table>
        <tr>
            <td>title</td>
            <td><input type="text"name="title" value= "<?php echo $title; ?>"> </td>
        </tr>
        <tr>
            <td>description</td>
            <td>
                <textarea name="description" cols="30" rows="5" value= "<?php echo $description; ?>"></textarea>
            </td>
        </tr>
        <tr>
            <td>price</td>
            <td><input type="number"name="price" value= "<?php echo $price; ?>"> </td>
        </tr>
        <tr>
            <td>current image:</td>
            <td>
                <?php
                if($current_image!='')
                {
                    //display the image
                    ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width = '100px'>

                    <?php
                }
                else {
                    //display message
                    echo "image not added";
                }
                ?>
        </td>
        </tr>
        <tr>
            <td>new image:</td>
            <td><input type="file" name="image"> </td>
        </tr>
        <tr>
            <td>category</td>
            <td>
                <select name="category">
                  <?php
                  //create php code to display categories from database
                  //create sql to get all active categories from database
                    $sql = "SELECT*FROM tb_category WHERE active='yes'";
                        //executing the query
                    $res = mysqli_query($con, $sql);
                            //count rows to check whether we have categories or not
                            $count = mysqli_num_rows($res);
                            //if rows is greater than zero, we have categories else we don't have categories
                            if($count>0)
                            {
                                //we have categories
                                while($rows = mysqli_fetch_assoc($res))
                                {
                                    //get the details of category
                                    $category_id = $rows['id'];
                                    $category_title = $rows['title'];
                                    ?>

                                     <option <?php if($current_image==$category_id){echo "selected"; }?> value ="<?php echo $category_id; ?>"></option>
                                    <?php
                                }
                            }
                            else {
                                //we do not have categories
                                ?>
                            <option value="0">no categories found</option>
                                <?php
                            }

                  //display on database
                  
                  ?>

                </select>
                
            </td>
        </tr>
        <tr>
            <td>featured</td>
            <td>
                <input <?php if($featured=="yes"){echo "checked";}?> type="radio"name="featured" value = "yes"> yes
                <input <?php if($featured=="no"){echo "checked";}?> type="radio"name="featured" value = "no"> no
        </td>
        </tr>
        <tr>
            <td>active</td>
            <td>
            <input <?php if($active=="yes"){echo "checked";}?> type="radio"name="active" value = "yes"> Yes
            <input <?php if($active=="no"){echo "checked";}?> type="radio"name="active" value = "no"> no
            </td>
        </tr>
        <tr>
            <td colspan = "2">
                <input type="hidden" name = "current_image" value = "<?php echo $current_image; ?>">
                <input type="hidden" name = "id" value = "<?php echo $id; ?>">
                <button><input type="submit" name ="submit" value = "update food" > </button>
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
    $id=$_POST['id'];
    $title=$_POST['title'];
    $description = $_POST['description'];
    $price= $_POST['price'];
    $category = $_POST['category'];
    $current_image =  $_POST['current_image'];
    $featured=$_POST['featured'];
    $active=$_POST['active'];

    //updating new image if selected
    //check whether the image is selected or not
    if(isset($_FILES['image']['name']))
    {
        //get the image details
        $image_name = $_FILES['image']['name'];

        //check whether if the image is available or not
        if($image_name!='')
        {
            //image available
            //upload the new image

                 //auto rename our image
           //get the extension of our image eg food1.jpg
           $ext = end(explode('.',$image_name));
           //rename the image
           $image_name= 'food_name_'.rand(0000, 9999).'.'.$ext; //eg food_name_656.jp
           $source_path = $_FILES['image']['tmp_name'];
           $destination_path = "../images/food/".$image_name;

           //upload the image

           $upload = move_uploaded_file($source_path, $destination_path);

           //check whether the image is uploaded or not
           //and if the image is not uploaded then we will stop the process and redirect with error message
           if($upload==false)
           {
               //set message
               $_SESSION['upload'] = 'failed to upload image';
               //redirect to add food page
               header('location:'. SITEURL. 'admin/manage-food.php');
               //stop the process
               die();
           }

            //remove the current image if the image is available
            if($current_image!='')
                    {
                    $remove_path = "../images/food/".$current_image;
                    $remove = unlink($remove_path);
                //check whether the image is removed or not
                //if failed to remove display message and stop process
                if($remove==false)
                {
                    //failed to remove image
                    $_SESSION['failed-remove'] = "failed to remove current image";
                    header('location:'. SITEURL. 'admin/manage-food.php');
                    die(); //stop the process
                }
            }
            
        }
        else {
            $image_name = $current_image;
        }
    }
    else {
        $image_name = $current_image;
    }

   //create sql query to update category
   $sql2 = "UPDATE tb_foods SET
    title = '$title',
    description = '$description',
    price=$price,
    image_name = '$image_name',
    category_id =$category,
    featured ='$featured',
    active='$active'
    where id = $id
    ";

   //execute the query
   $res2 = mysqli_query($con, $sql2);

   //check whether the query is executed successfully or not
   if ($res2==TRUE)
   {
     //QUERY executed and food updated
     $_SESSION['update'] = "food updated successfully";
     //redirect page to manage food
     header('location:'. SITEURL. 'admin/manage-food.php');
   }
   else {
      // failed to update food
      $_SESSION['update'] = "failed to update food";
      //redirect page to add food
      header('location:'. SITEURL. 'admin/manage-food.php');
   }
 }
 ?>

<?php include ("partials/footer.php"); ?>