<?php
include('header.php');
include 'db_connection.php';
include('sidebar.php');
?>
<div class="content-wrapper">

    <div class="container">


        <h2 class="text-center">Category List</h2>
        <h3>Category list</h3>
        <form method="GET" action="category_list.php" class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <a href="category_add.php" class="btn btn-primary" style="float: right;">
            <i class="fas fa-plus"></i> Add Category
        </a>
    </div>
    <hr>
    <div class="container">

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="bg-info">
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Image</th>
                        <th>Category Description</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php

                    $query = "SELECT * FROM tbl_category";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><img src="uploads/categoryimg/<?php echo $row['image']; ?>" width="100" height="100"></td>
                            <td><?php echo $row['description']; ?></td>
                            <td>

                                <a href="category_view.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <br>
                                <a href="category_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-secondary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <br>
                                <a href="category_delete.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                                
                            </td>
                        <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>