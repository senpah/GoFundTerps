<?php
	$fname = $_POST['firstname'];
	$lname = $_POST['lastname'];
  $visitor_email = $_POST['email'];
  $message = $_POST['message'];
	$link_address = "../html/index.html";

	$email_from = 'gofundterps@gmail.com';
	$email_subject = "New Form Submission";
	$email_body = "Name:\n".$fname ." ".$lname."\n".
		"Email:\n".$visitor_email."\n".
		"Message:\n".$message;

	$to = "gofundterps@gmail.com";
	$headers = "From: $email_from \r\n";
	$headers = "Reply-To: $visitor_email \r\n";
	//sends the email
	mail($to,$email_subject,$email_body,$headers);
	echo "Thank you, your submission has been received. ";
	echo '<a href="'.$link_address.'">Please click here to return to the homepage.</a>';
?>
