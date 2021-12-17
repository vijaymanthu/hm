<?php 
include "header.php";
if(isset($_GET['send_to_p']))
{
    $id = $_GET['send_to_p'];
    $p = $_GET['cost'] + 150;
    $pid = $_GET['pid'];
    $update_sql = "UPDATE `bookings` SET `sent_by_admin`=1,`new_price`='$p' WHERE booking_id = '$id'";
    $res = $conn->query($update_sql); 
    if($res)
    {
        echo "<script>alert('Sent Successfully');document.location = 'send_to.php?ut=photographer'</script>";
    }
}
if(isset($_GET['send_to_b']))
{
    $id = $_GET['send_to_b'];
    $update_sql = "UPDATE `product_buy` SET `send_to_boutique`=1 WHERE id = '$id'";
    $res = $conn->query($update_sql);
    if($res)
    {
        echo "<script>alert('Sent Successfully');document.location = 'send_to.php?ut=boutique'</script>";
    }
}
if(isset($_GET['ut'])){
    if($_GET['ut'] == 'photographer'){
?>
            <div class="content-wrapper">
                <div class="page-header">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                            <i class="mdi mdi-tshirt-v"></i>
                            </span> Send User Data To Photographer
                        </h3>
                </div>
            <div class="container table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>sl No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile Number</th>
                            <th>Photographer Email</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Feedback</th>
                            <th>Payment Status</th>
                            <th>Price</th>
                            <th class="text-center" colspan="2">Action </th>
                        </tr>
                    </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * from bookings";
                                $i=1;
                                $res = $conn->query($sql);
                                if($res){
                                    while($row = $res->fetch_assoc()){
                                        $user_id = $row['user_id'];
                                        $photographer_id = $row['booked_photographer_id'];
                                        ?>
                                         <tr>
                                            <td><?php echo $i++ ?></td>
                                            <td><?php echo $row['first_name']." ".$row['last_name']?></td>
                                            <?php
                                            $sql12 = "SELECT email from login where `user_id` = '$user_id'";
                                            $res12 = $conn->query($sql12);
                                            $user_email = $res12->fetch_assoc();
                                            ?>
                                            <td><?php echo $user_email['email']?></td>
                                            <td><?php echo $row['mobile']?></td>
                                            <?php
                                                $sql2 = "SELECT email from login where `user_id` = '$photographer_id'";
                                                $res2 = $conn->query($sql2);
                                                $row2 = $res2->fetch_assoc();
                                            ?>
                                            <td><?php echo $row2['email']?>
                                            <td><?php echo $row['fromdate']?></td>
                                            <td><?php echo $row['todate']?></td>
                                            <td><?php 
                                                if($row['feedback'] == ''){
                                                    echo "<p class='text-danger'>No Yet Given</p>";
                                                }else{
                                                    echo "<p class='h4 text-success'>".$row['feedback']."</p>";
                                                }
                                            ?></td>
                                            <?php
                                                $sql3 = "SELECT cost from photographer_info where `user_id` = '$photographer_id'";
                                                $res3 = $conn->query($sql3);
                                                $row3 = $res3->fetch_assoc();
                                            ?>
                                            <?php
                                            
                                            if($row['sent_by_admin']){
                                                ?>
                                                <td><?php echo $row['payment']?></td>
                                                <td><?php echo $row['new_price']?></td>
                                                <td><h5>Sent to Photographer</h5></td>
                                                <!-- <td><a href="managePhotographer.php?reject_p=<?php echo $row['user_id'] ?>" class="btn btn-danger">Reject</a></td> -->
                                        <?php    
                                        }else{
                                            ?>
                                            <td><?php echo "Rs. ".$row3['cost']." + "."150"?></td>
                                            <td><a href="send_to.php?&fname=<?php echo $row['first_name']?>&lname=<?php echo $row['last_name']?>pid=<?php echo $photographer_id?>&send_to_p=<?php echo $row['booking_id'] ?>&cost=<?php echo $row3['cost'] ?>" class="btn btn-danger">Send</a></td>
                                            <?php
                                        }?>
                                        </tr>
                                        <?php
                                    }

                                }

                            ?>
                        </tbody>
                    </table>    
                </div>
<?php
    }
    // Send to Boutique
    if($_GET['ut'] == 'boutique'){
    ?>

            <div class="content-wrapper">
                <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-tshirt-v"></i>
                    </span> Send User Data To Boutique
                </h3>
                </div>
                <div class="container table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>sl No</th>
                            <th>Product Name</th>
                            <th>Size</th>
                            <th>Material</th>
                            <th>Boutique's Name</th>
                            <th>Customer Name</th>
                            <th>Date and Time</th>
                            <th>Adress</th>
                            <th>Feedback</th>
                            <th>Price</th>
                            <th class="text-center" colspan="2">Action </th>
                        </tr>
                    </thead>
                        <tbody>
                        <?php
                                $sql = "SELECT * from product_buy";
                                $i=1;
                                $res = $conn->query($sql);
                                if($res){
                                    while($row = $res->fetch_assoc()){
                                        $product_id = $row['product_id'];
                                 ?>
                                <tr>
                                    <td><?php echo $i++?></td>
                                    <?php 
                                    $product = "SELECT product_name,price,`user_id`,size,material from boutique_products where id='$product_id'";
                                    $res2 = $conn->query($product);
                                    $p = $res2->fetch_assoc();
                                    $uid = $p['user_id'];

                                    $user = "SELECT `name` FROM `boutique_info` where `user_id` ='$uid'";
                                    $res3 = $conn->query($user);
                                    $u = $res3->fetch_assoc();
                                    ?>
                                    <td><?php echo $p['product_name']?></td>
                                    <td><?php echo $p['size']?></td>
                                    <td><?php echo $p['material']?></td>
                                    <td><?php echo $u['name']?></td>
                                    <td><?php echo $row['user_name']?></td>
                                    <td><?php echo $row['date']?></td>
                                
                                    <td><?php echo $row['address']?></td>
                                    <td><?php 
                                                if($row['feedback'] == ''){
                                                    echo "<p class='text-danger'>No Yet Given</p>";
                                                }else{
                                                    echo "<p class='h4 text-success'>".$row['feedback']."</p>";
                                                }
                                            ?></td>
                                    <td><?php echo "Rs. ".strval($p['price'])." + "."150"?></td>
                                    <?php
                                            if($row['send_to_boutique']){
                                                ?><td><h5>Sent to Boutique</h5></td>
                                                <!-- <td><a href="managePhotographer.php?reject_p=<?php echo $row['user_id'] ?>" class="btn btn-danger">Reject</a></td> -->
                                        <?php    
                                        }else{
                                            ?>
                                            <td><a href="send_to.php?send_to_b=<?php echo $row['id'] ?>" class="btn btn-danger">Send</a></td>
                                            <?php
                                        }?>

                                </tr>


                            <?php
                                    }
                                    ?>
            </div>
    <?php
    }
}
}
include 'footer.php';

?>