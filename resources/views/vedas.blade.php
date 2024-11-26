@extends('Nav')
@section('nav')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vedas</title>
   
<meta name="csrf-token" content="{{ csrf_token() }}">
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
        #vedas {
            background-color: transparent !important; 
            padding: 0 !important; 
            margin: 0 !important; 
        }
        
        .book {
    text-align: center;
    box-sizing: border-box;
    display: flex;
    flex-direction: row;
    align-items: center;
    height: 100%;
    padding: 10px; /* Add padding for spacing */
    margin: 0 auto; /* Center align the book container */
    max-width: 220px; /* Optional: limit the width of the book container */
}
        .book img {
    width: 220px; /* Fixed width */
    height: 340px; /* Fixed height */
    object-fit: cover; /* Cover the area without distortion */
    transition: transform 0.2s ease-in-out;
}

        .book h3 {
            font-size: 1rem; /* Smaller font size */
        }
        .book-description {
            font-size: 0.8rem; /* Smaller font size */
            margin: 10px 0;
        }
        .read-button {
    background-color: #f39c12;
    color: white;
    width: 200px; /* Fixed width for the button */
    height: 40px; /* Fixed height for the button */
    padding: 5px 0; /* Vertical padding */
    text-align: center;
    margin-top: 10px;
    padding-top:10px;
    font-size: 0.8rem; /* Font size */
    border: none; /* Remove default border */
    border-radius: 5px; /* Slight rounding to corners */
    transition: background-color 0.3s; /* Transition for hover effect */
}
.read-button:hover {
color:white;
}
        .book:hover {
            transform: scale(1.05);
        }
          /* Adjustments for smaller screens */
        @media (max-width: 576px) {
            .book img {
                height:80%;
                 width:220px;
            }
            .read-button {
                width: 60%; /* Smaller button width for very small screens */
                padding: 5px 0;
            }
            .heart-icons, .heart-icon {
                top: 5px; /* Position from the top of the container */
            left: 80%; /* Position from the right of the container */
                font-size: 20px; /* Slightly smaller icon size */
            }
        }
        /* Default positioning for larger screens */
        .heart-icons, .heart-icon {
            position: absolute;
            top: 5px; /* Position from the top of the container */
            left:80%; /* Position from the right of the container */
            color: #DEAD37;
            font-size: 20px;
            cursor: pointer;
            z-index: 10; /* Ensure it stays above other elements */
        }
        /* Adjustments for smaller screens */
        @media (max-width: 768px) {
            .heart-icons, .heart-icon {
                top: 5px; /* Position from the top of the container */
            left: 70%; /* Position from the right of the container */
                font-size: 20px; /* Slightly smaller icon size */
            }
            .book img {
                height:300px;
                width:200px;       
         }
         .subscription-image-container {
            margin-left:-20px; /* Position from the right of the container */

                    }    
        }
        /* Further adjustments for very small screens */
        @media (max-width: 576px) {
            .heart-icons, .heart-icon {
                top: 5px; /* Position from the top of the container */
            right: 5px; /* Position from the right of the container */
                font-size: 20px; /* Even smaller icon size for better fit */
            }
        }
        .tab-pane {
            display: flex;
            flex-wrap: wrap;
            background-color: transparent !important; 
            padding: 0 !important;
            margin: 0 !important; 
        }
        .tab-pane .col-md-3, .tab-pane .col-md-3 {
            margin-bottom: 30px;
        }
               
.book-container {
    position: relative;
}

.subscription-image-container {
    position: absolute;
    top: 15px;  /* Adjust the top position as needed */
    left:65px;  /* Adjust the left position as needed */
}

.subscription-plan {
    border: 1px solid #ddd;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 15px;
    background-color: #f9f9f9;
}
.subscription-plan h5 {
    color: #333;
}
.subscription-plan p {
    font-size: 14px;
}
.btn-success {
    background-color: #28a745;
    border-color: #28a745;
}
        /* .rig img {
            height:20%;
            width:200px;
        }
        .sam img {
            height:69%;
            width:200px;
        }
        .yajur img {
            height:69%;
            width:200px;
        }
        .Athrv img {
            height:69%;
            width:200px;
        } */
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<ul class="nav nav-tabs" id="libraryTab" role="tablist">
    @foreach($categories as $category)
        <li class="nav-item">
            <a class="nav-link {{ $category->name == $categoryName ? 'active' : '' }}"
               href="{{ route('books.show', $category->name) }}">{{ ucfirst($category->name) }}</a>
        </li>
    @endforeach
