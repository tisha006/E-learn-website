@extends('Nav')
@section('nav')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <!-- Add your styles here -->
    <style>
        body {
            font-family: 'Garamond', serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden; /* Prevent horizontal scrollbar */
            background-image: url('{{ asset('/images/om-background.png') }}'); /* Path to your Om image */
            background-size: cover;
            background-position: center;
            background-attachment: fixed; /* Fix the background to create a parallax effect */
            background-repeat: no-repeat;
        }

        .container1 {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            width: 90%;
            margin: auto;
            background: rgba(255, 255, 255, 0.8); /* Light background for text readability */
            border-radius: 10px; /* Rounded corners for aesthetic appeal */
            z-index: 1; /* Ensure it's above the background */
        }

        .image-text-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            margin: 20px 0;
        }

        .full-width-image {
            width: 100%;
            max-width: 600px;
            height: auto;
            object-fit: cover;
            border-radius: 10px;
            animation: fadeIn 2s ease-in-out;
        }

        .text-container {
            text-align: justify;
            line-height: 1.8;
            max-width: 900px; /* Increased width for larger text container */
            padding: 20px; /* Adjusted padding */
            margin-top: 20px;
            animation: fadeIn 2s ease-in-out;
        }

        @media (max-width: 768px) {
            .container1 {
                padding: 10px;
            }
            .full-width-image {
                width: 100%;
            }
            .text-container {
                font-size: 16px;
                padding: 10px; /* Adjusted padding for smaller screens */
                max-width: 90%; /* Allow text container to be wider on smaller screens */
            }
        }

        @media (max-width: 480px) {
            .text-container {
                font-size: 14px;
                padding: 5px; /* Further reduced padding for very small screens */
                max-width: 100%; /* Full width on very small screens */
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        li {
            list-style: none;
        }
    </style>
</head>
<body>
    <div class="container1">
        <div class="image-text-container animate_animated animate_fadeIn">
            <img src="{{ asset($aboutDetails->image_path) }}" alt="Full Width Image" class="full-width-image" style="margin-top:-10%;">
        </div>
        <div class="text-container animate_animated animate_fadeIn">
            {!! $aboutDetails->text_content !!}
        </div>
    </div>
</body>
</html>
@endsection
