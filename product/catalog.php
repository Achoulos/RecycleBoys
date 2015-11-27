<?php 
	session_start();// Start the session before you write your HTML page
?>
 <?php 
    include ("inventory.php"); 	
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns = "http://www.w3.org/1999/xhtml">
<head><title> Widget Catalog </title></head>
<body>
<table>
  <tr> <th> Widget <th> Weight <th> Price <th> 

  <tr> <td> Hammer </td>
       <td> 2 lbs </td>
       <td> <?php global $prices; echo "$",$prices["hm"]; ?> </td>
       <td> <a href="viewCart.php?add=hm">Add to cart</a> </td>
  </tr>
  <tr> <td> Wrench </td>
       <td> 1 lb </td>
       <td> <?php global $prices; echo "$",$prices["wr"]; ?> </td>
       <td> <a href="viewCart.php?add=wr">Add to cart</a></td>
  </tr>
  <tr> <td> Nut</td>
       <td> 0.5 lb </td>
       <td> <?php global $prices; echo "$",$prices["nt"]; ?> </td>
       <td> <a href="viewCart.php?add=nt">Add to cart</a></td>
  </tr>
  <tr> <td> Motor</td>
       <td> 10 lbs </td>
       <td> <?php global $prices; echo "$",$prices["mt"]; ?> </td>
       <td> <a href="viewCart.php?add=mt">Add to cart</a></td>
  </tr>
  </table>
  
  <p> 
    <a href="viewCart.php?show">View Shopping Cart</a> 
    <br/> <br/>
	<a href="viewCart.php?checkout">Checkout</a> 
    <br/> <br/>
    <a href="viewCart.php?clear">Clear Shopping Cart</a> 
   </p> 

  </body>
</html>
