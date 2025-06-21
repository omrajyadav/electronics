<?php
session_start();
include "db_connection.php"; // Fixed: correct file name and path

$customer = $_SESSION["customer_id"];
$total = $_POST["total"];
$address = $_POST["address"];
$d = $_POST["d"];
$status = $_POST["status"];
$term = $_POST["term"];
$paystatus = $_POST["paystatus"];


$query = "INSERT INTO tbl_order_master(order_m_customer_id,order_m_total_price,order_m_address,order_m_date,order_m_status,order_m_payment_term,order_m_payment_status) VALUES('$customer','$total','$address','$d','$status','$term','$paystatus')";
$result = mysqli_query($conn, $query);


$master_id = mysqli_insert_id($conn); // Get last inserted order ID


$sel = "SELECT * FROM tbl_cart WHERE tbl_cart.cart_customer_id = $customer";
$res = mysqli_query($conn, $sel);

while ($row = mysqli_fetch_array($res)) {
    $product_id = $row["cart_product_id"];
    $cardq = $row["cart_qty"];
    // Fix: Use correct product table name (tbl_product, not product_tbl)
    $product_query = "SELECT sale_price FROM tbl_product WHERE id='$product_id'";
    $product_res = mysqli_query($conn, $product_query);
    $product = mysqli_fetch_assoc($product_res);
    $totaloc = $product['sale_price'] * $cardq;


    $ins = "INSERT INTO tbl_order_child(oc_master_id,oc_product_id,oc_product_qty,oc_total_price) VALUES('$master_id','$product_id','$cardq','$totaloc')";
    mysqli_query($conn, $ins);
}


$sel = "DELETE FROM tbl_cart WHERE tbl_cart.cart_customer_id = $customer";
$result = mysqli_query($conn, $sel);

if ($result) {
    echo "<script>window.location.href='order_success.php'</script>";
} else {
    echo "<br>Not delete";
}
?>
