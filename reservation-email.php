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
    $net=$pay-3;
    $ticket=rand(300000000,300009999);
    $to   = $email;
    $from = 'egy.gaming@yahoo.com';
    $name = 'EGmaing';
    $subj = 'Reservation';
    $msg = '
                Hi,'.$user_name.'<br><br>
                Your reservation has been compeleted successfully<br>
                thank you for using our service ☺<br>
                Your ticket ID is :'.$ticket.'<br>
                see you in the hub <br>

                <h2>Order details</h2>
                <table style="width:300px  border:1px solid black">
                    <tr style=" border:1px solid black">
                                <th style=" border:1px solid black">details</th>
                                <th style=" border:1px solid black" >price</th>
                    </tr>
                    <tr  style=" border:1px solid black">
                                    <td  style=" border:1px solid black">internet cafe</td>
                                    <td style=" border:1px solid black">'.$net.'EGP</td>
                    </tr>
                    <tr style=" border:1px solid black">
                                    <td  style=" border:1px solid black">service fees</td>
                                    <td  style=" border:1px solid black">3.00EGP</td>
                     </tr>
                     <tr style=" border:1px solid black">
                                <td  style=" border:1px solid black">Total </td>
                                <td  style=" border:1px solid black">'.$pay.'EGP</td>
                      </tr>
                 </table><br>

                EGaming



    ';
    
    $result=smtpmailer($to,$from, $name ,$subj, $msg);


  
    $to2   = $host_email;
    $from2 = 'egy.gaming@yahoo.com';
    $name2 = 'EGmaing';
    $subj2 = 'Reservation';
    $msg2 = '
                Hi,'.$host_name.'<br><br>
                '.$user_name.' has reserved seat number '.$seat.' for '.$time.' hours at '.$now.' <br>
                his ticket ID is : '.$ticket.' <br>
                <h2>Order details</h2>
            <table style="width:300px  border:1px solid black">
                <tr style=" border:1px solid black">
                            <th style=" border:1px solid black">details</th>
                            <th style=" border:1px solid black" >price</th>
                </tr>
                <tr  style=" border:1px solid black">
                                <td  style=" border:1px solid black">internet cafe</td>
                                <td style=" border:1px solid black">'.$net.'EGP</td>
                </tr>
                <tr style=" border:1px solid black">
                                <td  style=" border:1px solid black">service fees</td>
                                <td  style=" border:1px solid black">3.00EGP</td>
                 </tr>
                <tr style=" border:1px solid black">
                                <td  style=" border:1px solid black">Total </td>
                                <td  style=" border:1px solid black">'.$pay.'EGP</td>
                 </tr>
                 
             </table><br>



                EGaming



    ';
    
    $result2=smtpmailer($to2,$from2, $name2 ,$subj2, $msg2);
        

?>
