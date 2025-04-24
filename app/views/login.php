<?php

// Xử lý đăng nhập
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Giả lập đăng nhập (thay bằng kiểm tra database sau này)
    if ($username === 'bee' && $password === '123456') {
        $_SESSION['user'] = [
            'username' => $username,
            'email' => 'beezy@gmail.com'
        ];
        header("Location: index.php?page=index");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Beezy</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #FFFFCC;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .main-content {
            flex: 1 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 0; 
        }
        .container {
            display: flex;
            width: 100%;
            max-width: 1200px;
            align-items: center;
            justify-content: space-between;
        }
        .left-section {
            flex: 1;
            color: white;
            text-align: center;
        }
        .left-section img {
            width: 140px;
            margin-bottom: 20px;
        }
        .left-section h1 {
            font-size: 48px;
            margin: 0;
            color: #333;
        }
        .left-section p {
            font-size: 18px;
            margin-top: 10px;
            color: #333;
        }
        .right-section {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        .right-section h2 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
        .right-section .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
            font-size: 14px;
        }
        .right-section input[type="text"],
        .right-section input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        .right-section button {
            width: 100%;
            padding: 10px;
            background-color: #FFC125;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 15px;
            cursor: pointer;
        }
        .right-section button:hover {
            background-color: #e6a700;
        }
        .right-section .forgot-password {
            text-align: right;
            margin-bottom: 20px;
        }
        .right-section .forgot-password a {
            color: #FFC125;
            text-decoration: none;
            font-size: 14px;
        }
        .right-section .social-login {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .right-section .social-login button {
            width: 48%;
            padding: 10px;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .right-section .social-login button img {
            width: 20px;
            margin-right: 10px;
        }
        .right-section .signup-link {
            text-align: center;
            font-size: 14px;
        }
        .right-section .signup-link a {
            color: #FFC125;
            text-decoration: none;
        }

        /* Media Query cho tablet (dưới 768px) */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                justify-content: center;
                padding: 20px;
            }
            .left-section {
                flex: none;
                margin-bottom: 20px;
            }
            .left-section img {
                width: 100px;
            }
            .left-section h1 {
                font-size: 36px;
            }
            .left-section p {
                font-size: 16px;
            }
            .right-section {
                width: 100%;
                max-width: 400px;
                padding: 20px;
            }
        }

        /* Media Query cho mobile (dưới 480px) */
        @media (max-width: 480px) {
            .main-content {
                padding: 20px 10px;
            }
            .container {
                padding: 10px;
            }
            .left-section img {
                width: 80px;
            }
            .left-section h1 {
                font-size: 28px;
            }
            .left-section p {
                font-size: 14px;
            }
            .right-section {
                padding: 15px;
            }
            .right-section h2 {
                font-size: 20px;
            }
            .right-section input[type="text"],
            .right-section input[type="password"] {
                padding: 10px;
                font-size: 14px;
            }
            .right-section button {
                padding: 10px;
                font-size: 14px;
            }
            .right-section .social-login {
                flex-direction: column;
                gap: 10px;
            }
            .right-section .social-login button {
                width: 100%;
                padding: 8px;
                font-size: 12px;
            }
            .right-section .social-login button img {
                width: 18px;
            }
            .right-section .forgot-password a {
                font-size: 12px;
            }
            .right-section .signup-link {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="container">
            <div class="left-section">
                <a href="/"><img src="img/logo.png" alt="Beezy Logo"></a>
                <h2 style="color: #363636;">Be smart. Be fast. Be Beezy!</h2>
            </div>
            <div class="right-section">
                <h2>LOGIN</h2>
                <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
                <form method="POST" action="">
                    <input type="text" name="username" placeholder="Username/ Email/ Phone number" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <div class="forgot-password">
                        <a href="#">Forgot Password</a>
                    </div>
                    <button type="submit">LOGIN</button>
                </form>
                <div class="social-login">
                    <button><img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook">Facebook</button>
                    <button><img src="img/gg.png" alt="Google">Google</button>
                </div>
                <div class="signup-link">
                    Don't have an account? <a href="?page=signup" class="auth-btn signup-btn"><i class="fa fa-user"></i> Sign up</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>