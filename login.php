<?php
include_once "config/dbconnect.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        .login-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f9;
        }

        .login-card {
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <h3 class="text-center mb-4">Login</h3>
            <form action="" method="post">
                <!-- Username Input -->
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="email" class="form-control" id="username" placeholder="Enter your username"
                        required>
                </div>
                <!-- Password Input -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password"
                        placeholder="Enter your password" required>
                </div>
                <!-- Login Button -->
                <div class="d-grid gap-2">
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                </div>
            </form>
            <?php
            if (isset($_POST['login'])) {
                $email = $_POST['email'];
                $password = md5($_POST['password']);

                $count = countData("select * from admin where email='$email' and password='$password'");
                if ($count >= 1) {
                    $_SESSION['admin'] = $email;
                    redirect("admin/index.php");
                } else {
                    msg("ivailid login try again");

                }
            }

            ?>
            <!-- Forgot Password -->
            <div class="text-center mt-3">
                <a href="" class="btn btn-success w-100">Go Back</a>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>