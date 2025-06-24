<?php
session_start();
include 'db_connection.php';
$id = $_GET['id'];
$query = "DELETE FROM tbl_wishlist WHERE wishlist_product_id='$id'";
$result = mysqli_query($conn, $query);
if ($result) {
    $_SESSION["danger"]="wishlist Deleted Successfully!";
    echo "<script>window.location.href='wishlist.php'</script>";


} else {
    echo "connection error";
}


?>