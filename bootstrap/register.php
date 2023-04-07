<?php 
$page_title = "Register Page";
include 'includes/config.php';
include 'includes/header.php';



    if(isset($_POST['submit'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $pass = mysqli_real_escape_string($conn, md5($_POST['pass']));
        $cpass = mysqli_real_escape_string($conn, md5($_POST['cpass']));

        $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('connection failed');

        if(mysqli_num_rows($select) > 0 ){
            $message[] = 'email already exist';
        }else{
            if($pass != $cpass){
                $message[] = 'confirm password not matched';
            }else{
                $insert = mysqli_query($conn, "INSERT INTO `user_form`(name,phone,email,password) VALUES ('$name', '$phone', '$email', '$pass') ") or die ('query failed');

                if($insert){
                    $message[] = 'Registered successfully';
                    header('Location:login.php');
                }else{
                    $message[] = 'Register Not Successfully';
                }
            }
        }

    }

?>


<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="text-center">Registration Form</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype = "multipart-form-data">
                            <?php
                                if(isset($message)){
                                    foreach($message as $message){
                                        echo '<div class="message">'.$message.'</div>';
                                }
                                }
                            ?>
                            <div class="form-group mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Phone Number</label>
                                <input type="text" name="phone" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Email Address</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Password</label>
                                <input type="password" name="pass" class="form-control">
                            </div>
                           <div class="form-group mb-3">
                                <label for="">Confirm Password</label>
                                <input type="password" name="cpass" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-primary">Register Now</button>
                            </div>
                            <div class="form-group">
                                <p>Have an account? <a href="login.php">Login Now</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>