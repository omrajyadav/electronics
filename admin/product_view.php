<?php
include "db_connection.php";
include "header.php";
include "sidebar.php";

if (isset($_GET["id"])) {
    $id = ($_GET["id"]);
    $query = "SELECT * FROM tbl_product WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_array($result)) {
    } else {
        $_SESSION["warning"] = "No blog found with this ID.";
        echo "<script>window.location.href='category_list.php'</script>";
    }
} else {
    $_SESSION["warning"] = "Invalid blog ID.";
}
?>

<div class="content-wrapper">
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-center">product view </h2>
            <a class="btn btn-outline-info" href="product_add.php">
                <i class="fas fa-plus  "></i> Add product
            </a>
        </div>

        <div class="card">
            <div class="card-header bg-info text-white">
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <br>
                        <img src="uploads/categoryimg/<?= ($row["image"]) ?>" class="img-fluid rounded shadow"
                            alt="<?= ($row["name"]) ?>">
                    </div>


                    <div class="col-md-8">
                        <table class="table table-bordered table-striped -hover">

                            <tr>
                                <td class="bg-light">category Name</td>
                                <td><?= ($row["name"]) ?></td>
                                <br>
                            </tr>
                            <tr>
                                <th class="bg-light">MRP</th>
                                <td><?= ($row["MRP"]) ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light">discount_percentaged</th>
                                <td><?= ($row["discount_percentaged"]) ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light">discount_value</th>
                                <td><?= ($row["discount_value"]) ?></td>

                            </tr>
                            <tr>
                                <th class="bg-light">sale_price</th>
                                <td><?= ($row["sale_price"]) ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light">category</th>
                                <td><?= ($row["category"]) ?></td>
                            </tr>

                            <tr>
                                <th class="bg-light">description</th>
                                <td><?= ($row["description"]) ?></td>
                            </tr>
                            <tr>

                        </table>
                    </div>
                </div>
            </div>

            <div class="card-footer text-end">
                <a href="product_list.php" class="btn btn-secondary">
                    <h6><i class="fas fa-arrow-left">Back to product list page</i></h6>
                </a>
            </div>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>