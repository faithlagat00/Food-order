<?php include ("partials/menu.php"); ?>
<div class = "main-content">
        <div class = "wrapper">
<h1>Update category</h1>
<br>
<br>
<?php 
//check whether the id is set or not
if(isset($_GET['id']))
{
//get the id of selected category
$id = $_GET["id"];
//create sql query to get the details
$sql = "SELECT*FROM tb_category WHERE id=$id";
//execute query
$res = mysqli_query($con, $sql);
    //check whether data is available or not
    $count = mysqli_num_rows($res);
    //check whether we have category data or not
    if($count==1)
    {
        //get details
        //echo "category available";
        $rows = mysqli_fetch_assoc($res);

        $title=$rows['title'];
        $current_image =  $rows['image_name'];
        $featured=$rows['featured'];
        $active=$rows['active'];
    }
    else {
        //redirect to manage category page with session message
        $_SESSION["no-category-found"] = "category not found";
        header('location:'. SITEURL. 'admin/manage-category.php');
    }
}
else {
    //redirect to manage category
    header('location:'. SITEURL. 'admin/manage-category.php');
}

?>
<form action="" method = "POST" enctype= "multipart/form-data">
    <table>
        <tr>
            <td>title</td>
            <td><input type="text"name="title" value= "<?php echo $title; ?>"> </td>
        </tr>
        <tr>
            <td>current image:</td>
            <td>
                <?php
                if($current_image!='')
                {
                    //display the image
                    ?>
                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width = '100px'>

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
                <button><input type="submit" name ="submit" value = "update category" > </button>
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
           $image_name= 'food_category_'.rand(000, 999).'.'.$ext; //eg food_category_656.jpg

           $source_path = $_FILES['image']['tmp_name'];
           $destination_path = "../images/category/".$image_name;

           //upload the image

           $upload = move_uploaded_file($source_path, $destination_path);

           //check whether the image is uploaded or not
           //and if the image is not uploaded then we will stop the process and redirect with error message
           if($upload==false)
           {
               //set message
               $_SESSION['upload'] = 'failed to upload image';
               //redirect to add category page
               header('location:'. SITEURL. 'admin/manage-category.php');
               //stop the process
               die();
           }

            //remove the current image if the image is available
            if($current_image!='')
                    {
                    $remove_path = "../images/category/".$current_image;
                    $remove = unlink($remove_path);
                //check whether the image is removed or not
                //if failed to remove display message and stop process
                if($remove==false)
                {
                    //failed to remove image
                    $_SESSION['failed-remove'] = "failed to remove current image";
                    header('location:'. SITEURL. 'admin/manage-category.php');
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
   $sql2 = "UPDATE tb_category SET
    title='$title',
    image_name='$image_name',
    featured= '$featured',
    active= '$active'
   WHERE id='$id'
   ";

   //execute the query
   $res2 = mysqli_query($con, $sql2);

   //check whether the query is executed successfully or not
   if ($res2==TRUE)
   {
     //QUERY executed and category updated
     $_SESSION["update"] = "category updated successfully";
     //redirect page to manage category
     header('location:'. SITEURL. 'admin/manage-category.php');
   }
   else {
      // failed to update category
      $_SESSION["update"] = "failed to update category";
      //redirect page to add category
      header('location:'. SITEURL. 'admin/manage-category.php');
   }
 }
 ?>

<?php include ("partials/footer.php"); ?>