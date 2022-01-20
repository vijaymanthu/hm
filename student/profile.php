<?php 
 include './header.php';
 ?>
 <style>
     .row{
         margin-top : '10px';
     }
 </style>
 <?php
 require './Navbar.php';
include '../includes/db.php';

 if(isset($_POST['changepwd']))
{
    $email = $_SESSION['user']['email'];
    $op=$_POST['oldpassword'];
    $np=$_POST['newpassword'];
    $ai=$_SESSION['user']['id'];
	$sql="SELECT `password` FROM `users` where `email`='$email'";
	$chngpwd = $conn->query($sql);
    $row_cnt=$chngpwd->num_rows;;
	if($row_cnt>0)
	{
        if($op == $chngpwd->fetch_assoc()['password']){
            $upsql="UPDATE `users` set `password`='$np' where id='$ai'";
            $chngpwd1 = $conn->query($upsql);
            if($chngpwd1)
                $_SESSION['msg']="Password Changed Successfully !!";
        }
        else
	{
		$_SESSION['msg']="Old Password not match !!";
	}	
	}
	

}
?>
<script>
    function valid(){
        if(document.changepwd.newpassword.value!= document.changepwd.cpassword.value)
            {
                alert("Password and Re-Type Password Field do not match  !!");
                document.changepwd.cpassword.focus();
                return false;
            }
        return true;
        }
</script>
<div class="container d-lg-flex mt-5 rounded" style="background-color:rgb(110, 90, 90,0.1)">
    <div class="container card m-3 shadow">
        <div class="card-title text-center h4 p-3"><i class="fas fa-user-circle text-primary"></i> Profile Info</div>
        <div class="card-body">
            <div class="row mt-3">
                <div class="col">
                    <h6>Name</h6>
                </div>
                <?php	
                    $aid=$_SESSION['user']['id'];
                    $ret="select * from users where id='$aid'";
                    $res=$conn->query($ret);
                    $user_data = $res->fetch_assoc();
                ?>
                            
                <div class="col">
                    <?php echo $user_data['firstName']." ".$user_data['lastName'] ?>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <h6>Email</h6>
                </div>	
                <div class="col">
                    <?php echo $user_data['email']; ?>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <h6>Mobile Number</h6>
                </div>	
                <div class="col">
                    <?php echo $user_data['contactNo']; ?>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <h6>College</h6>
                </div>	
                <div class="col">
                    <?php echo $user_data['college_name']; ?>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <h6>Address</h6>
                </div>	
                <div class="col">
                    <?php echo $user_data['paddress']; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container card p-5 m-3 shadow">
       <div class="card-title h4">Change Password</div>
        <div class="card-body">
        <form method="post" class="form-horizontal" name="changepwd" id="change-pwd" onSubmit="return valid();">

<?php if(isset($_POST['changepwd']))
{ ?>

                                           <p style="color: red"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg']=""); ?></p>
                                           <?php } ?>
                                           <div class="hr-dashed"></div>
                                           <div class="form-group">
                                               <label class="col-sm-4 control-label">old Password </label>
                                               <div class="col-sm-8">
                                   <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title = "Password must be contain : lowercase&#10UpperCase,&#10 Atleast 1 Number,&#10Minimum 8Character"value="" name="oldpassword" id="oldpassword" class="form-control" onBlur="checkpass()" required="required">
                                    <span id="password-availability-status" class="help-block m-b-none" style="font-size:12px;"></span> </div>
                                           </div>
                                           <div class="form-group">
                                               <label class="col-sm-4 control-label">New Password</label>
                                               <div class="col-sm-8">
                                           <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title = "Password must be contain : lowercase&#10UpperCase,&#10 Atleast 1 Number,&#10Minimum 8Character" class="form-control" name="newpassword" id="newpassword" value="" required="required">
                                               </div>
                                           </div>
                               <div class="form-group">
                                   <label class="col-sm-4 control-label">Confirm Password</label>
                                   <div class="col-sm-8">
                                   <input type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title = "Password must be contain : lowercase&#10UpperCase,&#10 Atleast 1 Number,&#10Minimum 8Character" value="" required="required" id="cpassword" name="cpassword" >
                                               </div>
                                           </div>
                                               <div class="col-sm-6 col-sm-offset-4 d-flex">
                                                   <input type="submit" name="changepwd" Value="Change Password" class="btn btn-primary m-3">
                                                   <input type="reset" class="btn btn-light m-2"></button>
                                           </div>
                                       </form>
        </div>

    </div>
</div>
<script>
    function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#emailid").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
<script>
function checkpass() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'oldpassword='+$("#oldpassword").val(),
type: "POST",
success:function(data){
$("#password-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>