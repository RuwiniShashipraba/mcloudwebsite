<?php
    session_start();
    if (isset($_SESSION["SESSION_EMAIL"])) {
        header("Location: doctorLoginForum.php");
    }

    //Import PHPMailer classes into the global namespace
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../../PHPMailer-master/src/Exception.php';
    require '../../PHPMailer-master/src/PHPMailer.php';
    require '../../PHPMailer-master/src/SMTP.php';

    function sendemail_verify($Pemail,$token){
        //Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);
 
        try {
            //Enable verbose debug output
           $mail->SMTPDebug = 0;//SMTP::DEBUG_SERVER;
 
            //Send using SMTP
            $mail->isSMTP();
 
            //Set the SMTP server to send through
            $mail->Host = 'smtp.gmail.com';
 
            //Enable SMTP authentication
            $mail->SMTPAuth = true;
 
            //SMTP username
            $mail->Username = 'mcloudorganization@gmail.com';
 
            //SMTP password
            $mail->Password = 'c42a9797';
 
            //Enable TLS encryption;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
 
            //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            $mail->Port = 587;
 
            //Recipients
            $mail->setFrom('mcloudorganization@gmail.com');
 
            //Add a recipient
            $mail->addAddress($Pemail);
 
            //Set email format to HTML
            $mail->isHTML(true);

            $mail->Subject = 'Email Verification from M CLOUD Organization';
            
            $email_template = "
                                <h2> You have Sign in with M CLOUD Organization</h2>
                                <h5>To verify your Login use the below code</h5>
                                <br/><br/>     
                                <h3>This is Your Verification Code: $token</h5>";       
                                
            
            $mail->Body  = $email_template;
 
            $mail->send();
 
        } catch (Exception $e) {
            echo "<script>alert('Message could not be sent. Mailer Error:{$mail->ErrorInfo}');</script>";
        }
    }

        $conn = new mysqli("us-cdbr-east-04.cleardb.com", "b839617a54151e", "c42a9797", "heroku_40c31dad5866879");

        
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $password = mysqli_real_escape_string($conn, md5($_POST["password"]));
        $Pemail =  $_POST["pemail"];
        $token = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

        $sql = "SELECT * FROM doctor WHERE Email='{$email}' AND Password='{$password}' AND Verify_status = '1'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);

        if ($count === 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION["SESSION_EMAIL"] = $email;
            $_SESSION['verified'] = true;
            $_SESSION["Pemail"] = $Pemail;
            $_SESSION["token"] = $token;
            sendemail_verify("$Pemail","$token");
            echo '<script>';
            echo 'alert("Patient Verification Code Send Successfully!");';
            echo 'location.href="verify_code.php"';
            echo '</script>';
          
        }else {
            echo '<script>';
            echo 'alert("Your Login details is incorrect.");';
            echo 'location.href="doctorLoginForum.php"';
            echo '</script>';
        }
  
?>