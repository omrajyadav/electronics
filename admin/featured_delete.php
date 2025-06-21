<?phP
session_start();
include 'db_connection.php';
$id=$_GET["feature_id"];
$query = "DELETE FROM tbl_featured WHERE feature_id='$id'";
$result = mysqli_query($conn,$query);
if ($result) {
    echo "<script>window.location.href='featured_list.php'</script>";
    $_SESSION["danger"]=" Category Deleted Successfully!";

   
} else {
    echo "connection error";
}


?>
