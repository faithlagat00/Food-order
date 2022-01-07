<?php include ("partials/menu.php"); ?>
<link rel = "stylesheet" href = "../css/table.css">
<div class = "main-content">
        <div class = "wrapper">
           
        <h1>Manage order</h1>
            <br>
        <br>
        <?php
        if(isset($_SESSION['update']))
           {
              echo $_SESSION['update']; //displaying session message
              unset($_SESSION['update']); //removing session message
           }
           ?>
         <br>
         <br>
        <table class="tbl-full">
                <tr>
                        <th>S.N.</th>
                        <th>food</th>
                        <th>price</th>
                        <th>quantity</th>
                        <th>total</th>
                        <th>order_date</th>
                        <th>status</th>
                        <th>customer name</th>
                        <th>customer contact</th>
                        <th>email</th>
                        <th>address</th>
                        <th>actions</th>
                </tr>
                <?php
                //get all orders from database
                $sql = "SELECT*FROM tb_order";
                //execute query
                $res= mysqli_query($con, $sql);
                //count rows
                $count =mysqli_num_rows($res);

                $sn = 1;

                if($count>0)
                {
                        //order available
                        while($row= mysqli_fetch_assoc($res))
                        {
                        $id = $row['id'];
                        $food = $row['food'];
                        $price = $row['price'];
                        $quantity = $row['quantity'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];
                        ?>
                                <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $food; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $quantity; ?></td>
                                        <td><?php echo $total; ?></td>
                                        <td><?php echo $order_date; ?></td>

                                        <td>
                                                <?php 
                                                if($status=="ordered")
                                                {
                                                        echo "<label>$status</label>";
                                                }
                                                elseif($status=="on delivery")
                                                {
                                                        echo "<label style = 'color: orange;'>$status</label>";
                                                }
                                                elseif($status=="Delivered")
                                                {
                                                        echo "<label style = 'color: green;'>$status</label>";
                                                }
                                                elseif($status=="cancelled")
                                                {
                                                        echo "<label style = 'color: red;'>$status</label>";
                                                }
                                                ?>
                                         </td>

                                        <td><?php echo $customer_name; ?></td>
                                        <td><?php echo $customer_contact; ?></td>
                                        <td><?php echo $customer_email; ?></td>
                                        <td><?php echo $customer_address; ?></td>
                                        <td>
                                        <a href= "<?php echo SITEURL; ?>admin/update-order.php?id= <?php echo $id; ?>"><button style="background-color: green; padding: 2px;">update order</button></a>
                                        <br>
                                        <br>
                                        </td>
                                </tr>
                        <?php
                }
        }
                else
                {
                        //order not available
                        echo "<tr><td colspan= '12'>orders not available</td></tr>";
                }
                ?>
                
                
        </table>
</div>
</div>

<?php include ("partials/footer.php"); ?>