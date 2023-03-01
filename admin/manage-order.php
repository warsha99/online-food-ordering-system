<?php include('partials/menu.php');?>
<div class="main-content">
<div class="wrapper">
<h1>Manage Order</h1>
<br/><br/><br/>

<?php 
if(isset($_SESSION['update']))
{
    echo $_SESSION['update'];
    unset($_SESSION['update']);
}
?>
<br><br>

<table class="tbl-full" >
    <tr>
        <th>S.N.</th>
        <th>Restuarent ID</th>
        <th>Food</th>
        <th>Price (Rs.)</th>
        <th>Qty. </th>
        <th>Total amount</th>
        <th>Order Date</th>
        <th>Status </th>
        <th>Customer Name</th>
        <th>Contact</th>
        <th>Email</th>
        <th>Address</th>
        <th>Actions</th>
    </tr>

    <?php
        //Get all the orders from database
        $sql = "SELECT * FROM orders ORDER BY id DESC"; //isplay the latest order at first

        //execute query
        $res = mysqli_query($conn, $sql);

        //count the rows
        $count = mysqli_num_rows($res);

        $sn = 1; //create a seriel number and set its initial value as 1

        if ($count>0)
        { 
            //order available
            while($row=mysqli_fetch_assoc($res))
            {
                //Get all the order details
                $id= $row['id'];
                $rest_id = $row['restuarent_id'];
                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $total = $row['total'];
                $order_date = $row['order_date'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];

                ?>
                                <tr>
                            <td><?php echo $sn++; ?>.</td>
                            <td><?php echo $rest_id; ?></td>
                            <td><?php echo $food; ?></td>
                            <td><?php echo $price; ?></td>
                            <td><?php echo $qty; ?></td>
                            <td><?php echo $total; ?></td>
                            <td><?php echo $order_date; ?></td>

                            <td>
                            <?php
                                //ordered, on delivery, delivered, cancelled
                                if($status=="Ordered")
                                {
                                    echo "<label>$status</label>";
                                }
                                elseif($status=="On Delivery")
                                {
                                    echo "<label style='color: green'>$status</label>";
                                }
                                elseif($status=="Delivered")
                                {
                                    echo "<label style='color:blue'>$status</label>";
                                }
                                elseif($status=="Cancelled")
                                {
                                    echo "<label style='color: red'>$status</label>";
                                }
                            ?>
                            </td>
                            <td><?php echo $customer_name; ?></td>
                            <td><?php echo $customer_contact; ?></td>
                            <td><?php echo $customer_email; ?></td>
                            <td><?php echo $customer_address; ?></td>
                        <td>
                        <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>"class="btn-secoundary">Update Order</a>

                        </td>
                    </tr>
                <?php
            }
        }
        else
        {
            //order not available
            echo "<tr><td colspan='13' class='error'>Orders Not Available</td></tr>"; 
        }
    ?>
    
    

</table>

<div class="clearfix"></div>

</div>
</div>
<?php include('partials/footer.php')?>