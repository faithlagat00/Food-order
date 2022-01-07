<?php include("partials-front/menu.php"); ?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
               //display all categories that are active
               //sql query
               $sql = "SELECT*FROM tb_category WHERE active = 'yes'";
               //execute query
               $res = mysqli_query($con, $sql);
               //counting rows to check whether the category is available or not
               $count = mysqli_num_rows($res);
                //check whether category is available or not
            if($count>0)
            {
                //categories available
                while($rows = mysqli_fetch_assoc($res))
                {
                    //get the value like id, title,image_name
                    $id = $rows['id'];
                    $title = $rows['title'];
                    $image_name = $rows['image_name'];
                    ?>
                         <a href="<?php echo SITEURL; ?>category-foods.php?category_id = <?php echo $id; ?>">
                                <div class="box-3 float-container">
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
                                  <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">

                                <?php
                            }
                            ?>
                                  
                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                                </a>

                <?php
                }
            }
            else{
                //category not available
                echo "category not found";
            }       
                            
            ?>
          

        

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include("partials-front/footer.php"); ?>