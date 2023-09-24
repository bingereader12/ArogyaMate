<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/836cf00832.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/homepage.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>

<body>

    <!-- main page -->
    <?php include('./components/header.php')?>
    <div class="mainContainer">
        <div class="HelloContainer"></div>
        <div class="WelcomeContainer flex">
            <div class="textContainer">
                <h1><b>Welcome to <em>ArogyaMate!</em></b></h1>
                <p class="p">Empowering Your Health Journey, Your All in One Healthcare Companion.</p>
            </div>
            <div class="imageContainer">
                <img class="docimage" src="img/home.svg">
            </div>
        </div>
    </div>
    <?php include('./components/footer.php')?>

</body>

</html>
<?php
    pg_close();
?>