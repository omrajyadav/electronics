<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        .video-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }
    </style>
</head>

<body>
    <video class="video-background" autoplay muted loop>
        <source src="uploads/categoryimg/login.mp4.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class=" p-4 shadow-lg" style="width: 400px; border-radius: 15px;">
            <h3 class="text-center mb-4 text-light">Welcome to login page !</h3>
            <p class=" text-light text-center">Please login to your account</p>
            <form method="POST" action="login_insert.php">
                <div class="mb-3">
                    <label for="username" class="form-label text-light">Username</label>
                    <input type="text" class="form-control" id="username" name="username"
                        placeholder="Enter your username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-light">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Enter your password" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label text-light">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email"
                        required>
                </div>

                <button type="submit" class="btn btn-info w-100 py-2">Login</button>

            </form>

            <div class="text-center mt-3">
                <a href="#" class="text-decoration-none text-light">Forgot Password?</a>
            </div>
            <div class="text-center mt-2">
                <a type="submit" href="register_form.php" class="btn btn-info w-100 py-2">register</a>
            </div>
        </div>
    </div>
</body>

</html>