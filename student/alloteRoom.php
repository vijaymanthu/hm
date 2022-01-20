<?php
include './header.php';
require_once './Navbar.php';
require '../includes/db.php';

$sid = $_SESSION['user']['id'];
$sql = "SELECT * from room_allocated where student_id = '$sid'";
$res = $conn->query($sql);
if($res->num_rows > 0)
{
    $room_alloted_data = $res->fetch_assoc();



    $sql_room = "SELECT * from rooms where id='".$room_alloted_data['room_id']."'";
    $res = $conn->query($sql_room);
    $room_data = $res->fetch_assoc();



    ?>

    <div class="container justify-content-center d-flex ">
    <div class="continer m-5 card p-3 text-center" style="max-width:800px">
        <div class="card-title h4 text-center bg-secondary p-2 text-light" style="font-family: 'Times New Roman', Times, serif;">Details of Allocated Room</div>
        <div class="card-body">
            <div class="row mt-3">
                <div class="col">
                    <h5>Room No</h5>
                </div>
                <div class="col">
                    <?php echo $room_data['room_no']?>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <h5>Total Fees</h5>
                </div>
                <div class="col">
                    <?php echo "<span class='h5'>Rs.</span>".$room_data['fees']?>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <h5>Total Paid</h5>
                </div>
                <div class="col">
                    <?php echo "<span class='h5'>Rs.</span>".$room_alloted_data['paid']?>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                <h5>Remaining Amount to be Paid</h5> 
                </div>
                <div class="col">
                    <?php echo "<span class='h5'>Rs.</span>".$room_data['fees'] - $room_alloted_data['paid']?>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php
}
else
{?>
    <div class="container text-center mt-5">
        <p class="h2 text-danger"> Room Not yet Assigned to You </p>
        <p> Please Contact Hostel for more Detail </p>
    </div>
<?php
}

