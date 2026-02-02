<?php
//require("PHPMailer/class.phpmailer.php");
//require("PHPMailer/class.smtp.php");
class cls_EMail{
	
   
    
    private $userName="registration@nasr.org.lb";
    private $password="Qoq86778@";
    private $fromEmail="registration@nasr.org.lb";
    private $fromName= "Mobarat ElOloum";
    public $pdfAttch='';

    public function sendEMail($subject,$msg,$emailAddressTo,$arrayReplyTo,$arrayBCC){


        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        //$mail->IsSendmail();
      /*  $mail->isSMTP(); 
        $mail->SMTPAuth = true;
	$mail->SMTPSecure = 'ssl';
//        $mail->SMTPAutoTLS = false;
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 456;//465; // or 587
	$mail->IsHTML(true);
        
	$mail->Username = "assaffsamer@gmail.com";
	$mail->Password = "sa141280";
        
        $mail->SMTPDebug = 2;*/

        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 2;

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
        $mail->Username = $this->userName;

        //Password to use for SMTP authentication
        $mail->Password = $this->password;

        /*
        $mail->SMTPAuth = true;
	$mail->SMTPSecure = 'tls';
        $mail->SMTPAutoTLS = false;
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587;//465; // or 587
	$mail->IsHTML(true);
	$mail->Username = "assaffsamer@gmail.com";
	$mail->Password = "sa141280";
        $mail->SMTPKeepAlive = true;   
        $mail->Mailer = "smtp"; // don't change the quotes!
         
         */
        //
        //Set who the message is to be sent from
        $mail->setFrom($this->fromEmail,$this->fromName);

        //Set an alternative reply-to address
        
        if(count($arrayReplyTo)>0){
            foreach( $arrayReplyTo as $clsEMailAddress){
                if (isset($clsEMailAddress->email))	{
                    $mail->addReplyTo($clsEMailAddress->email, $clsEMailAddress->label);	
                    //echo "<script>alert(\"" . $clsEMailAddress->email ."\")</script>";
                }
            }

        }

        if(count($arrayBCC)>0){
            foreach( $arrayBCC as $clsEMailAddress){
                if (isset($clsEMailAddress->email))	{
                    $mail->addBCC($clsEMailAddress->email, $clsEMailAddress->label);	
                    //	echo "<script>alert(\"" . $clsEMailAddress->email ."\")</script>";
                }
            }

        }
         

        
        $mail->Subject = $subject;
        
        $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
       //$mail->MsgHTML('123');
        $mail->MsgHTML($msg);
        $mail->ClearAddresses(); // clear all old recipients
        $mail->AddAddress($emailAddressTo->email, $emailAddressTo->label);
        
        //echo "<script>alert(\"" . $emailAddressTo->email ."\")</script>";
        //echo $msg;
       // return true;
      
        if($this->pdfAttch!=''){
            $mail->AddStringAttachment($this->pdfAttch, 'cert.pdf','base64','application/pdf');
        }
        if (!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
            return false;
        } else {
            return true;
        }  
      
        
    }

    public function sendEMailWithStatic($subject,$msg,$emailAddressTo){

        $arrayReplyTo=array();
        //$arrayReplyTo[]=new cls_EMailAddress('info@nasr.org.lb', $this->fromName);
        $arrayReplyTo[]=new cls_EMailAddress('staleb@nasr.org.lb', 'Sirine Taleb');

        $arrayBCC=array();
        $arrayBCC[]=new cls_EMailAddress('cemails@nasr.org.lb', $this->fromName);
        
//        $msg=$msg . "<p align='right' dir='rtl'> إذا وصل هذا البريد عن طريق الخطأ يرجى حذفه.
//                      <br>هذا البريد ورد من موقع الهيئة الوطنية للعلوم والبحوث
//                      <br>للاستفسار والمراسلة: info@nasr.org.lb < www.facebook.com/sciencelb > +961 71 59 39 62</p>";
              //echo $msg;
        $msg.= cls_EMail::MailFooter();
        //echo $msg;
        return $this->sendEMail($subject,$msg,$emailAddressTo,$arrayReplyTo,$arrayBCC);
    }
    
    public static function MailFooter(){
        //$current= Mobarat::getOpenMobaratRecord();
        ////تعطي مشكلة  من  double call
        //return '';
//        $phoneTrouble= Mobarat::getPhoneTrouble();
//        $msg= "<p align='right' dir='rtl'> إذا وصل هذا البريد عن طريق الخطأ يرجى حذفه.
//                      <br>هذا البريد ورد من موقع الهيئة الوطنية للعلوم والبحوث
//                      <br>للاستفسار والمراسلة: info@nasr.org.lb < www.facebook.com/sciencelb > ". $current['phone_trouble'] ."</p>";
        $msg= "<p align='right' dir='rtl'> إذا وصل هذا البريد عن طريق الخطأ يرجى حذفه.
                      <br>هذا البريد ورد من موقع الهيئة الوطنية للعلوم والبحوث
                      <br> info@nasr.org.lb | www.facebook.com/sciencelb  </p>";
        return $msg;
    }
    
    public static function sendCert($pdf,$email,$msg_st){
        $attch= $pdf->Output('', 'S');
        
        $clsEmail=new cls_EMail();
        $clsEmailAddress=new cls_EMailAddress($email, "samer assaf");
        $clsEmail->pdfAttch=$attch;

        if($clsEmail->sendEMailWithStatic('Attach',$msg_st,$clsEmailAddress)===true)
        {
            echo "<script> alert(\"You will recive an email\")</script>";
        }
        else {
            echo "<script> alert(\"An error occurs when sending the mail\")</script>";
        }
    }
    
    /*
     public function sendEMailWithStatic($subject,$msg,$emailAddressTo){
         $mail = new PHPMailer();
$mail->IsSMTP(); // send via SMTP
//$mail->IsSMTP(); // send via SMTP
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->Username = $this->userName; // SMTP username
$mail->Password = $this->password; // SMTP password
$webmaster_email = $this->fromEmail; //Reply to this email ID
$email="assaffsamer@gmail.com"; // Recipients email ID
$name="name"; // Recipient's name
$mail->From = $webmaster_email;
$mail->FromName = "Webmaster";
$mail->AddAddress($email,$name);
$mail->AddReplyTo($webmaster_email,"Webmaster");
$mail->WordWrap = 50; // set word wrap
$mail->Host = "ssl://smtp.gmail.com"; 
//$mail->AddAttachment("/var/tmp/file.tar.gz"); // attachment
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg"); // attachment
$mail->IsHTML(true); // send as HTML
$mail->Subject = "This is the subject";
$mail->Body = "Hi,
This is the HTML BODY "; //HTML Body
$mail->AltBody = "This is the body when user views in plain text format"; //Text Body
if(!$mail->Send())
{
echo "Mailer Error: " . $mail->ErrorInfo;
return false;
}
else
{
echo "Message has been sent";
return true;
}
     }*/
    public static function getMizo($email){
        $length = str_split($email);

        $a = array();
        if ($length[0] != '')
            array_push($a, $length[0]);
        if ($length[1] != '')
            array_push($a, $length[1]);
        if ($length[2] != '') {
            for ($i = 2; $i < count($length); $i++) {
                if ($length[$i] != '@')
                    array_push($a, '*');
                else
                    for ($j = $i; $j < count($length); $j++, $i++) {
                        array_push($a, $length[$j]);
                    }
            }
        }

        $mizo = implode("", $a);
        return $mizo;
    } 
}

	