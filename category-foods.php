<?php include("partials-front/menu.php"); ?>
 <?php
    //check whether id is passed or not
    if(isset($_GET['category_id']))
    {
        //category id is set and get the id
        $category_id = $_GET['category_id'];
        //get category tite based on category id
        $sql = "SELECT title FROM tb_category WHERE id = $category_id";
        //execute the query 
        $res = mysqli_query($con, $sql);
        //get value from database
        $row = mysqli_fetch_assoc($res);
        //get the title
        $category_title = $row['title'];
    }
    else
    {
        //category not passed
        //redirect to home page
        header('location:'.SITEURL);
    }
 
 ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
        
            //create sql query to display food from database basedon selected category
       $sql2= "SELECT*FROM tb_foods where category_id = $category_id";
       //execute the query
       $res2 = mysqli_query($con, $sql2);
       //counting rows to check whether the food is available or not
       $count2 = mysqli_num_rows($res2);
       //check whether food is available or not
       if($count2>0)
       {
           //food available
           while($rows = mysqli_fetch_assoc($res2))
           {
               //get the value like title,image_name
               $id = $rows['id'];
               $title = $rows['title'];
               $price = $rows['price'];
               $description = $rows['description'];
               $image_name = $rows['image_name'];
               ?>
               <div class="food-menu-box">
               <div class="food-menu-img">
               <?php
                       //check whether image is available or not
                       if($image_name=='')
                       {
                           //display message
                           echo "image not available";
                       }
                       else {
                           //image available
                           ?>
                           <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                           <?php
                       }
                       ?>
                        
                        
                   
               </div>

               <div class="food-menu-desc">
                   <h4><?php echo $title; ?></h4>
                   <p class="food-price"><?php echo $price; ?></p>
                   <p class="food-detail">
                        <?php echo $description; ?>
                   </p>
                   <br>

                   <a href="<?php echo SITEURL; ?>order.php?food_id = <?php echo $id; ?>" class="btn btn-primary">Order Now</a>
               </div>
           </div>
           </div>
                   </a>

               <?php

           }
       }
       else {
           //food not available
           echo "food not available";
       }
       ?>
            
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include("partials-front/footer.php"); ?>