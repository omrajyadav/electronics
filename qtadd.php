<?php
session_start();
include "db_connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cart_id = $_POST['cart_id'] ?? null;

    if (!$cart_id) {
        $_SESSION["danger"] = "Invalid cart item.";
        header("Location: cart.php");
        exit;
    }

    $qty = intval($_POST['cart_qty']);

    // Determine whether to increase or decrease quantity
    if (isset($_POST['plus'])) {
        $qty += 1;
    } elseif (isset($_POST['minus'])) {
        $qty = max(1, $qty - 1); // prevent going below 1
    }

    // Update the cart quantity
    $update = "UPDATE tbl_cart SET cart_qty = ? WHERE cart_id = ?";
    $stmt = mysqli_prepare($conn, $update);
    mysqli_stmt_bind_param($stmt, "ii", $qty, $cart_id);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION["success"] = "Quantity updated successfully.";
    } else {
        $_SESSION["danger"] = "Failed to update quantity.";
    }

    header("Location: cart_add.php");
    exit;
}
