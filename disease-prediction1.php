<!DOCTYPE html>
<html lang="en">
  <head>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <script
      src="https://kit.fontawesome.com/836cf00832.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="CSS/disease-prediction.css" />
    <link rel="stylesheet" href="CSS/header-footer.css" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Disease Predictive Page</title>
  </head>

  <body>
   <?php include('./components/header.php') ?>
    <!-- main page -->
    <div class="mainContainer">
      <div class="HelloContainer"></div>
      <div class="WelcomeContainer flex">
        <div class="imageContainer">
          <img class="docimage" src="img/predict.svg" />
        </div>
        <div class="container">
          <h1>Terms & Conditions</h1>
          <div class="terms">
            <ul>
              <li>
                Checkup is not a diagnosis. Checkup is for informational
                purposes and is not a qualified medical opinion.
              </li>
              <li>
                Do not use in emergencies. In case of a health emergency, call
                your local emergency number immediately.
              </li>
              <li>
                Your data is safe. Information that you provide is anonymous and
                not shared with anyone.
              </li>
            </ul>
          </div>
          <div class="accept">
            <label>
              <input type="checkbox" id="acceptTerms" /> I read and accept Terms
              of Service and Privacy Policy.
            </label>
          </div>
          <button class="button1" id="proceedBtn" disabled>
            <a class="links" href="dp.php">PROCEED</a>
          </button>
        </div>
      </div>
    </div>
    <script>
      function PROCEED() {
        const acceptTermsCheckbox = document.getElementById("acceptTerms");
        if (acceptTermsCheckbox.checked) {
          // The checkbox is checked, you can proceed with the action here.
          alert("Proceeding...");
        } else {
          alert("Please accept the Terms & Conditions to proceed.");
        }
      }
    </script>
  </body>
</html>
