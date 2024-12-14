<?php
if (!session_id())
    session_start();

use model\User;

require_once __DIR__ . "/database/database.php";
require_once __DIR__ . "/model/User.php";
require_once __DIR__ . "/middleware/middleware.php";

// Middleware to check if user is not logged in
isNotLoggedIn();

if(isset($_POST['register'])){
    try{
        mysqli_begin_transaction($dbs);

        $user = new User();
        $user->username = $_POST['username'] ?? null;
        $user->password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $user->email = $_POST['email'] ?? null;
        $user->name = $_POST['name'] ?? null;

        $validate = $dbs->prepare("SELECT email, username FROM users WHERE email = ? OR username = ?");
        $validate->bind_param("ss", $user->email, $user->username);
        $validate->execute();
        $result = $validate->get_result();
        $data = $result->fetch_assoc();

        if($data){
            echo "<script>alert('Email atau username sudah digunakan')</script> ";
        }else{
            $insert = $dbs->prepare("INSERT INTO users (username, password, email, name) VALUES (?,?,?,?)");
            $insert->bind_param("ssss", $user->username, $user->password, $user->email, $user->name);
            $insert->execute();

            mysqli_commit($dbs);

            echo"<script>
            alert('Pendaftaran Berhasil');
            location.replace('login.php');
            </script>";
            exit();
        }

    } catch(Exception $error) {
        mysqli_rollback($dbs);
        echo"<script>alert('ERROR database : $error')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OasisSeek</title>
  <link rel="stylesheet" type="text/css" href="/css/styles.css"/>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: Poppins, sans-serif;
      background-color: #f8f3ed;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
    }

    .signup-container {
      background-color: #fff;
      display: flex;
      flex-direction: row;
      overflow: hidden;
      border-radius: 20px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 1200px;
    }

    .signup-wrapper {
      display: flex;
      flex-direction: row;
      position: relative;
      width: 100%;
    }

    .background-image {
      position: absolute;
      inset: 0;
      height: 100%;
      width: 100%;
      object-fit: cover;
      object-position: center;
      z-index: -1;
      opacity: 0.5;
    }

    .content-container {
      display: flex;
      flex-direction: row;
      border-radius: 20px;
      background: var(--foundation-yellow-light-active, #ebdac8);
      padding: 30px;
      width: 100%;
    }

    .image-column {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .hero-image {
      max-width: 100%;
      height: auto;
      border-radius: 20px;
    }

    .form-column {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 20px;
    }

    .signup-form-container {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .brand-title {
      align-self: center;
      font: 400 36px Underdog, sans-serif;
      margin-bottom: 20px;
    }

    .signup-title {
      color: #000;
      font-size: 24px;
      font-weight: 600;
      text-align: center;
    }

    .login-prompt {
      font-size: 14px;
      color: #0094ff;
      text-align: center;
    }

    .login-link {
      color: #0094ff;
      text-decoration: none;
      font-weight: 600;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      font-size: 16px;
      color: #444b59;
      font-weight: 600;
    }

    .form-input {
      border-radius: 12px;
      background-color: transparent;
      height: 40px;
      width: 100%;
      border: 2px solid #734c10;
      padding: 8px;
    }

    .submit-button {
      align-self: stretch;
      border-radius: 12px;
      background-color: #734c10;
      font-size: 16px;
      color: #f8f3ed;
      font-weight: 600;
      padding: 10px;
      border: none;
      cursor: pointer;
      text-align: center;
    }

    @media (max-width: 768px) {
      .signup-container {
        flex-direction: column;
      }

      .content-container {
        flex-direction: column;
        padding: 20px;
      }

      .image-column,
      .form-column {
        flex: none;
        width: 100%;
      }

      .hero-image {
        max-width: 80%;
        margin: 0 auto;
      }

      .brand-title {
        font-size: 28px;
      }

      .signup-title {
        font-size: 20px;
      }

      .form-group {
        font-size: 14px;
      }

      .form-input {
        height: 36px;
      }

      .submit-button {
        padding: 8px;
      }
    }
  </style>
</head>
<body>
  <div class="signup-container">
    <div class="signup-wrapper">
      <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/0531993187149dbf378c78dfa09c5fad3741573dd39e2d51be801f5ea605c52b" class="background-image" alt=""/>
      <div class="content-container">
        <div class="image-column">
          <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/77364bbb6afb29b49e15c1eead3b0f04de6614b1d0333f6c14b66c5d3dadccf2" class="hero-image" alt="OasisSeek signup illustration"/>
        </div>
        <div class="form-column">
          <form class="signup-form-container" method="POST" action="">
            <h1 class="brand-title">OasisSeek</h1>
            <h2 class="signup-title">Sign-up</h2>
            <div class="login-prompt">
              <span>Already have an account?</span>
              <a href="login.php" class="login-link">Login</a>
            </div>
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" id="username" name="username" class="form-input" required/>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" name="password" class="form-input" required/>
            </div>
            <div class="form-group">
              <label for="email">E-mail</label>
              <input type="email" id="email" name="email" class="form-input" required/>
            </div>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" id="name" name="name" class="form-input" required/>
            </div>
            <button type="submit" name="register" class="submit-button">Sign-up</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
