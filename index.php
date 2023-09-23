<?php
    session_start();
    include('./connection.php');
// if(!isset($_SESSION))
// {
//     header("Location:login.php");
// }
    pg_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>INDEX.PHP</div>
</body>
</html>