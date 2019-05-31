<?php session_start(); ?>
<html>
<body>
<?php
	error_reporting(E_ALL ^ E_NOTICE);
	
	
		$servername="localhost";
	$username="root";
	$password="nischaya#89$&";
	$dbname="hdbms";
	
	$conn=mysqli_connect($servername,$username,$password,$dbname);
	
	if($conn->connect_error) {
		die("connection failed:" .$conn->connect_error);
	}
	$docid=$_POST['docid'];
	$pass1=$_POST['password'];
	$_SESSION['docid']=$docid;
		$sql = "SELECT  `docid`,`password` FROM `dpass` WHERE docid=?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('i', $docid);
		$stmt->execute();
		$result = $stmt->get_result();

		while ($row = $result->fetch_assoc()) {
			if (password_verify($pass1, $row['password'])) {
				header('location:doc_mainpage.php');
			}
			else echo"failed";
		}
	
?>
</body>
</html>