<?php include('partials/menu.php'); ?>
<div class = "main-content">
        <div class = "wrapper">
<h1>Add category</h1>
<br><br>

<?php 
             if(isset($_SESSION['add']))
           {
              echo $_SESSION['add']; //displaying session message
              unset($_SESSION['add']); //removing session message
           }
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
            <td><input type="text"name="title" placeholder= "category title"> </td>
        </tr>
        <tr>
            <td>select image</td>
            <td><input type="file" name="image"> </td>
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
                <button><input type="submit" name ="submit" value = "add category" > </button>
            </td>
        </tr>
    </table>

</form>

</div>
</div>



<?php include ("partials/footer.php"); ?>

<?php


//process the value from form and save it in database
//check whether the submit button is clicked or not

if(isset($_POST["submit"]))
{
       //button clicked
       //echo "button clicked";
       //get the value from form
   $title = $_POST["title"];

   //for radio input type you check whether the button is selected or not
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
               header('location:'. SITEURL. 'admin/add-category.php');
               //stop the process
               die();
           }
        }
       }
       else {
           //don't upload image and set the image value as blank
           $image_name='';
       }


    // create sql query to save the data into the database
    $sql = "INSERT INTO tb_category SET
    title ='$title',
    image_name ='$image_name',
    featured ='$featured',
    active='$active'
    ";
   
  //executing query and saving data into database
    $res = mysqli_query($con, $sql);

    //check whether data (query is executed) is inserted or not and display appropriate message
    if ($res==true)
    {
        //data inserted
        //echo "data inserted";
        //create a session variable to display message
        $_SESSION['add'] = 'category added successfully';
        //redirect page to manage category
        header('location:'. SITEURL. 'admin/manage-category.php');
    }
    else
    {
        //failed to insert data
       //echo "failed to insert data";
       //create a session variable to display message
       $_SESSION['add'] = 'failed to add category';
       //redirect page to add category
       header('location:'. SITEURL. 'admin/add-category.php');
    }
} 


?>

