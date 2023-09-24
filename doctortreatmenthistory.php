<?php session_start();
  include('./connection.php');
  include('./decryptnew.php');
if($_SESSION['role']=='patient')
    {
        header("Location:dash.php");
    }?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />

    <title>Patient History</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
    <!-- <link rel="stylesheet" href="../CSS/bootstrap.min.css"> -->
    <!-- using an offline copy saves time spent for loading bootstrap from online source  -->
    <!-- <link rel="stylesheet" href="./CSS/styles.css" /> -->
    <link rel="stylesheet" href="./CSS/doctortreatmenthistory.css" />
    <!-- <link rel="stylesheet" href="./CSS/variables.css" /> -->
  </head>
  <body style="background-color: #f8f9fc; overflow-x: hidden">
  <?php include('./components/sidebar.php') ?>

    <h2 class="head">DOCTOR TREATMENT HISTORY</h2>

    <div class="container1" style="left: 100px; width: calc(100% - 100px)">
      <div
        class="row col-lg-12 card card-body table-card table-responsive"
        id="top"
      >
        <table class="mb-0">
          <thead>
            <tr>
              <!-- HEADINGS -->
              <th scope="col">Appointment Date</th>
              <th scope="col">Patient Name</th>
              <th scope="col">Patient ID</th>
              <th scope="col">Reason of Visit</th>
              <th scope="col">Disease / Injury</th>
              <th scope="col">Medicines Prescribed</th>
              <th scope="col">Treatment</th>
            </tr>
          </thead>
          <?php 
              $pid = $_SESSION['id'];
              $dec_pid = decrypt($pid,$cipher,$key,$ivlen,$iv);
              $query = "SELECT * FROM past_medical_history WHERE doc_id LIKE '%$dec_pid%'";
              $res = pg_query($query);
              while($row = pg_fetch_assoc($res)){
                  ?>
                <tr class="tr">
                  <td><?php echo $row['ap_date'] ?></td>
                  <td><?php echo $row['patient'] ?></td>
                  <td><?php echo $row['pid'] ?></td>
                  <td><?php echo $row['purpose'] ?></td>
                  <td><?php echo $row['diagnose'] ?></td>
                  <td><?php echo $row['medicines'] ?></td>
                  <td><?php echo $row['treatment'] ?></td>
                </tr>
                <?php
              }

            ?>        
        </table>
      </div>
    </div>
  </body>
</html>
<?php
pg_close();
?>