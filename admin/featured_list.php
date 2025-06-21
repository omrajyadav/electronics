<?php
include('header.php');
include 'db_connection.php';
include('sidebar.php');
?>
<div class="content-wrapper">


    <div class="container-fluid">
        <h2 class="text-center">featured product  List</h2>
        <div class="container">


            <h3>product list</h3>
            <form method="GET" action="" class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search"
                    aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
          
        </div>
        <hr>
        <div class="container">

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="bg-primary">
                        <tr>
                            <th>ID</th>
                            <th>product Name</th>
                            <th>Image</th>
                            <th>MRP</th>
                            <th>discount_percentaged</th>
                            <th>Discount value </th>
                            <th>sale price </th>
                            <th> Description </th>
                            <th>category</th>
                            <!-- <th>featured product</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php

                        $query = "SELECT * FROM tbl_featured INNER JOIN tbl_product ON tbl_product.id = tbl_featured.product_id ";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($result)) {
                            ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><img src="uploads/categoryimg/<?php echo $row['image']; ?>" width="100" height="100">
                                </td>
                                <td><?php echo $row['MRP']; ?></td>
                                <td><?php echo $row['discount_percentaged']; ?></td>
                                <td><?php echo $row['discount_value']; ?></td>
                                <td><?php echo $row['sale_price']; ?></td>
                                <td><?php echo $row['description']; ?></td>
                                <td><?php echo $row['category']; ?></td>
                               <!-- <td> -->
                                    <!-- <a href="featured_insert.php?id=<?=$row["id"]?>" class="text-warning fs-5">
                                        <i class="fa fa-star"></i>
                                    </a> -->
                                <!-- </td> -->

                                <td>
                                   
                                    <br>
                                    <a href="featured_delete.php?feature_id=<?php echo $row['feature_id']; ?>"
                                        class="btn btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
include('footer.php');
?>