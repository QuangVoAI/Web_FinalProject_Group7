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
    <link rel="icon" type="image/png" href="img/logo.png">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0; 
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            display: flex;
            width: 100%;
            max-width: 800px;
            min-height: 500px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }
        .left-section {
            flex: 1;
            background-color: #FFFFCC; 
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            text-align: center;
        }
        .left-section img {
            width: 100px;
            margin-bottom: 20px;
        }
        .left-section h1 {
            font-size: 36px;
            font-weight: bold;
            margin: 0;
        }
        .left-section p {
            font-size: 18px;
            margin-top: 10px;
        }
        .right-section {
            flex: 1;
            background-color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }
        .right-section h2 {
            font-size: 28px;
            color: #FFC125;
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }
        .right-section .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
            font-size: 14px;
        }
        .right-section form {
            display: flex;
            flex-direction: column;
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
        .right-section input[type="password"] {
            padding-right: 40px;
        }
        .password-wrapper {
            position: relative;
        }
        .password-wrapper .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
        .password-wrapper .toggle-password img {
            width: 20px;
        }
        .right-section button {
            width: 100%;
            padding: 12px;
            background-color: #FFC125; 
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            text-transform: uppercase;
            font-weight: bold;
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

        .right-section .signup-link {
            text-align: center;
            font-size: 14px;
            margin-top: 15px;
            margin-bottom: 10px;
        }
        .right-section .signup-link a {
            color: #FFC125;
            text-decoration: none;
        }
        .right-section .footer-text {
            text-align: center;
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }

        .right-section button:hover {
            background-color: FFC125; 
        }
        .mascot {
            position: absolute;
            bottom: 20px;
            right: 20px;
        }
        .mascot img {
            width: 80px;
        }
        .mascot p {
            font-size: 12px;
            color: #666;
            text-align: right;
            margin-top: 5px;
        }

        /* Media Query cho tablet (dưới 768px) */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                max-width: 400px;
            }
            .left-section {
                padding: 30px;
            }
            .left-section img {
                width: 80px;
            }
            .left-section h1 {
                font-size: 28px;
            }
            .left-section p {
                font-size: 16px;
            }
            .right-section {
                padding: 20px;
            }
            .mascot img {
                width: 60px;
            }
        }

        /* Media Query cho mobile (dưới 480px) */
        @media (max-width: 480px) {
            .login-container {
                max-width: 300px;
            }
            .left-section img {
                width: 60px;
            }
            .left-section h1 {
                font-size: 24px;
            }
            .left-section p {
                font-size: 14px;
            }
            .right-section {
                padding: 15px;
            }
            .right-section h2 {
                font-size: 24px;
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
            .mascot p {
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="left-section">
            <a href="/"><img src="img/logo.png" alt="Beezy Logo"></a>
            <h3 style="font-family: Monospace; color: #363636;"> Be smart. Be fast. Be Beezy!</h3>
        </div>
        <div class="right-section">
            <h2>LOGIN</h2>
            <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
            <form method="POST" action="">
                <input type="text" name="username" placeholder="Username/ Email/ Phone number" required>
                <div class="password-wrapper">
                    <input type="password" name="password" placeholder="Password" required>
                    <div class="forgot-password">
                        <a href="#">Forgot Password</a>
                    </div>
                </div>
                <button type="submit">LOGIN</button>
            </form>
            <div class="signup-link">
                    Don't have an account? <a href="?page=signup" class="auth-btn signup-btn"><i class="fa fa-user"></i> Sign up</a>
            </div>
            <div class="mascot">
                <p>Login in to use Beezy!</p>
            </div>
        </div>
    </div>
</body>
</html>