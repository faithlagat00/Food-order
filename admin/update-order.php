<?php include ("partials/menu.php"); ?>

<div class = "main-content">
        <div class = "wrapper">
           
        <h1>Manage order</h1>
            <br>
        <br>
        <?php 
                //check whether the id is set or not
                if(isset($_GET['id']))
                {
                    $id = $_GET['id'];

                //get the id of selected category
                $id = $_GET["id"];
                //create sql query to get the details
                $sql = "SELECT*FROM tb_order WHERE id=$id";
                //execute query
                $res = mysqli_query($con, $sql);
                    //check whether data is available or not
                    $count = mysqli_num_rows($res);
                    //check whether we have  data or not
                    if($count==1)
                    {
                        //get details
                        //echo "details available available";
                        $rows = mysqli_fetch_assoc($res);

                        $food=$rows['food'];
                        $price =  $rows['price'];
                        $quantity=$rows['quantity'];
                        $status=$rows['status'];
                        $customer_name=$rows['customer_name'];
                        $customer_contact=$rows['customer_contact'];
                        $customer_email=$rows['customer_email'];
                        $customer_address=$rows['customer_address'];
                    }
                    else {
                        //redirect to manage category page 
                        header('location:'. SITEURL. 'admin/manage-order.php');
                    }
                }
                else {
                    //redirect to manage category
                    header('location:'. SITEURL. 'admin/manage-order.php');
                }
             ?>
        <form action="" method = "POST" enctype= "multipart/form-data">
            <table>
<tr>
    <td>food name</td>
    <td><?php echo $food; ?></td>
</tr>
<tr>
    <td>price</td>
    <td><?php echo $price; ?></td>
</tr>
<tr>
    <td>quantity</td>
    <td>
        <input type="number" name = "quantity" value ="<?php echo $quantity; ?>">
    </td>
</tr>
<tr>
<td>status</td>
<td>
    <select name="status" >
        <option <?php if($status=="ordered"){echo "selected";}?> value="ordered">ordered</option>
        <option <?php if($status=="on delivery"){echo "selected";}?> value="on delivery">on delivery</option>
        <option <?php if($status=="Delivered"){echo "selected";}?> value="Delivered">Delivered</option>
        <option <?php if($status=="cancelled"){echo "selected";}?> value="cancelled">cancelled</option>
    </select>
</td>
</tr>
<tr>
    <td>customer name</td>
    <td>
        <input type="text" name = "customer_name" value ="<?php echo $customer_name; ?>">
    </td>
</tr>
<tr>
    <td>customer contact</td>
    <td>
        <input type="number" name = "customer_contact" value ="<?php echo $customer_contact; ?>">
    </td>
</tr>
<tr>
    <td>customer email</td>
    <td>
        <input type="text" name = "customer_email" value ="<?php echo $customer_email; ?>">
    </td>
</tr>
<tr>
    <td>customer address</td>
    <td>
        <textarea name="customer_address"  cols="30" rows="5"><?php echo $customer_address; ?></textarea>
    </td>
</tr>
<tr>
    <td colspan= "2" >
        <input type="hidden" name= "id" value="<?php echo $id; ?>">
        <input type="hidden" name= "price" value="<?php echo $price; ?>">
        <input type="submit" name= "submit" value= "update order">
    </td>
</tr>

 </table>
            </form>

<?php
    //check whether update button is clicked or not
    if(isset($_POST['submit']))
    {
        //echo"clicked";
        //get all values from form
        $id= $_POST['id'];
        $price =  $_POST['price'];
        $quantity=$_POST['quantity'];
        $total =  $_POST['total'];
        $status=$_POST['status'];
        $customer_name=$_POST['customer_name'];
        $customer_contact=$_POST['customer_contact'];
        $customer_email=$_POST['customer_email'];
        $customer_address=$_POST['customer_address'];

        //update the values
        $sql2 = "UPDATE tb_order SET
        quantity = $quantity,
        total = $total,
        status = $status,
        customer_name = $customer_name,
        customer_contact = $customer_contact,
        customer_email = $customer_email,
        customer_address = $customer_address
        where id = $id
        ";
        //execute the query
        $res2 = mysqli_query($con, $sql2);
        //check whether updated or not 
        // and redirect to manage order with message
        if($res==true)
        {
            //updated
            $_SESSION['update'] = "order updated successfully";
            header('location:'. SITEURL. 'admin/manage-order.php');
        }
        else
        {
            //failed to update
            $_SESSION['update'] = "failed to update";
            header('location:'. SITEURL. 'admin/manage-order.php');
        }
    }
?>
</div>
</div>
<?php include ("partials/footer.php"); ?>