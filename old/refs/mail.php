<?php
//MOVED TO common.php
function email($toEmail, $subject, $addressTo , $vCode)
{
	$to = $toEmail; //deeppatelj@gmail.com";
	$subject = "Interestship ".$subject;
	$body1 = "<p>Hello ".$addressTo;
	$body2 = "</p><p>Thank you for registering to Interestship. Please click on the following link to verify your email address. <a href='http://www.interestship.com/verify.php?email=1&code=".$vCode
	$body3 = "'>Verification Link</a></p><p>Regards, <br> Team Interestship</p>";
	$body = $body1.$body2.$body3;
	$headers = "From: Team Interestship\r\n";
	$headers .= "Reply-To: team@interestship.com\r\n";
	$headers .= "Return-Path: team@interestship.com\r\n";
	$headers .= "X-Mailer: PHP5\n";
	$headers .= 'MIME-Version: 1.0' . "\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	mail($to,$subject,$body,$headers);
}
?>