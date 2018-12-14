<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = $email = $confirm_email = "";
$username_err = $password_err = $confirm_password_err = $email_err = $confirm_email_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already in use.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    if (empty(trim($_POST["confirm_email"]))) {
      $confirm_email_err = "Please confirm your email.";
    } else {
          $confirm_email = trim($_POST["confirm_email"]);
          if(empty($email_err) && ($email != $confirm_email)) {
              $confirm_email_err = "Emails do not match.";
          }
      }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm your password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Passwords do not match.";
        }
    }

    // Check input errors before inserting in database
    if(empty($username_err) && empty($email_err) && empty($confirm_email_err)
    && empty($password_err) && empty($confirm_password_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_email, $param_password);

            // Set parameters
            $param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/form_style.css">
</head>
<body>
  <header>
    <div class="container">
      <h3 class="logo">GO FUND TERPS</h3>

      <nav>
        <ul>
          <li><a href="../html/index.html">HOME</a></li>
          <li><a href="../html/about.html">ABOUT</a></li>
          <li><a href="#">FUNDRAISERS</a>
            <ul class="fundsubmenu">
              <li><a href="list_fundraisers.php">LIST OF FUNDRAISERS</a></li>
              <li class="last"><a href="start_fundraiser.php">START A FUNDRAISER</a></li>
            </ul>
         </li>
         <li><a href="../html/donate.html">DONATE</a></li>
         <li><a href="../html/contact.html">CONTACT</a></li>
         <li><a href="login.php">LOGIN</a>
            <ul class="loginsubmenu">
              <li><a href="welcome.php">USER CP</a></li>
            </ul>
        </li>
       </ul>
     </nav>
    </div>
  </header>

    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill out this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username <font color="red">*</font></label><br>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>"><br>
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email <font color="red">*</font></label><br>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>"><br>
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_email_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Email <font color="red">*</font></label><br>
                <input type="text" name="confirm_email" class="form-control" value="<?php echo $confirm_email; ?>"><br>
                <span class="help-block"><?php echo $confirm_email_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password <font color="red">*</font></label><br>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>"><br>
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password <font color="red">*</font></label><br>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>"><br>
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Sign up">
                  &emsp;<font color="red">*</font> <i>= required field</i>
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
</body>

<footer>
  <p class="copyright">&copy; 2018 GoFundTerps, LLC</p>
</footer>

</html>
