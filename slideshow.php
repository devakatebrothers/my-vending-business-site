<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Slideshow</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .slideshow-container {
            position: relative;
            width: 80%;
            max-width: 600px;
            overflow: hidden;
            border: 2px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
        }

        .slides {
            display: none;
            width: 100%;
        }

        .active {
            display: block;
        }

        img {
            width: 100%;
            height: auto;
        }

        .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }

        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        .prev:hover, .next:hover {
            background-color: rgba(0,0,0,0.8);
        }

        .dot-container {
            text-align: center;
            padding: 10px;
        }

        .dot {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
            cursor: pointer;
        }

        .active-dot {
            background-color: #717171;
        }
    </style>
</head>
<body>

<div class="slideshow-container">
    <?php
    // Specify your image directory here
    $images = glob("images/*.{jpg,jpeg,png,gif}", GLOB_BRACE); // Adjust the directory path as needed
    foreach ($images as $image) {
        echo '<div class="slides"><img src="'.$image.'" alt="Image"></div>';
    }
    ?>
    
    <a class="prev" onclick="changeSlide(-1)">&#10094;</a>
    <a class="next" onclick="changeSlide(1)">&#10095;</a>
</div>

<div class="dot-container">
    <?php
    // Create dots for navigation
    for ($i = 0; $i < count($images); $i++) {
        echo '<span class="dot" onclick="currentSlide('.($i + 1).')"></span>';
    }
    ?>
</div>

<script>
    let slideIndex = 0;
    showSlides();

    function showSlides() {
        const slides = document.getElementsByClassName("slides");
        const dots = document.getElementsByClassName("dot");

        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
            dots[i].className = dots[i].className.replace(" active-dot", "");
        }

        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1;
        }

        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active-dot";

        setTimeout(showSlides, 3000); // Change image every 3 seconds
    }

    function changeSlide(n) {
        slideIndex += n - 1; // adjust index for button clicks
        showSlides();
    }

    function currentSlide(n) {
        slideIndex = n;
        showSlides();
    }
</script>

</body>
</html>
