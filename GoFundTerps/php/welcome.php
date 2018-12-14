<?php
$link_address = "login.php";
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    echo "You must be logged in to to access the user control panel. ";
    echo '<a href="'.$link_address.'">Click here to login.</a>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Control Panel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body {
          font: 14px sans-serif; text-align: center; 
        }

    </style>
</head>
<body>
    <div class="page-header">
        <h1>GoFundTerps User Control Panel</h1>
        <h2>Hello, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h2>
    </div>
    <img src="../img/testudo.png" alt="Cartoon Testudo" class="testudo">
    <p>
        <a href="../html/index.html" class="btn btn-light btn-lg">Home Page</a>
        <a href="reset-password.php" class="btn btn-light btn-lg">Reset Password</a>
        <a href="logout.php" class="btn btn-light btn-lg">Sign Out</a>
    </p>
</body>
</html>
