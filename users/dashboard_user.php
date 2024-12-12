<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Profile-OasisSeek</title>
    <link rel="stylesheet" type="text/css" href="../assets/styles.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        .dashboard-profile {
        background: #fff;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        }
        
        .main-content-profile {
        flex: 1;
        padding: 85px 140px;
        }
        
        .profile-section {
        background: #bd874f;
        border-radius: 20px;
        color: #fff;
        padding: 60px 55px;
        }
        
        .profilesection-title {
        font: 28px 'Poppins', sans-serif;
        font-weight: bolder;
        margin: 0;
        }
        
        .profilesection-subtitle {
        font: 16px 'Poppins', sans-serif;
        font-weight: lighter;
        margin: 2px 0 42px;
        }
        
        .profile-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 60px;
        }
        
        .profile-form {
        display: flex;
        flex-direction: column;
        gap: 42px;
        }
        
        .form-group-profile {
        display: flex;
        align-items: center;
        gap: 25px;
        }
        
        .form-label-profile {
        color: #fff;
        font: 500 16px 'Poppins', sans-serif;
        text-align: right;
        width: 89px;
        }
        
        .form-input-profile {
        background: #fff;
        border: none;
        border-radius: 10px;
        color: #000;
        flex: 1;
        font: 500 14px 'Poppins', sans-serif;
        padding: 7px;
        }
        
        .form-actions-profile {
        display: flex;
        gap: 17px;
        margin-top: 20px;
        }
        
        .btn-primary-profile {
        background: #734c10;
        border: none;
        border-radius: 24px;
        color: #f8f3ed;
        cursor: pointer;
        font: 550 14px 'Poppins', sans-serif;
        padding: 8px 20px;
        }
        
        .profile-picture-section {
        background: #fff;
        border-radius: 10px;
        padding: 50px 45px;
        text-align: center;
        margin: 0px 20px;
        }
        
        .current-profile-picture {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        margin-bottom: 20px;
        }
        
        .upload-btn-profile {
        border: 1px solid #000;
        background: none;
        cursor: pointer;
        font: 300 12px 'Poppins', sans-serif;
        padding: 13px 15px;
        margin-bottom: 12px;
        }
        
        .upload-info-profile {
        color: #000;
        font: 300 14px 'Poppins', sans-serif;
        margin: 10px 0;
        }
        
        .bookmarks-section {
            display: flex;
            flex-direction: column;
            margin-top: 100px;
        }

        .bookmark-card {
            background: #fff;
            border-radius: 24px;
            display: flex;
            gap: 20px;
            padding: 19px 21px;
            margin: 15px 20px;
            align-items: center;
            margin-top: 0;
        }

        .bookmark-image {
            width: 100px;
            height: 100px;
            border-radius: 24px;
            object-fit: cover;
        }

        .bookmark-content {
            flex: 1;
        }

        .bookmark-title {
            font: 400 24px 'Sora', sans-serif;
            letter-spacing: 3.2px;
            margin: 0;
            color: black;
        }

        .bookmark-description {
            font: 300 12px 'Sora', sans-serif;
            margin-bottom: 0;
            color: black;
            /* Membatasi teks ke 2 baris */
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .bookmark-action {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
        }

        .action-icon {
            width: 50px;
            height: 50px;
        }
        
        @media (max-width: 991px) {
        .main-content {
            padding: 40px 20px;
        }
        
        .profile-section {
            padding: 40px 20px;
        }
        
        .profile-grid {
            grid-template-columns: 1fr;
        }
        
        .form-group {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
        
        .form-label {
            text-align: left;
            width: auto;
        }
        
        .profile-picture-section {
            padding: 30px 20px;
        }
        
        .bookmark-card {
        flex-direction: column; 
        align-items: center; 
        text-align: center;
        }

        .bookmark-image {
            width: 100px;
            height: 100px;
        }

        .bookmark-content {
            text-align: center; 
        }
        }
    </style>
</head>


<body>
<div class="dashboard">
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

    
    <!-- ======== FORM UBAH PROFILE ======== -->
    <main class="main-content-profile">
      <section class="profile-section" aria-labelledby="profile-title">
        <h1 id="profile-title" class="profilesection-title">My Profile</h1>
        <p class="profilesection-subtitle">Manage your account profile</p>
  
        <div class="profile-grid">
          <form class="profile-form" aria-label="Profile information form">
            <div class="form-group-profile">
              <label for="username" class="form-label-profile">Username</label>
              <input type="text" id="username" class="form-input-profile" value="@nabilaputri" />
            </div>
            <div class="form-group-profile">
              <label for="name" class="form-label-profile">Name</label>
              <input type="text" id="name" class="form-input-profile" value="Nabila" />
            </div>
            <div class="form-group-profile">
              <label for="email" class="form-label-profile">Email</label>
              <input type="email" id="email" class="form-input-profile" value="septiananabila@gmail.com" />
            </div>
            <div class="form-actions-profile">
              <button type="submit" class="btn-primary-profile">Save</button>
              <button type="button" class="btn-primary-profile">Log Out</button>
            </div>
          </form>
        

      <!-- ======== UPLOAD FOTO PROFILE ======== -->
        <div class="profile-picture-section">
          <img
            src="https://cdn.builder.io/api/v1/image/assets/TEMP/71a2fb7aa070218e7a9b043b4c0095d72c1d71e5603b41db3ab9f4a92d041727?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d"
            alt="Current profile picture"
            class="current-profile-picture"
          />
          <div class="picture-upload">
            <input type="file" id="file-input" class="file-input" accept=".jpeg, .png" hidden />
            <button type="button" class="upload-btn-profile" onclick="document.getElementById('file-input').click()">Select picture</button>
            <p class="upload-info-profile">Max file size: 5 MB</p>
            <p class="upload-info-profile">Format: .JPEG, .PNG</p>
          </div>
        </div>
      </div>
      
      <!-- ======== BOOKMARKS ======== -->
      <section class="bookmarks-section" aria-labelledby="bookmarks-title">
        <h2 id="bookmarks-title" class="profilesection-title">Bookmarks</h2>
        <p class="profilesection-subtitle">Mark your journey through Egypt's treasures!</p>
  
        <div class="bookmarks-list">

          <article class="bookmark-card">
            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/8552bf776a0158325454421348cebb12b034dec1d822ce834e68481ba3f112be?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d" alt="The Nile River" class="bookmark-image" />
            <div class="bookmark-content">
              <h3 class="bookmark-title">THE NILE</h3>
              <p class="bookmark-description">The Nile, stretching over 6,650 kilometers, is the world's longest river and a lifeline of civilizations for thousands of years. As a destination, it offers an unparalleled journey through history, culture, and natural beauty. Flowing through 11 countries, its most iconic section lies in Egypt, where it serves as the backdrop for some of humanity's greatest achievements.</p>
            </div>
            <button type="button" class="bookmark-action" aria-label="Remove bookmark">
              <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/ae785c420c97267ac981f08c07dc55b5e385399d76b7d52d4adf6024d5f0ea12?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d" alt="" class="action-icon" />
            </button>
          </article>

          <article class="bookmark-card">
            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/8552bf776a0158325454421348cebb12b034dec1d822ce834e68481ba3f112be?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d" alt="The Nile River" class="bookmark-image" />
            <div class="bookmark-content">
              <h3 class="bookmark-title">THE NILE</h3>
              <p class="bookmark-description">The Nile, stretching over 6,650 kilometers, is the world's longest river and a lifeline of civilizations for thousands of years. As a destination, it offers an unparalleled journey through history, culture, and natural beauty. Flowing through 11 countries, its most iconic section lies in Egypt, where it serves as the backdrop for some of humanity's greatest achievements.</p>
            </div>
            <button type="button" class="bookmark-action" aria-label="Remove bookmark">
              <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/ae785c420c97267ac981f08c07dc55b5e385399d76b7d52d4adf6024d5f0ea12?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d" alt="" class="action-icon" />
            </button>
          </article>
  
        </div>
      </section>

    </section>
    </main>
  
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
        <a href="places-list.html" class="footer-nav-link">Places</a>
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

</div>
</div>
  
<!-- =============== KODE JAVASCRIPT ================= -->
  <script>
    // UPLOAD FOTO
    const fileInput = document.getElementById('file-input');
    const currentProfilePicture = document.querySelector('.current-profile-picture');
  
    fileInput.addEventListener('change', (event) => {
      const file = event.target.files[0];
  
      if (file && file.size <= 5 * 1024 * 1024) { // Maksimum ukuran 5 MB
        const reader = new FileReader();
  
        reader.onload = (e) => {
          currentProfilePicture.src = e.target.result;
        };
  
        reader.readAsDataURL(file);
      } else {
        alert('Please select an image smaller than 5 MB.');
      }
    });
  </script>
  
</body>
</html>