<?php
session_start();
include('./connection.php');
include('./decryptnew.php');
if($_SESSION['role']=='patient')
{
    header("Location:dash.php");
}
$pid = $_SESSION['id'];
$query = "SELECT * FROM signup WHERE id ='$pid'";    
$res = pg_query($query);
$row = pg_fetch_assoc($res);
$doc_id = $row['doctor_reg'];
$dec_pid = decrypt($pid,$cipher,$key,$ivlen,$iv);

  if(isset($_POST['mycontact_submit'])){
    

      $fetch_contacts="SELECT * FROM emergency_contacts WHERE pid='$doc_id'";
      $res = pg_query($fetch_contacts);
      $contact_row = pg_fetch_assoc($res);
      if(pg_num_rows($res)>0)
      {
        $name1 = $_POST['name1'];
        $contact1 = $_POST['contact1'];
        $query = "UPDATE emergency_contacts SET name='$name1', contact_no='$contact1' WHERE pid='$doc_id'";    
        $res = pg_query($query);
        if(!$res){
          echo 'Failed to Add Emergency Contacts';
        }
      } else {
        $name1 = $_POST['name1'];
        $contact1 = $_POST['contact1'];
        $query = "INSERT INTO emergency_contacts(pid,name,contact_no,name2,contact_no2,name3,contact_no3,name4,contact_no4) VALUES ('$doc_id','$name1','$contact1',' ',-1,' ',-1,' ',-1)";    
        $res = pg_query($query);
        if(!$res){
          echo 'Failed to Add Emergency Contacts';
        }
      }

    if(isset($_POST['name2']) && isset($_POST['contact2']) && $_POST['contact2']!=''){
      $name2 = $_POST['name2'];
      $contact2 = $_POST['contact2'];
      $query = "UPDATE emergency_contacts SET name2='$name2',contact_no2='$contact2' WHERE pid='$doc_id'";    
      $res = pg_query($query);
      if(!$res){
        echo 'Failed to Add Emergency Contacts';
      }
    }

    if(isset($_POST['name3']) && isset($_POST['contact3']) && $_POST['contact3']!=''){
      $name3 = $_POST['name3'];
      $contact3 = $_POST['contact3']; 
      $query = "UPDATE emergency_contacts SET name3='$name3', contact_no3='$contact3' WHERE pid='$doc_id'";    
      $res = pg_query($query);
      if(!$res){
        echo 'Failed to Add Emergency Contacts';
      }
    }

    if(isset($_POST['name4']) && isset($_POST['contact4']) && $_POST['contact4']!=''){
      $name4 = $_POST['name4'];
      $contact4 = $_POST['contact4'];
      $query = "UPDATE emergency_contacts SET name4='$name4',contact_no4='$contact4' WHERE pid='$pid'";    
      $res = pg_query($query);
      if(!$res){
        echo 'Failed to Add Emergency Contacts';
      }
    }

    // exit();
  }


  if(isset($_POST['workAddress'])){
    $name = $_POST['name'];
    $address = $_POST['address'];
    $query = "INSERT INTO address (doc_id, name, address) VALUES ('$doc_id','$name','$address')";
    pg_query($query);
  }




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
    <link rel="stylesheet" href="CSS/doctorprofile.css">
    <script>
        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!"
        })
    </script>
    
