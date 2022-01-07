<?php include ("partials/menu.php"); ?>
<div class = "main-content">
        <div class = "wrapper">
           
        <h1>DASHBOARD</h1> 
        <br><br>
                <?php 
                    if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login']; //displaying session message
                    unset($_SESSION['login']); //removing session message
                }
                ?>
<br><br>
            <div class="col-4 text-center">
                <?php
                //sql query
                $sql = "SELECT*FROM tb_category";
                //execute query
                $res= mysqli_query($con, $sql);
                //count rows
                $count= mysqli_num_rows($res);
                ?>
                <h1><?php echo $count; ?></h1>
                <br />
                Categories
            </div>
            <div class="col-4 text-center">
            <?php
                //sql query
                $sql2 = "SELECT*FROM tb_foods";
                //execute query
                $res2= mysqli_query($con, $sql2);
                //count rows
                $count2= mysqli_num_rows($res2);
                ?>
                <h1><?php echo $count2; ?></h1>
                <br />
                Foods
            </div>
            <div class="col-4 text-center">
            <?php
                //sql query
                $sql3 = "SELECT*FROM tb_order";
                //execute query
                $res3= mysqli_query($con, $sql3);
                //count rows
                $count3= mysqli_num_rows($res3);
                ?>
                <h1><?php echo $count3; ?></h1>
                <br />
                Total orders
            </div>
            <div class="col-4 text-center">
            <?php
                //sql query
                //aggregated function in sql
                $sql4 = "SELECT SUM(total) AS Total FROM tb_order WHERE status = 'Delivered'";
                //execute query
                $res4= mysqli_query($con, $sql4);
                //get the value
                $rows4 = mysqli_fetch_assoc($res4);
                //get the total revenue
                $total_revenue = $rows4['Total'];
                ?>
                <h1><?php echo $total_revenue; ?></h1>
                <br />
                Revenues generated
            </div>
            <div class="clearfix"></div>
        </div>      
</div>
<?php include ("partials/footer.php"); ?>