<?php
include('header.php');
include('sidebar.php');
?>

<!-- Full Page Design with Bootstrap -->
<div class="container-fluid">

    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-8 col-lg-6">
            <!-- Add Category Form Card -->
            <div class="card shadow-lg border-light rounded-lg">
                <div class="card-body p-5">
                    <h3 class="text-center text-dark mb-4">Add product</h3>
                    <div class="mb-3">
                        <a href="product_list.php" class="btn btn-secondary btn-lg">
                            <h6><i class="fas fa-arrow-left">Back to product list page</i></h6>
                        </a>
                    </div>
                    <form action="product_insert.php" method="POST" enctype="multipart/form-data">
                        <!-- Category Name -->
                        <div class="form-group">
                            <label for="product_name">product Name</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg"
                                placeholder="Enter product name" required>
                        </div>

                        <!-- Category Image -->
                        <div class="form-group">
                            <label for="image">product Image</label>
                            <input type="file" name="image" id="image" class="form-control form-control-lg"
                                accept="image/*" required>
                        </div>
                        <div class="form-group">
                            <label for="product_MRP">MRP</label>
                            <input type="text" name="MRP" id="MRP" onkeyup='testFun()'
                                class="form-control form-control-lg" placeholder="Enter product MRP" required>
                        </div>
                        <div class="form-group">
                            <label for="product_name"> discount percentage</label>
                            <input type="text" name="discount_percentaged" id="discount_percentaged"
                                onkeyup="testFun();" class="form-control form-control-lg"
                                placeholder="Enter product discount percentaged" required>
                        </div>
                        <div class="form-group">
                            <label for="product_name"> discount_value</label>
                            <input type="text" name="discount_value" id="discount_value"
                                class="form-control form-control-lg" placeholder="Enter product discount value"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="product_name">sale price</label>
                            <input type="text" name="sale_price" id="sale_price" class="form-control form-control-lg"
                                placeholder="Enter product sale price" required>
                        </div>

                        <!-- Category Description -->
                        <div class="form-group">
                            <label for="product_description">product Description</label>
                            <textarea name="description" id="description" class="form-control form-control-lg"
                                placeholder="Enter product description" required></textarea>
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
<script type="text/javascript">
    function testFun() {
        var main_retailer_price = document.getElementById("MRP").value;
        var discount_percentaged = document.getElementById("discount_percentaged").value
        var discount_value = document.getElementById("discount_value").value = (main_retailer_price * discount_percentaged / 100)
        var sale_price = document.getElementById("sale_price").value = (main_retailer_price - discount_value)


    }
</script>
<?php
include('footer.php');
?>