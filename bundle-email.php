<?php  

require("PHPMailer-master/src/PHPMailer.php");
require("PHPMailer-master/src/SMTP.php");
require("PHPMailer-master/src/Exception.php");

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
    $name = 'EGmaing';
    $subj = 'Bundle';
    $msg = '
                Hi,'.$fname.'<br><br>
                You have bought '.$bname.' bundle successfully
                thank you for using our service ☺ <br><br>
                see you in the hub <br>

                <h2>Order details</h2>
                <table style="width:300px  border:1px solid black">
                    <tr  style=" border:1px solid black">
                                    <td  style=" border:1px solid black">Bundle price</td>
                                    <td style=" border:1px solid black">'.$bought.' EGP </td>
                    </tr>
                    <tr style=" border:1px solid black">
                                    <td  style=" border:1px solid black">New balance</td>
                                    <td  style=" border:1px solid black">'.$newbalance.' Hour</td>
                     </tr>
                 </table><br>

                EGaming



    ';
    
    $result=smtpmailer($to,$from, $name ,$subj, $msg);
