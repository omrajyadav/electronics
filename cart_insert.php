<?php
session_start();    
include "db_connection.php";

// Check if customer_id is set in session
if (!isset($_SESSION["customer_id"])) {
}

$product_id = $_POST["id"];
$customer_id = $_SESSION["customer_id"];
$cart_qty = $_POST['cart_qty'];
$query = "INSERT INTO tbl_cart (`cart_product_id`, `cart_customer_id`, `cart_qty`) VALUES 
('$product_id','$customer_id','$cart_qty')";
$result = mysqli_query($conn, $query);
if ($result) {
    $_SESSION["success"] = "cart added to cart successfully";
    echo "<script>window.location.href='cart_add.php'</script>";
} else {
    echo "Contact form submission failed";
}

?>