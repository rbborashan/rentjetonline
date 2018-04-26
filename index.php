<!DOCTYPE html>
<!-- Ryan Borashan
     011495107
     CMPE 272 -->
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Rent Jet Online</title>
        <?php include("header.php");?>
    </head>
    <body>
        <!-- Slideshow code: w3schools.com -->
        <div class="slideshow">
            <div class="slide">
                <img src="images/home1.jpg" alt="Flying Jet Image" class="home-img">
            </div>

            <div class="slide">
                <img src="images/home2.jpg" alt="Flying Jet Image" class="home-img">
            </div>

            <div class="slide">
                <img src="images/home3.jpg" alt="Flying Jet Image" class="home-img">
            </div>

            <div class="slide">
                <img src="images/home4.jpg" alt="Flying Jet Image" class="home-img">
            </div>

            <div class="slide">
                <img src="images/home5.jpg" alt="Flying Jet Image" class="home-img">
            </div>

            <a class="prev" onclick="nextSlide(-1)">&#10094;</a>
            <a class="next" onclick="nextSlide(1)">&#10095;</a>
        </div>
        <br>

        <div class="dots">
            <span class="dot" onclick="goToSlide(1)"></span>
            <span class="dot" onclick="goToSlide(2)"></span>
            <span class="dot" onclick="goToSlide(3)"></span>
            <span class="dot" onclick="goToSlide(4)"></span>
            <span class="dot" onclick="goToSlide(5)"></span>
        </div>

        <script>
            var index = 1;
            showSlides(index);

            function nextSlide(n) {
                showSlides(index += n);
            }

            function goToSlide(n) {
                showSlides(index = n);
            }

            function showSlides(n) {
                var i;
                var slides = document.getElementsByClassName("slide");
                var dots = document.getElementsByClassName("dot");

                if (n > slides.length) {index = 1}
                if (n < 1) {index = slides.length}
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                }
                for (i = 0; i < dots.length; i++) {
                    dots[i].className = dots[i].className.replace(" active", "");
                }
                slides[index-1].style.display="block";
                dots[index-1].className += " active";
            }
        </script>
        <div style="margin-top: 15px;" class="separator"></div>
        <div class="homeblock">
            <div class="opening">
                <h2 class="title">Rent a Jet Online</h2>
                <h5 class="subtitle">The Sky is the Limit. Make it Yours.</h5>
                <a href="products.php" class="rent-link">Get Started</a>
            </div>
        </div>
        <div class="separator"></div>
    </body>
    <footer>
        <?php include("footer.php");?>
    </footer>
</html>
