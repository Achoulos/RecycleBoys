<?php 
	session_start();// Start the session before you write your HTML page
?>
 <?php 
    include ("inventory.php"); 	
 ?>
<?php include ("../general/header.php");
?>
<body>
  <?php 
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
    echo "<table border='.5'>
    <tr> <th> Code </th> <th> Product </th> <th> Price </th>";
    //echo "<th> Quantity </th>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['Code'] . "</td>";
        echo "<td>" . $row['Title'] . "</td>";
        echo "<td>" . $row['Price'] . "</td>";
        //echo "<td>" . $row['Quantity'] . "</td>";
        echo "<td> IMAGE GOES HERE BONILLA </td>";
        echo "<td> <a href=\"viewCart.php?add=" . $row['Code'] . "\">Add to cart</a></td>";
        echo "<tr>";
    }
    echo "</table>";
  ?>
  </table>
  <p> 
    <a href="../general/login.php">Login</a>
    <br/><br/>
    <a href="../general/register.php">Register</a>
    <br/><br/>
    <a href="viewCart.php?show">View Shopping Cart</a> 
    <br/> <br/>
	<a href="generalCheckoutForm.php">Checkout</a> 
    <br/> <br/>
    <a href="viewCart.php?clear">Clear Shopping Cart</a> 
   </p> 

  </body>
</html>
