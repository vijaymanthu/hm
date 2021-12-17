<!DOCTYPE html>
<?php
 include 'header.php';
  include '../includes/db.php';

?>


<div class="content-wrapper">
  
  <div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-home"></i>
      </span> Dashboard
    </h3>
  </div>
	<div class="ts-main-content">
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3">
										<div class="card bg-info text-light">
												<div class="card-body text-center">
                            <?php
                            $result ="SELECT count(*) as c FROM users ";
                            $stmt = $conn->query($result);
                            $count = $stmt->fetch_assoc()['c'];
                            ?>

													<div class="h1"><?php echo $count-1;?></div>
													<div class="stat-panel-title text-uppercase">USERS </div>
												</div>
											<a href="manage-students.php" class="card-footer bg-light text-center nav-link">Full Detail <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<div class="col-md-3">
                  <div class="card bg-success text-light">
												<div class="card-body text-center">
                            <?php
                            $result1 ="SELECT count(*) as c FROM rooms ";
                            $stmt1 = $conn->query($result1);
                            $TotalRoom1 = $stmt1->fetch_assoc()['c'];
                            ?>
													<div class="stat-panel-number h1 "><?php echo $TotalRoom1;?></div>
													<div class="stat-panel-title text-uppercase">Total Rooms </div>
												</div>
											<a href="manage-rooms.php" class="card-footer bg-light text-center nav-link">See All &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>

									<div class="col-md-3">
									<div class="card bg-primary text-light">
												<div class="card-body text-center">
                              <?php
                              $result1 ="SELECT count(*) as c FROM foodmenu";
                              $stmt1 = $conn->query($result1);
                              $foodmenu = $stmt1->fetch_assoc()['c'];
                              ?>
													<div class="stat-panel-number h1 "><?php echo $foodmenu;?></div>
													<div class="stat-panel-title text-uppercase">Food Menu </div>
												</div>
											<a href="cfood.php" class="card-footer bg-light text-center nav-link">See All &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>

									<div class="col-md-3">
                    <div class="card bg-danger text-light">
												<div class="card-body text-center">
                            <?php
                            $result1 ="SELECT count(*) as c FROM Dining ";
                            $stmt1 = $conn->query($result1);
                            $dinning = $stmt1->fetch_assoc()['c'];
                            ?>
													<div class="stat-panel-number h1 "><?php echo $dinning;?></div>
													<div class="stat-panel-title text-uppercase">Dining </div>
												</div>
											<a href="Adining.php" class="card-footer bg-light text-center nav-link">See All &nbsp; <i class="fa fa-arrow-right"></i></a>
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
<script>

	window.onload = function(){

		// Line chart from swirlData for dashReport
		var ctx = document.getElementById("dashReport").getContext("2d");
		window.myLine = new Chart(ctx).Line(swirlData, {
			responsive: true,
			scaleShowVerticalLines: false,
			scaleBeginAtZero : true,
			multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
		});

		// Pie Chart from doughutData
		var doctx = document.getElementById("chart-area3").getContext("2d");
		window.myDoughnut = new Chart(doctx).Pie(doughnutData, {responsive : true});

		// Dougnut Chart from doughnutData
		var doctx = document.getElementById("chart-area4").getContext("2d");
		window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {responsive : true});

	}
	</script>





<style> .foot{text-align: center; border: 1px solid black;}</style>



</div>
          <!-- content-wrapper ends -->
<?php
include 'footer.php'?>