<?php
if (!isset($_SESSION['memberId'])) {
	echo '<form method="post" action="viewCart.php?checkout">
	  Mailing Address: <input type="text">
	  Phone Number: <input type="text">
	  Email: <input type="text">
	  <input type="submit">
	 </form>';
}
 ?>