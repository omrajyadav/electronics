<?php
session_start();
include 'db_connection.php';
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$query = "SELECT * FROM `tbl_customer` WHERE `customer_email`='$email' AND `customer_password`='$password'AND `customer_name`='$username'";
$result = mysqli_query($conn, $query);
if($result->num_rows>0){
    $row = mysqli_fetch_array($result);
    echo "Login successful...!";
    $_SESSION["login"] = 1;
    $_SESSION["customer_id"] = $row["customer_id"];
    echo "<script>window.location.href='index.php'</script>";
}
else{
    echo "Login unsuccessful...!";
}


?>