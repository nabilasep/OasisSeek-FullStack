<?php
if (!session_id())
    session_start();

use \model\User;

require_once __DIR__ . "/database/database.php";
require_once __DIR__ . "/model/User.php";
require_once __DIR__ . "/middleware/middleware.php";

// Middleware to check if user is not logged in
isNotLoggedIn();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST["password"];

    $query = "SELECT email, password, username, name, phone, photo, role FROM users WHERE email = ?";
    $statement = $dbs->prepare($query);
    $statement->bind_param("s", $email);
    $statement->execute();
    $result = $statement->get_result();
    $data = $result->fetch_assoc();

    if (!$data) {
        echo "<script>alert('Email atau Password salah')</script>";
    } else if (password_verify($password, $data['password'])) {
        $user = new User();
        $user->email = $data['email'];
        $user->username = $data['username'];
        $user->password = $data['password'];
        $user->name = $data['name'];
        $user->photo = $data['photo'];
        $user->role = $data['role'];
        $user->phone = $data['phone'];

        $_SESSION['user'] = (array)$user;
        $_SESSION['loggedin'] = true;
        $_SESSION['role'] = $data['role'];

        if($user->role == 'admin') {
            header('Location: /admin/dashboard.php');
            exit();
        }
        
        header('Location: /');
        exit(); // Pastikan untuk keluar setelah mengirim header
    } else {
        echo "<script>alert('Email atau Password salah')</script>";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Oasis Seek</title>
        <link rel="stylesheet" type="text/css" href="/css/styles.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .login-container {
            background-color: #fff;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            }
            
            .login-wrapper {
            display: flex;
            flex-direction: column;
            position: relative;
            min-height: 1024px;
            width: 100%;
            justify-content: center;
            padding: 85px 48px;
            }
            
            .background-image {
            position: absolute;
            inset: 0;
            height: 100%;
            width: 100%;
            object-fit: cover;
            object-position: center;
            }
            
            .content-box {
            position: relative;
            border-radius: 20px;
            background: var(--foundation-yellow-light-active, #ebdac8);
            padding: 59px 64px;
            }
            
            .content-grid {
            gap: 20px;
            display: flex;
            }
            
            .image-column {
            display: flex;
            flex-direction: column;
            line-height: normal;
            width: 59%;
            }
            
            .login-image {
            aspect-ratio: 0.85;
            object-fit: contain;
            object-position: center;
            width: 100%;
            border-radius: 20px;
            flex-grow: 1;
            }
            
            .form-column {
            display: flex;
            flex-direction: column;
            line-height: normal;
            width: 41%;
            margin-left: 20px;
            }
            
            .form-container {
            position: relative;
            display: flex;
            margin-top: 60px;
            width: 100%;
            flex-direction: column;
            }
            
            .brand-title {
            align-self: center;
            margin-left: 10px;
            font: 400 48px Underdog, sans-serif;
            }
            
            .login-header {
            align-self: center;
            display: flex;
            margin-top: 22px;
            width: 209px;
            max-width: 100%;
            align-items: center;
            gap: 5px -1px;
            font-family: Poppins, sans-serif;
            justify-content: center;
            flex-wrap: wrap;
            }
            
            .login-title {
            color: #000;
            font-size: 30px;
            font-weight: 600;
            align-self: stretch;
            margin: auto 0;
            }
            
            .signup-prompt {
            align-self: stretch;
            display: flex;
            align-items: start;
            gap: 2px;
            font-size: 15px;
            color: #0094ff;
            font-weight: 400;
            justify-content: center;
            flex-grow: 1;
            width: 191px;
            margin: auto 0;
            }
            
            .login-form {
            display: flex;
            margin-top: 23px;
            flex-direction: column;
            color: #444b59;
            white-space: nowrap;
            letter-spacing: 1.8px;
            justify-content: start;
            font: 600 18px Poppins, sans-serif;
            }
            
            .input-group {
            border-radius: 12px;
            display: flex;
            max-width: 100%;
            width: 421px;
            flex-direction: column;
            }
            
            .form-input {
            border-radius: 12px;
            background-color: rgba(255, 255, 255, 0);
            display: flex;
            margin-top: 17px;
            height: 42px;
            border: 3px solid #734c10;
            }
            
            .form-options {
            display: flex;
            margin-top: 30px;
            width: 100%;
            gap: 40px;
            }
            
            .remember-group {
            display: flex;
            align-items: start;
            gap: 13px;
            flex: 1;
            }
            
            .checkbox-wrapper {
            stroke-width: 2px;
            background-color: var(--white, #fff);
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            fill: var(--white, #fff);
            padding: 7px 6px;
            border: 2px solid #734c10;
            }
            
            .checkbox-inner {
            background-color: #000;
            box-shadow: 2px 4px 4px rgba(78, 99, 141, 0.12);
            border-radius: 50%;
            display: flex;
            width: 15px;
            height: 14px;
            }
            
            .remember-text {
            color: #444b59;
            letter-spacing: 1.8px;
            flex-basis: auto;
            font: 400 18px Poppins, sans-serif;
            }
            
            .forgot-password {
            color: #444b59;
            letter-spacing: 1.8px;
            flex-grow: 1;
            width: 150px;
            font: 400 18px Poppins, sans-serif;
            }
            
            .login-button {
            align-self: stretch;
            border-radius: 12px;
            background-color: #734c10;
            margin-top: 33px;
            gap: 10px;
            overflow: hidden;
            color: var(--Foundation-Yellow-Light, #f8f3ed);
            white-space: nowrap;
            padding: 8px 186px;
            font: 400 15px Poppins, sans-serif;
            }
            
            .visually-hidden {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            border: 0;
            }
            
            @media (max-width: 991px) {
            .login-wrapper {
                max-width: 100%;
                padding: 0 20px;
            }
            
            .content-box {
                max-width: 100%;
                padding: 0 20px;
            }
            
            .content-grid {
                flex-direction: column;
                align-items: stretch;
                gap: 0;
            }
            
            .image-column {
                width: 100%;
            }
            
            .login-image {
                max-width: 100%;
                margin-top: 40px;
            }
            
            .form-column {
                width: 100%;
            }
            
            .form-container {
                max-width: 100%;
                margin-top: 40px;
            }
            
            .brand-title {
                font-size: 40px;
            }
            
            .login-form {
                max-width: 100%;
                margin-right: 8px;
                white-space: initial;
            }
            
            .input-group {
                white-space: initial;
            }
            
            .form-label {
                margin-left: 9px;
            }
            
            .form-input {
                max-width: 100%;
            }
            
            .form-options {
                max-width: 100%;
                margin-right: 8px;
            }
            
            .login-button {
                white-space: initial;
                padding: 0 20px;
            }
            }
            </style>
    </head>

    <body>
        <div class="login-container">
          <div class="login-wrapper">
            <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/0531993187149dbf378c78dfa09c5fad3741573dd39e2d51be801f5ea605c52b?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d" class="background-image" alt="" />
            <div class="content-box">
              <div class="content-grid">
                <div class="image-column">
                  <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/77364bbb6afb29b49e15c1eead3b0f04de6614b1d0333f6c14b66c5d3dadccf2?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d" class="login-image" alt="Login illustration" />
                </div>
                <div class="form-column">
                  <form class="form-container" method="POST" action="">
                    <h1 class="brand-title">OasisSeek</h1>
                    <div class="login-header">
                      <h2 class="login-title">Login</h2>
                      <div class="signup-prompt">
                        <span>Don't have an account?</span>
                        <a href="register.php" class="sign-up">Sign-up</a>
                      </div>
                    </div>
                    <div class="login-form">
                      <div class="input-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-input" aria-label="Enter email" required/>
                      </div>
                      <div class="input-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-input" aria-label="Enter password" required/>
                      </div>
                    </div>
                    <button type="submit" name="login" class="login-button">Login</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
    </body>
</html>
