<?php
	session_start();

	if(!isset($_SESSION['verified']) || $_SESSION['verified'] !== true) {
		header("Location:../doctorLoginForum.php");
	}

  if (isset($_POST["submit"])) {
    $conn = new mysqli("us-cdbr-east-04.cleardb.com", "b839617a54151e", "c42a9797", "heroku_40c31dad5866879");


    $dname = mysqli_real_escape_string($conn, $_POST["dname"]);
    $pname = mysqli_real_escape_string($conn, $_POST["pname"]);
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
    $age = mysqli_real_escape_string($conn, $_POST["age"]);
    $date = mysqli_real_escape_string($conn, $_POST["date"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $medicine = mysqli_real_escape_string($conn, $_POST["medicine"]);
    $visit = mysqli_real_escape_string($conn, $_POST["visit"]);


    if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM doctor WHERE Email='".$_SESSION["SESSION_EMAIL"]."' AND Username='{$dname}'")) == 1){
        if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM patient WHERE Email='".$_SESSION["Pemail"]."'")) > 0){
          if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM patient WHERE Username='{$pname}'")) > 0){
              $sql = "INSERT INTO patient_medical (`Date_for_this_treatment`,`Doctor_name`,`Medical_description_of_patient`,`Medicine_for_this_visit`,`Next_visit_and_reports_required`,`Patient_name`,`Age`,`Gender`,`Email`) VALUES ('{$date}', '{$dname}','{$description}', '{$medicine}', '{$visit}','{$pname}','{$age}','{$gender}', '".$_SESSION["Pemail"]."')";
              $result = mysqli_query($conn, $sql);

              if ($result) {
                header("Location: ../medical_table/medicaltable.php");
              }else{
                echo "<script>Error: ".$sql.mysqli_error($conn)."</script>";
              }
          }else{
            echo "<script>alert('The patient username is incorrect.');</script>";
          }
      }else{
        echo "<script>alert('The patient email is incorrect.');</script>";
      }
    }else{
      echo '<script>';
            echo 'alert("Your username is incorrect.");';
            echo 'location.href="medical_data.php"';
            echo '</script>';
    }     
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Patient Diagnosis Form | M cloud</title>
  <link rel="icon" href="../../../images/logo.png">
	<link rel="stylesheet" href="addstyles.css">
</head>
<body>

<div class="wrapper">
    <div class="title">
      Patient Diagnosis 
    </div>
    <form action="medical_data.php" method="post" class="form">
           
      <div class="inputfield">
        <label>Doctor name</label>
        <input type="text" name="dname" id="dname" class="input" placeholder="Enter your username" required>
     </div>  


     <div class="inputfield">
      <label>Date for this treatment</label>
      <input type="date" class="input" name="date" id="date" placeholder="Date-Month-Year" required>
   </div> 

       <div class="inputfield">
          <label>Patient Name</label>
          <input type="text" class="input" name="pname" id="pname" placeholder="Enter patient username" required>
       </div>  

        <div class="inputfield">
          <label>Patient age</label>
          <input type="number" class="input" name="age" id="age" placeholder="Enter patient age" required>
       </div>  

        <div class="inputfield">
          <label>Gender</label>
          <div class="custom_select">
            <select id="gender" name="gender" required>
              <option value="" disabled selected>Select Gender</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>
       </div>       

      <div class="inputfield">
          <label>Medical description of patient</label>
          <textarea class="textarea" name="description" id="description" required></textarea>
       </div> 

       <div class="inputfield">
        <label>Medicine for this visit</label>
        <textarea class="textarea" name="medicine" id="medicine" required></textarea>
     </div> 

     <div class="inputfield">
      <label>Next visit and reports required</label>
      <textarea class="textarea" name="visit" id="visit" required></textarea>
   </div> 

   <button class="btn" name="submit">Save in patient's profile</button>
    
</form>
</div>	
	
</body>
</html>
