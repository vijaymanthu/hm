<?php
$edit_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg>';
$delete_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
<path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
</svg>';

include '../includes/db.php';
include './header.php';
if(isset($_GET['del']))
{
	$id=intval($_GET['del']);
	$adn="DELETE from foodmenu where id='$id'";
		$stmt= $conn->query($adn);
        if($stmt){
            echo "<script>alert('Data Deleted');" ;
            echo "document.location = './mfood.php';";
            echo "</script>";
        }
}


if(isset($_POST['add_food']))
{
    $Day=$_POST['day'];
    $item1=$_POST['itm1'];
    $item2=$_POST['itm2'];
    $item3=$_POST['itm3'];
    $item4=$_POST['itm4'];
    $item5=$_POST['itm5'];

    $query="insert into foodmenu(day,it1,it2,it3,it4,it5) values('$Day','$item1','$item2','$item3','$item4','$item5')";

    $stmt = $conn->query($query);
    if($stmt){
        echo "<script>alert('Food Item Added');" ;
        echo "document.location = './mfood.php';";
        echo "</script>";
    }
}

if(isset($_POST['update_food']))
{
$Day=$_POST['day'];
$item1=$_POST['itm1'];
$item2=$_POST['itm2'];
$item3=$_POST['itm3'];
$item4=$_POST['itm4'];
$item5=$_POST['itm5'];
$id= $_POST['edit_id'];

$sql = "UPDATE foodmenu SET `day` = '$Day',`it1` = '$item1',`it2`= '$item2',`it3`='$item3',`it4`='$item4',`it5`='$item5' where `id` = '$id'";
$stmt = $conn->query($sql);
if($stmt){
    echo "<script>alert('Food Item Updated');" ;
    echo "document.location = './mfood.php';";
    echo "</script>";
}
}
?>

<script>
$(document).ready( function () {
    $('#managefood').DataTable();
});
</script>
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-primary text-white mr-2">
      <i class="mdi mdi-food menu-icon"></i>
      </span> Manage Food
  </div>
  <div class="">
      <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary p-0 m-3 col-2 rounded " data-toggle="modal" data-target="#exampleModal">
        <span class="h3">+</span>Add Food-Items
        </button>
      <table id="managefood" class="table">
            <thead class="table-dark">
            <tr>
                <th>Sno.</th>
                <th>Day</th>
                <th>Item No-1</th>
                <th>Item No-2</th>
                <th>Item No-3</th>
                <th>Item No-4</th>
                <th>Item No-5</th>
                <th>Action</th>
            </tr>
          </thead>
          <tbody>
              <?php 
                $sql = "SELECT * FROM `foodmenu`";
                $res = $conn->query($sql);
                if($res->num_rows > 0){
                    $i=1;
                    while($row = $res->fetch_assoc()){
                        ?>
                        <tr><td><?php echo $i++;?></td>
                        <td><?php echo $row['day'];?></td>
                        <td><?php echo $row['it1'];?></td>
                        <td><?php echo $row['it2'];?></td>
                        <td><?php echo $row['it3'];?></td>
                        <td><?php echo $row['it4'];?></td>
                        <td><?php echo $row['it5'];?></td>
                        <td><a href="" data-toggle="modal" data-target="#exampleModal<?php echo $i?>"><?php echo $edit_icon ?></a>&nbsp;&nbsp;
                       <a class="text-danger" href="mfood.php?del=<?php echo $row['id'];?>" onclick="return confirm('Do you want to delete');"><?php echo $delete_icon ?></a></td>
						</tr>

                        <div class="modal fade" id="exampleModal<?php echo $i?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Food-items</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="" method="post">
                                        <div class="modal-body">
                                            <div class="hr-dashed"></div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Select Day  </label>
												<div class="col-sm-8">
                                                    <Select name="day" class="form-control" required>
                                                        <option value="<?php echo $row['day'];?>"><?php echo $row['day'];?></option>
                                                        <option value="1">1st Day</option>
                                                        <option value="2">2nd Day</option>
                                                        <option value="3">3rd Day</option>
                                                        <option value="4">4th Day</option>
                                                        <option value="5">5th Day</option>
                                                        <option value="6">6th Day</option>
                                                        <option value="7">7th Day</option>
                                                    </Select>
                                                </div>
                                            </div>
                                            <input type="text" name="edit_id" hidden value="<?php echo $row['id'] ?>" />
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Item No-1</label>
                                                <div class="col-sm-8">
                                                <input type="text" value="<?php echo $row['it1'];?>" class="form-control" name="itm1" id="itm1"  required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Item No-2</label>
                                                <div class="col-sm-8">
                                                    <input type="text"  class="form-control" value="<?php echo $row['it2'];?>" name="itm2" id="itm2" required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Item No-3</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="itm3" id="itm3" value="<?php echo $row['it3'];?>" required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Item No-4</label>
                                                <div class="col-sm-8">
                                                    <input type="text"  class="form-control" name="itm4" id="itm4" value="<?php echo $row['it4'];?>" required="required">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Item No-5</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="itm5" id="itm5" value="<?php echo $row['it5'];?>" required="required">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="update_food" class="btn btn-primary">Update Food Items</button>
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



    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Food-items</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="" method="post">
                                        <div class="modal-body">
                                            <div class="hr-dashed"></div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Select Day  </label>
												<div class="col-sm-8">
                                                    <Select name="day" class="form-control" required>
                                                        <option value="">SELECT</option>
                                                        <option value="Monday">1st Day</option>
                                                        <option value="Tuesday">2nd Day</option>
                                                        <option value="Wednesday">3rd Day</option>
                                                        <option value="Thursday">4th Day</option>
                                                        <option value="Friday">5th Day</option>
                                                        <option value="Saturday">6th Day</option>
                                                        <option value="Sunday">7th Day</option>
                                                    </Select>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Item No-1</label>
                                                <div class="col-sm-8">
                                                <input type="text"  class="form-control" name="itm1" id="itm1" value="" required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Item No-2</label>
                                                <div class="col-sm-8">
                                                    <input type="text"  class="form-control" name="itm2" id="itm2" value="" required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Item No-3</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="itm3" id="itm3" value="" required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Item No-4</label>
                                                <div class="col-sm-8">
                                                    <input type="text"  class="form-control" name="itm4" id="itm4" value="" required="required">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Item No-5</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="itm5" id="itm5" value="" required="required">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="add_food" class="btn btn-primary">Add Food Items</button>
                                        </div>
									</form>
                                </div>
                            </div>
                        </div>

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  