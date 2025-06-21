<?phP
session_start();
include 'db_connection.php';
$id=$_GET["id"];
$query = "DELETE FROM tbl_category WHERE id='$id'";
$result = mysqli_query($conn,$query);
if ($result) {
    echo "<script>window.location.href='category_list.php'</script>";
    $_SESSION["danger"]=" Category Deleted Successfully!";

   
} else {
    echo "connection error";
}


?>
