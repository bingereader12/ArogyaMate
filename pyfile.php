<!DOCTYPE html>
<html>
<head>
    <title>Python Script Execution</title>
</head>
<body>

    <?php

    if(isset($_POST['submit'])){
        $S1 = $_POST['S1'];
        $S2 = $_POST['S2'];
        $S3 = $_POST['S3'];

        // Execute the Python script with input values
        $pythonScriptPath = "C:\\xampp\\htdocs\\sih\\dp.py"; // Updated path with double backslashes

        // Construct the command to run the Python script with inputs
        $command = "python $pythonScriptPath $S1 $S2 $S3"; // Removed "3" from python3

        // Execute the command and capture the output
        $output = shell_exec($command);

        // Display the output from the Python script
        // echo "<h2>Python Script Output:</h2>";
        // echo "<pre>$output</pre>";
    }
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/836cf00832.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/dp.css">
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disease Predictive Page</title>
    <style>
        /* Center text horizontally and vertically */
        .centered-text {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            text-align: center;
            font-size: 25px; /* Adjust the font size as needed */
        }

        /* Add any additional CSS styles here */
    </style>
</head>

<body>
    <?php include('./components/header.php') ?>
    <section class="main-section-container">
        <!-- Add the heading above the text -->
        <h1>Display Prediction</h1>

        <div class="containers">
            <!-- Display the Python script output in the center of the container -->
            <div class="information centered-text">
                <?php echo $output; ?>
            </div>
            <div class="information centered-text">
                <?php 
                include('connection.php');

                $out = strval(trim($output));
                $sql = "SELECT info FROM disease WHERE disease LIKE '%$out%'";
                $res = pg_query($conn , $sql);
                $rows = pg_num_rows($res);

                    while($row = pg_fetch_assoc($res)){
                    echo $row['info'];
                    }
                
                
                ?>
            </div>
        </div>
        <div class="submit-button-container">
                <button class="button1 larger-button"><a href="dp.php">BACK</a></button>
            </div>
    </section>
</body>

</html>

