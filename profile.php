<?php
  session_start();
  include('./connection.php');
  if(isset($_POST['contact_submit'])){
    $phone_no = $_SESSION['user'];
    $query = "SELECT * FROM signup WHERE mobile_no = '$phone_no'";    
    $res = pg_query($query);
    $row = pg_fetch_assoc($res);
    $pid = $row['id'];


    $name1 = $_POST['name1'];
    $relation1 = $_POST['relation1'];
    $contact1 = $_POST['contact1'];
    $query = "INSERT INTO emergency_contacts (pid, name, relation, contact_no) VALUES ('$pid', '$name1', '$relation1', '$contact1')";    
    $res = pg_query($query);
    if(!$res){
      echo 'Failed to Add Emergency Contacts';
    }

    if(isset($_POST['name2']) && isset($_POST['relation2']) && isset($_POST['contact2'])){
      $name2 = $_POST['name2'];
      $relation2 = $_POST['relation2'];
      $contact2 = $_POST['contact2'];
      $query = "INSERT INTO emergency_contacts (pid, name, relation, contact_no) VALUES ('$pid', '$name2', '$relation2', '$contact2')";    
      $res = pg_query($query);
      if(!$res){
        echo 'Failed to Add Emergency Contacts';
      }
    }

    if(isset($_POST['name3']) && isset($_POST['relation3']) && isset($_POST['contact3'])){
      $name3 = $_POST['name3'];
      $relation3 = $_POST['relation3'];
      $contact3 = $_POST['contact3']; 
      $query = "INSERT INTO emergency_contacts (pid, name, relation, contact_no) VALUES ('$pid', '$name3', '$relation3', '$contact3')";    
      $res = pg_query($query);
      if(!$res){
        echo 'Failed to Add Emergency Contacts';
      }
    }

    if(isset($_POST['name4']) && isset($_POST['relation4']) && isset($_POST['contact4'])){
      $name4 = $_POST['name4'];
      $relation4 = $_POST['relation4'];
      $contact4 = $_POST['contact4'];
      $query = "INSERT INTO emergency_contacts (pid, name, relation, contact_no) VALUES ('$pid', '$name4', '$relation4', '$contact4')";    
      $res = pg_query($query);
      if(!$res){
        echo 'Failed to Add Emergency Contacts';
      }
    }

    // exit();
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
    <link rel="stylesheet" href="CSS/profile.css">

</head>
<body>
  <?php
  include('./components/sidebar.php')?>
    <Button><a href="login.html">Login</a></Button>
    <Button><a href="signup.html">Signup</a></Button>
    <Button><a href="dash.html">Dash</a></Button>
    <Button><a href="profile.html">Profile</a></Button>
    <h1 class="head">PID Card</h1>
    <div class="photo">
        <img src="./Assets/profileimg.png" alt="Profile" class="profileimg">
    </div>
    <div class="container1 container gx-3">
        <div class="row">
            <div class="col-lg-7 col-12">

                <div class="card1 row gx-3">
                    
                        <span class="name">Praneel Tejpal Bora</span>
                        <span class="leftText col-4">PID: </span><span class="rightText col-8"><b>192512351231</b></span>
                        <span class="leftText col-4">Gender: </span><span class="rightText col-8"><b>Male</b></span>
                        <span class="leftText col-4">Age: </span><span class="rightText col-8"><b>19</b></span>
                        <span class="leftText col-4">Blood Grp: </span><span class="rightText col-8"><b>O-ve</b> <a class="btn" data-bs-toggle="modal" data-bs-target="#bloodgroup"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                          </svg></a></span>

                </div>
            </div>
            
            <div class="col-lg-5 col-12">
                <div class="card2 row gx-3">
                        <span class="header col-12">Emergency Contacts  <a class="btn" data-bs-toggle="modal" data-bs-target="#updateContacts"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                          </svg></a></span>
                        <hr>
                        <span class="leftText col-8">Devesh Jain: <span class="rel">(Fam)</span> </span><a href="tel:7447425397" class="btn rightText col-4"><b>7447425397</b> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000" class="bi bi-telephone-fill" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
</svg></a>
                        <span class="leftText col-8">Hiral Patel: <span class="rel">(Fam)</span> </span><a href="tel:7447425397" class="btn rightText col-4"><b>7447425397</b> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000" class="bi bi-telephone-fill" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
</svg></a>
                        <span class="leftText col-8">Dhruv Dedhia:<span class="rel">(Frnd)</span> </span><a href="tel:7447425397" class="btn rightText col-4"><b>7447425397</b> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000" class="bi bi-telephone-fill" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
</svg></a>
                        <span class="leftText col-8">Aryan Shirsat:<span class="rel">(Doc)</span> </span><a href="tel:7447425397" class="btn rightText col-4"><b>7447425397</b> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000" class="bi bi-telephone-fill" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
</svg></a>
                </div>
            </div>
            <div class="col-8">
                <div class="card3 row gx-3">
                        <span class="header col-12">Health Data <a class="btn" data-bs-toggle="modal" data-bs-target="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                          </svg></a></span>
                        <hr>
                        <span class="leftText col-4">Disabilities: </span><span class="rightText col-8"><b><span class="badge rounded-pill bg-dark">Partially Impaired vision</span> <span class="badge rounded-pill bg-dark">Partially Impaired vision</span> <span class="badge rounded-pill bg-dark">Partially Impaired vision</span> <span class="badge rounded-pill bg-dark">Partially Impaired vision</span></b></span>
                        <span class="leftText col-4">Illness: </span><span class="rightText col-8"><b><span class="badge rounded-pill bg-dark">Partially Impaired vision</span> <span class="badge rounded-pill bg-dark">Partially Impaired vision</span> <span class="badge rounded-pill bg-dark">Partially Impaired vision</span> <span class="badge rounded-pill bg-dark">Partially Impaired vision</span></b></span>
                        <span class="leftText col-4">Allergies: </span><span class="rightText col-8"><b><span class="badge rounded-pill bg-success">Partially Impaired vision</span> <span class="badge rounded-pill bg-success">Partially Impaired vision</span> <span class="badge rounded-pill bg-success">Partially Impaired vision</span> <span class="badge rounded-pill bg-success">Partially Impaired vision</span></b></span>
                        <span class="leftText col-4">Vaccines: </span><span class="rightText col-8"><b><span class="badge rounded-pill bg-primary">Partially Impaired vision</span> <span class="badge rounded-pill bg-primary">Partially Impaired vision</span> <span class="badge rounded-pill bg-primary">Partially Impaired vision</span> <span class="badge rounded-pill bg-primary">Partially Impaired vision</span></b></span>
                        <span class="leftText col-4">Major Surgeries: </span><span class="rightText col-8"><b><span class="badge rounded-pill bg-danger">Partially Impaired vision</span> <span class="badge rounded-pill bg-danger">Partially Impaired vision</span> <span class="badge rounded-pill bg-danger">Partially Impaired vision</span> <span class="badge rounded-pill bg-danger">Partially Impaired vision</span></b></span>
                        <span class="leftText col-4">Medications: </span><span class="rightText col-8"><b><span class="badge rounded-pill bg-danger">Partially Impaired vision</span> <span class="badge rounded-pill bg-danger">Partially Impaired vision</span> <span class="badge rounded-pill bg-danger">Partially Impaired vision</span> <span class="badge rounded-pill bg-danger">Partially Impaired vision</span></b></span>
                        <span class="leftText col-4">Birthmarks: </span><span class="rightText col-8"><b><span class="badge rounded-pill bg-danger">Partially Impaired vision</span> <span class="badge rounded-pill bg-danger">Partially Impaired vision</span> <span class="badge rounded-pill bg-danger">Partially Impaired vision</span> <span class="badge rounded-pill bg-danger">Partially Impaired vision</span></b></span>
                        </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="card4 col-12 row">
                        <span class="header col-12">Emergency Instructions <a class="btn" data-bs-toggle="modal" data-bs-target="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                          </svg></a></span>
                        <hr>
                        <span class="col-6">Resusitate</span>         <span class="col-6">No</span>
                        <span class="col-6">Organ Donor ()  </span>   <span class="col-6">Unknown</span> 
                        <span class="col-6">Organ Donor (Yes) </span> <span class="col-6">Verified</span>
                        <span class="col-6">Organ Donor (No) </span>  <span class="col-6">Verified</span>
                        <span class="col-6">Blood Transfusion </span> <span class="col-6">Allergic</span>
                        <span class="col-6">Anesthetic </span>        <span class="col-6">Possible Allergic</span>
                        
                    </div>
                    <br>
                    <div class="card4 col-12 row">
                        <span class="header col-12">Insurance Details <a class="btn" data-bs-toggle="modal" data-bs-target="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                          </svg></a></span>
                        <hr>
                        <span class="col-7">Insurance Present?</span><span class="col-5">No</span>
                        <span class="col-7">Date of Issue  </span> <span class="col-5">09/03/04</span> 
                        <span class="col-7">Date of Expiry </span> <span class="col-5">08/03/64</span>
                        <span class="col-7">Insurance Company </span> <span class="col-5">Healthcare limited</span>
                    </div>
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
  <div class="modal fade" id="bloodgroup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                    <label for="floatingSelect" class="ms-3">Relation</label>
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
                  <!-- Contact 1 -->
                    <div class="form-floating mb-3 col-5">
                        <input type="text" class="form-control" id="name1" name="name1" placeholder="John Wick" required>
                        <label for="name1" class="ms-3">Name</label>
                    </div>
                    <div class="form-floating col-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="relation1" required>
                          <option selected hidden disabled>---</option>
                           <option value="Fam">Family</option>
                          <option value="Frnd">Friend</option>
                          <option value="Doc">Doctor</option>
                        </select>
                        <label for="floatingSelect" class="ms-3">Relation</label>
                      </div>
                    <div class="form-floating mb-3 col-4">
                        <input type="number" class="form-control" id="floatingInput" placeholder="0000000000" name="contact1" required>
                        <label for="num1" class="ms-3">Contact</label>
                    </div>
                      <!-- Contact 2 -->
                    <div class="form-floating mb-3 col-5">
                        <input type="text" class="form-control" id="name1" name="name2"  placeholder="John Wick">
                        <label for="name1" class="ms-3">Name</label>
                    </div>
                    <div class="form-floating col-3">
                        <select class="form-select" id="floatingSelect"  name="relation2" aria-label="Floating label select example">
                          <option selected hidden disabled>---</option>
                           <option value="Fam">Family</option>
                          <option value="Frnd">Friend</option>
                          <option value="Doc">Doctor</option>
                        </select>
                        <label for="floatingSelect" class="ms-3">Relation</label>
                      </div>
                    <div class="form-floating mb-3 col-4">
                        <input type="number" class="form-control" id="floatingInput" name="contact2"  placeholder="0000000000">
                        <label for="num1" class="ms-3">Contact</label>
                    </div>
                      <!-- Contact 3 -->
                    <div class="form-floating mb-3 col-5">
                        <input type="text" class="form-control" id="name1" name="name3"  placeholder="John Wick">
                        <label for="name1" class="ms-3">Name</label>
                    </div>
                    <div class="form-floating col-3">
                        <select class="form-select" id="floatingSelect"  name="relation3" aria-label="Floating label select example">
                          <option selected hidden disabled>---</option>
                          <option value="Fam">Family</option>
                          <option value="Frnd">Friend</option>
                          <option value="Doc">Doctor</option>
                        </select>
                        <label for="floatingSelect" class="ms-3">Relation</label>
                      </div>
                    <div class="form-floating mb-3 col-4">
                        <input type="number" class="form-control" id="floatingInput" name="contact3"  placeholder="0000000000">
                        <label for="num1" class="ms-3">Contact</label>
                    </div>
                      <!-- Contact 4 -->
                    <div class="form-floating mb-3 col-5">
                        <input type="text" class="form-control" id="name1"  name="name4" placeholder="John Wick">
                        <label for="name1" class="ms-3">Name</label>
                    </div>
                    <div class="form-floating col-3">
                        <select class="form-select" id="floatingSelect"  name="relation4" aria-label="Floating label select example">
                          <option selected hidden disabled>---</option>
                          <option value="Fam">Family</option>
                          <option value="Frnd">Friend</option>
                          <option value="Doc">Doctor</option>
                        </select>
                        <label for="floatingSelect" class="ms-3">Relation</label>
                      </div>
                    <div class="form-floating mb-3 col-4">
                        <input type="number" class="form-control" id="floatingInput"  name="contact4" placeholder="0000000000">
                        <label for="num1" class="ms-3">Contact</label>
                    </div>
                </div>
            <!-- </form> -->
            
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" name="contact_submit" class="btn btn-success"><input type="submit" name="contact_submit" hidden>Submit</button>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>