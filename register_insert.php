<?php
include 'db_connection.php';   
session_start();
$customer_name = $_POST["customer_name"];
$customer_email = $_POST["customer_email"];
$customer_password = $_POST["customer_password"];
$customer_phone = $_POST["customer_phone"];
$customer_address = $_POST["customer_address"];
$customer_landmark = $_POST["customer_landmark"];
$customer_status = $_POST["customer_status"];
$query = "INSERT INTO `tbl_customer`(`customer_name`, `customer_email`, `customer_password`, `customer_phone`, `customer_address`, `customer_landmark`, `customer_status`) VALUES ('$customer_name','$customer_email','$customer_password','$customer_phone','$customer_address','$customer_landmark','$customer_status')";
$result = mysqli_query($conn, $query);
if ($result) {
    $_SESSION["info"] = "Registration successful..";
            echo "<script>window.location.href='login.php'</script>";

} else {
    echo "Registration failed";
}

?>