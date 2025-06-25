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
                    <h3 class="text-center text-dark mb-4">Add Category</h3>
                    <div class="mb-3">
                        <a href="category_list.php" class="btn btn-secondary btn-lg">Back to Categories</a>
                    </div>
                    <form action="category_insert.php" method="POST" enctype="multipart/form-data">
                        <!-- Category Name -->
                        <div class="form-group">
                            <label for="category_name">Category Name</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg" placeholder="Enter category name" required>
                        </div>

                        <!-- Category Image -->
                        <div class="form-group">
                            <label for="image">Category Image</label>
                            <input type="file" name="image" id="image" class="form-control form-control-lg" accept="image/*" required>
                        </div>

                        <!-- Category Description -->
                        <!-- <div class="form-group">
                            <label for="category_description">Category Description</label>
                            <textarea name="description" id="description" class="form-control form-control-lg" placeholder="Enter category description" required></textarea>
                        </div> -->

                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 

<?php
include('footer.php');
?>
