<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reach out to us!</title>
    <link rel="stylesheet" href="CSS/contactus.css">
    <script src="https://kit.fontawesome.com/d0890909e1.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include('./components/header.php') ?>

    <!-- main page -->
    <div class="aboutusform">
        <form action="#" class="abtus">
            <div class="field" >
                <input type="text" placeholder="Enter your name" required>                
            </div>
            <div class="field">
                <input type="text" placeholder="Enter your mail id" required>
            </div>
            <div class="field">
                <input type="text" placeholder="What is it about?" required>
            </div>
            <div class="field" id="messagebox">
                <input type="text" placeholder="How can we help you?" required>
            </div>
            <div class="field btn">
                <div class="btn-layer"></div>
                <input type="submit" value="SUBMIT">
            </div>
        </form>
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3770.792650630225!2d72.89735127474789!3d19.072852052072335!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c627a20bcaa9%3A0xb2fd3bcfeac0052a!2sK.%20J.%20Somaiya%20College%20of%20Engineering!5e0!3m2!1sen!2sin!4v1695484978062!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    
    <?php include('./components/footer.php') ?>
</body>
</html>
