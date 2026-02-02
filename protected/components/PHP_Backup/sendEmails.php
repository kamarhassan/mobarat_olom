<?php
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require 'PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtpout.secureserver.net';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 80;

//Set the encryption system to use - ssl (deprecated) or tls
//$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "registration@sciencelb.org";

//Password to use for SMTP authentication
$mail->Password = "P@12323434555";

//Set who the message is to be sent from
$mail->setFrom('registration@sciencelb.org', 'Mobarat ElOloum');

//Set an alternative reply-to address
$mail->addReplyTo('hyoussef@sciencelb.org', 'Hassan Youssef');
$mail->addBCC('cemails@sciencelb.org', 'Mob');

//Set who the message is to be sent to
$mail->addAddress('hassan_youssef_8@hotmail.com', 'Youyou');

//Set the subject line
$mail->Subject = 'PHPMailer SMTP test';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
$mail->Body = 'This is the HTML message body <b>in bold!</b>';

//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}