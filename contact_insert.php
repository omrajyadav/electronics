<?php
include "db_connection.php";
$contact_name = $_POST["contact_name"];
$contact_subject = $_POST["contact_subject"];
$contact_emali = $_POST["contact_emali"];
$contact_message = $_POST["contact_message"];
$query = "INSERT INTO `tbl_contact`(`contact_name`, `contact_subject`, `contact_emali`,`contact_message`) VALUES 
('$contact_name','$contact_subject','$contact_emali','$contact_message')";
$result = mysqli_query($conn, $query);
if ($result) {
    $_SESSION["info"] = "Contact form submitted successfully..";
} else {
    echo "Contact form submission failed";
}







?>