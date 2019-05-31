<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome Doctor</title>
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

		hr {
			border: 1px solid black;
		}
		.your_details {
			border: 2px solid black;
			border-radius: 12px;
			padding: 20px;
			font-size: 20px;
			font-family: monospace;
			margin: 125px 25px 25px 500px;
			width: 25%;
		}
		.your_patients {
			
			
			font-size: 20px;
			font-family: monospace;
			margin: 75px 25px 25px 475px;
			width: 35%;
		}
		.view_buttons {
			margin-top:50px;
			margin-left:auto;
			margin-right:auto;
			text-align:center;
			border: 2px solid black;
			border-radius: 6px;
			padding:8px;
			width:100%;
			font-size:20px;
			background-color: grey;
			color:white;
			cursor: pointer;
		}
		.view_buttons:hover {
			background-color: green;
		}
    .hidden_block {
      font-size:20px;
			border: 3px solid black;
			border-radius:10px;
			padding: 6px;
    }
		.hidden_block:hover {
			background-color: green !important;
      color:white;
			cursor: pointer;
		}
		.del_pat:hover {
			background-color: red !important;
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
		table {
			border: 3px solid black;
			border-radius: 12px;
			
		}
		th,td {
			border:2px solid black; 
			padding: 10px;
		}
  </style>
	<script>
		function show_hide_x() {
			var x = document.getElementsByClassName("view_test").style.display;
			if (x === "none") {
					document.getElementByClassName("view_test").style.display="block";
			} else {
					document.getElementByClassName("view_test").style.display="none";
			}
		}
		function show_hide_y() {
			var y = document.getElementsByClassName("view_treat");
			if (y.style.display === "none") {
					y.style.display = "block";
			} else {
					y.style.display = "none";
			}
		}
		function myfunc() {
			alert("patient deleted successfully");
		}
	</script>
</head>
<body>
<?php
		error_reporting (E_ALL ^ E_NOTICE);

		$servername="localhost";
	$username="root";
	$password="nischaya#89$&";
	$dbname="hdbms";

	if($conn->connect_error) {
		die("connection failed:" .$conn->connect_error);
	}
	$conn=mysqli_connect($servername,$username,$password,$dbname);
	$sql = "SELECT `docid`, `name`,  `practype`  FROM doctor WHERE docid=?";
	$stmt = $conn->prepare($sql);
	$docid=$_SESSION['docid'];
		$stmt->bind_param('i', $docid);
		$stmt->execute();
		$result = $stmt->get_result();
	while ($row = $result->fetch_assoc()) {
		$doctid=$row['docid'];
		$name=$row['name'];
		$prac=$row['practype'];

	}
	$_SESSION['dname']=$name;
	$query = "SELECT dp.dname from department dp,doctor d where d.deptid=dp.deptid and d.docid=?";
	$stm=$conn->prepare($query);
	$stm->bind_param('i', $docid);
		$stm->execute();
		$res = $stm->get_result();
		while ($row = $res->fetch_assoc()) {
			$dname=$row['dname'];
		}
	
	
?>

  <nav class="navbar fixed-top navbar-dark bg-dark" style="height:70px">
		<div class="container-fluid">
			<img class="profile_pic" src="./imgs/doc.png"></img>
			<div class="profile_banner">Profile:Dr.<?php echo $name?></div>
			<button class="logout_but" type="button" onclick='window.location.href="http://localhost/loginpage.php"'>Logout</a></button>
		</div>
	</nav>

		<div class="your_details">
			<div><b>DocID: </b><?php echo $doctid ?></div>
			<hr>
			<div><b>Practice Type: </b><?php echo $prac ?></div>
			<hr>
			<div><b>Department:  </b><?php echo $dname ?></div>
			<hr>
		</div>
		<div class="your_patients">
			<h2 style="font-size:30px;text-align:center"><u>Your Patients</u></h2>
			<table>
			<tr>
			<th>PID</th>
			<th>Patient Name</th>
			<th>Age</th>
			<th>Disease</th>
			<th>Ward No</th>
			<?php
				$docid=$_SESSION['docid'];
				$sq="select pid,pname,age,disease,wardno from patient where docid=?";
				$st=$conn->prepare($sq);
				$st->bind_param('i',$docid);
				$st->execute();
				$rt=$st->get_result();				
				while($row=$rt->fetch_assoc()) {
					echo  "<tr><td>" . $row['pid'] . "</td><td>" . $row['pname'] . "</td><td>" . $row['age'] . "</td><td>\t" . $row['disease'] . "</td><td>" . $row['wardno']."</td></tr>" ;
				}?>
		</table></div>
		<center>
		<div class="container">
			<div class="row">
				<div class="col"><button class="view_buttons" onclick="window.location.href='http://localhost/add_patient.php'"> Add New Patient </button></div>
				<div class="col"><button class="view_buttons" onclick="window.location.href='http://localhost/add_test.php'"> Add New Test </button></div>
				<div class="col"><button class="view_buttons" onclick="window.location.href='http://localhost/add_treatment.php'"> Add New Treatment </button></div>
				<div class="col"><button class="view_buttons" onclick="window.location.href='http://localhost/view_test.php'">View Test</button></div>
				<div class="col"><button class="view_buttons" onclick="window.location.href='http://localhost/view_tr.php'">View Treatment</button></div>
			</div><br>

		</div><br>

	
			<div class="row">
				
				<div class="col"><form id="deletep" action="<?php $_PHP_SELF ?>" method="POST">
					<input type="text" style="padding:4px;border:2px solid black;border-radius:6px" name="pid4" placeholder="Enter Patient ID" />
				  <input type="submit" class="hidden_block del_pat" name="del_pat" value="Delete Patient"  onclick="setTimeout(function(){window.location.reload();},10)"/></form>
					<?php 
						
						$pid4=$_POST['pid4'];
						$q2="delete from patient where pid=$pid4";
						$rs=mysqli_query($conn,$q2);
						
						
						mysqli_close($conn);
						?>
						
								
				</div>
			</div>
		</div><br>
	</center>
</body>
</html>
