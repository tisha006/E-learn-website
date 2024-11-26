<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/bootstrap.bundle.min.js.map') }}">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-size: cover;
    overflow-x: hidden;  
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link,
        .navbar-custom .navbar-toggler-icon {
            color: black;
        }
        .navbar-custom .nav-link:hover {
            color: white;
        }
        .navbar-custom .dropdown-menu {
            background-color: #f8c471;
        }
        .navbar-custom .dropdown-item:hover {
            background-color: #f39c12;
            color: white;
        }
        .footer {
            position: relative;
            width: 105%;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
            url('{{ asset('images/imges2/i17.webp') }}') no-repeat center center;
            background-size: cover;
            color: orange;
            padding: 30px 0;
        }
        .footer-overlay {
            position: relative;
            width: 100%;
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            box-sizing: border-box;
        }
        .footer-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-start;
            max-width: 1200px;
            margin: 0 auto;
        }
        .footer-image,
        .footer-image1 {
            flex: 1;
            margin: 10px;
        }
        .footer-image1 img {
            max-width: 270px;
            margin-top: -70px;
        }
        .footer-image img {
            max-width: 130px;
        }
        .footer-text,
        .footer-info {
            flex: 2;
            color: #f8c471;
            margin: 10px;
        }
        .footer-text h4 {
            color: #f39c12;
            margin-bottom: 10px;
        }
        .footer-subscribe {
            text-align: center;
            margin-top: -10px;
        }
        .footer-subscribe input[type="email"] {
            width: 80%;
            max-width: 300px;
            height: 40px;
            padding: 0 10px;
            border: 1px solid #f39c12;
            margin-bottom: 10px;
            border-radius: 4px;
            color: black;
        }
        .footer-subscribe button {
            background-color: #f39c12;
            border: none;
            height: 40px;
            color: black;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
            padding: 0 20px;
        }
        .footer-subscribe button:hover {
            background-color: #e08e0b;
        }
        .social-icons {
            text-align: center;
            margin-top: 20px;
        }
        .social-icons a {
            color: orange;
            margin: 0 10px;
            font-size: 24px;
            text-decoration: none;
        }
        .social-icons a:hover {
            color: #fff;
        }
        @media (max-width: 768px) {
            .footer-content {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            .footer-image,
            .footer-image1 {
                margin: 10px 0;
            }
            .footer-info,
            .footer-text {
                margin: 10px 0;
            }
            .footer-subscribe input[type="email"] {
                width: 90%;
            }
            .footer-subscribe button {
                width: 90%;
            }
            .navbar {
                height: auto;
            }
            .navbar-collapse {
                background-color: white;
                padding: 10px;
            }
            .navbar-nav {
                width: 100%;
            }
            .nav-item {
                /* text-align: center; */
                margin: 5px 0;
            }
            .form-inline {
                display: flex;
                flex-direction: column;
                align-items: center;
                width: 100%;
            }
            .form-inline input {
                width: 90%;
                margin-bottom: 10px;
            }

            .form-inline a {
                width: 90%;
            }
        }
        .navbar-logo {
    width: 80px; /* Maintain aspect ratio by using auto */
    max-width: 125px; /* Set a max-width to prevent the logo from being too large */
    height: auto; /* Maintain aspect ratio */
    margin-left: -40px; /* Adjust margin to align with other elements */
    margin-top: 10px; /* Adjust margin as needed */
}
@media (max-width: 1600px) {
    .navbar-logo {
        max-width: 130px; /* Reduce size for ultra-wide screens */
        margin-left: -50px; /* Align left as needed */
        margin-top: 10px; /* Adjust margin */
    }
}
@media (max-width: 1200px) {
    .navbar-logo {
        max-width: 130px; /* Reduce size for large screens */
        margin-left: -50; /* Align left as needed */
        margin-top: 10px; /* Adjust margin */
    }
}
@media (max-width: 1024px) {
    .navbar-logo {
        max-width: 125px; /* Adjust size for larger tablets */
        margin-left: -60px; /* Center align */
        margin-top: -30px; /* Adjust margin */
    }
}
@media (max-width: 840px) {
    .navbar-logo {
        max-width: 125px; /* Adjust size for intermediate screens */
        margin-left: -40px; /* Center align */
        margin-top: -30px; /* Adjust margin */
    }
}
@media (max-width: 768px) {
    .navbar-logo {
        max-width: 125px;
        margin-left: -40px;
        margin-top: -30px;
    }
    .footer-subscribe input[type="email"], .footer-subscribe button {
        width: 90%;
    }
    .navbar-collapse {
        background-color: white;
        padding: 10px;
    }
    .navbar-nav {
        width: 100%;
    }
}
@media (max-width: 600px) {
    .navbar-logo {
        max-width: 125px; /* Reduce size for large smartphones */
        margin-left: -40px; /* Center align */
        margin-top: -30px; /* Adjust margin */
    }
}
@media (max-width: 576px) {
    .navbar-logo {
        max-width: 125px; /* Reduce size for very small screens */
        margin-left: -40px; /* Center align */
        margin-top: -30px; /* Adjust margin */
    }
}
@media (max-width: 400px) {
    .navbar-logo {
        max-width: 125px; /* Reduce size for extra small screens */
        margin-left: -40px; /* Center align */
        margin-top: -30px; /* Adjust margin */
    }
}
@media (max-width: 320px) {
    .navbar-logo {
        max-width: 80px; /* Further reduce size for very small screens */
        margin-left: -5px; /* Center align */
        margin-top: -20px; /* Adjust margin */
    }
}
@media (max-width: 280px) {
    .navbar-logo {
        max-width: 80px; /* Minimum size for the smallest screens */
        margin-left: -5px; /* Center align */
        margin-top: -20px; /* Adjust margin */
    }
}
        li{
            list-style: none;
        }
        .nav-link.active {
    color: white;
}
    </style>
</head>
<body>
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container" style="height: 55px;">
        <img src="{{ asset('images/imges2/finallogo.png') }}" alt="Footer Image 2" class="navbar-logo" style="width: 200px !important;">
    </div>
</nav>
<div style="height:100px;"></div>

<nav class="navbar navbar-expand-lg navbar-custom" style="background-color: #DEAD37; padding-top: 5px; height: 55px; margin-top: -29px; width: 100%;">
    <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars" style="color: black; font-size: 20px;"></i> <!-- Hamburger icon -->
        </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0"style="padding-top:10px;">
                <li class="nav-item">
                <a class="nav-link" href="{{ URL::to('/Home') }}" style="margin-left: 34px; margin-top: 5px;">HOME</a>
                </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ URL::to('/About') }}" style="margin-left: 34px; margin-top: 5px;">ABOUT US</a>
                    </li>
                    <li class="nav-item">
                    @if(isset($categories) && $categories->isNotEmpty())
                        <a class="nav-link" href="{{ route('books.show', $categories->first()->name) }}"style="margin-top:5px;margin-left:28px;">LIBRARY</a>
                    @else
                        <a class="nav-link" href="#" disabled>LIBRARY</a>
                    @endif
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ URL::to('/Contact') }}" style="margin-left: 32px; margin-top: 5px;">CONTACT</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" method="GET" action="{{ URL::to('/search') }}">
    <div class="input-group">
        <input class="form-control" type="search" name="query" placeholder="Search..." aria-label="Search" style="height: 40px; background-color: white; color: black;margin-top:-2px;">
        <div class="input-group-append">
            <!-- <button class="btn " type="submit"> -->
                <img src="{{ asset('images/searchlogo.png') }}" alt="Search Icon" style="width: 20px; height: 20px;margin-top:10px;margin-left:5px;">
            <!-- </button> -->
        </div>
    </div>
