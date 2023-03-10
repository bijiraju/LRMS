    <?php
    require 'connection.php';
    session_start();
    require 'header.php';
    if(!isset($_SESSION['email'])) {
        header("Location:index.php");
    }
    $email=$_SESSION['email'];
    $sql=("SELECT * FROM registration_table WHERE email=:email");
    $statement=$connection->prepare($sql);
    $statement->execute([':email'=>$email]);
    $register=$statement->fetch(PDO::FETCH_OBJ);
    if(isset($_POST['logout'])){
        session_unset();
        session_destroy();
        header("Location:index.php");

    }
?> 

        <div class="container">
            <div class="text-end">
            <form method="POST">
                <a href="index.php" name="logout"><i class="fas fa-sign-out-alt fa-2x text-secondary"></i></a>
            </form>
            </div>
            <div class="row mt-5 justify-content-end">
                <div class="col-sm-3 img"><img src="uploads/<?=$stud->BLOB_pic ; ?>" class="img-fluid h-75 img"></h3></div>
                <div class="col-sm-6">
                    <h3><?=$register->fname ?> <?=$register->lname ?></h3>
                    <h3><?=$register->email ?></h3>
                <form method="POST">
                <!-- <button name="logout"><i class="fa fa-sign-out" aria-hidden="true"></i></button></form> -->
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
