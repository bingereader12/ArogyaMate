 <!-- Header -->
 
    <header>
        <div class="navContainer flex">
            <div class="navlogo">
                <a href="index.php"><img class="logoimg" src="img/logo.png" alt="logo"></a>
            </div>
            <div class="navlinks">
                <ul class="navItems flex">
                    <li><a class="alink" href="index.php">Home</a></li>
                    <li><a class="alink" href="explore.php">Explore</a></li>
                    <li><a class="alink" href="contacts.php">Emergency</a></li>
                    <li><a class="alink" href="contactus.php">Help</a></li>
                    <li><a class="alink" href="chatbot.html">Chat Bot</a></li>
                    <li><a class="alink" href="disease-prediction1.php">Disease Prediction</a></li>
                </ul>
            </div>
            <div class="navlogin">
                <?php 
                session_start();
                if(isset($_SESSION['loggedin'])){

                    if($_SESSION['loggedin'] == false){
                        ?>
                    <button class="loginButton"><a class="links" href="login.php">LOGIN</a></button>
                    <?php
                }else{
                    ?>
                    <button class="loginButton"><a class="links" href="dash.php">Dashboard</a></button>
                    <?php
                }
            }else{
                    ?>
                    <button class="loginButton"><a class="links" href="login.php">LOGIN</a></button>
                    <?php 
            }

                ?> 
            </div>
        </div>
    </header>
