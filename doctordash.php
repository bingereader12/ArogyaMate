<?php 
    session_start();
    if($_SESSION['role']=='patient')
    {
        header("Location:dash.php");
    }
    include('./auth.php');
    include('./connection.php');
    include('./encryptnew.php');
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
    $validate_otp = 0;
    if(isset($_POST['switchuser']))
    {
        if($_SESSION['curr']=='doctor')
        {
            $_SESSION['curr']='patient';
            header("Location:dash.php");
        }
        else
        {
            $_SESSION['curr']='doctor';
            header("Location:doctordash.php");
        }
    }

    if(isset($_POST['otpSubmit'])){
        $pid = $_POST['pid'];
        $otp = $_POST['otp'];
        $enc_pid = encrypt($pid,$cipher,$key,$ivlen,$iv);

        $pat_query = "SELECT * FROM signup WHERE id = '$enc_pid'";
        $row = pg_fetch_assoc(pg_query($pat_query));
        $pat_fname =  $row['fname'];
        $pat_lname =  $row['lname'];

        $doc_id = $_SESSION['id'];
        $doc_query = "SELECT * FROM signup WHERE id = '$doc_id'";
        $row = pg_fetch_assoc(pg_query($doc_query));
        $doc_fname =  $row['fname'];
        $doc_lname =  $row['lname'];
        $doc_id = decrypt($doc_id,$cipher,$key,$ivlen,$iv);

        $query = "SELECT * FROM otp_verification WHERE patient_id = '$enc_pid' AND otp =$otp";
        $res = pg_query($query);
        if(pg_num_rows($res)>0){
            $validate_otp = 1;
            $query2 = "DELETE FROM otp_verification WHERE patient_id = '$enc_pid'";
            pg_query($query2);

        }

    }

    if(isset($_POST['historyModalSubmit'])){
            $doctorName = $_POST['doctorName'];
            $doctorPid = $_POST['doctorPid'];
            $patientName = $_POST['patientName'];
            $patientPid = $_POST['patientPid'];
            $purpose = $_POST['purpose'];
            $diagnose = $_POST['diagnose'];
            $medicine = $_POST['medicine'];
            $treatment = $_POST['treatment'];

            $query = "INSERT INTO past_medical_history (ap_date, doctor, doc_id, purpose, patient, pid, diagnose, medicines, treatment) VALUES (CURRENT_DATE, '$doctorName','$doctorPid', '$purpose', '$patientName', '$patientPid', '$diagnose', '$medicine', '$treatment')";
            pg_query($query);
            header("Location: ");
            // exit();
        }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dash</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./CSS/doctordash.css">
