<?php
include "db_connection.php";

$id = $_GET["id"];
$sel = "SELECT * FROM `tbl_product` WHERE `id`=$id ";
$res = mysqli_query($conn, $sel);
while ($row = mysqli_fetch_array($res)) {

    $product_id = $row["id"];
}
$sel = "INSERT INTO `tbl_featured`(`product_id`) VALUES ('$product_id')";
$result = mysqli_query($conn, $sel);
if ($result) {
    echo "<script>window.location.href='featured_list.php';</script>";
}