@extends('Nav')
@section('nav')

<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
        background-attachment: fixed;
        font-family: 'Garamond', serif;
    }

    .carousel, .carousel-inner, .carousel-item {
        height: 100%;
    }

    .carousel-item img {
        width: 90%;
        height: 590px;
        object-fit: cover;
    }

    @media (max-width: 1200px) {
        .carousel-item img {
            height: 350px;
        }
    }

    @media (max-width: 992px) {
        .carousel-item img {
            height: 300px;
        }
    }

    @media (max-width: 768px) {
        .carousel-item img {
            height: 250px;
        }
    }

    @media (max-width: 576px) {
        .carousel-item img {
            height: 200px;
        }
    }

    .carousel-control-prev, .carousel-control-next {
        width: auto;
        margin-left: -50px;
    }

    .carousel-indicators {
        bottom: 10px;
    }

    .navbar-custom {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 -4px 6px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .content-line {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
        overflow: hidden;
    }

    .content-line .text-wrapper {
        display: inline-block;
        white-space: nowrap;
        animation: slide 10s linear infinite;
    }

    .content-line .half-orange {
        color: orange;
        width:10px;
    }

    @keyframes slide {
        0% {
            transform: translateX(100%);
        }
        100% {
            transform: translateX(-100%);
        }
    }

    .image-slider {
        position: relative;
        width: 160%;
        height: 130px;
        overflow: hidden;
        margin: 0 auto;
    }

    .image-slider::before,
    .image-slider::after {
        content: "";
        position: absolute;
        left: 0;
        width: 100%;
        height: 20px;
        background: orange;
        z-index: 1;
    }

    .image-slider::before {
        top: -20px;
        clip-path: url(#top-curly-border);
    }

    .image-slider::after {
        bottom: -20px;
        clip-path: url(#bottom-curly-border);
    }

    .slider-wrapper {
        display: flex;
        width: 100%;
        animation: slide 15s linear infinite;
    }

    .slider-wrapper img {
        width: 10%;
        height: 130px;
        flex-shrink: 0;
        object-fit: cover;
    }

    @keyframes slide {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-100%);
        }
    }

    @media (max-width: 1200px) {
        .image-slider {
            width: 140%;
            height: 100px;
        }

        .slider-wrapper img {
            height: 100px;
        }
    }

    @media (max-width: 992px) {
        .image-slider {
            width: 120%;
            height: 90px;
        }

        .slider-wrapper img {
            height: 90px;
        }
    }

    @media (max-width: 768px) {
        .image-slider {
            width: 115%;
            height: 80px;
        }

        .slider-wrapper img {
            height: 80px;
        }
    }

    @media (max-width: 576px) {
        .image-slider {
            width: 110%;
            height: 70px;
            margin-left: -5%;
        }

        .slider-wrapper img {
            height: 70px;
        }
    }

    .three-images-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 30%;
        overflow: hidden;
    }

    .image-wrapper {
        position: relative;
        flex: 1;
        margin: 0 20px;
        max-width: 350px;
        margin-top: 35%;
    }

    .image-wrapper img {
        width: 100%;
        height: auto;
    }

    .image-text {
        position: absolute;
        top: -40px;
        left: 50%;
        transform: translateX(-50%);
        color: orange;
        font-size: 16px;
        font-weight: bold;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
    }

    .central-image-container {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 300px;
        margin-top: 50px;
    }

    .central-image {
        width: 700px;
        height: 750px;
        border-radius: 50%;
        margin-left: 27%;
        animation: rotate 8s linear infinite;
    }

    @keyframes rotate {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

    @media (max-width: 1200px) {
        .central-image {
            width: 400px;
            height: 450px;
        }

        .image-wrapper {
            margin-top: 20%;
        }

        .image-wrapper img {
            width: 80%;
            position: absolute;
        }
    }

    @media (max-width: 992px) {
        .central-image {
            width: 400px;
            height: 450px;
        }

        .image-wrapper {
            margin-top: 15%;
        }

        .image-wrapper img {
            width: 80%;
            position: absolute;
        }
    }

    @media (max-width: 768px) {
        .central-image {
            width: 400px;
            height: 450px;
        }

        .image-wrapper {
            margin-top: 10%;
        }

        .image-wrapper img {
            width: 80%;
            position: absolute;
        }
    }

    @media (max-width: 576px) {
        .central-image {
            width: 400px;
            height: 450px;
            margin-top: -300px;
        }

        .image-wrapper {
            margin-top: 5%;
        }

        .image-wrapper img {
            width: 80%;
            position: absolute;
        }
    }

   

</style>
</head>
<body>


@if(session('success'))
    <script>
        window.onload = function() {
            alert("{{ session('success') }}");
        };
    </script>
@endif

<!-- Carousel -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 -4px 6px rgba(0, 0, 0, 0.1); width: 118%; margin-top: -13%; margin-left: -9%;height:600px;">

    <ol class="carousel-indicators">
        @foreach ($carouselImages as $index => $image)
            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
        @endforeach
    </ol>
    <div class="carousel-inner">
        @foreach ($carouselImages as $index => $image)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <img class="d-block w-100" src="{{ $image->image_url }}" alt="{{ $image->alt_text }}">
            </div>
        @endforeach
    </div>
</div>

<!-- Image Slider -->
<nav class="content-line navbar-custom"style="padding-top: 15px; padding-bottom: 16px; background-color:#DEAD37; margin-top:-10px; width: 120%; margin-left: -130px;height:20%;">
    <div class="image-slider">
        <div class="slider-wrapper">
            @foreach ($sliderImages as $image)
                <img src="{{ $image->image_url }}" alt="{{ $image->alt_text }}">
            @endforeach
        </div>
    </div>
</nav>

<!-- Central Image -->
<section class="central-image-section"style="margin-top:20%;">
    <div class="central-image-container">
        @if ($centralImage)
            <img src="{{ $centralImage->image_url }}" alt="Central Image" class="central-image"style="position: absolute;margin-left:-37px;margin-top:30px;">
        @endif
        <div class="three-images-container"style=" margin-top:-31%;margin-left:-16px;">
            @foreach ($threeImages as $image)
                <div class="image-wrapper">
                    <a href="{{ $image->link }}">
                        <img src="{{ $image->image_url }}" class="image-text"style="width:45%;top:40%;">
                        <img src="images/imges2/letter.png" alt="{{ $image->image_text }}">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
   
   
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body><br><br><br><br><br><br><br><br><br><br><br>
@endsection