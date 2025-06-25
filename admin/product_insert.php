<?php
session_start();
include("db_connection.php");

$name = mysqli_real_escape_string($conn, $_POST["name"]);
$MRP = mysqli_real_escape_string($conn, $_POST["MRP"]);
$discount_percentaged = mysqli_real_escape_string($conn, $_POST["discount_percentaged"]);
$discount_value = mysqli_real_escape_string($conn, $_POST["discount_value"]);
$sale_price = mysqli_real_escape_string($conn, $_POST["sale_price"]);
$category = mysqli_real_escape_string($conn, $_POST["category"]);
$description = mysqli_real_escape_string($conn, $_POST["description"]);
$img = mysqli_real_escape_string($conn, $_FILES["image"]["name"]);
$tmp_name = $_FILES["image"]["tmp_name"];

move_uploaded_file($tmp_name, "uploads/categoryimg/$img");

$query = "INSERT INTO tbl_product (`name`, `image`, `MRP`, `discount_percentaged`, `discount_value`, `sale_price`, `category`, `description`) VALUES
('$name', '$img', '$MRP', '$discount_percentaged', '$discount_value', '$sale_price', '$category', '$description')";

$result = mysqli_query($conn, $query);

if ($result) {
    $_SESSION["success"] = "Registration successful..";
    echo "<script>window.location.href='product_list.php'</script>";
} else {
    echo "Connection error: " . mysqli_error($conn);
}
?>