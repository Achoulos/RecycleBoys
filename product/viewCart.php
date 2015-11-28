<?php 
session_start();	// Start the session before you write your HTML page
?>
<?php 
    include ("inventory.php"); 
 ?>
 <?php 
 	// get the current quantities from inventory.
 	ini_set('display_errors','On');
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

      $sql="SELECT * FROM Catalog";

      $result = $con->query($sql);
      if (!$result)
      {
        die('Error: ' . mysqli_error($con));
      } 
  
    while($row = mysqli_fetch_assoc($result)) {
        $inventory[$row['Code']] = $row['Quantity'];
    }
 ?>
<?php 
// This function displays the contents of the shopping cart 
function show_cart() {
	global $widgets;
    if (isset($_SESSION['cart'])){
		echo "Your Shopping Cart has the following items so far:<br/>"; 
		$mycart = $_SESSION['cart'];
		foreach ($mycart as $key => $value){
			if ($value >0) {
			    // get the full widget name from the widgets array;
				$fullname = $widgets[$key];
				print("$fullname = $value"."<a href="."viewCart.php?drop=$key".
				">    Remove</a><br/>");
			}
		}
	}
	else {
		echo "No items in the cart";
	
	}
}
// This function removes an item from the shopping cart
function drop() {
	 if (isset($_GET['drop'])){
	 	$dropItemId = $_GET['drop'];	 		 		
		if (isset($_SESSION['cart'])){
			$mycart = $_SESSION['cart'];
			if ($mycart[$dropItemId] > 1) {
				$mycart[$dropItemId] = ($mycart[$dropItemId] - 1);
			}
			else { 
				unset ($mycart[$dropItemId]);	
			}		
			$_SESSION['cart'] = $mycart; 			
		} 
	}  
} 
// Adds an item to the shopping cart
function addToCart(){
	// Access the global array
	global $widgets;
	global $inventory;
	
	// Get the item id to add - this is the string sent with the 
	// selection when the user clicked a link
	
	$addItemId = $_GET['add'];

		 		 		
	if (isset($_SESSION['cart'])){
		$mycart = $_SESSION['cart'];
		
		// if the item already exists, increment the count
		if (isset($mycart[$addItemId])){
			$mycart[$addItemId]+= 1;									
		} 
		// if the item does not exist, add it to the cart
		else{
			$mycart[$addItemId] = 1;
		}		
	}
	else{
		// cart does not exist, create one
		$mycart = array();
		$mycart[$addItemId] = 1;
	}
    $_SESSION['cart'] = $mycart; 
	echo "$widgets[$addItemId] added to cart <br/>";  
}
function clearCart(){
	if (isset($_GET['clear'])){
	 	if (isset($_SESSION['cart'])){
			unset($_SESSION['cart']); 
	  	}
		echo "Shopping Cart Cleared ";
	} 
}
function checkout()
{
	global $widgets;
	global $prices;
	global $inventory;

	$grandTotal = 0;

	if (isset($_SESSION['cart'])){
		echo "Your Checkout:<br/>"; 
		$mycart = $_SESSION['cart'];
		foreach ($mycart as $key => $value){
		if ($value >0) {
			    // get the full widget name from the widgets array;
				$fullname = $widgets[$key];
				if ($inventory[$key] - $value < 0) {
					$subtotal = (($prices[$key]) * $value);
					print("$fullname = $value"." Subtotal: 0<br>");
					print("There aren't enough $fullname for your order.<br>");
					print("We will notify you when $fullname is back in stock.<br>");
				} else {
					$subtotal = (($prices[$key]) * $value);
					$grandTotal += $subtotal;
					print("$fullname = $value"." Subtotal: " . $subtotal . "<br>");
				}
			}
		}
		print("Grand Total: " . $grandTotal);
	} else {
		echo "No items in the cart";
	}
    
	session_destroy();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns = "http://www.w3.org/1999/xhtml">
<head><title>ViewCart</title></head>
<body>
<?php
	// if user has chosen "add"
	if ( isset($_GET['add'])) { 
		addToCart();
		unset($_GET['add']);
	}
	// if user has chosen "show cart"	
	elseif (isset($_GET['show'])){ 
		show_cart();
		unset($_GET['show']);	
	}
	// if user has chosen "clear cart"	
	elseif (isset($_GET['clear'])){ 
		clearCart();
		unset($_GET['clear']);	
	}
	// if user has chosen "remove item from cart"		
	elseif (isset($_GET['drop'])){ 
		drop();
		unset($_GET['drop']);	
	}// if user has chosen "remove item from cart"		
	elseif (isset($_GET['checkout'])){ 
		checkout();
		unset($_GET['checkout']);	
	}	   	
?>
<p> 
    <a href="catalog.php?">Back to the Catalog</a> 
</p> 
 </body>
</html>
