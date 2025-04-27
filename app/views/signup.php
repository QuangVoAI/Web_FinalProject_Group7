<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Beezy</title>
    <link rel="icon" type="image/png" href="img/logo.png">
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #f5f5f5;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            display: flex;
            width: 100%;
            max-width: 800px; 
            min-height: 400px; 
            background-color: #ffffff;
            border-radius: 12px; 
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .left-section {
            flex: 1;
            background-color: #FFFFCC; 
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
            transition: transform 0.3s ease;
        }
        .left-section img:hover {
            transform: scale(1.1);
        }
        .left-section h2 {
            font-size: 24px; 
            font-weight: 700;
            margin: 0;
            color: #333;
            font-family: 'Roboto', monospace;
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
            font-weight: 700;
            text-transform: uppercase;
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
            border-radius: 5px;
            font-size: 14px; 
            box-sizing: border-box;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .right-section input[type="text"]::placeholder,
        .right-section input[type="password"]::placeholder {
            color: #aaa;
        }
        .right-section input[type="text"]:focus,
        .right-section input[type="password"]:focus {
            border-color: #FFC125;
            box-shadow: 0 0 5px rgba(255, 193, 37, 0.3);
            outline: none;
        }
        .right-section button {
            width: 100%;
            padding: 12px; 
            background-color: #FFC125;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 14px; 
            cursor: pointer;
            text-transform: uppercase;
            font-weight: 700;
            transition: background-color 0.3s ease, transform 0.1s ease;
        }
        .right-section button:hover {
            background-color: #e6a700;
            transform: translateY(-2px);
        }
        .right-section button:active {
            transform: translateY(0);
        }
        .right-section .login-link {
            text-align: center;
            font-size: 13px; 
            margin-top: 15px;
        }
        .right-section .login-link a {
            color: #FFC125;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .right-section .login-link a:hover {
            color: #e6a700;
            text-decoration: underline;
        }
        .mascot {
            position: absolute;
            bottom: 15px;
            right: 15px;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }
        .mascot img {
            width: 50px; 
            margin-bottom: 5px;
        }
        .mascot p {
            font-size: 11px; 
            color: #666;
            margin: 0;
        }

        /* Media Query for tablets (below 768px) */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                max-width: 400px; 
            }
            .left-section {
                padding: 30px;
            }
            .left-section img {
                width: 80px; 
            }
            .left-section h2 {
                font-size: 24px; 
            }
            .right-section {
                padding: 25px; 
            }
            .mascot img {
                width: 40px; 
            }
        }

        /* Media Query for mobile (below 480px) */
        @media (max-width: 480px) {
            .container {
                max-width: 300px; 
            }
            .left-section img {
                width: 60px; 
            }
            .left-section h2 {
                font-size: 24px; 
            }
            .right-section {
                padding: 15px; 
            }
            .right-section h2 {
                font-size: 28px; 
                margin-bottom: 20px;
            }
            .right-section input[type="text"],
            .right-section input[type="password"] {
                padding: 10px;
                font-size: 13px; 
            }
            .right-section button {
                padding: 10px;
                font-size: 13px; 
            }
            .right-section .login-link {
                font-size: 12px;
                margin-top: 10px;
            }
            .mascot img {
                width: 35px; 
            }
            .mascot p {
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-section">
            <a href="/"><img src="img/logo.png" alt="Beezy Logo"></a>
            <h3 style="font-family: Monospace; color: #363636;"> Be smart. Be fast. Be Beezy!</h3>
        </div>
        <div class="right-section">
            <h2>SIGN UP</h2>
            <form action="signup_process.php" method="POST">
                <input type="text" name="fullname" placeholder="Your name" required>
                <input type="text" name="email" placeholder="Email" required>
                <input type="text" name="phone" placeholder="Phone number" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="repeat_password" placeholder="Confirm Password" required>
                <button type="submit">SIGN UP</button>
            </form>
            <div class="login-link">
                Already have an account? <a href="?page=login">Login</a>
            </div>
            <div class="mascot">
                <p>Sign up to use Beezy!</p>
            </div>
        </div>
    </div>
</body>
</html>