<?php
include './header.php';
require_once './Navbar.php';
require_once './includes/db.php';


if(isset($_POST['register'])){
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $college = $_POST['college'];
    $department = $_POST['department'];
    $paddress = $_POST['paddress'];

    $sql = "INSERT INTO `users`(`firstName`, `lastName`, `gender`, `contactNo`, `email`, `password`, `user_type`, `college_name`, `department`,`paddress`) VALUES ('$fname','$lname','$gender','$mobile','$email','$password','user','$college','$department','$paddress')";
    $res =$conn->query($sql);
    if($res){
        ?>
        <script>
            alert('Registration Success ,Please Login');
            document.location = './login.php';
        </script>

        <?php
    }
}
?>

<div class="container mt-5 rounded mb-2" style="max-width:800px;background-color:rgb(237, 234, 232,0.7)">
    <div class=" p-3">
        <div class="car-title">
            <h3 class="text-center text-dark"><i class="fas fa-user-plus"></i>Register</h3>
        </div>
        <form action="" method="post" class="form">
            <div class="row mt-3">
                <div class="col-sm">
                    <label for="first_name"class="form-label">First Name</label>
                    <input type="text" name="first_name" placeholder="First Name" id="first_name" class="form-control">
                </div>
                <div class="col-sm">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" name="last_name"placeholder="Last Name" id="last_name" class="form-control">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm">
                    <label for="mobile"class="form-label">Mobile Number</label>
                    <input type="Number" name="mobile" placeholder="Mobile Number" id="mobile" class="form-control">
                </div>
                <div class="col-sm">
                    <label for="paddress" class="form-label">Permanent Address</label>
                    <textarea name="paddress" id="paddress" class="form-control"></textarea>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm">
                    <label for="email"class="form-label">Email</label>
                    <input type="email" name="email" placeholder="Mail Id" id="email" class="form-control">
                </div>
                <div class="col-sm">
                    <label for="college" class="form-label">College</label>
                    <select name="college" class="form-control"onChange="other_college_box()" required id="college">
                        <option value="" selected>SELECT Collage</option>
                        <option value="Kls Gogte Institute of Technology,Belgaum">KLS Gogte Institute of Technology,Belgaum</option>
                        <!-- <option value="others">Others</option> -->
                    </select>
                    <!-- <input type="text" class="form-control" placeholder="Enter Your college Name" style="display:none" name="other_college" id="other_college" > -->
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm">
                    <label for="department"class="form-label">Department</label>
                    <input type="text" name="department"  id="department" class="form-control">
                </div>
                <div class="col-sm">
                    <div class="form-check">
                        <label class="form-check-label" for="male"class="form-label">Male</label>
                        <input class="form-check-input" type="radio" name="gender" id="male" class="radio" value="male" >    
                    </div> 
                    <div class="form-check">
                        <label class="form-check-label" for="female"class="form-label">Female</label>
                        <input class="form-check-input" type="radio" name="gender" id="female" class="radio" value="female" >
                    </div> 
                    <div class="form-check">
                        <label class="form-check-label" for="others"class="form-label">Others</label>
                        <input class="form-check-input" type="radio" name="gender" id="others" class="radio" value="others" >    
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm">
                    <label for="password"class="form-label">Password <span title = "Password must be contain : lowercase&#10UpperCase,&#10 Atleast 1 Number,&#10Minimum 8Character " onmouseover="Passwordinfo(this)"><i class="fas fa-info"></i></span></label>
                    <input type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Password" id="password" class="form-control">
                </div>
                <div class="col-sm">
                    <label for="cpassword"class="form-label">Confirm Password </label>
                    <input type="password" name="cpassword" onchange="CheckPassword()" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Confirm Password" id="cpassword" class="form-control">
                    <p id="pass_text" class="text-danger"></p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col"></div>
                    <button name="register" class="btn btn-warning mt-3 col-lg-3">Register</button>
            </div>
        </form>
    </div>
</div>

<script>
// function other_college_box() {
//     var college = document.getElementById('college').value
//   var x = document.getElementById("other_college");
//   if (college === "others") {
//     x.style.display = "block";
//   } else {
//     x.style.display = "none";
//   }
// }
function CheckPassword(){
    var pass = document.getElementById('password').value;
    var cpass=document.getElementById('cpassword').value;
    var text = document.getElementById('pass_text');
    if(pass !== cpass){
        text.innerHTML = '** Password not Matched';
    }
    else{
        text.innerHTML = '';
    }

}
function Passwordinfo(x){
    x.title.show
}
</script>