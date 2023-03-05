<?php 

    require 'header.php';
    require 'connection.php';

session_start();

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query the database for the registration_table with the provided email address
    $stmt = $connection->prepare("SELECT * FROM registration_table WHERE email=:email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    // If the registration_table with the provided email address is found, check the password
    if ($user && password_verify($password, $user['password'])) {
        // Password is correct, set session variables and redirect to homepage
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        header('Location: profile.php');
        exit;
    } else {
        // Password is incorrect, display error message
        echo "Invalid email or password";
    }
}

?>
    <body>
    <div class="container  mt-5 p-3  ">
        <div class="row justify-content-center ">
            <div class="col-sm-6">
                <img src="images/login.png" alt="">
            </div>
            <div class="col-sm-6 p-5">
                <h2 class="text-center mb-5">LOGIN</h2>
                <form action="" method="POST">
                    <div class=" my-3">
                        <input type="email" class="form-control p-3" name="email" placeholder="Email" required>
                    </div>
                    <div class=" mb-3">
                        <input type="password" class="form-control  p-3" name="password" placeholder="Password" required>
                    </div>
                    <div class="d-grid gap-2">
                        <input type='submit' class="btn btn-primary p-3" value="Login"  name='submit'>
                        <a href="register.php" class="btn btn-info p-3" >Create new Account</a>

                    </div>  
                </form>  
                    
                <div class=" mb-3">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn border-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Forgot Password?
                    </button>
                </div>
                 <!-- Modal -->
            <div class="modal fade " id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog ">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Reset Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-white ">
                       
                       <form method="POST" >
                           <div class="mb-4 d-flex">
                               <input type="email" class="form-control " placeholder="Email Please" name="email-exist" id="email-exist">
                               <span id="email_error" class="ms-3 me-sm-5 me-0  text-success"></span>
                           </div>
                           <div  class="mb-4">
                               <label class="text-primary">Your security question:</label>
                               <span id="ques_error" class="fw-bolder"></span>
                           </div>
                           <div  class="mb-4 d-flex">
                               <input type="text" class="form-control" id="sec_answer" placeholder="Enter your answer" disabled>
                               <span id="ans_error" class="ms-3 me-sm-5 me-0 text-success"></span>
                           </div >
                           
                           <div  class="mb-4 d-flex" >
                               <input type="hidden" class="form-control" id="password" placeholder="New Password" >
                               <span id="pass_error" class="ms-3 me-sm-5 me-0 d-none"><i class="fas fa-lock"></i></span>
                           </div>
                           <div class="mb-4 d-flex">
                               <input type="hidden" class="form-control" id="cpassword" placeholder="Retype Password" >
                               <span id="confirm_error" class="ms-3 me-sm-5 me-0 d-none"><i class="fas fa-lock"></i></span>
                           </div>
                           <span id="pass-match" class="text-danger d-block text-center fw-bolder"></span>
                           <div class="mb-4 modal-footer d-flex">
                               <input type="submit" class="btn btn-primary w-50 p-2" name="pass_reset" id="pass_reset"  disabled>
                               
                           </div>
                       </form>
                    </div>
                  
                    </div>
                </div>
            </div>
            </div>
        </div>

    </div>
    


<?php 
    require 'footer.php';
?>





