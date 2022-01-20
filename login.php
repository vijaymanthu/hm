<?php
include './header.php';
require_once './Navbar.php';
require_once './includes/db.php';


// login code
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $sql = "SELECT `id`,`email`,`user_type`,`firstName`,`lastName` FROM `users` where `email` = '$email' and `password` = '$password'";
    $res = $conn->query($sql);
    
    if(($res->num_rows) > 0){
        
        $data = $res->fetch_assoc();
        $_SESSION['user'] = $data;
        echo "<script>alert('Login success');";
        if($data['user_type'] == 'admin'){
            echo "document.location = './admin'";
        }
        else{
            echo "document.location = './student/foodMenu.php'";
        }
        echo "</script>";
    
    }
    else{
        ?>
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'UserName or Password Might be wrong!',
            
        })
        </script>
        <?php
        // echo "<script>alert('UserName or Password might be Wrong');";
        // echo "document.location = ''";
        // echo "</script>";
    }
}
?>
<div class="d-lg-flex justify-content-center shadow border p-3 rounded" style="margin:8rem;
  background-color:rgb(140, 138, 137,0.5)">
    <div class="d-lg-flex">
    <div class="w-75">
        <img class="img-fluid"  src="./assets/img/Home_Banner.jpg">
    </div>
    <form action="" method="post">
    <div class="container-fluid">
       <h3 class="text-center mb-4"><i class="fab fa-centercode"></i>Login</h3>
       <div class=" mt-3">
       <label for="email" class="form-label">Email</label>
           <input type="email" name="email" id="email" class="form-control" >
       </div>
       <div class=" mt-3">
           <label for="password" class="form-label">Password</label>
           <input type="password" name="password" id="password" class="form-control password" />
       </div>  
    </div>
    <button name="login" class="btn btn-primary mt-5 float-lg-end">Login</button>
       <p><a href="forget-password.php" style="font-size:12px" class="float-lg-end nav-link">Forget password?</a><p>
    </form>
    </div>
</div>