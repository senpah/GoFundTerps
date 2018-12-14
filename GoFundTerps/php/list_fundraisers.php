<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List of Fundraisers</title>
    <link rel="stylesheet" href="../css/style.css">
    <style type = "text/css">
      table, th, td {border: 1px solid black};
    </style>
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
              <li><a href="../php/welcome.php">USER CP</a></li>
            </ul>
        </li>
       </ul>
     </nav>
    </div>
  </header>
</body>

  <h2>List of Fundraisers</h2>
  <p>
   <?php
    try {
    $con= new PDO('mysql:host=localhost;dbname=gofundterps', "root", "mysql");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT org_name AS Organization, fundraiser_name AS Fundraiser,
    fundraiser_desc AS Description FROM fundraisers";
    //first pass just gets the column names
    echo '<table class="fundraiser_table"> ';
    $result = $con->query($query);
    //return only the first row (we only need field names)
    $row = $result->fetch(PDO::FETCH_ASSOC);
    echo " <tr> ";
    foreach ($row as $field => $value) {
     echo " <th>$field</th> ";
    } // end foreach
    echo " </tr> ";
    //second query gets the data
    $data = $con->query($query);
    $data->setFetchMode(PDO::FETCH_ASSOC);
    foreach($data as $row){
     echo " <tr> ";
     foreach ($row as $name=>$value) {
     echo " <td>$value</td> ";
     } // end field loop
     echo " </tr> ";
    } // end record loop
    echo "</table> ";
    } catch(PDOException $e) {
     echo 'ERROR: ' . $e->getMessage();
    } // end try
   ?>
   </p>
   <p>See an organization that you would like to support? <a href="../html/donate.html">Click here to donate</a>.</p>

<footer>
  <p class="copyright">&copy; 2018 GoFundTerps, LLC</p>
</footer>

</html>
