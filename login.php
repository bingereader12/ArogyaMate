<?php 

// if(isset($_SESSION['loggedin']))
//     {
//       if($_SESSION['loggedin']==true)
//       {
//         if($_SESSION['role']=='patient')
//         {
//           header("Location:dash.php");


//         }
//         else
//         {
//           if($_SESSION['curr']=='doctor')
//           {
//             header("Location:doctordash.php");
//           }
//           else
//           {
//             header("Location:dash.php");
//           }
//         }
//       }
//       else
//       {
//         header("Location:logout.php");


//       }
//     }

    session_start();
    include('./connection.php');

    if (isset($_POST['login_btn'])) {

        $phone_no = $_POST['phone_no'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM signup WHERE mobile_no = '$phone_no'";
        $res = pg_query($sql);
        $rows = pg_num_rows($res);

        if ($rows == 1) {
            $row = pg_fetch_assoc($res);
            if(password_verify($password,$row['password'])){
                $pid=$row['id'];
                $_SESSION['user'] = $phone_no;
                $result=pg_query("SELECT * FROM signup where id='$pid'");
                $fetch=pg_fetch_assoc($result);
                $_SESSION['id'] = $row['id'];
                $_SESSION['loggedin']=true;
                if($fetch['doctor_reg']>0)
                {
                  $_SESSION['role']='doctor';
                  $_SESSION['curr']='doctor';
                  header("Location:./doctordash.php");
                }
              else{
                $_SESSION['role']='patient';

                header("Location:./dash.php");
              } 
                
            }else{
            echo "<script>alert('Password doesnt match');</script>";
            }
        }else{
        echo "<script>alert('Phone No. doesnt match');</script>";
        }
    }


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <title>Login</title>
    <link rel="stylesheet" href="./CSS/login.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>

  <body>
    <div class="pagecontainer">
      <img src="img/login.svg" alt="login" class="custom-image" />
      <div class="wrapper">
        <div class="title-text">
          <div class="title login">Login</div>
          <div class="title signup">Signup</div>
        </div>
        <div class="form-container">
          <div class="slide-controls">
            <input type="radio" name="slide" id="login" checked />
            <input type="radio" name="slide" id="signup" />
            <label for="login" class="slide login">Login</label>
            <label for="signup" class="slide signup">Signup</label>
            <div class="slider-tab"></div>
          </div>
          <div class="form-inner">
            <form action="login.php" method="POST" class="login">
              <div class="field">
                <input type="number" placeholder="Phone Number" name="phone_no" required />
              </div>
              <div class="field">
                <input type="password" placeholder="Password" name="password" required />
              </div>
              <div class="field btn">
                <div class="btn-layer"></div>
                <input type="submit" value="Login" name="login_btn" />
              </div>
              <div class="signup-link">
                Not a member? <a href="">Signup now</a>
              </div>
            </form>
            <form action="signup.php" method="POST" class="signup">
              <div class="field">
                <input
                  type="text"
                  placeholder="Aadhar Number"
                  name="aadhar_no"
                  id="aadhar_no"
                  required
                />
              </div>
              <div class="field">
                <input
                  type="number"
                  placeholder="Phone Number"
                  name="phone_no"
                  id="phone_no"
                  required
                />
              </div>
              <select class="choice" name="choose" id="choose">
                <option value="seeker">Healthcare Seeker</option>
                <option value="provider">Healthcare Provider</option>
              </select>
              <div class="field btn">
                <div class="btn-layer"></div>
                <input type="submit" value="Generate PID" name="signup_btn" />
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="svgcontainer" style="width: 1528px">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 1000 100"
        preserveAspectRatio="none"
      >
        <path
          class="elementor-shape-fill"
          opacity="0.33"
          d="M473,67.3c-203.9,88.3-263.1-34-320.3,0C66,119.1,0,59.7,0,59.7V0h1000v59.7 c0,0-62.1,26.1-94.9,29.3c-32.8,3.3-62.8-12.3-75.8-22.1C806,49.6,745.3,8.7,694.9,4.7S492.4,59,473,67.3z"
        ></path>
        <path
          class="elementor-shape-fill"
          opacity="0.66"
          d="M734,67.3c-45.5,0-77.2-23.2-129.1-39.1c-28.6-8.7-150.3-10.1-254,39.1 s-91.7-34.4-149.2,0C115.7,118.3,0,39.8,0,39.8V0h1000v36.5c0,0-28.2-18.5-92.1-18.5C810.2,18.1,775.7,67.3,734,67.3z"
        ></path>
        <path
          class="elementor-shape-fill"
          d="M766.1,28.9c-200-57.5-266,65.5-395.1,19.5C242,1.8,242,5.4,184.8,20.6C128,35.8,132.3,44.9,89.9,52.5C28.6,63.7,0,0,0,0 h1000c0,0-9.9,40.9-83.6,48.1S829.6,47,766.1,28.9z"
        ></path>
      </svg>
    </div>
    <div class="blank"></div>

    <script>
      const loginText = document.querySelector(".title-text .login");
      const loginForm = document.querySelector("form.login");
      const loginBtn = document.querySelector("label.login");
      const signupBtn = document.querySelector("label.signup");
      const signupLink = document.querySelector("form .signup-link a");
      signupBtn.onclick = () => {
        loginForm.style.marginLeft = "-50%";
        loginText.style.marginLeft = "-50%";
      };
      loginBtn.onclick = () => {
        loginForm.style.marginLeft = "0%";
        loginText.style.marginLeft = "0%";
      };
      signupLink.onclick = () => {
        signupBtn.click();
        return false;
      };
    </script>
  </body>
</html>
<?php
    pg_close($conn);
?>