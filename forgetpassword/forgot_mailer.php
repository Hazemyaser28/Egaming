<?php  

require("../PHPMailer-master/src/PHPMailer.php");
require("../PHPMailer-master/src/SMTP.php");
require("../PHPMailer-master/src/Exception.php");

function smtpmailer($to, $from, $from_name, $subject, $body)
    {
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true; 
        $mail->SMTPDebug  = 0;
        $mail->SMTPSecure = 'tls'; 
        $mail->Host = 'smtp.mail.yahoo.com';
        $mail->Port = 587;  
        $mail->Username = "egy.gaming@yahoo.com";
        $mail->Password = "hmcoxcwdabthdtpb";
   
   //   $path = 'reseller.pdf';
   //   $mail->AddAttachment($path);
   
        $mail->IsHTML(true);
        $mail->From="egy.gaming@yahoo.com";
        $mail->FromName=$from_name;
        $mail->Sender=$from;
        $mail->AddReplyTo($from, $from_name);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($to);
        if(!$mail->Send())
        {
$result = "<div class='alert alert-danger alert-dismissible'>
   <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>  an error occured, Please try again </div>";            
   return $result; 
        }
        else 
        {
           $result = "<div class='alert alert-success alert-dismissible'>
   <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Please Check Your Email Inbox or Spam folder!</div>";
            return $result;
        }
    }
    
    $to   = $email;
    $from = 'egy.gaming@yahoo.com';
    $name = 'EGaming';
    $subj = 'Reset Password';
    $msg = '
                Hi,<br><br>
                In order to reset your password, please click on the link below:<br><br>
                <a href="http://localhost/egaming/forgetpassword/resetPassword.php?code='.$code.'"> Reset</a><br><br>
                or copy and paste the link below in a new tab <br><br>
                    
                http://localhost/egaming/forgetpassword/resetPassword.php?code='.$code.' <br><br>

                Kind Regards,<br><br>
                EGaming



    ';
    
    $result=smtpmailer($to,$from, $name ,$subj, $msg);
        

?>