</head>
<body>
    
    <?php include('./components/sidebar.php') ?>
    <?php if($_SESSION['role']=='doctor'){?>
        <form action="" method="post" class="switch" style="float:right; margin-right:50px;margin-top:20px;">
    <a><Button type="submit" name="switchuser" class="btn btn-outline-success ">
        <?php 
            if($_SESSION['curr']=='doctor')
            {
                echo "Personal View";
            }
            else 
            {
                echo "Doctor View";
            }
        ?>
    </Button></a>
    </form>
    <?php }?>
    <h1 class="heading">Dashboard</h1>
    <div class="card container">
        <div class="row gy-2 gx-3">
            <div class="col-lg-6 col-md-12 p-2">
                <div class="card1 row">
                    <div class="photo col-3">
                        <img src="./Assets/profileimg.png" alt="Profile" class="profileimg">
                    </div>
                    <span class="col-9 row">
                        <span class="name col-12"><?php echo $fname.' '.    $mname.' '.$lname?></span>
                        <span class="data col-12 row">
                        <span class="leftText col-5">PID: <span><i class="fa-solid fa-eye" id="eye" onclick="togglePrivateInfo()"></i><i style="display:none;" class="fa-solid fa-eye-slash" id="eye" onclick="togglePrivateInfo()"></i></span></span> <span class="rightText col-7"><b class="private-info" style="display:none;"><?php echo $dec_pid?></b><b class="private-info2" style="display:block;">XXXXXXXXXXXXXX</b></span><br>
                        <span class="leftText col-5">Gender: </span>   <span class="rightText col-7"><b><?php echo $gender?></b></span><br>
                        <span class="leftText col-5">Date of birth: </span>      <span class="rightText col-7"><b><?php echo $bdate?></b></span><br>
                        <span class="leftText col-5">Blood Grp: </span><span class="rightText col-7"><b><?php echo $bld_grp?></b></span>
                    
                    </span>

                    </span>
                    
                        <a href="doctorprofile.php">
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
                <div class="card2">
                    <div class="card-content row" style="position: relative;">
                        <p class="card-title">Patient History</p>
                        <div class="col-12 row gx-2" style="position: relative;">
                        <?php
                            $query="SELECT * FROM past_medical_history WHERE doc_id = '$dec_pid'";
                            $res=pg_query($query);
                            if(pg_num_rows($res)==0){
                                ?>
                                    <div class="col" style="padding: 0 1%;">
                                <div class="histcard row">
                                    <h5>No Previous Treatments!</h5>
                                </div>
                            </div>
                                <?php
                                // echo "No previous results";
                            } else {
                                $i=0;
                            while($row1=pg_fetch_assoc($res)){
                                if($i <2){

                                
                                ?>
                                <div class="col" style="padding: 0 1%;">
                                    
                                <div class="histcard row">
                                    <span class="col-5">Patient: </span><span class=" col-7"><?php  echo $row1['patient'] ?></span>
                                    <hr style="margin: 0.3rem; color: var(--green);">
                                    <span class="col-5">Purpose: </span><span class=" col-7"><?php echo $row1['purpose'] ?></span>
                                    <hr style="margin: 0.3rem; color: var(--green);">
                                    <span class="col-5">Visit: </span><span class=" col-7"><?php echo $row1['ap_date'] ?></span>
                                    <hr style="margin: 0.3rem; color: var(--green);">
                                    <span class="col-5">Treatment: </span><span class=" col-7"><?php echo $row1['treatment'] ?></span>
                                    
                                </div>
                            </div>
                                <?php
                                $i+=1;
                                if($i==1){
                                    ?>
                                        <span style=" width: 2px;margin: 0;padding: 0; background-color: #fff; border-radius: 5px; height: 80%; position: absolute; left: 50%; top:50%;transform: translate(-50%,-30%);"></span>
                                    <?php
                                }
                            }}
                        }
                        ?>      
                                              
                        </div><a href="doctortreatmenthistory.php">
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
            
        <div class="col-lg-6 col-md-6 p-2">
            <div class="card2 ">
                <div class="card-content">
                    <p class="card-title">Trending News Health</p>
                    <p class="card-para">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <p class="card-para">New vaccine for diseasename</p>
                </div>
                    <button class="cta1">
                        <span class="hover-underline-animation"> View</span>
                        <svg viewBox="0 0 46 16" height="10" width="30" xmlns="http://www.w3.org/2000/svg" id="arrow-horizontal">
                            <path transform="translate(30)" d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z" data-name="Path 10" id="Path_10"></path>
                        </svg>
                    </button>
                </div>
                
              </div>
        </div>
                      
    
            

            <!-- <div class="col-lg-6 col-md-6 p-2">
                <div class="card2">
                    <div class="card-content">
                        <p class="card-title">Trending News Health</p>
                        <p class="card-para">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <p class="card-para">New vaccine for diseasename</p>
                        <button class="cta1">
                            <span class="hover-underline-animation"> View</span>
                            <svg viewBox="0 0 46 16" height="10" width="30" xmlns="http://www.w3.org/2000/svg" id="arrow-horizontal">
                                <path transform="translate(30)" d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z" data-name="Path 10" id="Path_10"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div> -->
            
        </div>
        <div class="col-lg-9 col-md-9">
            <button class="addrecords" data-bs-target="#otpModal" data-bs-toggle="modal">
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"></path><path fill="currentColor" d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"></path></svg> Add
                </span>
              </button>
        </div>
        </div>
        <!-- adb -->
        
            
        <div class="modal fade" id="otpModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Modal 1</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="" method="post">
                    <div class="row align-items-center gy-2">
                    <div class="col-5 formHeading"><h5>Patient PID:</h5></div>
                    <div class="col-7"> 
                        <!-- <label for="name1" class="col-12 ms-0 ps-0"></label>  -->
                        <input class="col-12 form-control" type="number" id="pid" name="pid" placeholder="11223344556677" required>
                    </div>
                    <div class="col-5 formHeading"><h5>OTP:</h5></div>
                    <div class="col-7"> 
                        <!-- <label for="name1" class="col-12 ms-0 ps-0"></label>  -->
                        <input class="col-12 form-control" type="number" id="otp" name="otp" placeholder="4 digit OTP" required>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-success" type="submit" name="otpSubmit">Submit</button>
                </div>
            </form>
              </div>
            </div>
          </div>
          <div class="modal fade" id="historyEditModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Modal 2</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="row align-items-center gy-2">
                        <div class="col-5 formHeading"><h5>Doctor Name:</h5></div>
                        <div class="col-7"> 
                            <!-- <label for="name1" class="col-12 ms-0 ps-0"></label>  -->
                            <input class="col-12 form-control" type="text" id="doctorname" name="doctorName" placeholder="John Wick" value="<?php 
                            echo $doc_fname.' '.$doc_lname ?>" hidden required>
                            <input class="col-12 form-control" type="text" placeholder="John Wick" value="<?php 
                            echo $doc_fname.' '.$doc_lname ?>" disabled required>
                        </div>
                        <div class="col-5 formHeading"><h5>Doctor PID:</h5></div>
                        <div class="col-7"> 
                            <!-- <label for="name1" class="col-12 ms-0 ps-0"></label>  -->
                            <input class="col-12 form-control" type="text" id="doctorpid" name="doctorPid" value="<?php echo $doc_id;?>" hidden required>
                            <input class="col-12 form-control" type="text" placeholder="11223344556677" value="<?php echo $doc_id;?>" disabled required>
                        </div>
                        <div class="col-5 formHeading"><h5>Patient Name:</h5></div>
                        <div class="col-7"> 
                            <!-- <label for="name1" class="col-12 ms-0 ps-0"></label>  -->
                            <input class="col-12 form-control" type="text" id="patientname" name="patientName" placeholder="John Wick" value="<?php echo  $pat_fname.' '.$pat_lname ?>" hidden required>
                            <input class="col-12 form-control" type="text" placeholder="John Wick" value="<?php echo $pat_fname.' '.$pat_lname ?>" disabled required>
                        </div>
                        <div class="col-5 formHeading"><h5>Patient PID:</h5></div>
                        <div class="col-7"> 
                            <!-- <label for="name1" class="col-12 ms-0 ps-0"></label>  -->
                            <input class="col-12 form-control" type="text" id="patientpid" name="patientPid"  value="<?php echo $pid;?> "hidden required>
                            <input class="col-12 form-control" type="text"  value="<?php echo $pid;?>"  disabled required>
                        </div>
                        <div class="col-5 formHeading"><h5>Purpose:</h5></div>
                        <div class="col-7"> 
                            <!-- <label for="name1" class="col-12 ms-0 ps-0"></label>  -->
                            <input class="col-12 form-control" type="text" id="purpose" name="purpose" placeholder="" value="" required>
                            <!-- <input class="col-12 form-control" type="text" placeholder="" value="" disabled required> -->
                        </div>
                        <div class="col-5 formHeading"><h5>Diagnosed With:</h5></div>
                        <div class="col-7"> 
                            <!-- <label for="name1" class="col-12 ms-0 ps-0"></label>  -->
                            <input class="col-12 form-control" type="text" id="diagnose" name="diagnose" placeholder="" value="" required>
                            <!-- <input class="col-12 form-control" type="text" placeholder="" value="" disabled required> -->
                        </div>
                        <div class="col-5 formHeading"><h5>Medicine:</h5></div>
                        <div class="col-7"> 
                            <!-- <label for="name1" class="col-12 ms-0 ps-0"></label>  -->
                            <input class="col-12 form-control" type="text" id="medicine" name="medicine" placeholder="" value="">
                            <!-- <input class="col-12 form-control" type="text" placeholder="" value="" disabled required> -->
                        </div>
                        <div class="col-5 formHeading"><h5>Treatment:</h5></div>
                        <div class="col-7"> 
                            <!-- <label for="name1" class="col-12 ms-0 ps-0"></label>  -->
                            <input class="col-12 form-control" type="text" id="treatment" name="treatment" placeholder="" value="">
                            <!-- <input class="col-12 form-control" type="text" placeholder="" value="" disabled required> -->
                        </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-success" name="historyModalSubmit" type="submit">Submit</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
                

    </div>
</body>
<script>
        function togglePrivateInfo() {
            const privateInfo = document.querySelector(".private-info");
            const privateInfo2 = document.querySelector(".private-info2");
            const eye = document.querySelector(".fa-eye");
            const eye2 = document.querySelector(".fa-eye-slash");
            if (privateInfo.style.display === "none" || privateInfo.style.display === "") {
                eye.style.display = "none"
                eye2.style.display = "inline"
                privateInfo.style.display = "block";
                privateInfo2.style.display = "none";
            } else {
                eye.style.display = "inline"
                eye2.style.display = "none"
                privateInfo.style.display = "none";
                privateInfo2.style.display = "block";
            }
        }
    </script>
  <?php 
        if($validate_otp == 1){
            echo "<script> let myModal = new bootstrap.Modal(document.getElementById('historyEditModal'), {});
                myModal.show();
                </script>";
        }
        pg_close();
?>
</html>

<?php
// pg_close();
?>