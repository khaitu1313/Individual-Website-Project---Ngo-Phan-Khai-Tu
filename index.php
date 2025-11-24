<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Home Page</title>
        <meta name="description" content="Buy sneakers online — Nike, Adidas, Jordan and Puma at MySite.">

        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/footer.css">
    </head>

    <body>
        <!-- Include files linking -->
        <?php session_start();?>
        <?php include 'include/navbar.php'; ?>

        <main>
            <div id="home">
                <!-- Image -->
                <div class="left-image">
                    <img src="images/main-menu/main-menu(1).jpg" alt="Store Banner" class="banner-img">
                </div>

                <!-- Google Maps -->
                <div class="right-map">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.5046388940455!2d106.65512307451715!3d10.77260825926519!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752ec17709146b%3A0x54a1658a0639d341!2zxJDhuqFpIEjhu41jIELDoWNoIEtob2EgLSAyNjggTMO9IFRoxrDhu51uZyBLaeG7h3Q!5e0!3m2!1svi!2s!4v1733400000000!5m2!1svi!2s"
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </main>

        <?php include 'include/footer.php'; ?>

        <!-- Javascript Linking -->
        <script src="javascript/product.js" defer></script>
    </body>
</html>