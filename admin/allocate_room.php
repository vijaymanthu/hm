<?php 
include '../includes/db.php';
include './header.php';

function get_student($conn,$id){
    $sql = "SELECT * from users where user_type='user' and id='$id'";
    $res = $conn->query($sql);
    $student = $res->fetch_assoc();
    return $student;
}

function get_room($conn,$id){
    $get_room_num = "SELECT room_no,fees from rooms where id ='$id'";
    $res_get_room_num = $conn->query($get_room_num);
    $r_data = $res_get_room_num->fetch_assoc();
    return $r_data;
}
if(isset($_POST['update_fees'])){
    $id = $_POST['alloc_id'];
    $fees = $_POST['fees_paid'] + $_POST['fee_paid_before'];
    
    if ($fees > $_POST['actual_fees']){
            echo "<script>";
            echo "alert('Given amount exceeds hostel fees');document.location = ''";
            echo "</script>";
    }
    else{ 
    
        $update = "UPDATE `room_allocated` SET paid = '$fees' where id='$id'";
        $res = $conn->query($update);
        if($res){
            echo "<script>";
            echo "document.location = ''";
            echo "</script>";
        }
    }
}

?>
<script>
$(document).ready( function () {
    $('#allocate_room').DataTable();
});
</script>
<div class="container">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-seat-flat menu-icon"></i>
            </span> Allocate Room To Students
        </div>

    <div class="container d-flex">
        <div class="row m-4">
            <form action="" method="post">
                <div class="col">
                    <label for="student_info">Student Email id</label>
                    <input type="email" required name="s_email" id="s_email" class="form-control">
                </div>
                <div class="col">
                    <button name="fetch" class="btn btn-primary mt-4">Fetch Details And Allocate</button>
                </div>
        </div>

        <div class="m-4">
        <label for="roomno">Room Number</label>
        <select required name="roomid" id="roomno" class="form-control">
            <option value="" selected disabled>SELECT</option>
            <?php 
                // $room_sql = "SELECT r.id,r.room_no,(r.seater - filled_bed.filled) as vacancy from (SELECT r.room_no,count(*) as filled FROM `room_allocated` as ra Right Join `rooms` as r ON r.id = ra.room_id group by r.room_no) as filled_bed Right join rooms as r on filled_bed.room_no = r.room_no group by r.room_no;";
               $room_sql = "SELECT * from rooms";
               $bed_vacancy_flag = 0;
                $res = $conn->query($room_sql);
                while($room = $res->fetch_assoc()){
                    $rmno = $room['room_no'];
                    $filled_bedSql = "SELECT filled from `track_bed` where `room_no`='$rmno'";
                    $filledBed = ($conn->query($filled_bedSql))->fetch_assoc()['filled'];
                   if($room['seater'] - $filledBed !=0){ 
                       $bed_vacancy_flag = 1;
                ?>
                <option value="<?php echo $room['id']?>"><h4>Room Number:<?php echo $rmno.",TotalBeds:".$room['seater']." AvilableBeds".$room['seater']-$filledBed?></h4></option>
                <?php
                }
                  
            }
            if(!$bed_vacancy_flag){
            ?>
            <option value="" selected disabled>No Vacancy All Rooms are full</option>
            <?php 
            }
            ?>
        </select>
            </form>
        </div>
        <?php
            if(isset($_POST['fetch'])){

                $s_email = $_POST['s_email'];
                $sql = "SELECT * from users where user_type='user' and email='$s_email'";
                $res = $conn->query($sql);
                if($res->num_rows>0){
                    $student = $res->fetch_assoc();
                    $std_id = $student['id'];

                    $roomid = $_POST['roomid'];
                    $r_data = get_room($conn,$roomid);
                    $room_no = $r_data['room_no'];
                    $room_fees = $r_data['fees'];


                    $alloc_sql = "INSERT INTO `room_allocated`(`student_id`, `room_id`, `room_no`, `paid`, `room_fees`) VALUES('$std_id','$roomid','$room_no',0,'$room_fees')";
                    $alloc_res = $conn->query($alloc_sql);
                    if (!$alloc_res){
                        echo "<script>alert('Already Room is allocated for this Student');document.location=''</script>";
                    }
                    $msg = "";
                    if($alloc_res){
                        $insert_id = $conn->insert_id;
                        $sql3 = "SELECT room_no from `room_allocated` where `id`='$insert_id'";
                        $res3 = $conn->query($sql3);
                        $room_allocated = $res3->fetch_assoc();
                        $alloted_roomNo = $room_allocated['room_no'];
                        $sql4 ="SELECT * FROM `track_bed` where `room_no`='$alloted_roomNo'";
                        $sql5 = "" ;
                        $res4 = $conn->query($sql4);
                        try {
                            if($res4->num_rows > 0){
                                
                                $d = $conn->query($sql4)->fetch_assoc()['filled'];
                                $sql5 = "UPDATE `track_bed` SET `filled` = $d+1 where room_no = '$alloted_roomNo' ";
                            }
                            else if($res4->num_rows == 0){
                                $sql5 = "INSERT INTO `track_bed`(`room_no`, `filled`) VALUES ('$alloted_roomNo','1')";
                            }
                            
                            if($conn->query($sql5))
                                echo "<script>document.location=''</script>";
                        } catch (Exception $e) {
                            echo $conn->mysqli_error();
                        }
                        
                    


                        $msg = "Room Allocation Successfull";
                    }
                }
                else{
                    echo "<p class='text-center text-danger'>User or Student doest not registered</p>";
                }
            }
        ?>
    </div>
    <hr >
    <div class="container">
        <table id="allocate_room" class="table table-responsive">
            <thead class="table-dark">
                <tr>
                    <th>SL.No</th>
                    <th>Student Name</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>College</th>
                    <th>Department</th>
                    <th>Room Number</th>
                    <th>Fees</th>
                    <th>Payment paid</th>
                    <th>Remaining</th>

                </tr>
            </thead>
            <tbody>
                <?php 
                    $sql2 = "SELECT * from room_allocated";
                    $res2 = $conn->query($sql2);
                    if($res2->num_rows > 0){
                        $i=1;
                        while($row = $res2->fetch_assoc())
                        {
                        ?>
                            <tr>
                                <td> <?php echo $i++?></td>
                                <?php 
                                $std = get_student($conn,$row['student_id']);
                                ?>
                                <td><strong><?php echo $std['firstName']." ".$std['lastName']?></strong></td>
                                <td><?php echo $std['email']?></td>
                                <td><?php echo $std['contactNo']?></td>
                                <td><?php echo $std['college_name']?></td>
                                <td><?php echo $std['department']?></td>
                                <?php 
                                $room_info = get_room($conn,$row['room_id']);
                                ?>
                                <td><?php echo $room_info['room_no']?></td>
                                <td>Rs. <?php echo $row['room_fees']?></td>
                                <td>Rs.<?php echo $row['paid']?><a href="#" data-toggle="modal" data-target="#exampleModal<?php echo $i?>"><i style="margin-left:30px;" class="mdi mdi-grease-pencil h4" title="Update Fees"></i></a></td>
                                <td>Rs. <?php echo $row['room_fees']-$row['paid']?></td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal<?php echo $i?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content bg-danger" >
                                <form action="#" method="post" onsubmit="return validateFees(this)">
                                    <div class="modal-header">
                                        <h3 class="modal-title text-light" id="exampleModalLabel">Update Payment</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body p-3">
                                        <div class="form-group">
                                            <label class="form-label"><h3>Name</h3></label>
                                            <div class="col"><?php echo $std['firstName']." ".$std['lastName']?></div>
                                        </div>
                                        <p id="FeesError" class="text-light"></p>
                                        <div class="form-group">
                                            <label for="fees_paid" ><h3>Fees</h3></label>
                                            <input type="hidden" name="fee_paid_before" value="<?php echo $row['paid']?>">
                                            <input type="number" name="fees_paid" id="fees_paid" class="form-control" >
                                            <input type="hidden" name="alloc_id" value="<?php echo $row['id']?>">
                                            <input type="hidden" name="actual_fees" id="actual_fees" value="<?php echo $row['room_fees']?>" >                                        </div>
                                        

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button class="btn btn-primary"  id="update_fees" name="update_fees" >Update</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
                            <?php
                            }
                        }
                    ?>
                    
                </tbody>
            </table>
        </div>
    </div>
    </div>
                    </div>
                 
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  <script>
      $('#fees_paid').keyup(function(){
         
        var actual_amount =  $('#actual_fees').val();
        var paid = $('#fees_paid').val();
        console.log(actual_amount);
        
        if(parseInt(paid) > parseInt(actual_amount)){
            $('#update_fees').prop("disabled",true);
            $("#FeesError").text("**Value should be less than or Equal to Actual Room Fees");
        }
        else{
            $('#update_fees').prop("disabled",false);
            $("#FeesError").text("");
        }

      })
</script>