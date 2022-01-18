<?php

    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer-master/src/Exception.php';
    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';

    function sendemail_verify($name,$email,$subject,$message){
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
            $mail->setFrom($email, $name);
 
            //Add a recipient
            $mail->addAddress('mcloudorganization@gmail.com');
 
            //Set email format to HTML
            $mail->isHTML(true);

            $mail->Subject = ("$email ($subject)");

            $mail->Body  = $message;
 
            $mail->send();
 
        } catch (Exception $e) {
            echo "<script>alert('Message could not be sent. Mailer Error:{$mail->ErrorInfo}');</script>";
        }
    }

	if (isset($_POST["submit"])) {
       $conn = new mysqli("us-cdbr-east-04.cleardb.com", "b839617a54151e", "c42a9797", "heroku_40c31dad5866879");

        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $subject = mysqli_real_escape_string($conn, $_POST["subject"]);
        $message =  mysqli_real_escape_string($conn, $_POST["message"]);

        $sql = "INSERT INTO feedback (Name, Email, Subject, Message) VALUES ('{$name}', '{$email}', '{$subject}', '{$message}')";
        $result = mysqli_query($conn, $sql);

        if ($result) {          
            sendemail_verify("$name","$email","$subject","$message");
            echo '<script>';
            echo 'alert("Feedback send successfully.");';
            echo 'location.href="thankyou.php"';
            echo '</script>';
          
        }else {
            header("Location: index.php");
        }
	 }
  
?>