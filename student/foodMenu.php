<?php
include './header.php';
require_once './Navbar.php';
require '../includes/db.php';
$sid = $_SESSION['user']['id'];
$sql = "SELECT * from room_allocated where student_id = '$sid'";
$res = $conn->query($sql);
if($res->num_rows > 0)
{
?>
<div class="container-fluid mt-5">
    <div class="card shadows">
        <div class="card-title text-center h4 p-3">
            <i class="fas fa-utensils"></i> Food Menus
        </div>
        <div class="card-body table-responsive">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>SlNo</th>
                        <th>Day</th>
                        <th>Item1</th>
                        <th>Item2</th>
                        <th>Item3</th>
                        <th>Item4</th>
                        <th>Item5</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $sql="SELECT * From foodmenu";
                        $res = $conn->query($sql);
                        if($res->num_rows > 0){
                            $i=1;
                            while($foodmenu = $res->fetch_assoc()){
                            
                        ?>
                        <tr>
                            <td><?php echo $i++?></td>
                            <td><h6><?php echo $foodmenu['day']?></h6></td>
                            <td><?php echo $foodmenu['it1']?></td>
                            <td><?php echo $foodmenu['it2']?></td>
                            <td><?php echo $foodmenu['it3']?></td>
                            <td><?php echo $foodmenu['it4']?></td>
                            <td><?php echo $foodmenu['it5']?></td>


                        </tr>
                        <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
}
else
{?>
    <div class="container text-center mt-5">
        <p class="h2 text-danger"> Room Not yet Assigned to You </p>
        <p>You will get Food menu once your Room Allocated to you</p>
        <p> Please Contact Hostel for more Details </p>
    </div>
<?php
}