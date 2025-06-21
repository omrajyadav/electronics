<?php
session_start();
include("db_connection.php");
$name = $_POST["name"];

$description = $_POST["description"];
$img = $_FILES["image"]["name"];
$tmp_name = $_FILES["image"]["tmp_name"];

move_uploaded_file($tmp_name, "uploads/categoryimg/$img");

$query = "INSERT INTO tbl_category (`name`,`image`,`description`) VALUES
('$name','$img','$description')";
$result = mysqli_query($conn, $query);
if ($result) {
    $_SESSION["success"] = "Registration successful..";
    echo "<script>window.location.href='category_list.php'</script>";

} else {
    echo "connection error";
}


?>