</form>
@if(session()->has('name'))
    <li class="nav-item">
        <a href="{{ URL::to('/profile_page') }}">
            <img src="{{ asset('images/imges2/profile.png') }}" alt="Profile Icon" class="rounded-circle"style="width:37px;height:37px;margin-left:25px;">
        </a>
    </li>
    <!-- <li class="nav-item">
        <a href="{{ URL::to('/wishlist') }}">
            <img src="images/icons/fav2.png" alt="Favorites Icon" style="width:30px;height:30px;margin-left:5px;">
        </a>
    </li> -->
    <li class="nav-item">
    <a href="{{ URL::to('/logout') }}">
    <img src="{{ asset('images/icons/logout.png') }}" alt="Profile Icon" class="rounded-circle"style="width:37px;height:37px;margin-left:25px;">

        </a>    
    </li>
@else
    <a class="btn my-2 my-sm-0 bg-dark" href="{{ URL::to('/Login') }}" style="color: white;margin-left:5px;margin-bottom:20px;">SIGN IN</a>
@endif
    </a>   
</li>
                    </ul>
                </li>
            </div>
        </div>
    </nav>
    <div class="container" style="margin-top: 140px;">
        @yield('nav')
    </div>
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Log out successfully.
                </div>
            </div>
        </div>
    </div>

    <footer class="footer" style="margin-top: 10%;">
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

                    <img src="{{ asset('images/icons/icons.png') }}" alt="Facebook" style="width:30%; height: 20%; cursor: pointer;">

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
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('logoutButton').addEventListener('click', function() {
            var logoutModal = new bootstrap.Modal(document.getElementById('logoutModal'));
            logoutModal.show();
        });
    </script>
</body>

</html>