</head>
<body>
<?php include('./components/sidebar.php') ?>

  <!-- <Button><a href="login.html">Login</a></Button>
  <Button><a href="signup.html">Signup</a></Button>
  <Button><a href="dash.html">Dash</a></Button>
  <Button><a href="doctordash.html">DoctorDash</a></Button>
  <Button><a href="doctorprofile.html">DoctorProfile</a></Button>
  <Button><a href="profile.html">Profile</a></Button> -->
  <h1 class="head">Profile Page</h1>
    <div class="photo">
        <img src="./Assets/profileimg.png" alt="Profile" class="profileimg">
    </div>
    <div class="container1 container gx-3">
        <div class="row">
            <div class="col-lg-7 col-12">

                <div class="card1 row gx-3">
                    
                        <span class="name"><?php echo $row['fname']." ".$row['mname']." ".$row['lname'] ?></span>
                        <span class="leftText col-4">PID: </span><span class="rightText col-8"><b><?php echo $dec_pid?></b></span>
                        <span class="leftText col-4">Registration ID: </span><span class="rightText col-8"><b><?php echo $row['doctor_reg'] ?></b></span>
                        <span class="leftText col-4">Gender: </span><span class="rightText col-8"><b><?php echo $row['gender'] ?></b></span>
                        <span class="leftText col-4">Date of birth:: </span><span class="rightText col-8"><b><?php echo $row['dob'] ?></b></span>
                        <span class="leftText col-4">Blood Grp: </span><span class="rightText col-8"><b><?php echo $row['blood_grp'] ?></b> <a class="btn" data-bs-toggle="modal" data-bs-target="#bloodGroup"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                          </svg></a></span>

                </div>
            </div>
            
                      <div class="col-lg-5 col-12">
                <div class="card2 row gx-3">
                        <span class="header col-12">Emergency Contacts  
                            <a class="btn" data-bs-toggle="modal" data-bs-target="#updateContacts"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                          </svg></a></span>
                        <hr>
                        <?php 
                            $fetch_contacts="SELECT * FROM emergency_contacts WHERE pid='$doc_id'";
                            $res = pg_query($fetch_contacts);
                            $contact_row = pg_fetch_assoc($res);
                            if(pg_num_rows($res)>0)
                            {
                              if($contact_row['contact_no']!=-1)
                              {
                              ?>
                            
<span class="leftText col-8"><?php echo $contact_row['name'] ?><span class="rel"><?php echo $contact_row['relation'] ?></span> </span><a href="tel:7447425397" class="btn rightText col-4"><b><?php echo $contact_row['contact_no'] ?></b> <?php if($contact_row['contact_no']){?><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000" class="bi bi-telephone-fill" viewBox="0 0 16 16"><?php } ?>
  <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
</svg></a>
<?php }
 if($contact_row['contact_no2']!=-1)
 {
 ?>

<span class="leftText col-8"><?php echo $contact_row['name2'] ?><span class="rel"><?php echo $contact_row['relation2'] ?></span> </span><a href="tel:7447425397" class="btn rightText col-4"><b><?php echo $contact_row['contact_no2'] ?></b> <?php if($contact_row['contact_no2']){?><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000" class="bi bi-telephone-fill" viewBox="0 0 16 16"><?php } ?>
  <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
</svg></a>
<?php }
 if($contact_row['contact_no3']!=-1)
 {
 ?>
<span class="leftText col-8"><?php echo $contact_row['name3'] ?><span class="rel"><?php echo $contact_row['relation3'] ?></span> </span><a href="tel:7447425397" class="btn rightText col-4"><b><?php echo $contact_row['contact_no3'] ?></b> <?php if($contact_row['contact_no3']){?><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000" class="bi bi-telephone-fill" viewBox="0 0 16 16"><?php } ?>
  <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
</svg></a>
<?php }
 if($contact_row['contact_no4']!=-1)
 {
 ?>
<span class="leftText col-8"><?php echo $contact_row['name4'] ?><span class="rel"><?php echo $contact_row['relation4'] ?></span> </span><a href="tel:7447425397" class="btn rightText col-4"><b><?php echo $contact_row['contact_no4'] ?></b> <?php if($contact_row['contact_no4']){?><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000" class="bi bi-telephone-fill" viewBox="0 0 16 16"><?php } ?>
  <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
</svg></a>
<?php }

 ?>

<?php
                            }
?>
                      
                </div>
            </div>
            <div class="col-7">
                <div class="card3 row gx-3">
                        <span class="header col-12">Professional Information <a class="btn" data-bs-toggle="modal" data-bs-target="#profdata"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                          </svg></a></span> 
                        <hr>
                        <span class="leftText col-4">Experience: </span> <span class="rightText col-8"><b>15 Years </b></span>
                        <span class="leftText col-4">Degrees: </span> <span class="rightText col-8"><b><span class="badge rounded-pill bg-dark">Partially Impaired vision | <form action="" style="margin:0; padding: 0; display: inline;"><a href="" class="btn" style="text-decoration: none; padding: 0; margin: 0; color: #f00;">X</a></form></span> <span class="badge rounded-pill bg-dark">Partially Impaired vision</span> <span class="badge rounded-pill bg-dark">Partially Impaired vision</span> <span class="badge rounded-pill bg-dark">Partially Impaired vision</span></b></span>
                        <span class="leftText col-4">Specialised in: </span>    <span class="rightText col-8"><b><span class="badge rounded-pill bg-success">Partially Impaired vision</span> <span class="badge rounded-pill bg-success">Partially Impaired vision</span> <span class="badge rounded-pill bg-success">Partially Impaired vision</span> <span class="badge rounded-pill bg-success">Partially Impaired vision</span></b></span>
                        <span class="leftText col-4">Other Qualifications: </span>      <span class="rightText col-8"><b><span class="badge rounded-pill bg-dark">Partially Impaired vision</span> <span class="badge rounded-pill bg-dark">Partially Impaired vision</span> <span class="badge rounded-pill bg-dark">Partially Impaired vision</span> <span class="badge rounded-pill bg-dark">Partially Impaired vision</span></b></span>
                        <!-- <span class="leftText col-4">Vaccines: </span>     <span class="rightText col-8"><b><span class="badge rounded-pill bg-primary">Partially Impaired vision</span> <span class="badge rounded-pill bg-primary">Partially Impaired vision</span> <span class="badge rounded-pill bg-primary">Partially Impaired vision</span> <span class="badge rounded-pill bg-primary">Partially Impaired vision</span></b></span>
                        <span class="leftText col-4">Surgeries: </span>    <span class="rightText col-8"><b><span class="badge rounded-pill bg-danger">Partially Impaired vision</span> <span class="badge rounded-pill bg-danger">Partially Impaired vision</span> <span class="badge rounded-pill bg-danger">Partially Impaired vision</span> <span class="badge rounded-pill bg-danger">Partially Impaired vision</span></b></span> -->
                        </div>
            </div>
            <div class="col-5">
             
                <div class="row">
                    <div class="card4 col-12 row">

                        <span class="header col-12">Work Address<a class="btn" data-bs-toggle="modal" data-bs-target="#address"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                          </svg></a></span>
                        <hr>
                         <?php 
                            $fetch_contacts="SELECT * FROM address WHERE doc_id='$doc_id'";
                            $res = pg_query($fetch_contacts);
                            $row = pg_fetch_assoc($res);

                            if(pg_num_rows($res) > 0){
                              ?>
                              <span class="col-3"><?php echo $row['name'];?> :</span>  <span class="col-9"><?php echo $row['address'];?></span> 
                              <?php
                            }
                              ?>
                        
                        
                    </div>
                    <!-- <br> -->
                    <!-- <div class="card4 col-12 row">
                        <span class="header col-12">Insurance Details <a class="btn" data-bs-toggle="modal" data-bs-target="#insurance"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                          </svg></a></span>
                        <hr>
                        <span class="col-7">Insurance Present?</span><span class="col-5">No</span>
                        <span class="col-7">Date of Issue  </span> <span class="col-5">09/03/04</span> 
                        <span class="col-7">Date of Expiry </span> <span class="col-5">08/03/64</span>
                        <span class="col-7">Insurance Company </span> <span class="col-5">Healthcare limited</span>
                    </div> -->
                </div>
                
            </div>
            <span class="col-12 updated">Last updated: 22/9/23</span>

        </div>
        

    </div>
    
    <!-- <div class="card2">
        <hr>
        <span class="text1"><span class="left">Devesh Jain<span class="rel">(Fam)</span></span><span class="right"><b><span>7447425397</span></b></span></span>
        <span class="text1"><span class="left">Hiral Patel<span class="rel">(Fam)</span></span><span class="right"><b><span>7447425397</span></b></span></span>
        <span class="text1"><span class="left">Dhruv Dedhia<span class="rel">(Fri)</span></span><span class="right"><b><span>7447425397</span></b></span></span>
        <span class="text1"><span class="left">Aryan Shirsat<span class="rel">(Doc)</span></span><span class="right"><b><span>7447425397</span></b></span></span>
            
    </div>
    <div class="card3">
        <span class="header">Health Data</span>
        <hr>
        <span class="maintext" >
            <span class="text1"><span class="left">Diabilities: </span><span class="right"><b>Partially Impaired vision, physically impaired</b></span></span>
            <span class="text1"> <span class="left">Allergies:</span> <span class="right"><b>Dust,  Animals, Pollen, Perfumes</b></span></span>
            <span class="text1"><span class="left">Vaccines: </span><span class="right"><b>Covid, Flu, Hepatitis, Chickenpox</b></span></span>
            <span class="text1"><span class="left">Major Surgeries: </span><span class="right"><b>Liver Transplant, Kidney donor, Kidney recipient, Bypass Surgery</b></span></span>
        </span>
        
    </div>  -->

  <!-- Modal -->
  <div class="modal fade" id="profdata" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Health Data</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="">
                <div class="row align-items-center">
                    <!-- <div class="floating-label col-6 input-group"> 
                        <label for="disabilities">Disabilities</label>
                        <select class="choices form-control" id="disabilities" placeholder="" multiple> -->
                    <div class="col-4 formHeading"><h4 class="">Experience</h4></div>
                    <div class="col-7"> 
                        <!-- <label for="name1" class="col-12 ms-0 ps-0"></label>  -->
                        <input class="inp col-12" type="text" id="name1" placeholder="Years of Experience" required>
                    </div>
                
                    <hr class="mt-4" style="width:96%; margin-left: 2%;">
                    <div class="col-3 formHeading"><h4 class="">Disabilities</h4></div>
                    <div class="col-5"> 
                        <label for="disabilities">Search</label>
                        <select class="choices" id="disabilities" placeholder="Search" multiple>
                            <option value="HTML">HTML</option>
                            <option value="Jquery">Jquery</option>
                            <option value="CSS">CSS</option>
                            <option value="Bootstrap 3">Bootstrap 3</option>
                            <option value="Bootstrap 4">Bootstrap 4</option>
                            <option value="Java">Java</option>
                            <option value="Javascript">Javascript</option>
                            <option value="Angular">Angular</option>
                            <option value="Python">Python</option>
                            <option value="Hybris">Hybris</option>
                            <option value="SQL">SQL</option>
                            <option value="NOSQL">NOSQL</option>
                            <option value="NodeJS">NodeJS</option>
                        </select> 
                    </div>
                    <div class="col-4">
                        <label for="name1" class="col-12 ms-0 ps-0">Other</label> 
                        <input class="inp col-12" type="text" id="name1" placeholder="Custom Input" required>
                    </div>
                
                    <hr class="mt-4" style="width:96%; margin-left: 2%;">
                    <div class="col-3 formHeading"><h4 class="">Disabilities</h4></div>
                    <div class="col-5"> 
                        <label for="disabilities">Search</label>
                        <select class="choices" id="disabilities" placeholder="Search" multiple>
                            <option value="HTML">HTML</option>
                            <option value="Jquery">Jquery</option>
                            <option value="CSS">CSS</option>
                            <option value="Bootstrap 3">Bootstrap 3</option>
                            <option value="Bootstrap 4">Bootstrap 4</option>
                            <option value="Java">Java</option>
                            <option value="Javascript">Javascript</option>
                            <option value="Angular">Angular</option>
                            <option value="Python">Python</option>
                            <option value="Hybris">Hybris</option>
                            <option value="SQL">SQL</option>
                            <option value="NOSQL">NOSQL</option>
                            <option value="NodeJS">NodeJS</option>
                        </select> 
                    </div>
                    <div class="col-4">
                        <label for="name1" class="col-12 ms-0 ps-0">Other</label> 
                        <input class="inp col-12" type="text" id="name1" placeholder="Custom Input" required>
                    </div>
                
                    <hr class="mt-4" style="width:96%; margin-left: 2%;">
                    <div class="col-3 formHeading"><h4 class="">Disabilities</h4></div>
                    <div class="col-5"> 
                        <label for="disabilities">Search</label>
                        <select class="choices" id="disabilities" placeholder="Search" multiple>
                            <option value="HTML">HTML</option>
                            <option value="Jquery">Jquery</option>
                            <option value="CSS">CSS</option>
                            <option value="Bootstrap 3">Bootstrap 3</option>
                            <option value="Bootstrap 4">Bootstrap 4</option>
                            <option value="Java">Java</option>
                            <option value="Javascript">Javascript</option>
                            <option value="Angular">Angular</option>
                            <option value="Python">Python</option>
                            <option value="Hybris">Hybris</option>
                            <option value="SQL">SQL</option>
                            <option value="NOSQL">NOSQL</option>
                            <option value="NodeJS">NodeJS</option>
                        </select> 
                    </div>
                    <div class="col-4">
                        <label for="name1" class="col-12 ms-0 ps-0">Other</label> 
                        <input class="inp col-12" type="text" id="name1" placeholder="Custom Input" required>
                    </div>
                
                    <hr class="mt-4" style="width:96%; margin-left: 2%;">
                    <div class="col-3 formHeading"><h4 class="">Disabilities</h4></div>
                    <div class="col-5"> 
                        <label for="disabilities">Search</label>
                        <select class="choices" id="disabilities" placeholder="Search" multiple>
                            <option value="HTML">HTML</option>
                            <option value="Jquery">Jquery</option>
                            <option value="CSS">CSS</option>
                            <option value="Bootstrap 3">Bootstrap 3</option>
                            <option value="Bootstrap 4">Bootstrap 4</option>
                            <option value="Java">Java</option>
                            <option value="Javascript">Javascript</option>
                            <option value="Angular">Angular</option>
                            <option value="Python">Python</option>
                            <option value="Hybris">Hybris</option>
                            <option value="SQL">SQL</option>
                            <option value="NOSQL">NOSQL</option>
                            <option value="NodeJS">NodeJS</option>
                        </select> 
                    </div>
                    <div class="col-4">
                        <label for="name1" class="col-12 ms-0 ps-0">Other</label> 
                        <input class="inp col-12" type="text" id="name1" placeholder="Custom Input" required>
                    </div>
                
                    <hr class="mt-4" style="width:96%; margin-left: 2%;">
                    <div class="col-3 formHeading"><h4 class="">Disabilities</h4></div>
                    <div class="col-5"> 
                        <label for="disabilities">Search</label>
                        <select class="choices" id="disabilities" placeholder="Search" multiple>
                            <option value="HTML">HTML</option>
                            <option value="Jquery">Jquery</option>
                            <option value="CSS">CSS</option>
                            <option value="Bootstrap 3">Bootstrap 3</option>
                            <option value="Bootstrap 4">Bootstrap 4</option>
                            <option value="Java">Java</option>
                            <option value="Javascript">Javascript</option>
                            <option value="Angular">Angular</option>
                            <option value="Python">Python</option>
                            <option value="Hybris">Hybris</option>
                            <option value="SQL">SQL</option>
                            <option value="NOSQL">NOSQL</option>
                            <option value="NodeJS">NodeJS</option>
                        </select> 
                    </div>
                    <div class="col-4">
                        <label for="name1" class="col-12 ms-0 ps-0">Other</label> 
                        <input class="inp col-12" type="text" id="name1" placeholder="Custom Input" required>
                    </div>
                
                    <hr class="mt-4" style="width:96%; margin-left: 2%;">
                    
                </div>
            </form>
            
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" name="healthdata" class="btn btn-success">Submit</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  

  <div class="modal fade" id="bloodGroup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Blood Group</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="">
                <div class="form-floating">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                      <option selected hidden disabled>---</option>
                      <option value="1">O +ve</option>
                      <option value="1">O -ve</option>
                      <option value="1">A +ve</option>
                      <option value="1">A -ve</option>
                      <option value="1">B +ve</option>
                      <option value="1">B -ve</option>
                      <option value="1">AB +ve</option>
                      <option value="1">AB -ve</option>
                      
                    </select>
                    <label for="floatingSelect">Blood Group</label>
                  </div>
            </form>
            
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" name="bloodgroup" class="btn btn-success">Submit</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="updateContacts" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Contact Details</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="" method="POST">
                <div class="row">
                    <div class="form-floating mb-3 col-5">
                        <input type="text" class="form-control" id="name1" placeholder="John Wick" name="name1" required>
                        <label for="name1" class="ms-3">Name</label>
                    </div>
                    <!-- <div class="form-floating col-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="relation1" required>
                          <option selected hidden disabled>---</option>
                          <option value="1">Hospital</option>
                          <option value="2">Clinic</option>
                          <option value="3">Personal</option>
                        </select>
                        <label for="floatingSelect" class="ms-3">Relation</label>
                      </div> -->
                    <div class="form-floating mb-3 col-4">
                        <input type="number" class="form-control" id="floatingInput" placeholder="0000000000" name="contact1" required>
                        <label for="num1" class="ms-3">Contact</label>
                    </div>
                    <div class="form-floating mb-3 col-5">
                        <input type="text" class="form-control" id="name1"  name="name2" placeholder="John Wick">
                        <label for="name1" class="ms-3">Name</label>
                    </div>
                    <!-- <div class="form-floating col-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                          <option selected hidden disabled>---</option>
                          <option value="1">Hospital</option>
                          <option value="2">Clinic</option>
                          <option value="3">Personal</option>
                        </select>
                        <label for="floatingSelect" class="ms-3">Relation</label>
                      </div> -->
                    <div class="form-floating mb-3 col-4">
                        <input type="number" class="form-control" id="floatingInput" name="contac2"  placeholder="0000000000">
                        <label for="num1" class="ms-3">Contact</label>
                    </div>
                    <div class="form-floating mb-3 col-5">
                        <input type="text" class="form-control" id="name1"  name="name3"placeholder="John Wick">
                        <label for="name1" class="ms-3">Name</label>
                    </div>
                    <!-- <div class="form-floating col-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                          <option selected hidden disabled>---</option>
                          <option value="1">Hospital</option>
                          <option value="2">Clinic</option>
                          <option value="3">Personal</option>
                        </select>
                        <label for="floatingSelect" class="ms-3">Relation</label>
                      </div> -->
                    <div class="form-floating mb-3 col-4">
                        <input type="number" class="form-control" id="floatingInput" name="contact3" placeholder="0000000000">
                        <label for="num1" class="ms-3">Contact</label>
                    </div>
                    <div class="form-floating mb-3 col-5">
                        <input type="text" class="form-control" id="name1" name="name4" placeholder="John Wick">
                        <label for="name1" class="ms-3">Name</label>
                    </div>
                    <!-- <div class="form-floating col-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                          <option selected hidden disabled>---</option>
                          <option value="1">Hospital</option>
                          <option value="2">Clinic</option>
                          <option value="3">Personal</option>
                        </select>
                        <label for="floatingSelect" class="ms-3">Relation</label>
                      </div> -->
                    <div class="form-floating mb-3 col-4">
                        <input type="number" class="form-control" id="floatingInput"  name="contact4"placeholder="0000000000">
                        <label for="num1" class="ms-3">Contact</label>
                    </div>
                </div>
            <!-- </form> -->
            
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" name="mycontact_submit" class="btn btn-success">Submit</button>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="address" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Work Address Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-4">
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="name1" placeholder="John Wick" name="name" required>
                            <label for="name1">Name</label>
                          </div>
                        </div>
                        <div class="col-8">
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="name1" placeholder="John Wick" name="address" required>
                            <label for="name1">Address</label>
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="workAddress" class="btn btn-success">Submit</button>
                  </div>
                </form>
        </div>
    </div>
</div>

<!-- <div class="modal fade" id="insurance" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Insurance</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="">
          <div class="row align-items-center">
            <div class="col-6">
              <div class="form-floating mt-3">
                <select class="form-select" id="insurancePresent" aria-label="Insurance Present?">
                  <option selected hidden disabled>---</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
              </select>
              <label for="insurancePresent">Insurance Present?</label>
              </div>
            </div>
            
          <div class="col-6">
            <div class="form-floating mt-3">
              <input type="date" class="form-control" id="dateOfIssue" placeholder="Date of Issue">
              <label for="dateOfIssue">Date of Issue</label>
          </div>
          </div>

          <div class="col-5">
            <div class="form-floating mt-3">
              <input type="date" class="form-control" id="dateOfExpiry" placeholder="Date of Expiry">
              <label for="dateOfExpiry">Date of Expiry</label>
          </div>
          </div>
          
          <div class="col-7">
            <div class="form-floating mt-3">
              <input type="text" class="form-control" id="policyNumber" placeholder="Policy Number">
              <label for="policyNumber">Policy Number</label>
          </div>
          </div>
          
          <div class="col-12">
            <div class="form-floating mt-3">
              <input type="text" class="form-control" id="insuranceCompany" placeholder="Insurance Company">
              <label for="insuranceCompany">Insurance Company</label>
          </div>
          </div>
          <div class="col-12">
            <div class="form-floating mt-3">
              <select class="form-select" id="coverageType" aria-label="Coverage Type">
                  <option selected hidden disabled>---</option>
                  <option value="individual">Individual</option>
                  <option value="family">Family</option>
                  <option value="group">Group</option>
              </select>
              <label for="coverageType">Coverage Type</label>
         </div>
          </div>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" name="bloodgroup" class="btn btn-success">Submit</button>
      </form>
      </div>
    </div>
  </div>
</div> -->
<script>
    $(document).ready(function(){
    
    var multipleCancelButton = new Choices('.choices', {
       removeItemButton: true,
       maxItemCount:1000,
       searchResultLimit:5,
       renderChoiceLimit:5
     });   
});
</script>
</body>
</html>
<?php
pg_close();
?>