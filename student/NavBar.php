<?php 
if(!isset($_SESSION['user'])|| $_SESSION['user']['user_type'] != 'user')
header('location:../signout.php');
?>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse d-lg-flex justify-content-between" id="navbarSupportedContent">
      <!-- Navbar brand -->
      <a class="navbar-brand mt-2 mt-lg-0" href="#">
        <p class="h4 brand-text text-warning"><?php echo $_SESSION['user']['firstName']." ". $_SESSION['user']['lastName'] ?> </p> </a>
      <div class="d-lg-flex text-light">
      <a class="nav-link text-light" href="./foodMenu.php"><span class="nav-text"><i class="fas fa-utensils m-2 bg-success text-light p-1 rounded-circle"></i>Food Menu</span></a>
       <a class="nav-link text-light" href="./alloteRoom.php"><span class="nav-text"><i class="fas fa-bed m-2 bg-success text-light p-1 rounded-circle"></i>Room details</span></a>
       <a class="nav-link text-light" href="./profile.php"><span class="nav-text"><i class="fas fa-user m-2 bg-success text-light p-1 rounded-circle"></i>My Profile</span></a>
        <a class="nav-link text-light" href="../signout.php"><span class="nav-text"><i class="fas fa-sign-out-alt m-2 bg-danger p-1 rounded-circle"></i>Logout</span></a>
     
      <div>
    </div>
    <!-- Collapsible wrapper -->
    
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->
