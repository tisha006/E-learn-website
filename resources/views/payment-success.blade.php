<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            background: linear-gradient(135deg, #f3e6a0,  #DEAD37); /* Light gold gradient background */
            animation: gradient 3s ease infinite; /* Gradient animation */
        }

        @keyframes gradient {
            0% {
                background-color: #f3e6a0; /* Light gold */
            }
            50% {
                background-color: #debb4d; /* Slightly darker gold */
            }
            100% {
                background-color: #f3e6a0; /* Light gold */
            }
        }

        h1 {
            color: #5c4d2e; /* Darker text color */
            font-size: 3em;
            margin-bottom: 20px;
            animation: fadeIn 1s; /* Fade-in animation */
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        p {
            font-size: 1.5em;
            color: #5c4d2e; /* Darker text color */
            margin: 20px 0;
            animation: slideIn 1s; /* Slide-in animation */
        }

        @keyframes slideIn {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .redirect-button {
            background-color: #debb4d; /* Gold button */
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.2em;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.3s;
            margin-top: 20px;
            display: inline-block;
            animation: bounce 2s infinite; /* Bounce animation */
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }

        .redirect-button:hover {
            background-color: #d4a800; /* Slightly darker gold on hover */
            transform: scale(1.05); /* Slightly enlarge on hover */
        }

        .footer {
            margin-top: 30px;
            font-size: 0.9em;
            color: #5c4d2e; /* Darker footer text */
        }
    </style>
</head>
<body>
    <div>
        <h1 style="color:white;">Payment Successful!</h1>
       
    </div>

    <script>
        // Redirect to home page after a few seconds
        setTimeout(function() {
            window.location.href = '/Home'; // Change this to your home page URL
        }, 1000); // Redirect after 5 seconds
    </script>
</body>
</html>