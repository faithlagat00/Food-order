<?php include("partials-front/menu.php"); ?>
  <?php
  //check whether food id is set or not
  if(isset($_GET['food_id']))
  {
    //get the food id and the details of the selected food
        $food_id = $_GET['food_id'];
        //get details for selected food
        $sql= "SELECT*FROM tb_foods WHERE id=$food_id";
        //execute the query
        $res = mysqli_query($con, $sql);
        //count the rows
        $count = mysqli_num_rows($res);
        //check whether data is available or not
        if($count==1)
        {
            //we have data
            //get data from database
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
        }
        else
        {
            //food not available
            //redirect to home page
            header('location:'.SITEURL);
        }
  }
  else
  {
      //redirect to home page
      header('location:'.SITEURL);
  }
  ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method = "POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                            //check whether the image is available or not
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
                        <h3><?php echo $title?></h3>
                        <input type="hidden" name = "food" value= "<?php echo $title; ?>">

                        <p class="food-price"><?php echo $price?></p>
                        <input type="hidden" name = "price" value= "<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="quantity" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Faith Lagat" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 0757xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. faithjepchumba00@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
                <?php
                //check whether submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    //get all details from the form
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $quantity = $_POST['quantity'];

                    $total = $price * $quantity; 
                    $order_date = date("y-m-d h:i:sa");
                    $status= "ordered";
                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];

                    //save the order in database
                    //create sql to save data
                    $sql2= "INSERT INTO tb_order SET 
                    food = '$food',
                    price = '$price',
                    quantity= '$quantity',
                    total = '$total',
                    order_date = '$order_date',
                    status= '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                    ";

                    //execute query
                    $res2= mysqli_query($con, $sql2);

                    //check whether query executed successfully or not
                    if($res2==true)
                    {
                        //query executed and order saved
                        $_SESSION['order']= "order placed successfully";
                       header('location:'.SITEURL);
                    }
                    else
                    {
                        //failed to save order
                        $_SESSION['order']= "failed to placed order";
                        header('location:'.SITEURL);
                    }

                }
                ?>
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include("partials-front/footer.php"); ?>