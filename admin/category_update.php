<?php
session_start();
include 'db_connection.php';
$id=$_GET["id"];
$name = $_POST["name"];
$description = $_POST["description"];
$img = $_FILES["image"]["name"];
$tmp_name = $_FILES["image"]["tmp_name"];


if ($img) {
    move_uploaded_file($tmp_name, "uploads/categoryimg/$img");

    $query = "UPDATE `tbl_category` SET `name`='$name',`image`='$img',`description`='$description' WHERE `id`='$id'";

} else {
    $query = "UPDATE `tbl_category` SET `name`='$name',`description`='$description'  WHERE `id `='$id' ";
}
$result = mysqli_query($conn, $query);
if ($result) {
    $_SESSION["info"] = "Registration successful..";
    echo "<script>window.location.href='category_list.php'</script>";
}
else {
    echo "Registration failed";
}
