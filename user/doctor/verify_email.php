<?php

session_start();

if(isset($_GET['token'])){
    $token = $_GET['token'];
    $conn = new mysqli("us-cdbr-east-04.cleardb.com", "b839617a54151e", "c42a9797", "heroku_40c31dad5866879");

    if(mysqli_num_rows(mysqli_query($conn, "SELECT token FROM doctor WHERE Token ='$token' LIMIT 1")) > 0)
    {
        $row = mysqli_fetch_assoc((mysqli_query($conn, "SELECT Token,Verify_status FROM doctor WHERE Token ='$token' LIMIT 1")));
        if($row['Verify_status'] == '0'){
            $clicked_token = $row['Token'];
            $update_query = "UPDATE doctor SET Verify_status = '1' WHERE Token = '$clicked_token' LIMIT 1";
            $result = mysqli_query($conn, $update_query);
            if($result){
                echo '<script>';
                echo 'alert("Your Account Verified Successfully!");';
                echo 'location.href="doctorLoginForum.php"';
                echo '</script>';
                exit(0);
            }else{
                echo '<script>';
                echo 'alert("Verification Failed.");';
                echo 'location.href="doctorLoginForum.php"';
                echo '</script>';
                exit(0);
            }
        }else{
            echo '<script>';
            echo 'alert("Email Already Verified. Please Login.");';
            echo 'location.href="doctorLoginForum.php"';
            echo '</script>';
            exit(0);
        }
    }else{
        echo '<script>';
        echo 'alert("This Token does not Exists.");';
        echo 'location.href="doctorLoginForum.php"';
        echo '</script>';
    }
}else{
    header("Location: doctorLoginForum.php");
}
?>