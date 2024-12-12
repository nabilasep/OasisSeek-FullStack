<?php
// php -S localhost:3000
if (!session_id())
    session_start();
include_once __DIR__ . "/database/database.php";

$query = "SELECT des_id, name, banner FROM destinations ORDER BY des_id LIMIT 4";


$destinations = getData($dbs, $query);

//event
$query = "SELECT event_id, name, date, banner FROM events ORDER BY event_id DESC LIMIT 3";

$events = getData($dbs, $query);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once __DIR__ . "/template/meta.php"; ?>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <title>Document</title>
</head>

<body>
    <div class="landing-container">
        <?php include_once __DIR__ . "/template/navbar.php"; ?>

        <section class="hero-section">
            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/ade8e9e5f28b57b355553701f47134961e61536f25fce1f749388ee92733c941?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d"
                alt="Egyptian landscape panorama" class="hero-img" />
            <div class="hero-content">
                <p class="hero-subtitle">DISCOVER EGYPT</p>
                <h2 class="hero-title">Experience Unforgettable Landscape, Relive History!</h2>
                <a href="#" class="cta-button">Explore more</a>
            </div>
        </section>

        <main class="main-content">
            <section class="destinations-section">
                <h2 class="section-title">POPULAR DESTINATIONS</h2>
                <div class="destinations-grid">
                    <?php foreach ($destinations as $destination): ?>

                        <article class="destination-card">
                            <img src="/images/<?= $destination['banner']; ?>" alt="image of <?= $destination['name']; ?>"
                                class="destination-img" />
                            <h3 class="destination-name">
                                <?= $destination['name']; ?>
                            </h3>
                        </article>

                    <?php endforeach; ?>
                </div>
            </section>
            <section class="events-section">
        <div class="events-content">
          <h2 class="events-heading">WHAT'S ON</h2>
          <p class="events-description">Dive into rich history, stunning landscapes, and cultural experiences that will leave you inspired.</p>
          <a href="#" class="cta-button">Discover more events</a>
        </div>
        <div class="events-gallery">
        <?php foreach ($events as $event): ?>
          
          <img src="/images/<?= $event['banner']; ?>"alt="image of <?= $event['name']; ?>">
          <?php endforeach; ?>
          
        </div>
      </section>
            <section class="souvenirs-section">
                <h2 class="souvenirs-heading">Handpicked from the Locals</h2>
                <p class="souvenirs-description">Take a piece of Egypt home with you! From hand-carved artifacts and
                    colorful papyrus art to intricate jewelry and aromatic spices, our curated selection of souvenirs
                    captures the essence of Egypt's rich culture and timeless beauty. Find the perfect keepsake to
                    cherish forever!</p>
                <div class="souvenirs-grid">
                    <article class="souvenir-card">
                        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/debc29e85cf0b4d18c4b729446c3462673f4db537c408460d8314d54e2d63f27?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d"
                            alt="Egyptian statue replicas" class="souvenir-img" />
                        <h3 class="souvenir-name">Statues Replicas</h3>
                    </article>
                    <article class="souvenir-card">
                        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/1e1b1188db3c00e2fefad6716f491ca8cec65eb36e8515fd15dec713ebe3e1ea?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d"
                            alt="Traditional Khayameya textiles" class="souvenir-img" />
                        <h3 class="souvenir-name">Khayameya</h3>
                    </article>
                    <article class="souvenir-card">
                        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/16e703551b52e0e5b89aa917e2294e46065409fcd3a2cf925b4907137e115ff9?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d"
                            alt="Traditional Baklava dessert" class="souvenir-img" />
                        <h3 class="souvenir-name">Baklava</h3>
                    </article>
                    <article class="souvenir-card">
                        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/15440757a337667fdf9902f4423e9b1c7105d984c29ccc78c57ff4a513945e25?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d"
                            alt="Egyptian pottery" class="souvenir-img" />
                        <h3 class="souvenir-name">Pottery</h3>
                    </article>
                </div>
            </section>

            <section class="gallery-section">
                <h2 class="gallery-heading">GALLERY</h2>
                <p class="gallery-subtitle">A glimpse of heaven on earth were found in Egypt.</p>
                <div class="gallery-grid">
                    <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/0521f285a82f582f9fad700127d26f0313f69841178b0203f4e6eb8fdc601a67?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d"
                        alt="Egyptian landscape" class="gallery-main gallery-img" />
                    <div class="gallery-side">
                        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/da4a5a900a787bb1cc53d8eed5269b59c30a914d852ca81dd00f88515bdf670e?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d"
                            alt="Historical site" class="gallery-img" />
                        <div class="gallery-row">
                            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/95a1b9f9f1edd1c42779ccc7f14920794e5143e2a9483f0dfa4d609b20769084?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d"
                                alt="Cultural scene" class="gallery-img" />
                            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/2a6f2d4a67d6fcbaa319be9038369f9988de68f6865110683aa5723463f36ca1?placeholderIfAbsent=true&apiKey=9813aeb455d842cea0d227df786a7f1d"
                                alt="Traditional architecture" class="gallery-img" />
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <?php include_once __DIR__ . "/template/footer.php"; ?>
    </div>
</body>

</html>