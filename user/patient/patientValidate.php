<?php
    session_start();
    if (isset($_SESSION["SESSION_EMAIL"])) {
        header("Location: patientLoginForum.php");
    }


        $conn = new mysqli("us-cdbr-east-04.cleardb.com", "b839617a54151e", "c42a9797", "heroku_40c31dad5866879");

        
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $password = mysqli_real_escape_string($conn, md5($_POST["password"]));

        $sql = "SELECT * FROM patient WHERE Email='{$email}' AND Password='{$password}' AND Verify_status = '1'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);

        if ($count === 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION["SESSION_EMAIL"] = $email;
            $_SESSION['verified'] = true;
            header("Location: medical_table/medicaltable.php");
          
        }else {
            echo '<script>';
            echo 'alert("Your Login details is incorrect.");';
            echo 'location.href="patientLoginForum.php"';
            echo '</script>';
        }
  
?>