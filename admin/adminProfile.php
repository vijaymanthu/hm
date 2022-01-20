<?php
include('../includes/db.php');
 include('./header.php');
//code for update email id
if(isset($_POST['update']))
{
    $email=$_POST['emailid'];
    $aid=$_SESSION['user']['id'];
    $query="update users set email='$email' where id='$aid'";
    $res = $conn->query($query);
    if($res)
    echo"<script>alert('Email id has been successfully updated');</script>";
}
// code for change password
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
	<div class="ts-main-content">
		<div class="content-wrapper">
        <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-camera"></i>
                </span> Admin Profile
              </h3>
            </div>
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
                        <?php	
                            $aid=$_SESSION['user']['id'];
                            $ret="select * from users where id='$aid'";
                            $res=$conn->query($ret);
                        //$cnt=1;
                        while($row=$res->fetch_assoc())
                        {
                            ?>
						<div class="row">
							<div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-body">
										<form method="post" class="form-horizontal">
											
											<div class="hr-dashed"></div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Name </label>
												<div class="col-sm-10">
													<input type="text" value="<?php echo $row['firstName']." ".$row['lastName'];?>" disabled class="form-control"><span class="help-block m-b-none">
													Name can't be changed.</span> </div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Email</label>
												<div class="col-sm-10">
	                                                <input type="email" class="form-control" name="emailid" id="emailid" value="<?php echo $row['email'];?>" required="required">
						 
												</div>
											</div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Reg Date</label>
                                                <div class="col-sm-10">
                                                     <input type="text" class="form-control" value="<?php echo $row['regDate'];?>" disabled>
												</div>
											</div>
												<div class="col-sm-8 col-sm-offset-2">
													<button class="btn btn-default" type="submit">Cancel</button>
													<input class="btn btn-primary" type="submit" name="update" value="Update Profile">
												</div>
											</div>

										</form>

									</div>
								</div>
									<?php }  ?>
								<div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-heading">Change Password</div>
									<div class="panel-body">
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
												<div class="col-sm-6 col-sm-offset-4">
													<button class="btn btn-default" type="submit">Cancel</button>
													<input type="submit" name="changepwd" Value="Change Password" class="btn btn-primary">
											</div>

										</form>

									</div>
								</div>
							</div>
							</div>
						
									
							

							</div>
						</div>

					</div>
				</div> 	
				

			</div>
		</div>
	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
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
</body>

</html>