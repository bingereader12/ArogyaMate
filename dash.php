<?php
    session_start();
    include('./connection.php');
    include('./auth.php');
    include('./decryptnew.php');

    $pid = $_SESSION['id'];
    $query = "SELECT * FROM signup WHERE id = '$pid'";
    $dec_pid = decrypt($pid,$cipher,$key,$ivlen,$iv);
    $row = pg_fetch_assoc(pg_query($query));
    $fname = $row['fname'];
    $mname = $row['mname'];
    $lname = $row['lname'];
    $gender = $row['gender'];
    $bld_grp = $row['blood_grp'];
    $bdate = $row['dob'];
?>


</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dash</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./CSS/dash.css">
</head>
<body>
    <!-- <Button><a href="login.php">Login</a></Button>
    <Button><a href="signup.php">Signup</a></Button>
    <Button><a href="dash.php">Dash</a></Button>
    <Button><a href="doctordash.php">DoctorDash</a></Button>
    <Button><a href="doctorprofile.php">DoctorProfile</a></Button>
    <Button><a href="profile.php">Profile</a></Button> -->

    <?php include('./components/sidebar.php') ?>
    <h1 class="heading">Dashboard</h1>
    <div class="card container">
        <div class="row gy-2 gx-3">
            <div class="col-lg-6 col-md-12 p-2">
                <div class="card1 row">
                    <div class="photo col-3">
                        <img src="./Assets/profileimg.png" alt="Profile" class="profileimg">
                    </div>
                    <span class="col-9 row">
                        <span class="name col-12"><?php echo $fname.' '.$mname.' '.$lname?></span>
                        <span class="data col-12 row">
                        <span class="leftText col-5">PID: </span>      <span class="rightText col-7"><b><?php echo $dec_pid?></b></span><br>
                        <span class="leftText col-5">Gender: </span>   <span class="rightText col-7"><b><?php echo $gender?></b></span><br>
                        <span class="leftText col-5">Age: </span>      <span class="rightText col-7"><b><?php echo $bdate?></b></span><br>
                        <span class="leftText col-5">Blood Grp: </span><span class="rightText col-7"><b><?php echo $bld_grp?></b></span>
                    
                    </span>

                    </span>
                    
                        <a href="profile.php">
                        <button class="cta">
                            <span class="hover-underline-animation"> View</span>
                            <svg viewBox="0 0 46 16" height="10" width="30" xmlns="http://www.w3.org/2000/svg" id="arrow-horizontal">
                                <path transform="translate(30)" d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z" data-name="Path 10" id="Path_10"></path>
                            </svg>
                        </button>
                    </a>
                </div>
            </div>
            
        
        <div class="col-lg-6 col-md-6 p-2">
            <div class="card2 ">
                <div class="card-content row">
                  <p class="card-title">Current Prescriptions
                  </p><br><p class="card-para">Lorem ipsum dolor sit 
                    amet, consectetur adipiscing elit.(this part contains calendar)</p>
                    <!-- <button class="cta1">
                        <span class="hover-underline-animation"> View</span>
                        <svg viewBox="0 0 46 16" height="10" width="30" xmlns="http://www.w3.org/2000/svg" id="arrow-horizontal">
                            <path transform="translate(30)" d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z" data-name="Path 10" id="Path_10"></path>
                        </svg>
                    </button> -->
                </div>
                
              </div>
        </div>
                      
    
            <div class="col-lg-7 col-md-6 p-2">
                <div class="card2">
                    <div class="card-content row">
                        <p class="card-title">Past History</p>
                        <div class="row gx-2" style="position: relative;">
                            <div class="col" style="padding: 0 1%;">
                                <div class="histcard row">
                                    <span class="col-5">Doctor: </span><span class=" col-7">Jagjit Singh Bhumra </span>
                                    <hr style="margin: 0.3rem; color: var(--green);">
                                    <span class="col-5">Reason: </span><span class=" col-7">Constipation and headache and cold </span>
                                    <hr style="margin: 0.3rem; color: var(--green);">
                                    <span class="col-5">Visit: </span><span class=" col-7">17/8/23 </span>
                                    <hr style="margin: 0.3rem; color: var(--green);">
                                    <span class="col-5">Treatment: </span><span class=" col-7">Medicines and Exercise </span>
                                    
                                </div>
                            </div>

                            
                            <span style=" width: 2px;margin: 0;padding: 0; background-color: #fff; border-radius: 5px; height: 80%; position: absolute; left: 50%; top:50%;transform: translate(-50%,-30%);"></span>
                            <div class="col" style="padding: 0 1%;">
                                <div class="histcard row">
                                    <span class="col-5">Doctor: </span><span class=" col-7">Jagjit Singh Bhumra </span>
                                    <hr style="margin: 0.3rem; color: var(--green);">
                                    <span class="col-5">Reason: </span><span class=" col-7">Constipation and headache and cold </span>
                                    <hr style="margin: 0.3rem; color: var(--green);">
                                    <span class="col-5">Visit: </span><span class=" col-7">17/8/23 </span>
                                    <hr style="margin: 0.3rem; color: var(--green);">
                                    <span class="col-5">Treatment: </span><span class=" col-7">Medicines and Exercise </span>
                                    
                                </div>
                            </div>
                            
                        </div>
                        <!-- <p class="card-para">Treated for diseasename</p> -->
                        <!-- <p class="card-para">Suffered diseasename</p> -->
                        <a href="past_medical.php">
                            <button class="cta1">
                                <span class="hover-underline-animation"> View</span>
                                <svg viewBox="0 0 46 16" height="10" width="30" xmlns="http://www.w3.org/2000/svg" id="arrow-horizontal">
                                    <path transform="translate(30)" d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z" data-name="Path 10" id="Path_10"></path>
                                </svg>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            

            <div class="col-lg-5 col-md-6 p-2">
                <div class="card2">
                    <div class="card-content row">
                        <p class="card-title">Advanced Health</p>
                        <div class="histcard row">
                            <span class="col-4">Allergies: </span><span class=" col-8">Partially Impaired vision,Partially Impaired vision </span>
                            <hr style="margin: 0.3rem; color: var(--green);">
                            <span class="col-4">Vaccines: </span><span class=" col-8">Partially Impaired vision </span>
                            <hr style="margin: 0.3rem; color: var(--green);">
                            <span class="col-4">Surgeries: </span><span class=" col-8">Partially Impaired vision </span>
                            <hr style="margin: 0.3rem; color: var(--green);">
                            <span class="col-4">Disabilities: </span><span class=" col-8">Partially Impaired vision Partially Impaired vision </span>
                            <hr style="margin: 0.3rem; color: var(--green);">
                            <span class="col-4">Illness: </span><span class=" col-8">Partially Impaired vision</span>
                            
                        </div>
                        <a href="profile.php">
                        <button class="cta1">
                            <span class="hover-underline-animation"> View</span>
                            <svg viewBox="0 0 46 16" height="10" width="30" xmlns="http://www.w3.org/2000/svg" id="arrow-horizontal">
                                <path transform="translate(30)" d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z" data-name="Path 10" id="Path_10"></path>
                            </svg>
                        </button>
                        </a>
                    </div>
                </div>
            </div>
            


        <div class="col-lg-5 col-md-5 p-2">
            <div class="card3">
                <div class="card-content row">
                    <p class="card-title">Trending News</p><br>
                    <p class="card-para">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-md-7 p-2">
            <div class="card3">
                <div class="card-content row">
                    <p class="card-title">Emergency contacts</p>
                    <div class="col-6" style="padding-top: 40px;">
                        <div class=" contactcard row gx-3">
                            <?php 
                                $pid = $_SESSION['id'];
                                $query  = "SELECT * FROM emergency_contacts WHERE pid = '$pid'";
                                $row = pg_fetch_assoc(pg_query($query));
                            ?>
                                    <span class="leftText col-6"><?php echo $row['name']?> <span class="rel">(<?php echo $row['relation']?>)</span> </span><a href="tel:7447425397" class="btn rightText col-5"><b><?php echo $row['contact_no']?></b> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000" class="bi bi-telephone-fill" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
        </svg></a>
                                <span class="leftText col-6"><?php echo$row['name2']?><span class="rel">(<?php echo$row['relation2']?>)</span> </span><a href="tel:7447425397" class="btn rightText col-5"><b><?php echo$row['contact_no2']?></b> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000" class="bi bi-telephone-fill" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
        </svg></a>
                                <span class="leftText col-6"><?php echo$row['name3']?><span class="rel">(<?php echo$row['relation3']?>)</span> </span><a href="tel:7447425397" class="btn rightText col-5"><b><?php echo$row['contact_no3']?></b> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000" class="bi bi-telephone-fill" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
        </svg></a>
                                <span class="leftText col-6"><?php echo$row['name4']?><span class="rel">(<?php echo$row['relation4']?>)</span> </span><a href="tel:7447425397" class="btn rightText col-5"><b><?php echo $row['contact_no4']?></b> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000" class="bi bi-telephone-fill" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
        </svg></a>
                        </div>
                    </div>
                    <div class="col-6" style="padding-top: 40px;">
                        <div class=" contactcard row gx-3">
                                    <span class="leftText col-6">Police: </span><a href="tel:7447425397" class="btn rightText col-5"><b>7447425397</b> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000" class="bi bi-telephone-fill" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
        </svg></a>
                                <span class="leftText col-6">Ambulance: </span><a href="tel:7447425397" class="btn rightText col-5"><b>7447425397</b> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000" class="bi bi-telephone-fill" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
        </svg></a>
                                <span class="leftText col-6">Suicide Hotline: </span><a href="tel:7447425397" class="btn rightText col-5"><b>7447425397</b> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000" class="bi bi-telephone-fill" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
        </svg></a>
                                <span class="leftText col-6">Emergency: </span><a href="tel:7447425397" class="btn rightText col-5"><b>7447425397</b> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000" class="bi bi-telephone-fill" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
        </svg></a>
                        </div>
                    </div>
                    
                    <!-- <button class="cta1">
                        <span class="hover-underline-animation"> View</span>
                        <svg viewBox="0 0 46 16" height="10" width="30" xmlns="http://www.w3.org/2000/svg" id="arrow-horizontal">
                            <path transform="translate(30)" d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z" data-name="Path 10" id="Path_10"></path>
                        </svg>
                    </button> -->
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9">
            <form action="" method = "POST">
                 <button class="addrecords" name="generateOTP" type="submit">
                <span><a class="btn" data-bs-toggle="modal" data-bs-target="#generateotp">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"></path><path fill="currentColor" d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"></path></svg> Add
                </a></span>
              </button>
            </form>
           
        </div>
            
        <div class="modal fade" id="generateotp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Generate OTP</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="otpDisplay" style="display: none;">
                        <p>Generated OTP: <span id="generatedOTP">
                        </span></p>
                    </div>
                      <?php 
                                $newOTP = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
                                $pid = $_SESSION['id'];
                                $query = "INSERT INTO otp_verification (patient_id, otp) VALUES ('$pid', $newOTP)";
                                pg_query($query);
                                echo $newOTP;
                    ?>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                  <!-- <button type="submit" class="btn btn-success" name="otp">Generate OTP</button> -->
                <!-- </form> -->
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- adb -->
        
            
                
        
    </div>
    <!-- <script>
        function generateOTP() {
            document.getElementById("generatedOTP").textContent = "";
            const otp = Math.floor(1000 + Math.random() * 9000);
            document.getElementById("generatedOTP").textContent = otp;
            document.getElementById("otpDisplay").style.display = "block";
    
            return false;
        }
    </script> --></body>
</html>

