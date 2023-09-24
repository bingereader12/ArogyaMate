<?php
session_start();
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="./CSS/search.css">
</head>
<body>
    <?php include("./components/sidebar.php");?>
    <div class="row pt-3">
        <div class="col-2"></div>
        <div class="col-4 head">Search Doctors</div>
        <div class="col-6">
            <form action="" method="post" class="row">
            <div class="form-floating col-8">
                <input type="text" class="form-control" id="search" name="search" placeholder="Search">
                <label for="search" class="ms-3">Search</label>
            </div>
            <div class="col-4 mt-2"><button class="btn btn-success" type="submit">Search</button></div>
            </form>
        </div>
    </div>
    
    <div class="container1 container">
        <div class="row">
                <?php
                    // $other_doctors="SELECT doc_id FROM doc_data";
                    $doctor_fetch = "SELECT * FROM signup WHERE doctor_reg IS NOT NULL";
                    if(isset($_POST['search'])){
                        $searchVal=$_POST['search'];
                        $other_doctors="SELECT id,fname,mname,lname,dob,gender,aadhar_no,mobile_no,password,doctor_reg,blood_grp FROM doc_data as d,signup WHERE d.deg LIKE '%$searchVal%' OR d.special LIKE '%$searchVal%' OR d.qual LIKE '%$searchVal%' OR CAST(d.exp  as VARCHAR(12)) LIKE '%$searchVal%'";

                        $doctor_fetch = $doctor_fetch." AND (fname LIKE '%$searchVal%' OR mname LIKE '%$searchVal%' OR lname LIKE '%$searchVal%' OR CAST(mobile_no  as VARCHAR(12)) LIKE '%$searchVal%' OR CAST(doctor_reg  as VARCHAR(20)) LIKE '%$searchVal%') ";

                        $doctor_fetch = $doctor_fetch." UNION ".$other_doctors;
                    }
                    // echo $doctor_fetch;
                    $result_fetch = pg_query($doctor_fetch);
                    while($row=pg_fetch_assoc($result_fetch)){
                        ?>
                        <div class="col-lg-6 mb-5 col-sm-12">
                <div class="container gx-3">
                    <div class="row">
                        <div class="col-lg-11 col-12">
                            <div class="card1 row gx-3">
                                <div class="col-5">
                                    <img src="./Assets/profileimg.png" alt="" style="width:140px;">
                                </div>
                                <div class="col-7 row">
                                    <div class="col-12"><span class="name"><?php echo $row['fname']." ".$row['mname']." ".$row['lname']; ?></span></div>
                                    <div class="col-12"><span class="leftText col-4">PID: </span><span class="rightText col-8"><b>XXXXXXXXXXXXXX</b></span></div>
                                    <div class="col-12"><span class="leftText col-4">Registration ID: </span><span class="rightText col-8"><b><?php echo $row['doctor_reg']; ?></b></span></div>
                                    <div class="col-12"><span class="leftText col-4">Gender: </span><span class="rightText col-8"><b><?php echo $row['gender']; ?></b></span></div>
                                    <div class="col-12"><span class="leftText col-4">Age: </span><span class="rightText col-8"><b>43</b></span></div>
                                    
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="col-11">
                            <br>
                            <div class="card3 row gx-3">
                                    <span class="header col-12">Professional Information </span> 
                                    <hr>
                                    <span class="leftText col-4">Experience: </span> <span class="rightText col-8"><b>15 Years</b></span>
                                    <span class="leftText col-4">Degrees: </span> <span class="rightText col-8">MBBS, MD</span>
                                    <span class="leftText col-4">Specialised in: </span>    <span class="rightText col-8">Neuroscience</span>
                                    <span class="leftText col-4">Other Qualifications: </span>      <span class="rightText col-8"></span>
                                    <!-- <span class="leftText col-4">Vaccines: </span>     <span class="rightText col-8"><b><span class="badge rounded-pill bg-primary">Partially Impaired vision</span> <span class="badge rounded-pill bg-primary">Partially Impaired vision</span> <span class="badge rounded-pill bg-primary">Partially Impaired vision</span> <span class="badge rounded-pill bg-primary">Partially Impaired vision</span></b></span>
                                    <span class="leftText col-4">Surgeries: </span>    <span class="rightText col-8"><b><span class="badge rounded-pill bg-danger">Partially Impaired vision</span> <span class="badge rounded-pill bg-danger">Partially Impaired vision</span> <span class="badge rounded-pill bg-danger">Partially Impaired vision</span> <span class="badge rounded-pill bg-danger">Partially Impaired vision</span></b></span> -->
                                    </div>
                        </div>
                        <div class="col-11">
                            <div class="row">
                                <div class="card4 col-12 row">
                                    <span class="header col-12">Work Address</span>
                                    <hr>
                                    <span class="col-3">Address 1: </span>         <span class="col-9">213, Siddhimangal Apartment, Mahatmanagar, Nashik - 422007</span>
                                    <span class="col-3">Address 2: </span>         <span class="col-9">City Hospital, Nashik - 422007</span>
                                    <span class="col-3">Address 3: </span>         <span class="col-9">Doctor's Clinic, Center Bus Stand, Nashik - 422007</span>
                                    
                                </div>
                                
                            </div>
                            
                        </div>
            
                    </div>
                    
            
                </div>                
            </div>
                        <?php
                    }
                ?>
            
        </div>

    </div>
</body>
</html>