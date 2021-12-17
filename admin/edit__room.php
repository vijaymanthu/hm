<?php
session_start();
include '../includes/db.php';
include './header.php';
?>
	<div class="ts-main-content">
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title">Edit Room Details </h2>
	
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-body">
										<form method="post" class="form-horizontal">
												<?php	
												$id=$_GET['id'];
	                                            $ret="select * from rooms where id='$id'";
                                                $stmt= $mysqli->prepare($ret) ;
                                                
                                            //$cnt=1;
                                            while($row=$res->fetch_assoc())
                                            {
                                                ?>
						<div class="hr-dashed"></div>
						<div class="form-group">
						        <label class="col-sm-2 control-label">Seater  </label>
                            <div class="col-sm-8">
                                <input type="text"  name="seater" value="<?php echo $row['seater'];?>"  class="form-control"> </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Room no </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="rmno" id="rmno" value="<?php echo $row['room_no'];?>" disabled>
                                    <span class="help-block m-b-none">Room no can't be changed.</span>
                                </div>
                            </div>
                                <div class="form-group">
									<label class="col-sm-2 control-label">Fees (PM) </label>
									<div class="col-sm-8">
									    <input type="text" class="form-control" name="fees" value="<?php echo $row['fees'];?>" >
									</div>
								</div>


                                <?php } ?>
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <input class="btn btn-primary" type="submit" name="submit" value="Update Room Details">
                                    </div>
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

    <?php include 'footer.php'?>