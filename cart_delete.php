<?php
session_start();
include 'db_connection.php';
$id = $_GET['id'];
$query = "DELETE FROM tbl_cart WHERE cart_product_id='$id'";
$result = mysqli_query($conn, $query);
if ($result) {
    echo "<script>window.location.href='cart_add.php'</script>";
    $_SESSION["danger"]="card Deleted Successfully!";


} else {
    echo "connection error";
}


?>