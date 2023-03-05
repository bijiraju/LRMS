<?php
    require 'header.php';
    require 'connection.php';
    session_start();
?> 
<?php
    
    if(isset($_POST['fname'])&&isset($_POST['lname'])&&isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['question'])&&isset($_POST['answer'])){
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $email=$_POST['email'];
        $password=md5($_POST['password']);
        $question=$_POST['question'];
        $answer=$_POST['answer'];
        $pic=$_FILES['image']['name']; 
        $temp=$_FILES['image']['tmp_name'];
        $target="uploads/".basename($pic);
        $move_pic=move_uploaded_file($temp,$target);
        $sql=("SELECT * FROM registration_table WHERE email=:email LIMIT 1");
        $statement=$connection->prepare($sql);
        $statement->execute([':email' => $email]);
        $check_email=$statement->fetch(PDO::FETCH_ASSOC);
        if ($check_email) {
            echo "<script>alert('Email already exists in database')</script>";
        }
        else{
            
            $sql='INSERT INTO registration_table(fname,lname,email,password,image,question,answer) VALUES(:fname,:lname,:email,:password,:image,:question,:answer)';
            $statement=$connection->prepare($sql);
            if($statement->execute([':fname'=>$fname,':lname'=>$lname,':email'=>$email,':password'=>$password,':image'=>$pic,':question'=>$question,':answer'=>$answer])){
                echo "<script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Data Added Successfully',
                    showConfirmButton: false,
                    timer: 2000
                  }).then(function(){
                    window.location='index.php';
                  });

                </script>";
                    }
            }
        }
            
    
?>

        <div class="container">
        <div class="row mt-5">
            <div class="col-sm-6 mt-5"><img src="images/register.png"></div>
            <div class="col-sm-6">
                <div class="mt-5"><h2 class="text center"> Register</h2></div>
                <form action="" method="POST" enctype="multipart/form-data" class="">
                    <div><input type="text" name="fname" placeholder="First Name" class="form-control mt-5 p-2" required></div>
                    <div><input type="text" name="lname" placeholder="Last Name" class="form-control mt-3 p-2" required></div>
                    <div><input type="email" name="email" placeholder="Email" class="form-control mt-3 p-2"></div>
                    <div><input type="file" name="image" value="No File Choosen" class="form-control mt-3 p-2" required></div>
                    <div><input type="password" name="password" placeholder="Password" class="form-control mt-3 p-2" required></div>
                    <div><input type="password" name="cpassword" placeholder="Confirm Password" class="form-control mt-3 p-2" required></div>
                    <div>
                        <select id="question" name="question" class="form-control mt-3 p-2" required>
                            <option value="Choose one security question ">Choose one security question</option>
                            <option value="What is your pet name?">What is your pet name?</option>
                            <option value="What is your nick name?">What is your nick name?</option>
                            <option value="Enter your 4 digit number?">Enter your 4 digit number?</option>
                        </select>
                    </div>
                    <div><input type="text" name="answer" placeholder="Your Answer" class="form-control mt-3 p-2" required></div>
                    <div><input type="submit" name="submit" value="Submit" class="form-control btn btn-primary mt-3 p-2"></div>
                    <div><a href="index.php" name="create" value="Already have an Account??" class="form-control btn btn-info mt-3 mb-3 p-3 bg-opacity-75">Already have an Account??</a></div>
                </form>
            </div>
        </div>
        </div>
        <!--bootstrap-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- jquery CDN -->
        <script
            src="https://code.jquery.com/jquery-3.6.3.min.js"
            integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
            crossorigin="anonymous"
        ></script>
        <!-- fontawsome CDN -->
        <script
            src="https://kit.fontawesome.com/34baa6b8a4.js"
            crossorigin="anonymous"
        ></script>
        <!-- custom script -->
        
        <script src="js/script.js"></script>
    </body>
</html>