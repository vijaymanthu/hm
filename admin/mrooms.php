<?php 
include '../includes/db.php';
include './header.php';
if(isset($_GET['del']))
{
	$id=intval($_GET['del']);
	$adn="DELETE from rooms where id='$id'";
		$stmt= $conn->query($adn);
        if($stmt){
            echo "<script>alert('Data Deleted');" ;
            echo "document.location = './mrooms.php';";
            echo "</script>";
        }
}
if(isset($_POST['add_room']))
{
    $seater=$_POST['seater'];
    $roomno=$_POST['rmno'];
    $fees=$_POST['fee'];

    $sql="SELECT room_no FROM rooms where room_no='$roomno'";
    $stmt1 = $conn->query($sql);
    $row_cnt=$stmt1->num_rows;
    if($row_cnt>0)
    {
        echo"<script>alert('Room alreadt exist');</script>";
    }
    else
    {
        $query="insert into  rooms (seater,room_no,fees) values('$seater','$roomno','$fees')";
        $stmt = $conn->query($query);
        if($stmt){
        echo"<script>alert('Room has been added successfully')";
        echo "document.location = './mrooms.php'";
        echo "</script>";
        }
    }
}
if(isset($_POST['update_room']))
{
    $seater=$_POST['seater'];
    $roomno=$_POST['rmno'];
    $fees=$_POST['fee'];
    $id = $_POST['edit_id'];
    $sql = "UPDATE rooms Set seater = '$seater',room_no='$roomno',fees='$fees'where id='$id'";
    $res = $conn->query($sql);
    if($res)
    {
        echo"<script>alert('Room Details has been Updated successfully');";
        echo "document.location = './mrooms.php';";
        echo "</script>";
    }
    else{
        echo $conn->error;
    }
}
$edit_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg>';
$delete_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
<path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
</svg>';
?>
<script>
$(document).ready( function () {
    $('#manageroom').DataTable();
});
</script>
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-primary text-white mr-2">
      <i class="mdi mdi-seat-flat menu-icon"></i>
      </span> Manage Room
  </div>
  <div class="">
      <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary p-0 m-3 col-2 rounded " data-toggle="modal" data-target="#exampleModal">
        <span class="h3">+</span>Add Rooms
        </button>
      <table id="manageroom" class="table">
            <thead class="table-dark">
                <tr>
                <th>Sno.</th>
                <th>Seater</th>
                <th>Room No.</th>
                <th>Fees (PM) </th>
                <th>Posting Date  </th>
                <th>Action</th>
              </tr>
          </thead>
          <tbody>
              <?php 
                $sql = "SELECT * FROM `rooms`";
                $res = $conn->query($sql);
                if($res->num_rows > 0){
                    $i=1;
                    while($row = $res->fetch_assoc()){
                        ?>
                        <tr><td><?php echo $i++;?></td>
                        <td><?php echo $row['seater'];?></td>
                        <td><?php echo $row['room_no'];?></td>
                        <td><?php echo $row['fees'];?></td>
                        <td><?php echo $row['posting_date'];?></td>
                        <td><a href="" data-toggle="modal" data-target="#exampleModal<?php echo $i?>"><?php echo $edit_icon ?></a>&nbsp;&nbsp;
                        <a class="text-danger" href="mrooms.php?del=<?php echo $row['id'];?>" onclick="return confirm('Do you want to delete');"><?php echo $delete_icon ?></a></td>
						</tr>
                        <div class="modal fade" id="exampleModal<?php echo $i?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Rooms</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="" method="post">
                                <div class="modal-body">
                                            <div class="hr-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm control-label">Select Seater  </label>
                                                <div class="col-sm-8">
                                                    <Select name="seater" class="form-control" required>
                                                        <option value="<?php echo $row['seater']?>"><?php echo $row['seater']?></option>
                                                        <option value="1">Single Seater</option>
                                                        <option value="2">Two Seater</option>
                                                        <option value="3">Three Seater</option>
                                                        <option value="4">Four Seater</option>
                                                        <option value="5">Five Seater</option>
                                                    </Select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm control-label">Room No.</label>
                                                <div class="col-sm-8">
                                                    <input type="text" value="<?php echo $row['room_no']?>" class="form-control" name="rmno" id="rmno" value="" required="required">
                                                </div>
                                            </div>
                                            <input type="text" hidden name="edit_id" value="<?php echo $row['id'] ?>" />
                                            <div class="form-group">
                                                <label class="col-sm control-label">Fee(Per user)</label>
                                                    <div class="col-sm-8">
                                                    <input type="text" class="form-control" value="<?php echo $row['fees']?>" name="fee" id="fee" value="" required="required">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="update_room" class="btn btn-primary">Update Room</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    <?php    
                    }
                }
                else
                {
                    echo "<td colspan='6'>No Record Found</td>";
                }
              ?>
          </tbody>
      </table>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADD Rooms</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
      <div class="modal-body">
                <div class="hr-dashed"></div>
                <div class="form-group">
                    <label class="col-sm control-label">Select Seater  </label>
                    <div class="col-sm-8">
                        <Select name="seater" class="form-control" required>
                            <option value="">Select Seater</option>
                            <option value="1">Single Seater</option>
                            <option value="2">Two Seater</option>
                            <option value="3">Three Seater</option>
                            <option value="4">Four Seater</option>
                            <option value="5">Five Seater</option>
                        </Select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm control-label">Room No.</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="rmno" id="rmno" value="" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm control-label">Fee(Per user)</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" name="fee" id="fee" value="" required="required">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="add_room" class="btn btn-primary">Add Room</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  