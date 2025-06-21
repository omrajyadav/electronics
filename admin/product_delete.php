<?phP
session_start();
include 'db_connection.php';
$id=$_GET["id"];
$query = "DELETE FROM tbl_product WHERE id='$id'";
$result = mysqli_query($conn,$query);
if ($result) {
    echo "<script>window.location.href='product_list.php'</script>";
    $_SESSION["danger"]="product Deleted Successfully!";

   
} else {
    echo "connection error";
}


?>
