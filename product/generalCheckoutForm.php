<?php 
	session_start();// Start the session before you write your HTML page
?>
<?php
function redirect($url, $statusCode = 303)
{
   header('Location: ' . $url, true, $statusCode);
   die();
}

if (!isset($_SESSION['memberId'])) {
	echo '<form method="post" action="viewCart.php?checkout">
	  Mailing Address: <input type="text">
	  Phone Number: <input type="text">
	  Email: <input type="text">
	  <input type="submit">
	 </form>';
} else {
	redirect("viewCart.php?checkout");
}
 ?>
