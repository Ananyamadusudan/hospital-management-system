<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link rel="stylesheet" href="bootstrap-4.1.3-dist/css/bootstrap.css">
	<script type="text/javascript" src="bootstrap-4.1.3-dist/js/bootstrap.js"></script>
	<script src="bootstrap-4.1.3-dist/jquery.min.js"></script>
	<style>
		body {
			 background-color: #ded;
		}
		.profile_pic {
			border-radius:50%;
			width:50px;
			height:50px;
			float:left;
		}
		.profile_banner {
			font-size: 25px;
			font-family: 'Google Sans';
			color:white;
		}
		button.logout_but {
			background-color:#f00;
			color:white;
			font-size: 18px;
			border: 2px solid black;
			cursor: pointer;
			border-radius: 6px;
			margin:10px;
			padding: 5px;
		}
		button.logout_but:hover {
			background-color:#880;
			transition-delay:0.1s;
			transform: scale(1.02);
		}
		.treating, .testing {
			border: 2px solid black;
			border-radius: 12px;
			padding: 20px;
			font-size: 20px;
			font-family: monospace;
			margin: 25px 25px 25px 500px;
			width: 25%;
		}
		.maincontent {
			margin: 30px 250px 150px 250px;
			border: 6px solid skyblue;
			border-radius: 10px;
			padding: 20px;
		}
		form {
			text-align:center;
			font-size: 20px;
		}
		input[type="text"] {
			border: 2px solid black;
			padding: 7px;
			border-radius: 12px;
		}
		input[type="submit"], button {
			background-color: black;
			color:white;
			border: 3px solid black;
			border-radius:10px;
			padding: 6px;
		}
		input[type="submit"]:hover, button:hover {
			background-color: green !important;
			cursor: pointer;
		}
		button {
			margin-top:80px;
			font-size:20px;
			background-color:red !important;
		}
	</style>
	</head>
	<body>
		 <nav class="navbar fixed-top navbar-dark bg-dark" style="height:70px">
		<div class="container-fluid">
			<img class="profile_pic" src="./imgs/pat.png"></img>
			<div class="profile_banner">Profile: <?php echo $_SESSION['pname'];?></div>
			<button class="logout_but" type="button"onclick='window.location.href="http://localhost/loginpage.php"'>Logout</a></button>
		</div>
	</nav>
		<center><button type="button" onclick="window.location.href = './pat_mainpage.php' ">Go Back </button></center><br>
		<div class="testing">
					<h2 style="font-weight:800;"><u>Tests</u></h2><br>
						<?php
						
		error_reporting (0);

		$servername="localhost";
	$username="root";
	$password="nischaya#89$&";
	$dbname="hdbms";

	if($conn->connect_error) {
		die("connection failed:" .$conn->connect_error);
	}
	$conn=mysqli_connect($servername,$username,$password,$dbname);
							$pid=$_SESSION['pid'];
							$q="select testid,tname,costs from tests where pid=$pid";
							$re=mysqli_query($conn,$q);
							while($row = $re->fetch_assoc()) {
								$tid= $row['testid'];
								 $tn= $row['tname'];
								$cs= $row['costs'];
							}
						mysqli_close($conn);	
						?>
						<div>TestID: <?php echo $tid;?></div>
						<div>Test Name: <?php echo $tn;?></div>
						<div>Cost: <?php echo $cs;?></div>
		
		</div>
		</body>
		</html>