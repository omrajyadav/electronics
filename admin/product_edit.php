<?php
include('header.php');
include('sidebar.php');
include("db_connection.php");
$id = $_GET["id"];
$query = "SELECT * FROM `tbl_product` WHERE`id`='$id' ";
$result = mysqli_query($conn, $query);
($row = mysqli_fetch_array($result));
?>
<!-- Full Page Design with Bootstrap -->
<div class="container-fluid">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-8 col-lg-6">
            <!-- Add Category Form Card -->
            <div class="card shadow-lg border-light rounded-lg">
                <div class="card-body p-5">
                    <h3 class="text-center text-dark mb-4"> edit product</h3>
                    <div class="mb-3">
                        <a href="product_list.php" class="btn btn-secondary btn-lg">
                            <h6><i class="fas fa-arrow-left">Back to product list page</i></h6>
                        </a>
                    </div>
                    <form action="product_uploate.php?id=<?= $row["id"] ?>" method="POST" enctype="multipart/form-data">
                        <!-- Category Name -->
                        <div class="form-group">
                            <label for="product_name"> Name</label>
                            <input type="text" name="name" id="name" value="<?= $row['name'] ?>"
                                class="form-control form-control-lg" placeholder="Enter product name" required>
                        </div>

                        <!-- Category Image -->
                        <div class="form-group">
                            <label for="image"> Image</label>
                            <input type="file" name="image" id="image" value="<?= $row["image"] ?>"
                                class="form-control form-control-lg" accept="image/*" required>
                        </div>


                        <div class="form-group">
                            <label for="product_MRP"> MRP</label>
                            <input type="text" name="MRP" id="MRP" value="<?= $row['MRP'] ?>" onkeyup="fun()"
                                class="form-control form-control-lg" placeholder="Enter product MRP" required>
                        </div>

                        <div class="form-group">
                            <label for="product discount_percentaged"> discount_percentaged</label>
                            <input type="text" name="discount_percentaged" id="discount_percentaged"
                                value="<?= $row['discount_percentaged'] ?>" onkeyup="fun()"
                                class="form-control form-control-lg" placeholder="Enter product discount_percentaged"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="product discount_value"> discount_value</label>
                            <input type="text" name="discount_value" id="discount_value"
                                value="<?= $row['discount_value'] ?>" class="form-control form-control-lg"
                                placeholder="Enter product discount_value" required>
                        </div>
                        <div class="form-group">
                            <label for="product sale_price"> sale_price</label>
                            <input type="text" name="sale_price	" id="sale_price" value="<?= $row['sale_price'] ?>"
                                class="form-control form-control-lg" placeholder="Enter product sale_price	" required>
                        </div>
                        <!-- Category Description -->
                        <div class="form-group">
                            <label for="product_description"> Description</label>
                            <textarea name="description" id="description" class="form-control form-control-lg"
                                value="<?= $row["description"] ?>" placeholder="Enter product description"
                                required></textarea>
                        </div>
                        <b>select category</b>
                        <select name="category" class="form-control mb-3" id="">
                            <option value="">select category</option>

                            <?php
                            include 'db_connection.php';
                            $query = "SELECT * FROM `tbl_category`";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <option value="<?= $row['id'] ?>">
                                    <?= $row['name'] ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function fun() {
        var MRP = document.getElementById("MRP").value;
        var discount_percentaged = document.getElementById("discount_percentaged").value
        var discount_value = document.getElementById("discount_value").value = (MRP * discount_percentaged / 100)
        var sale_price = document.getElementById("sale_price").value = (MRP - discount_value)


    }
</script>
<?php
include('footer.php');
?>