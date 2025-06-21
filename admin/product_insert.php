<?php
session_start();
include("db_connection.php");

$name = $_POST["name"];
$MRP = $_POST["MRP"];
$discount_percentaged = $_POST["discount_percentaged"];
$discount_value = $_POST["discount_value"];
$sale_price = $_POST["sale_price"];

$category = $_POST["category"];
 

$description = $_POST["description"];
$img = $_FILES["image"]["name"];
$tmp_name = $_FILES["image"]["tmp_name"];

move_uploaded_file($tmp_name, "uploads/categoryimg/$img");

$query = "INSERT INTO tbl_product (`name`, `image`, `MRP`, `discount_percentaged`, `discount_value`, `sale_price`, `category`, `description`) VALUES
('$name', '$img', '$MRP', '$discount_percentaged', '$discount_value', '$sale_price', '$category', '$description')";

$result = mysqli_query($conn, $query);

if ($result) {
    echo "<script>window.location.href='product_list.php'</script>";
    $_SESSION["success"] = "Registration successful..";
} else {
    echo "Connection error";
}
?>