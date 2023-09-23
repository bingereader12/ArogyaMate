<?php 
    session_start();
    include('./connection.php');

    if (isset($_POST['submitbtn'])) {
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $bdate = $_POST['bdate'];
        $gender = $_POST['gender'];
        $aadhar_no = $_POST['aadhar'];
        $phone_no = $_POST['mobile'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        $exists = false;
        $phone_copy = "SELECT * FROM signup WHERE mobile_no ='$phone_no'";
        if (pg_num_rows(pg_query($conn, $phone_copy)) > 0) {
            $exists = true;
            echo "<script>alert('Phone No. Already Exists!');</script>";
        }
        $emailcopy = "SELECT * FROM signup WHERE aadhar_no='$aadhar_no'";
        if (pg_num_rows(pg_query($conn, $emailcopy)) > 0) {
            $exists = true;
            echo "<script>alert('Aadhar No. Already Exists!');</script>";
        }

        if(!$exists){
            if($password != $cpassword){
                echo "<script>alert('Passwords are not same!');</script>";
            }else{
                $password = password_hash($password, PASSWORD_DEFAULT);
                $query = "INSERT INTO signup (fname, mname, lname, dob, gender, aadhar_no, mobile_no, password) VALUES ('$fname', '$mname', '$lname', '$bdate', '$gender', $aadhar_no, $phone_no, '$password')";
            }

            $res = pg_query($query);
             if(!$res){
                echo 'Failed to connect';
            }else{
                header("Location:http://localhost/index.php");
            }
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
    <link rel="stylesheet" href="./CSS/signup.css" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head> -->

<body>
    <div class="left">
        <div class="box">
            <form action="signup.php" method="post">
                <div class="header">Signup</div>
                    <div class="content">
                        <div class="input">
                            <input type="text" placeholder="First Name" id="name" name="fname" required />
                        </div>
                        <div class="input">
                            <input type="text" placeholder="Middle Name" id="name" name="mname" />
                        </div>
                        <div class="input">
                            <input type="text" placeholder="Last Name" id="name" name="lname" required />
                        </div>
                        <div class="input">
                            <input type="date" class="bdate" placeholder="Birthday" id="bday" name="bdate" required />
                        </div>
                        
                        
                        <div class="input">
                            <select name="gender" id="gender" required>
                                <option value="" selected disabled hidden>
                                Gender
                                </option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        
                        
                        <!-- <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div> -->
                        
                    </div>
                </div>
            <!-- </form> -->
        </div>
    </div>
    <div class="right">
        <div class="box">
            <!-- <form action="signup.php" method="post"> -->
                    <div class="content box2">
                        <!-- <div class="input">
                            <input type="number" placeholder="Age" id="age" name="age" required />
                        </div> -->
                        <div class="input">
                            <input type="number" placeholder="Aadhaar Number" id="aadhar" name="aadhar" required />
                        </div>
                        <div class="input">
                            <input type="number" placeholder="Mobile Number" id="mobile" name="mobile" required />
                        </div>
                        <div class="input">
                            <input type="password" placeholder="Password" id="password" name="password" required />
                        </div>
                        <div class="input">
                            <input type="password" placeholder="Confirm Password" id="password" name="cpassword" required />
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
                            <input type="submit" value="Signup" name="submitbtn" />
                        </div>
                        <div class="signUp input">
                            <p>Already have an account? <a href="./login.php">Log In</a></p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>