</ul>
<br><br><br>
<div class="tab-content" id="libraryTabContent">
    <div class="tab-pane fade show active" id="books">
        <div class="row">
            @foreach ($selectedCategoryBooks as $book)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="book">
                    <div class="book-container" style="position: relative;">

                    <!-- <div class="heart-icons">
                            <i class="fas fa-heart heart-icon" onclick="addToWishlist(event, {{ $book->id }})" style="cursor:pointer; color: #DEAD37; margin-left: 50px;"></i>
                        </div> -->
                        @if (!Session::has('email') || (Session::has('email') && empty(Session::get('plan_name'))))
                        @if (!is_null($book->subscription_image) && $book->subscription_image !== '')
                        <div class="subscription-image-container">
                            <img src="{{ asset('storage/' . $book->subscription_image) }}" style="width: 40px; height: 40px; margin-left: 117px; margin-top: -10px;">
                        </div>
                        @endif
                        @endif
                        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->name }}">
                        <h3>{{ $book->name }}</h3>
                        <p class="book-description">{{ $book->description }}</p>

                        <button class="read-button"
                                onclick="handleReadButtonClick({{ $book->id }}, '{{ $book->subscription_image }}', '{{ $book->price_15days }}', '{{ $book->price_1month }}', '{{ $book->price_6months }}')">
                            Read
                        </button>
                    </div>
                </div>
            </div>     
            @endforeach
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="upgradeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h4>Premium Subscription</h4>
                <p>Select a subscription plan to continue.</p>
                <div class="row text-center">
                    <div class="col-md-4">
                        <div class="subscription-plan">
                            <h5>15 Days</h5>
                            <p>Price: <span id="price-15days"></span></p>
                            <button class="btn btn-success" onclick="processPayment('15_days')">Choose Plan</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="subscription-plan">
                            <h5>1 Month</h5>
                            <p>Price: <span id="price-1month"></span></p>
                            <button class="btn btn-success" onclick="processPayment('1_month')">Choose Plan</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="subscription-plan">
                            <h5>6 Months</h5>
                            <p>Price: <span id="price-6months"></span></p>
                            <button class="btn btn-success" onclick="processPayment('6_months')">Choose Plan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function handleReadButtonClick(bookId, subscriptionImage, price15days, price1month, price6months) {
    if (!isUserLoggedIn()) {
        window.location.href = '/Login';
    } else if (hasSubscriptionPlan()) {
        window.location.href = `/description/${bookId}`;
    } else if (subscriptionImage) {
        showUpgradeModal(price15days, price1month, price6months);
    } else {
        window.location.href = `/description/${bookId}`;
    }
}

function isUserLoggedIn() {
    return {!! Session::has('email') ? 'true' : 'false' !!};
}

function hasSubscriptionPlan() {
    return {!! Session::has('plan_name') ? 'true' : 'false' !!};
}

function showUpgradeModal(price15days, price1month, price6months) {
    document.getElementById('price-15days').textContent = price15days || 'N/A';
    document.getElementById('price-1month').textContent = price1month || 'N/A';
    document.getElementById('price-6months').textContent = price6months || 'N/A';
    $('#upgradeModal').modal('show');
}

function processPayment(plan) {
    window.location.href = `/payment?plan=${plan}`;
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.heart-icon').forEach(icon => {
        icon.addEventListener('click', function () {
            const bookId = this.dataset.id; // Get the book ID from the data-id attribute of the icon
            const url = '/add-to-wishlist'; // Laravel route to add the book to the wishlist

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ book_id: bookId }) // Pass the book ID to the backend
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Book added to wishlist!');
                } else {
                    alert('There was an error adding the book to your wishlist.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Something went wrong. Please try again.');
            });
        });
    });
});

</script>

@endsection

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
