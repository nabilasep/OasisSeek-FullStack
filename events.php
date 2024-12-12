<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8"/>
        <title>Event List - OasisSeek</title>
        <link rel="stylesheet" type="text/css" href="../assets/styles.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <style>
           .events-container {
            background-color: #fff;
            display: flex;
            flex-direction: column;
            overflow: hidden;
          }

          .header {
            align-items: center;
            background: var(--foundation-yellow-light-hover, #f5ede5);
            box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
            display: flex;
            min-height: 110px;
            width: 100%;
            gap: 40px 129px;
            white-space: nowrap;
            justify-content: start;
            flex-wrap: wrap;
            padding: 28px 70px;
            font: 400 20px Sora, sans-serif;
          }

          .brand-logo {
            align-self: stretch;
            flex-grow: 1;
            width: 149px;
            margin: auto 0;
            font: 36px Underdog, sans-serif;
          }

          .nav-menu {
            align-self: stretch;
            display: flex;
            min-width: 240px;
            align-items: center;
            gap: 3px;
            color: #000;
            text-align: center;
            justify-content: start;
            flex-wrap: wrap;
            margin: auto 0;
          }

          .nav-item {
            align-self: stretch;
            width: 146px;
            margin: auto 0;
            padding: 0 42px 14px;
          }

          .nav-item-active {
            font-weight: 600;
          }

          .auth-buttons {
            align-self: stretch;
            display: flex;
            min-width: 240px;
            align-items: center;
            gap: 23px;
            text-align: center;
            justify-content: start;
            flex-grow: 1;
            width: 226px;
            margin: auto 0;
          }

          .btn {
            align-self: stretch;
            border-radius: 24px;
            padding: 15px 25px;
            cursor: pointer;
          }

          .btn-outline {
            border: 1px solid var(--Foundation-Yellow-Normal, #bd874f);
            color: var(--Foundation-Yellow-Normal, #bd874f);
          }

          .btn-filled {
            background: var(--Foundation-Yellow-Normal, #bd874f);
            color: var(--Foundation-Yellow-Light, #f8f3ed);
          }

          .hero-image {
            aspect-ratio: 0.61;
            object-fit: contain;
            width: 100%;
            border-radius: 60px 60px 0 0;
          }

          .footer {
            background: var(--foundation-yellow-normal-active, #976c3f);
            min-height: 352px;
            width: 100%;
            position: relative;
            padding: 80px 160px 40px;
          }

          .footer-brand {
            font: 400 36px Underdog, sans-serif;
            margin-bottom: 20px;
          }

          .footer-description {
            color: var(--Foundation-Yellow-Light, #f8f3ed);
            font: 400 16px Sora, sans-serif;
            max-width: 255px;
          }

          .footer-content {
            display: flex;
            justify-content: space-between;
            margin-bottom: 60px;
          }

          .footer-nav {
            color: var(--Foundation-Yellow-Light, #f8f3ed);
            font-family: Sora, sans-serif;
          }

          .footer-nav-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 18px;
          }

          .footer-nav-items {
            display: flex;
            flex-direction: column;
            gap: 13px;
            font-size: 16px;
          }

          .social-links {
            display: flex;
            gap: 25px;
          }

          .social-icon {
            width: 50px;
            height: 50px;
          }

          .footer-divider {
            border: 1px solid #f8f3ed;
            margin-bottom: 10px;
          }

          .copyright {
            color: var(--Foundation-Yellow-Light, #f8f3ed);
            font: 200 16px Sora, sans-serif;
            text-align: center;
          }

          @media (max-width: 991px) {
            .header {
              padding: 20px;
              max-width: 100%;
              white-space: initial;
            }

            .nav-menu {
              max-width: 100%;
            }

            .nav-item {
              padding: 0 20px;
              white-space: initial;
            }

            .auth-buttons {
              white-space: initial;
            }

            .btn {
              padding: 15px 20px;
            }

            .hero-image {
              max-width: 100%;
            }

            .footer {
              padding: 40px 20px;
            }

            .footer-content {
              flex-direction: column;
              gap: 40px;
            }

            .copyright {
              max-width: 100%;
            }
          }
        </style>
  </head>

  <body>
   <!-- ======== HEADER ======== -->
   <div class="landing-container">
    <header class="site-header">
      <h1 class="brand-name">OasisSeek</h1>
      <nav class="main-nav">
        <a href="landing-page.html" class="nav-link">Home</a>
        <a href="place-list.html" class="nav-link">Places</a>
        <a href="event-list.html" class="nav-link">Events</a>
        <a href="about.html" class="nav-link">About</a>
      </nav>
  <!-- ======== profile button ======== -->
      <div class="user-profile">
        <div class="profile-empty"></div>
        <div class="profile-container">
          <a href="dashboard-user.html" class="profile-wrapper">
            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/e0f8083a2af05b8315cb39f0ee55f7ffcc527bc8dad48c168e7cb295095ffb69?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d" alt="User profile" class="profile-image" />
            <span class="profile-name">Nabila</span>
          </a>
        </div>
      </div>
    </header>



    <!-- =========== FOOTER =========== -->
  <footer class="site-footer">
    <div class="footer-content">
      <div>
      <div class="footer-logo">OasisSeek</div>
      <p class="footer-description">Your Gateway to Egypt's Hidden Treasures</p>
      </div>
      
      <nav class="footer-nav">
        <h3 class="footer-nav-title">Navigates</h3>
        <a href="landing-page.html" class="footer-nav-link">Home</a>
        <a href="place-list.html" class="footer-nav-link">Places</a>
        <a href="event-list.html" class="footer-nav-link">Events</a>
        <a href="about.html" class="footer-nav-link">About</a>
      </nav>
      <div class="footer-nav">
        <h3 class="footer-nav-title">Contact</h3>
        <div class="social-links">
          <a href="#"><img src="https://cdn.builder.io/api/v1/image/assets/TEMP/82410e63410082f05cbcd4776b0f53d214411487582452efac6a22a5af2103d7?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d" alt="Social media link" class="social-icon" /></a>
          <a href="#"><img src="https://cdn.builder.io/api/v1/image/assets/TEMP/134bcf82c490247938a6cecd25e32f7841efd8290828d100192cfc9e505200e7?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d" alt="Social media link" class="social-icon" /></a>
          <a href="#"><img src="https://cdn.builder.io/api/v1/image/assets/TEMP/a923cb32070ac414cf6276ad94a6ed5bdfcf4ceb25f00008e64d3fce6fa250fb?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d" alt="Social media link" class="social-icon" /></a>
        </div>
      </div>
    </div>
    <hr class="footer-divider" />
    <p class="copyright">Copyright © 2024 OasisSeek. All rights reserved.</p>
  </footer>


    </body>