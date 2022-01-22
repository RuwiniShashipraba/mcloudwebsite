<?php

$conn = new mysqli("us-cdbr-east-04.cleardb.com", "b839617a54151e", "c42a9797", "heroku_40c31dad5866879");


    $idnum = $_GET['rn'];
    $query = "DELETE FROM patient_medical WHERE id ='$idnum'";

    $data=mysqli_query($conn,$query);

    echo '<script>';
    echo 'alert("Record deleted successfully!");';
    echo 'location.href="medicaltable.php"';
    echo '</script>';

?>