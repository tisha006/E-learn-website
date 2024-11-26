<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading</title>
    <style>
        /* Styles for the loading overlay */
        body {
            margin: 0;
            padding: 0;
            overflow: hidden; /* Prevents scrolling while loading overlay is active */
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 1s ease-out, visibility 1s ease-out;
            opacity: 1;
            visibility: visible;
        }

        .loading-overlay img {
            width: 100px; /* Starting size of the image */
            height: auto;
            animation: rotate 2s linear infinite, scaleUp 2s ease-out forwards;
        }

        @keyframes scaleUp {
            0% {
                transform: scale(1); /* Initial size */
            }
            100% {
                transform: scale(2); /* Final size */
            }
        }

        @keyframes rotate {
            0% {
                transform: rotate(0deg); /* Initial rotation */
            }
            100% {
                transform: rotate(360deg); /* Full rotation */
            }
        }

        /* Fade Out the Overlay */
        .fade-out {
            opacity: 0;
            visibility: hidden;
        }
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay">
        <img src="images/imges2/ohm.png" alt="Loading Image">
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                // Start the fade-out transition
                document.querySelector('.loading-overlay').classList.add('fade-out');

                // Wait for the fade-out animation to finish before redirecting
                setTimeout(function() {
                    // Redirect to the homepage
                    window.location.href = '/Home';
                }, 1000); // Duration of fade-out animation
            }, 3000); // Initial delay before starting the fade-out
        });
    </script>
</body>
</html>
