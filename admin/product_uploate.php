<?php
include 'db_connection.php';
$id = $_GET["id"];
$name = isset($_POST["name"]) ? $_POST["name"] : '';
$MRP = isset($_POST["MRP"]) ? $_POST["MRP"] : '';
$discount_percentaged = isset($_POST["discount_percentaged"]) ? $_POST["discount_percentaged"] : '';
$discount_value = isset($_POST["discount_value"]) ? $_POST["discount_value"] : '';
$sale_price = isset($_POST["sale_price"]) ? $_POST["sale_price"] : '';
$description = isset($_POST["description"]) ? $_POST["description"] : '';
$category = isset($_POST["category"]) ? $_POST["category"] : '';
$img = isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"] : '';
$tmp_name = isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"] : '';


if ($img) {
    move_uploaded_file($tmp_name, "uploads/categoryimg/$img");

    $query = "UPDATE tbl_product SET `name`='$name',`image`='$img',
    `MRP`='$MRP',`discount_percentaged`='$discount_percentaged',
    `discount_value`='$discount_value',`sale_price`='$sale_price',
    `description`='$description',`category`='$category' WHERE `id`='$id'";

} else {
    $query = "UPDATE tbl_product SET `name`='$name',
    `MRP`='$MRP',`discount_percentaged`='$discount_percentaged',
    `discount_value`='$discount_value',`sale_price`='$sale_price',
    `description`='$description',`category`='$category' WHERE `id`='$id'";
}
$result = mysqli_query($conn, $query);
if ($result) {
    $_SESSION["info"] = "Registration successful..";
    echo "<script>window.location.href='product_list.php'</script>";

} else {
    echo "Registration failed";
}
