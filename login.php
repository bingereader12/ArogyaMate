<?php 
    session_start();
    include('./connection.php');

    if (isset($_POST['submitbtn'])) {

        $phone_no = $_POST['phoneno'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM signup WHERE mobile_no = '$phone_no'";
        $res = pg_query($conn , $sql);
        $rows = pg_num_rows($res);

        if ($rows == 1) {
            $row = pg_fetch_assoc($res);
            if(password_verify($password,$row['password'])){
                // $_SESSION['user'] = $username;
                // $_SESSION['id'] = $row['pid'];
                // $_SESSION['loggedin']=true;
                echo 'loggedin';
                // header("Location:http://localhost/index.php");
            }else{
            echo "<script>alert('Password doesnt match');</script>";
            }
        }else{
        echo "<script>alert('Phone No. doesnt match');</script>";
        }
    }


    pg_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign In</title>
    <link rel="stylesheet" href="./CSS/login.css" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </head> -->

<body>
        <div class="bg">
            <img src="./Assets/bg.png" alt="Background Image">
        </div>
    <div class="right">
        <div class="box">
            <form action="login.php" method="post">
                <div class="header">Login</div>
                    <div class="content">
                        <div class="input">
                            <input type="text" placeholder="Phone No." id="phoneno" name="phoneno" required />
                        </div>
                        <div class="input">
                            <input type="password" placeholder="Password" id="password" name="password" required />
                        </div>
                        <!-- <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div> -->
                        <div class="input submit">
                            <input type="submit" value="Login" name="submitbtn" />
                        </div>
                        <div class="signUp input">
                            <p>New User? <a href="./signup.php">Sign up</a></p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>