<?php

if (!session_id())
session_start();
include_once __DIR__ . "/database/database.php";

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8"/>
        <title>About OasisSeek</title>
        <link rel="stylesheet" type="text/css" href="/css/styles.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>

  <body>
    <div class="about-container">
   <!-- ======== HEADER ======== -->
   <div class="landing-container">
    
   <?php include_once __DIR__. "/template/navbar.php"; ?>


    <section class="hero-section-about">
        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/12bc3840b621b99acf27dcf8637961a9717884f85feb21dc72f374cc0c24085a?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d" alt="About section hero image" class="hero-image-about" />
        <h1 class="hero-title-about">About</h1>
        <p class="hero-description-about">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus venenatis ornare magna, sit amet pulvinar ex mollis ut. Curabitur rutrum nec nisi in ultricies. Quisque vulputate ligula dictum lectus porta, eu iaculis risus sagittis. Nam vitae tortor vitae erat faucibus rhoncus. Nulla nec ante semper, interdum massa quis, feugiat turpis. In nunc lacus, iaculis et nisl sed, fermentum fermentum libero. Integer nec vulputate turpis. Donec non massa est. Vestibulum tincidunt nulla leo, sed convallis augue euismod nec. Nulla vel eros nibh. Donec cursus sem vel vulputate interdum. Nulla a vehicula ex. Morbi sit amet congue arcu, a ultrices tellus. Cras ac aliquam mi. Donec at turpis sit amet dui tincidunt molestie.
        </p>
      </section>
    
      <section class="contact-section-about">
        <div class="contact-container-about">
          <div class="contact-info-about">
            <h2 class="contact-title-about">Our Contact</h2>
            <p class="contact-subtitle-about">
              If you have any questions, critique, or advice regarding us and our website, don't hesitate to contact us!
            </p>
            <div class="contact-details-about">
              <div class="contact-item-about">
                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/e1484191328345a333b98a6e4064e1580710c3ff12d110d79b4d01503627a30b?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d" alt="Location icon" class="contact-icon-about" />
                <span>Blater, Purbalingga</span>
              </div>
              <div class="contact-item-about">
                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/be2fcd856416c0f8e3b87eea85a832b06d1d2fc504543aa15877d5cd096a5a25?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d" alt="Phone icon" class="contact-icon-about" />
                <span>+62 8123 4567 890</span>
              </div>
              <div class="contact-item-about">
                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/86a512b945fadef62304c0f76388dbf98ea58eb4211b443060f5d8e27553fbb8?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d" alt="Email icon" class="contact-icon-about" />
                <span>oasisseek@gmail.com</span>
              </div>
            </div>
            
            <div class="social-section-about">
              <h3 class="social-title-about">Follow us on social media:</h3>
              <div class="social-links-about">
                <div class="social-item-about">
                  <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/d5fb2cb8a57ce4aa6e0588726b4967cc0826b204dd6f2750f5f2ddc7a76c82e7?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d" alt="Twitter icon" class="social-icon-about" />
                  <span>@oasisseek1</span>
                </div>
                <div class="social-item-about">
                  <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/2bb6042da92c0a83266db412ef350f3d4b207c2c0f592cf8797b7211853b5845?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d" alt="Facebook icon" class="social-icon-about" />
                  <span>OasisSeek Official</span>
                </div>
                <div class="social-item-about">
                  <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/04f0bcde0b51ffb8220edcd1d5ffe1f4fe630e6768ea4919c7228a26e3f20ee8?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d" alt="Instagram icon" class="social-icon-about" />
                  <span>@oasisseek1</span>
                </div>
              </div>
            </div>
          </div>
          <!-- <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/a44a81509480ae176fc80cca69746342e3b2781ad4d32d17f49d07fb195728fc?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d" alt="Contact section illustration" class="contact-image-about" /> -->
        </div>
      </section>
    
    

      <div class="faq-container">
        <div class="header-wrapper">
          <h1 class="main-title">Any questions?</h1>
          <h2 class="subtitle">Frequently Asked Questions (FAQ)</h2>
        </div>
        
        <div class="questions-wrapper">
          <hr class="faq-divider"/>          
          <div class="question-item">
            <div class="icon-wrapper">
              <img class="icon" src="https://cdn.builder.io/api/v1/image/assets/TEMP/598dd2ba013211af23c4234e684054f2003f2ef59b1778729dfe72dcb231da5f?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d" alt="" />
            </div>
            <div class="content-wrapper">
              <h3 class="question-title">What is this website about?</h3>
              <p class="question-answer">Our website provides information on Egypt's top destinations, including historical landmarks, cultural attractions, and travel tips to help you plan your trip.</p>
            </div>
          </div>
      
          <hr class="faq-divider"/>

          <div class="question-row">
            <div class="icon-wrapper">
              <img class="icon" src="https://cdn.builder.io/api/v1/image/assets/TEMP/598dd2ba013211af23c4234e684054f2003f2ef59b1778729dfe72dcb231da5f?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d" alt="" />
            </div>
            <h3 class="question-text">How do I get around in Egypt?</h3>
          </div>
      
          <hr class="faq-divider"/>

          <div class="question-row">
            <div class="icon-wrapper">
              <img class="icon" src="https://cdn.builder.io/api/v1/image/assets/TEMP/598dd2ba013211af23c4234e684054f2003f2ef59b1778729dfe72dcb231da5f?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d" alt="" />
            </div>
            <h3 class="question-text">Is Egypt affordable for travelers?</h3>
          </div>
      
          <hr class="faq-divider"/>  

          <div class="question-row">
            <div class="icon-wrapper">
              <img class="icon" src="https://cdn.builder.io/api/v1/image/assets/TEMP/598dd2ba013211af23c4234e684054f2003f2ef59b1778729dfe72dcb231da5f?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d" alt="" />
            </div>
            <h3 class="question-text">What activities can I do in Egypt?</h3>
          </div>
          <hr class="faq-divider"/>
        </div>
      </div>

    <!-- =========== FOOTER =========== -->
  
    <?php include_once __DIR__ . "/template/footer.php"; ?>

  </div>
</body>
</html>
