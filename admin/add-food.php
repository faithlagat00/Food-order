<?php include ("partials/menu.php"); ?>
<div class = "main-content">
        <div class = "wrapper">
<h1>Add Food</h1>
<br>
<br>
<?php 
           
           if(isset($_SESSION['upload']))
           {
              echo $_SESSION['upload']; //displaying session message
              unset($_SESSION['upload']); //removing session message
           }

    ?>  
<br><br>
<form action="" method = "POST" enctype= "multipart/form-data">
    <table>
        <tr>
            <td>title</td>
            <td><input type="text"name="title" placeholder= "food title"> </td>
        </tr>
        <tr>
            <td>description</td>
            <td>
                <textarea name="description" cols="30" rows="5" placeholder ="description"></textarea>
            </td>
        </tr>
        <tr>
            <td>price</td>
            <td><input type="number"name="price"> </td>
        </tr>
        <tr>
            <td>select image</td>
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
                                    $id = $rows['id'];
                                    $title = $rows['title'];
                                    ?>

                                     <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
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
                <input type="radio"name="featured" value = "yes"> Yes
            <input type="radio"name="featured" value = "no"> no
        </td>
        </tr>
        <tr>
            <td>active</td>
            <td>
            <input type="radio"name="active" value = "yes"> Yes
            <input type="radio"name="active" value = "no"> no
            </td>
        </tr>
        <tr>
            <td colspan = "2">
                <button><input type="submit" name ="submit" value = "add food" > </button>
            </td>
        </tr>
    </table>

</form>

<?php  
//check whether the button is clicked
if(isset($_POST['submit']))
{
    //add food in database
    //echo 'clicked';
    //get the data from form
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price= $_POST['price'];
    $category = $_POST['category'];

    //check whether the radio button for featured and active are checked or not
    if(isset($_POST["featured"]))
    {
        //get value from form
        $featured= $_POST['featured'];
    }
    else {
        //set the default value
        $featured = "no";
    }
    if(isset($_POST["active"]))
    {
        //get value from form
        $active= $_POST['active'];
    }
    else {
        //set the default value
        $active = "no";
    }
    //upload image if selected
      //check whether the image is selected or not and set the value for image name accordingly
      //print_r($_FILES['image']);

       //die(); //break the code
       if(isset($_FILES['image']['name']))
       {
           
           //to upload image we need image name,source path and destintion path
           $image_name = $_FILES['image']['name'];

           //upload image only is image is selected
           if($image_name!='')
           {

           //auto rename our image
           //get the extension of our image eg food1.jpg
           $ext = end(explode('.',$image_name));
           //rename the image
           $image_name= 'food_name_'.rand(0000, 9999).'.'.$ext; //eg food_name_656.jpg

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
               header('location:'. SITEURL. 'admin/add-food.php');
               //stop the process
               die();
           }
        }
       }
       else {
           //don't upload image and set the default value 
           $image_name='';
       }

    //insert into database
    //redirect with message to manage food
    // create sql query to save the data into the database
    $sql2 = "INSERT INTO tb_foods SET
    title = '$title',
    description = '$description',
    price=$price,
    image_name = '$image_name',
    category_id =$category,
    featured ='$featured',
    active='$active'
    ";
   
  //executing query and saving data into database
    $res2 = mysqli_query($con, $sql2);

    //check whether data (query is executed) is inserted or not and display appropriate message
    if ($res2==true)
    {
        //data inserted
        //echo "data inserted";
        //create a session variable to display message
        $_SESSION['add'] = 'food added successfully';
        //redirect page to manage food
        header('location:'. SITEURL. 'admin/manage-food.php');
    }
    else
    {
        //failed to insert data
       //echo "failed to insert data";
       //create a session variable to display message
       $_SESSION['add'] = 'failed to add food';
       //redirect page to add food
       header('location:'. SITEURL. 'admin/add-food.php');
    }
} 



?>
</div>
</div>



<?php include ("partials/footer.php"); ?>