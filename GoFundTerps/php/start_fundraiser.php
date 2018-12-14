<?php
$link_address = "login.php";
$link_address2 = "list_fundraisers.php";
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    echo "You must be logged in to start a fundraiser. ";
    echo '<a href="'.$link_address.'">Click here to login.</a>';
    exit;
}
// Include config file
require_once "config.php";
$org_name = $fundraiser_name = $fundraiser_desc = "";
$org_name_err = $fundraiser_name_err = $fundraiser_desc_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Validate username
  if(empty(trim($_POST["org_name"]))){
      $org_name_err = "Please enter the organization name.";
  } else{
      // Prepare a select statement
      $sql = "SELECT fundraiser_id FROM fundraisers WHERE org_name = ?";

      if($stmt = mysqli_prepare($link, $sql)){
          // Bind variables to the prepared statement as parameters
          mysqli_stmt_bind_param($stmt, "s", $param_org_name);

          // Set parameters
          $param_org_name = trim($_POST["org_name"]);

          // Attempt to execute the prepared statement
          if(mysqli_stmt_execute($stmt)){
              /* store result */
              mysqli_stmt_store_result($stmt);

              if(mysqli_stmt_num_rows($stmt) == 1){
                  $org_name_err = "This organization name has already been registered.";
              } else{
                  $org_name = trim($_POST["org_name"]);
              }
          } else{
              echo "Oops! Something went wrong. Please try again later.";
          }
      }
      // Close statement
      mysqli_stmt_close($stmt);
  }

  if(empty(trim($_POST["fundraiser_name"]))){
      $fundraiser_name_err = "Please enter a name for the fundraiser.";
  } else {
      $fundraiser_name = trim($_POST["fundraiser_name"]);
  }

  if(empty(trim($_POST["fundraiser_desc"]))){
      $fundraiser_desc_err = "Please enter a description for the fundraiser.";
  } else {
      $fundraiser_desc = trim($_POST["fundraiser_desc"]);
  }

  // Check input errors before inserting in database
  if(empty($username_err) && empty($email_err) && empty($confirm_email_err)
  && empty($password_err) && empty($confirm_password_err)) {

      // Prepare an insert statement
      $sql = "INSERT INTO fundraisers (org_name, fundraiser_name, fundraiser_desc) VALUES (?, ?, ?)";

      if($stmt = mysqli_prepare($link, $sql)){
          // Bind variables to the prepared statement as parameters
          mysqli_stmt_bind_param($stmt, "sss", $param_org_name, $param_fundraiser_name, $param_fundraiser_desc);

          // Set parameters
          $param_org_name = $org_name;
          $param_fundraiser_name = $fundraiser_name;
          $param_fundraiser_desc = $fundraiser_desc;
          // Attempt to execute the prepared statement
          if(mysqli_stmt_execute($stmt)){
              // Redirect to login page
              echo "You have successfully added a new fundraiser. ";
              echo '<a href="'.$link_address2.'">Click here to see the list of fundraisers.</a>';
              exit;
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
    <title>Start a Fundraiser</title>
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
         <li><a href="../php/login.php">LOGIN</a>
            <ul class="loginsubmenu">
              <li><a href="welcome.php">USER CP</a></li>
            </ul>
        </li>
       </ul>
     </nav>
    </div>
  </body>
 
    <div class="wrapper">
        <h2>Start a Fundraiser</h2>
        <p>Please fill out this form to start a fundraiser.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($org_name_err)) ? 'has-error' : ''; ?>">
                <label>Organization Name <font color="red">*</font></label><br>
                <input type="text" name="org_name" class="form-control" value="<?php echo $org_name; ?>"><br>
                <span class="help-block"><?php echo $org_name_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($fundraiser_name_err)) ? 'has-error' : ''; ?>">
                <label>Fundraiser Name <font color="red">*</font></label><br>
                <input type="text" name="fundraiser_name" class="form-control" value="<?php echo $fundraiser_name; ?>"><br>
                <span class="help-block"><?php echo $fundraiser_name_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($fundraiser_desc_err)) ? 'has-error' : ''; ?>">
                <label>Fundraiser Description <font color="red">*</font></label><br>
                <textarea name="fundraiser_desc" class="form-control" value="<?php echo $fundraiser_desc; ?>"></textarea><br>
                <span class="help-block"><?php echo $fundraiser_desc_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="login_button" value="Submit">
                &emsp;<font color="red">*</font> <i>= required field</i>
            </div>
            <p>Want to see a list of fundraisers? <a href="list_fundraisers.php">Click here</a>.</p>
        </form>
    </div>
  </header>

  <footer>
    <p class="copyright">&copy; 2018 GoFundTerps, LLC</p>
  </footer>

</html>
