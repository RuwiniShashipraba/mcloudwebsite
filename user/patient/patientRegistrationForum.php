<?php
    session_start();
    if (isset($_SESSION["SESSION_EMAIL"])) {
        header("Location: patientRegistrationForum.php");
    }

    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../../PHPMailer-master/src/Exception.php';
    require '../../PHPMailer-master/src/PHPMailer.php';
    require '../../PHPMailer-master/src/SMTP.php';

    function sendemail_verify($name,$email,$token){
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
            $mail->setFrom('mcloudorganization@gmail.com', $name);
 
            //Add a recipient
            $mail->addAddress($email);
 
            //Set email format to HTML
            $mail->isHTML(true);

            $mail->Subject = 'Email Verification from M CLOUD Organization';

            $email_template = "
                                <h2> You have Registered with M CLOUD Organization</h2>
                                <h5>Verify your email address to Login with the below link</h5>
                                <br/><br/>                     
                                <a href = 'https://m-cloud.herokuapp.com/user/patient/verify_email.php?token=$token'> Click to Verify </a>";
            
            $mail->Body  = $email_template;
 
            $mail->send();
 
        } catch (Exception $e) {
            echo "<script>alert('Message could not be sent. Mailer Error:{$mail->ErrorInfo}');</script>";
        }
    }

    if (isset($_POST["submit"])) {
        $conn = new mysqli("us-cdbr-east-04.cleardb.com", "b839617a54151e", "c42a9797", "heroku_40c31dad5866879");


        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $password = mysqli_real_escape_string($conn, md5($_POST["password"]));
        $cpassword = mysqli_real_escape_string($conn, md5($_POST["cpassword"]));
        $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
        $username = mysqli_real_escape_string($conn, $_POST["username"]); 
        $phone	= mysqli_real_escape_string($conn, $_POST["phone"]);
        $nid = mysqli_real_escape_string($conn, $_POST["nid"]);
        $address = mysqli_real_escape_string($conn, $_POST["address"]);
        $birth = mysqli_real_escape_string($conn, $_POST["birth"]);
        $description = mysqli_real_escape_string($conn, $_POST["description"]);
        $token = md5(rand());
        
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM patient WHERE Email='{$email}'")) > 0) {
            echo "<script>alert('{$email} - This email has already taken.');</script>";
        }else {
            if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM patient WHERE NationalID='{$nid}'")) > 0){
                echo "<script>alert('{$nid} - This nationalID has already taken.');</script>";
            }else{
                if ($password === $cpassword) {
                    $sql = "INSERT INTO patient (Fullname, Username, Email, Password, Gender, TelNumber, NationalID, Address, DOB, Description, Token) VALUES ('{$name}', '{$username}','{$email}', '{$cpassword}', '{$gender}','{$phone}','{$nid}','{$address}', '{$birth}','{$description}','{$token}')";
                    $result = mysqli_query($conn, $sql);
    
                    if ($result) {
                        sendemail_verify("$name","$email","$token");
                        echo "<script>alert('Registration Successfull! Please Verify Your Email Address!');</script>";
                    }else {
                        echo "<script>Error: ".$sql.mysqli_error($conn)."</script>";
                    }
                }else {
                    echo "<script>alert('Password and confirm password do not match.');</script>";
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\rstyle.css">
    <title>Patient Registration Form | M cloud</title>
    <link rel="icon" href="../../images/logo.png">
</head>
<body>
    <div class="wrapper">
        <h2 class="title">Patient Registration</h2>
        <form action="" method="post" class="form">
            <div class="input-field">
                <label for="name" class="input-label">Full Name</label>
                <input type="name" name="name" id="name" class="input" placeholder="Enter your full name" required>
            </div>
            <div class="input-field">
                <label for="email" class="input-label">Email</label>
                <input type="email" name="email" id="email" class="input" placeholder="Enter your email" required>
            </div>
            <div class="input-field">
                <label for="nid" class="input-label">National ID</label>
                <input type="text" name="nid" id="nid" class="input" placeholder="Enter your national id" required>
            </div>
            <div class="input-field">
                <label for="username" class="input-label">Username</label>
                <input type="text" name="username" id="username" class="input" placeholder="Enter your username" required>
            </div>
            <div class="input-field">
                <label for="phone" class="input-label">Phone Number</label>
                <input type="number" name="phone" id="phone" class="input" placeholder="Enter your phone number" required>
            </div>
            <div class="input-field">
                <label for="birth" class="input-label">Date of Birth</label>
                <input type="date" name="birth" id="birth" class="input" placeholder="Date-Month-Year" required>
            </div>
            <div class="input-field">
                <label for="address" class="input-label">Address</label>
                <input type="text" name="address" id="address" class="input" placeholder="Enter your address" required>
            </div>
            <div class="input-field">
                <label for="description" class="input-label">Description</label>
                <input type="text" name="description" id="description" class="input" placeholder="Enter description" required>
            </div>
            <div class="input-field">
                <label for="gender" class="input-label">Gender</label>
                <select id="gender" name="gender" class="input" required>
                    <option value="" disabled selected>Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Prefer not to say">Prefer not to say</option>
                </select>
            </div>

            <div class="input-field">
                <label for="password" class="input-label">Password</label>
                <input type="password" name="password" id="password" class="input" placeholder="Enter your password" required>
            </div>
            <div class="input-field">
                <label for="cpassword" class="input-label">Confirm Password</label>
                <input type="password" name="cpassword" id="cpassword" class="input" placeholder="Enter your confirm password" required>
            </div>
            
            <button class="btn" name="submit">Register</button>
            <p>You have already an account! <a href="patientLoginForum.php">Login</a></p>
        </form>
    </div>
</body>
</html>
