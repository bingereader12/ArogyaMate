<?php
    session_start();
    include('./connection.php');
    include('encryptnew.php');

    if(isset($_POST['submit_btn'])){
        $aadhar_no = $_POST['aadhar_no'];
        $phone_no = $_POST['phone_no'];
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $bdate = $_POST['bdate'];
        $gender = $_POST['gender'];
        $password = $_POST['password'];
        $doc_reg = $_POST['doc_reg'];

        // $pid = uniqid();

        $exists = false;
        $phone_copy = "SELECT * FROM signup WHERE mobile_no ='$phone_no'";
        if (pg_num_rows(pg_query($phone_copy)) > 0) {
            $exists = true;
            echo "<script>alert('Phone No. Already Exists!');</script>";
        }
        $emailcopy = "SELECT * FROM signup WHERE aadhar_no='$aadhar_no'";
        if (pg_num_rows(pg_query($emailcopy)) > 0) {
            $exists = true;
            echo "<script>alert('Aadhar No. Already Exists!');</script>";
        }
        if($doc_reg != -1){
            $doc_copy = "SELECT * FROM signup WHERE doctor_reg ='$doc_reg'";
            if (pg_num_rows(pg_query($doc_copy)) > 0) {
            $exists = true;
            echo "<script>alert('Doctor Registration ID Already Exists!');</script>";
            }
        }

        if(!$exists){
               $password = password_hash($password, PASSWORD_DEFAULT);
               $demoquery = pg_num_rows(pg_query("SELECT * FROM signup"));
               $pid = encrypt( 10000000000000+$demoquery ,$cipher,$key,$ivlen,$iv);
               $aadhar_no = encrypt($aadhar_no,$cipher,$key,$ivlen,$iv);
               echo $pid;
               echo $aadhar_no;
               $query = "INSERT INTO signup(id,fname, mname, lname, dob, gender, aadhar_no, mobile_no, password) VALUES ('$pid','$fname', '$mname', '$lname', '$bdate', '$gender', '$aadhar_no', $phone_no, '$password')";
               
               $res = pg_query($query);
               if(!$res){
                   echo 'Failed to connect';
                }else{
                    header("Location: ./index.php");
                    
                }
        }

        // header("Location: ./login.php");
    }else{
        $aadhar_no = $_POST['aadhar_no'];
        $phone_no = $_POST['phone_no'];
        $choose  = $_POST['choose'];
        $isDoctor = ($choose == "provider");
    }
    pg_close($conn);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="./CSS/signup.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <section class="main-section-container">
        <form method="post">
            <h1>Fill in the details for Registration!</h1>
            <div class="containers">
                <div class="information">
                    <div class="flex-container">
                        <h6>Enter your First Name:<br> <input type="text" name="fname" id="name" placeholder="First Name" required>
                        </h6>
                        <h6>Enter your Middle Name:<br> <input type="text" name="mname" id="name" placeholder="Middle Name" required>
                        </h6>
                        <h6>Enter your Last Name:<br> <input type="text" name="lname" id="name" placeholder="Last Name" required>
                        </h6>
                    </div>
                    <div class="flex-container">
                        <h6>Enter your gender:<br>
                            <select name="gender" id="gender" required>
                                <option value="" disabled selected>Select the Category</option>
                                <option value="female">Female</option>
                                <option value="male">Male</option>
                                <option value="other">Other</option>
                                <option value="prefer not to say">Prefer not to say</option>
                            </select>
                        </h6>
                        <h6>Your date of birth:<br> <input type="date" name="bdate" id="bday" placeholder="DD-MM-YYYY" required>
                        </h6>
                        
                        <h6>Enter your Aadhar Number:<br> <input type="number" name="aadhar" id="aadhar_no" value=<?php echo $aadhar_no; ?>
                                placeholder="Aadhar Number" disabled ></h6> 

                            <!-- HIDDEN -->
                            <input type="number" name="aadhar_no" id="aadhar_no" value=<?php echo $aadhar_no; ?> hidden>
                    </div>
                    <div class="flex-container">
                        <?php 
                            if($isDoctor){
                                ?>
                                <h6>Enter your Doctor Registration Number:<br> <input type="number" name="doc_reg" id="reg"
                            placeholder="Registration Number"></h6> 
                                <?php 
                            }else{
                                ?>
                                <input type="number" name="doc_reg" id="reg"placeholder="Registration Number" hidden value=-1> 
                                <?php
                            }
                        
                        ?>
                        
                        <h6>Enter your Mobile Number:<br> <input type="number" name="phone" id="mobile"
                                placeholder="Mobile Number" value=<?php echo $phone_no; ?> disabled></h6>

                        <!-- NEW HIDDEN -->
                        <input type="number" name="phone_no" id="mobile"
                                placeholder="Mobile Number" value=<?php echo $phone_no; ?> hidden>
                        <h6>Enter your Password:<br> <input type="password" name="password" id="password"
                            placeholder="Password" required></h6>
                    </div>
                </div>
            </div>
            <div class="field btn">
                <div class="btn-layer"></div>
                <input type="submit" value="Submit" name="submit_btn">
            </div>
        </form>
    <div class="svgcontainer" style="width: 1528px;">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none">
            <path class="elementor-shape-fill" opacity="0.33"
                d="M473,67.3c-203.9,88.3-263.1-34-320.3,0C66,119.1,0,59.7,0,59.7V0h1000v59.7 c0,0-62.1,26.1-94.9,29.3c-32.8,3.3-62.8-12.3-75.8-22.1C806,49.6,745.3,8.7,694.9,4.7S492.4,59,473,67.3z">
            </path>
            <path class="elementor-shape-fill" opacity="0.66"
                d="M734,67.3c-45.5,0-77.2-23.2-129.1-39.1c-28.6-8.7-150.3-10.1-254,39.1 s-91.7-34.4-149.2,0C115.7,118.3,0,39.8,0,39.8V0h1000v36.5c0,0-28.2-18.5-92.1-18.5C810.2,18.1,775.7,67.3,734,67.3z">
            </path>
            <path class="elementor-shape-fill"
                d="M766.1,28.9c-200-57.5-266,65.5-395.1,19.5C242,1.8,242,5.4,184.8,20.6C128,35.8,132.3,44.9,89.9,52.5C28.6,63.7,0,0,0,0 h1000c0,0-9.9,40.9-83.6,48.1S829.6,47,766.1,28.9z">
            </path>
        </svg>
    </div>
    <div class="blank"></div>




    <script>
        const loginText = document.querySelector(".title-text .login");
        const loginForm = document.querySelector("form.login");
        const loginBtn = document.querySelector("label.login");
        const signupBtn = document.querySelector("label.signup");
        const signupLink = document.querySelector("form .signup-link a");
        signupBtn.onclick = (() => {
            loginForm.style.marginLeft = "-50%";
            loginText.style.marginLeft = "-50%";
        });
        loginBtn.onclick = (() => {
            loginForm.style.marginLeft = "0%";
            loginText.style.marginLeft = "0%";
        });
        signupLink.onclick = (() => {
            signupBtn.click();
            return false;
        });
    </script>
</body>

</html>