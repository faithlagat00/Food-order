<?php include ("partials-front/menu.php"); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <?php
    if(isset($_SESSION['order']))
    {
       echo $_SESSION['order']; //displaying session message
       unset($_SESSION['order']); //removing session message
    }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
            //create sql query to display categories from database
            $sql = "SELECT*FROM tb_category WHERE active = 'yes' AND featured = 'yes' LIMIT 3";
            //execute the query
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
            else {
                //categories not available
                echo "category not added";
            }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
                <?php
                 //create sql query to display food from database
            $sql2= "SELECT*FROM tb_foods WHERE active = 'yes' AND featured = 'yes' LIMIT 6";
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
                    //get the value like id, title,image_name
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
                        <h4><?php echo $title?></h4>
                        <p class="food-price"><?php echo $price?></p>
                        <p class="food-detail">
                             <?php echo $description?>
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
                echo "food not added";
            }
            ?>
            
            <div class="clearfix"></div>

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include("partials-front/footer.php"); ?>