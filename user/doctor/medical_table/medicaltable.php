<?php
	session_start();

	if(!isset($_SESSION['verified']) || $_SESSION['verified'] !== true) {
		header("Location:../doctorLoginForum.php");
	}

?>

<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="style.css"/>
		<title>Medical Data | M Cloud</title>
		<link rel="icon" href="../../../images/logo.png">
		<style>
			table{
				width: 100%;
			}
			tr{
				width: 100%;
			}
			td{
				background-color: rgb(238, 235, 235);
				text-align: center;
				font-weight: bold;
			}


			* {box-sizing: border-box;}

							body {
							margin: 0;
							font-family: Arial, Helvetica, sans-serif;
							}

							.topnav {
							overflow: hidden;
							background-color: #e9e9e9;
							}

							.topnav a {
							float: left;
							display: block;
							color: black;
							padding: 14px 16px;
							margin-left: 30px;
							text-decoration: none;
							font-size: 17px;
							}

							.topnav a:hover {
							background-color: rgb(3, 18, 46);
							color: white;
							
							}
							.topnav .search-container {
							float: left;
							}

							.topnav input[type=text] {
							padding: 6px 20px;
							margin-top: 8px;
							margin-left: 300px;
							font-size: 17px;
							border: none;
							text-align: start;				
     						width: 550px;
					
							}

							.topnav .search-container button {
							float: right;
							padding: 6px 20px;
							margin-top: 8px;
							margin-right: 16px;
							background: #ddd;
							font-size: 17px;
							border: none;
							cursor: pointer;
							
							}

							.topnav .search-container button:hover {
							background: #ccc;
							
							
							}

							@media screen and (max-width: 550px) {
							.topnav .search-container {
								float: none;
							
							}
							.topnav a, .topnav input[type=text], .topnav .search-container button {
								float: none;
								display: block;
								text-align: left;
								width: 100%;
								margin: 0;
								padding: 14px;
								
								
							
							}
							.topnav input[type=text] {
								border: 1px solid #ccc;  
							}
							}

			
		</style>
	</head>
	<body>



		<div class="topnav">
		<div class="search-container">
			  <form action="medicaltable.php" method ="post">
				<input type="text" placeholder="Search" name="search_value">
				<button type="submit" name="search"><i class="fa fa-search"></i></button>
			  </form>
			</div>
			<div>
			<a href="../add_medical_data/medical_data.php">Add new medical details</i></a>
			<a href="../../logout.php">Logout</a>
			</div>
		</div>

		

   <table class="table">
     <thead>
     	<tr>
		 <th>Date For This Treatment</th>
     	 <th>Doctor Name</th>
     	 <th>Medical Description Of Patient</th>
     	 <th>Medicine For This Visit</th>
     	 <th>Next Visit And Reports Required</th>
		 <th>Patient Name</th>
		 <th>Age</th>
		 <th>Gender</th>
     	</tr>
     </thead>
     <tbody> 

			<?php

				$conn = new mysqli("us-cdbr-east-04.cleardb.com", "b839617a54151e", "c42a9797", "heroku_40c31dad5866879");

				if(isset($_POST['search'])){


					$search_value = $_POST['search_value'];
					$sql = "SELECT * FROM patient_medical WHERE Email = '".$_SESSION["Pemail"]."' AND CONCAT(`Date_for_this_treatment`,`Doctor_name`,`Medical_description_of_patient`,`Medicine_for_this_visit`,`Next_visit_and_reports_required`) LIKE  '%".$search_value."%'";

					$result = mysqli_query($conn,$sql);
	
				}else{
									
					$sql = "SELECT * FROM patient_medical WHERE Email = '".$_SESSION["Pemail"]."'";

					$result = mysqli_query($conn,$sql);
				}

				while($row = mysqli_fetch_array($result)){
					?>
						<tr>
							<td><?php echo $row['Date_for_this_treatment'];?></td>
							<td><?php echo $row['Doctor_name'];?></td>
							<td><?php echo $row['Medical_description_of_patient'];?></td>
							<td><?php echo $row['Medicine_for_this_visit'];?></td>
							<td><?php echo $row['Next_visit_and_reports_required'];?></td>
							<td><?php echo $row['Patient_name'];?></td>
							<td><?php echo $row['Age'];?></td>
							<td><?php echo $row['Gender'];?></td>
							<td><a href = 'delete.php?rn=<?php echo $row['id'] ?>' id = "deletebtn">Delete</td></a>
																			
						</tr>

					<?php
						}

											
					?>

	</tbody> 
   </table>

</body>
</html>

