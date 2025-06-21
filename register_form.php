<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registration form</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <div class="card" style="width:30rem;margin-top:200px">
                    <div clas="card-body">
                        <form action="register_insert.php" method="post">
                            <h1 class="text-center">registration form</h1>
                            <div class="form-group">
                                <label for="customer_name">customer_name</label>
                                <input type="customer_name" class="form-control" placeholder="customer_name" name="customer_name">
                            </div>
                            <div class="form-group mb-3">
                                <label for="email address">customer_email </label>
                                <input type="customer_email" class="form-control" placeholder="customer_email " name="customer_email">
                            </div>

                            <div class="form-group mb-3">
                                <label for="customer_password">customer_password	</label>
                                <input type="customer_password" class="form-control" placeholder="customer_password" name="customer_password">
                            </div>
                            <div class="form-group mb-3">
                                <label for="customer_phone">customer_phone</label>
                                <input type="customer_phone" class="form-control" placeholder="customer_phone" name="customer_phone">
                            </div>
                            <div class="form-group mb-3">
                                <label for="customer_address">customer_address	</label>
                                <input type="customer_address" class="form-control" placeholder="customer_address" name="customer_address">
                            </div>
                            <div class="form-group mb-3">
                                <label for="customer_landmark">customer_landmark	</label>
                                <input type="customer_landmark" class="form-control" placeholder="customer_landmark" name="customer_landmark">
                            </div>
                            <div class="form-group mb-3">
                                <label for="customer_status">customer_status	</label>
                                <input type="customer_status" class="form-control" placeholder="customer_status" name="customer_status">
                            </div>
                            <div class="mb-3 form-check">
                                <label class="form-check-label" for="examplecheck1">Remember me?</label>

                            </div>
                            <button type="submit" class="btn btn-info" style="width:450px">register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>