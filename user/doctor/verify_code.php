<?php
    session_start();
    if(!isset($_SESSION['verified']) || $_SESSION['verified'] !== true) {
		header("Location:doctorLoginForum.php");
	}

    if (isset($_POST["login"])) {
        $conn = new mysqli("us-cdbr-east-04.cleardb.com", "b839617a54151e", "c42a9797", "heroku_40c31dad5866879");

        $token = $_SESSION["token"];
        $code = mysqli_real_escape_string($conn, $_POST["code"]);

        if ($token === $code){
            unset($_SESSION["token"]);
            echo '<script>'; 
            echo 'alert("Verified Successfully!");';
            echo 'location.href="medical_table/medicaltable.php"';
            echo '</script>';
            exit(0);
        }else{
            echo '<script>'; 
            echo 'alert("Verify code is incorrect!");';
            echo 'location.href="verify_code.php"';
            echo '</script>';
        }             
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\lstyle.css">
    <title>Doctor Login Form | M Cloud</title>
    <link rel="icon" href="../../images/logo.png">
</head>
<body>
    <div class="wrapper">
        <h2 class="title">Email Verification</h2>
        <form action="" method="post" class="form">
            <div class="input-field">
                <label for="code" class="input-label">Code</label>
                <input type="text" name="code" id="code" class="input" placeholder="Enter Patient Email Verfication Code" required>
            </div>
           
            <button class="btn" name="login">Verify</button>
        </form>
    </div>
</body>
</html>