
<?php
// for testing
                            //host username pw dbname
    $conn = mysqli_connect("us-cdbr-east-04.cleardb.com", "b839617a54151e", "c42a9797", "heroku_40c31dad5866879");
    
    // Check connection
    if ($conn -> connect_errno) {
        echo "Failed to connect to MySQL: " . $conn -> connect_error;
        exit();
    }else{
        echo "Yep! Database Connected...";
    }
?>

