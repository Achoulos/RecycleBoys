<?php 
	session_start();// Start the session before you write your HTML page
	if (isset($_SESSION['memberId'])) {
		echo "Your previous session has been logged out. <br>";
		unset($_SESSION['memberId']);
	}
?>
<?php include ("../general/header.php");
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  Email: <input type="text" name="email" id="email">
  Phone: <input type="text" name="phone" id="phone">
  <input type="submit">
 </form>

<p>
	<a href="../home/home.html">Back To Home</a>
</p>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    # collect input data
     $email = $_POST['email'];
     $phone = $_POST['phone'];
     if (!empty($phone) && !empty($email)){
		$email = prepareInput($email);
	    $phone = prepareInput($phone);

	if (checkPhone($phone) && checkEmail($email)){
		 error_reporting(E_ALL);
	    $db_host = "localhost";
	    $db_user = "root";
	    $db_pass = "root";
	    $db_name = "mysql";
	    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	    // Check connection
	    if (mysqli_connect_errno())
	      {
	        echo "Failed to connect to MySQL: " . mysqli_connect_error();
	      }
		
		 $result = $con->query("SELECT * FROM MEMBERS WHERE Email='$email' AND Phone='$phone'");
	     if (!$result)
	     {
	        die('Error: ' . mysqli_error($con));
	     } 
	     $row = mysqli_fetch_assoc($result);
		if ($row){
			$_SESSION['memberId'] = $row['id'];
			echo "Successfully Logged in, $email <br>";
		} else {
			echo "Invalid login. Please try again. <br>";
		}
		mysql_close($con);
	} else {
		echo "Invalid data. Please try again. <br>"; 
	}
} else {
	echo "Empty input. Please input some data.<br>";
}
}
function prepareInput($inputData){
	$inputData = trim($inputData);
 	$inputData = stripslashes($inputData);
  	$inputData  = htmlspecialchars($inputData);
  	return $inputData;
}
function checkPhone($phone){
	if (preg_match('/^[2-9]\d{9}$/',$phone)){		
		echo "Phone ok <br>";
		return true;
	}
	else {
		echo "Invalid Phone <br>";
		return false;
	}
}
function checkEmail($email){

	if (preg_match('/^(?!.{30,})(\S+@\S+\.\S+)$/',$email)){
		echo "email ok <br>";
		return true;
	}
	else{
		echo "Invalid email <br>";
		return false;
	}
}

?>
<?php include ("../general/footer.php");
?>