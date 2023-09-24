<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/836cf00832.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/explore1.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Options Page</title>
</head>

<body>

    <?php include('./components/header.php')?>

    <!-- main page -->
    <main>
        <section class="options-container flex">
            <!-- Emergency Contacts Option -->
            <a class="option-button" href="communities.html">
                <div class="option">
                    <h2>Communities</h2>
                    <p>
                        In case of emergencies, here are some important community links numbers you should keep handy.
                    </p>
                </div>
            </a>

            <!-- Government Schemes Option -->
            <a class="option-button" href="governmentschemes.php">
                <div class="option">
                    <h2>Government Schemes</h2>
                    <p>
                        Explore various government healthcare schemes and initiatives that can benefit you and your family.
                    </p>
                </div>
            </a>

            <!-- Helpline Numbers Option -->
            <a class="option-button" href="contacts.php">
                <div class="option">
                    <h2>Helpline Numbers</h2>
                    <p>
                        Here are some important helpline numbers for healthcare-related inquiries and support.
                    </p>
                </div>
            </a>
        </section>
    </main>

    <?php include('./components/footer.php')?>
</body>

</html>
