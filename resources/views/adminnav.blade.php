<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VedaVishwa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome for icons
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
     <style>
        body {
            display: flex;
            height: 100vh;
            margin: 0;
            font-family: "Roboto Slab", serif; /* Font resembling Sanskrit but in English */
            background-color: #f8f9fa;
        }
        .sidebar {
            background-color: #343a40;
            color: white;
            padding: 15px;
            width: 250px;
            height: 100vh;
            position: fixed;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.3s ease;
        }
        .sidebar img.logo {
            width: 80px; /* Adjust the size as needed */
            height: 80px; /* Ensure height matches width for a perfect circle */
            border-radius: 50%; /* Makes the image round */
            display: block;
            margin: 0 auto -60px; /* Center the image and add space below */
        }
        .sidebar .nav-link {
            display: flex;
            align-items: center;
            color: white;
            font-size:20px;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
        }
        .sidebar .nav-link:hover {
            background-color: #f77f00;
            color: white;
            transform: translateX(10px);
        }
        .sidebar .nav-link i {
            margin-right: 10px;
        }
        .sidebar .nav-link.active {
            background-color: #f77f00;
            color: white;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
            flex: 1;
            background-color: #f8f9fa;
            transition: margin-left 0.3s, padding 0.3s;
        }
        .navbar-nav {
            width: 100%;
        }
        .nav-item {
            width: 100%;
        }
        .footer {
            /* background-color: #f8f9fa; */
            padding: 1rem;
            text-align: center;
            border-top: 1px solid #e9ecef;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            margin-bottom: 20px;
        }
        .card:hover {
            transform: translateY(-10px);
        }
        .card-header {
            background-color: #f77f00;
            color: white;
            font-size: 1rem;
            text-align: center;
        }
        .card-body {
            font-size: 1rem;
        }
        .book-section {
            margin-top: 20px;
        }
        .book-card {
            margin-bottom: 20px;
        }
        .book-card img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                width: 60px;
                overflow-x: hidden;
            }
            .sidebar .nav-link {
                justify-content: center;
                padding: 10px;
            }
            .sidebar .nav-link span {
                display: none;
            }
            .sidebar .nav-link i {
                font-size: 1rem;
            }
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
        }
       


/* .three-images-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 30%;
        overflow: hidden;
    } */
/* 
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
    } */

    /* .image-text {
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
    } */

    /* .central-image-container {
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
    } */
    .central-image-container {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: auto;
    margin-top: 20px; /* Adjust margin to reduce space */
}

.three-images-container {
    display: flex;
    justify-content: space-around;
    align-items: center;
    flex-wrap: wrap; /* Allow wrapping on smaller screens */
    width: 100%;
}

.image-wrapper {
    position: relative;
    flex: 1;
    margin: 10px;
    max-width: 300px; /* Limit the width of each image */
    text-align: center;
}

.image-wrapper img.image-text{
    position: absolute;
    width: 20%;
    top: 50%;
    left: 50%;
    font-size: 1vw; /* Reduced font size for better fit */
    text-align: center;
    transform: translate(-50%, -50%); /* Center the text over the image */
    padding: 0.5vw; 
}

.image-wrapper img.img-fluid {
    width: 100%;
    height: auto;
    border-radius: 10px;
}

h2 {
    margin-top: 10px; /* Adjust to reduce space */
    margin-bottom: 20px; /* Adjust spacing between heading and images */
}

/* Adjustments for small screens */
@media (max-width: 768px) {
    .central-image-container {
        flex-direction: column;
        align-items: center;
    }
    .three-images-container {
        flex-direction: column; /* Stack the images vertically */
    }
    .image-wrapper {
        max-width: 90%; /* Allow images to take more width on small screens */
        margin: 10px auto;
    }
    .image-wrapper img.image-text {
        width: 100%; /* Make sure the text size is adjusted for smaller images */
        top: 45%;
        font-size: 3vw; /* Adjust text size for smaller screens */
    }
}

@media (max-width: 576px) {
    .image-wrapper img.image-text {
        width: 80%;
        top: 45%;
        font-size: 4vw; /* Further adjust text size for very small screens */
    }
}


    @media (max-width: 576px) {
    .sidebar {
        width: 50px;
    }

    .sidebar img.logo {
        width: 40px;
        height: 40px;
    }

    .main-content {
        margin-left: 50px;
        padding: 5px;
    }

    .footer {
        font-size: 0.75rem;
        padding: 0.25rem;
    }
}
    </style>
</head>
<body>
<div class="sidebar">
    
        <img src="{{ asset('images/finallogo.png') }}" alt="Logo" class="logo" style="width:150px;height:150px;">
        <ul class="nav flex-column">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="d-none d-md-inline">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('books') }}">
                    <i class="fas fa-book"></i>
                    <span class="d-none d-md-inline">Books</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/user-management_admin') }}">
                    <i class="fas fa-users"></i>
                    <span class="d-none d-md-inline">Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/add_books') }}">
                    <i class="fas fa-book"></i>
                    <span class="d-none d-md-inline">Add Books</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/description1') }}">
                    <i class="fas fa-book"></i>
                    <span class="d-none d-md-inline">description</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('profile_admin') }}">
                    <i class="fas fa-user"></i>
                    <span class="d-none d-md-inline">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="confirmLogout(event)">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="d-none d-md-inline">Logout</span>
                 </a>
            </li>
        </ul>
        <div class="footer">
            &copy; 2024  Web
        </div>
        <!-- <footer class="footer" style="margin-top: 10%;">
        <div class="footer-overlay">
            <div class="footer-content">
                <div class="footer-text">
                    <div class="footer-image">
                        <img src="{{ asset('images/imges2/logo2.png') }}" alt="Footer Image 1">
                    </div>
                    <p>Immerse in the spiritual and intellectual depth <br>of the Vedas, ancient wisdom guiding rituals;<br>the Puranas, rich mythological tales; and <br>Sanatan Dharma, eternal truths guiding <br>righteous living.</p>
                </div>
                <div class="footer-info">
                    <h4 style="color: #DEAD37;">Contact</h4>
                    <p>Email: info@example.com</p>
                    <p>Phone: +123 456 7890</p>
                </div>
                <div class="footer-image1">
                    <img src="{{ asset('images/imges2/book3.png') }}" alt="Footer Image 2">
                </div>
            </div>
            <div class="footer-subscribe">
                <input type="email" placeholder="Subscribe to our newsletter">
                <button type="button">Subscribe</button>
            </div>
          
        </div>
    </footer> -->
    </div> 

    <div class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </div>
    <form id="logout-form" action="{{ route('a_logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <script>
    function confirmLogout(event) {
        event.preventDefault(); // Prevent the default link action

        if (confirm('Are you sure you want to logout?')) {
            document.getElementById('logout-form').submit(); // Submit the logout form if confirmed
        }
    }
</script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
