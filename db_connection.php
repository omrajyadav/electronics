<?php
$_servername= "localhost";
$_username = "root";
$_password= "";
$_database="ecom_table";

$conn = mysqli_connect($_servernae, $_username, $_password, $_database);

if($conn){
    // echo "Connection successful <br>";
}
else{
    echo "Connection Error";
}
?>