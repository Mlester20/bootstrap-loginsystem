<?php
include 'includes/header.php';
include 'includes/config.php';
session_start();

    if(isset($_POST['submit'])){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = mysqli_real_escape_string($conn, md5($_POST['pass']));

        $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die ('connection failed');

        if(mysqli_num_rows($select) > 0 ){
            $row = mysqli_fetch_assoc($select);
            $_SESSION['user_id'] = $row['id'];
            header('location:index.php');
        }else{
            $message[] = 'incorrect email or password';
        }

    }

?>


<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="text-center">Login Form</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                        <?php
                                if(isset($message)){
                                    foreach($message as $message){
                                        echo '<div class="message">'.$message.'</div>';
                                }
                                }
                            ?>
                            <div class="form-group mb-3">
                                <label for="">Email Address</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Password</label>
                                <input type="password" name="pass" class="form-control">
                            </div>
                           
                            <div class="form-group">
                                <button type="submit"  name="submit" class="btn btn-primary">Login Now</button>
                            </div>
                            <div class="form-group">
                                <p>Don't have an account? <a href="register.php">Register Now</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>