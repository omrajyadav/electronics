<?php
session_start();
include("db_connection.php");
$product_id = $_GET["id"];
$customer = $_SESSION["customer_id"];
$query = "INSERT INTO tbl_wishlist(`wishlist_product_id`,`wishlist_customer_id`) VALUES('$product_id','$customer')";
$result = mysqli_query($conn, $query);
if ($result) {
    $_SESSION["success"] = "Add Successfully..!";
    echo "<script>window.location.href='wishlist.php'</script>";
}else{

}
?>