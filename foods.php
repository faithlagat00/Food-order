<?php include("partials-front/menu.php"); ?>

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



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
               //display all food that are active
               //sql query
               $sql = "SELECT*FROM tb_foods WHERE active = 'yes'";
               //execute query
               $res = mysqli_query($con, $sql);
               //counting rows to check whether the food is available or not
               $count = mysqli_num_rows($res);
                //check whether food is available or not
            if($count>0)
            {
                //food available
                while($rows = mysqli_fetch_assoc($res))
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
    <!-- fOOD Menu Section Ends Here -->

    <?php include("partials-front/footer.php"); ?>