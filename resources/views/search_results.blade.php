@extends('Nav')
@section('nav')
<!DOCTYPE html>
<html>
<head>
    <style>

        body {
            font-family: 'Garamond', serif;
        }
        .book {
    text-align: center;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
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
        .ramayan img, .mahabharat img, .naishadha img, .kumarasambhava img, .Bhavanamrita img, .raghuvansh img, .shishupala img, .bhagavad-gita img, .kiratarjuniya img {
            height:69%;
            width:200px;
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
.remove-btn {
    background: none;
    border: none;
    color: red;
    cursor: pointer;
    transition: color 0.3s;
}

.remove-btn:hover {
    color: darkred;
}



/* Responsive Styles */
@media (max-width: 1200px) {
    .tab-pane .col-md-3 {
        flex: 0 0 30%; /* Adjust for medium screens */
    }
}

@media (max-width: 992px) {
    .tab-pane .col-md-3 {
        flex: 0 0 45%; /* Adjust for smaller medium screens */
    }
}

@media (max-width: 768px) {
    .tab-pane .col-md-3 {
        flex: 0 0 100%; /* Full width on small screens */
    }

    .book img {
        max-height: 300px; /* Reduce image height for smaller screens */
    }

    .book h3 {
        font-size: 1.1rem; /* Smaller title font */
    }

    .book-description {
        font-size: 0.8rem; /* Smaller description font */
    }

    .empty-wishlist {
        padding: 15px; /* Adjust padding */
        
    }
}

    </style>
</head>
<body>
    <div class="container">

        @if (session('info'))
            <div class="alert ">
                {{ session('info') }}
            </div>
        @elseif (session('error'))
            <div class="alert ">
                {{ session('error') }}
            </div>
        @endif

  
        @if ($books->isEmpty())
            <div class="empty-wishlist">
                <p>book not found</p>
            </div>
        @else

        <div class="tab-content" id="libraryTabContent" role="tabpanel" aria-labelledby="puranas-tab">
            <div class="tab-pane fade show active" id="puranas" role="tabpanel" aria-labelledby="puranas-tab">
                <br><br>    <div class="row">
                @foreach ($books as $book)
<div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
    <div class="book"
        data-price-15days="{{ $book->price_15days }}"
        data-price-1month="{{ $book->price_1month }}"
        data-price-6months="{{ $book->price_6months }}"
        @if (!is_null($book->subscription_image) && $book->subscription_image !== '' && (!auth()->check() || auth()->user()->plan_name === null))
            onclick="upgradeModal(event, {{ $book->id }}, '{{ $book->price_15days }}', '{{ $book->price_1month }}', '{{ $book->price_6months }}')"
        @endif
    >
    <div class="book-container" style="position: relative;">

    @if (!is_null($book->subscription_image) && $book->subscription_image !== '')
        <div class="subscription-image-container">
            <img src="{{ asset('storage/' . $book->subscription_image) }}" style="width: 40px; height: 40px; margin-left:117px; margin-top: -10px;">
        </div>
    @endif

    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->name }}">
    <h3><br>{{ $book->name }}</h3>
    <p class="book-description">{{ $book->description }}</p>
        <a href="{{ route('description', $book->id) }}" 
           class="btn read-button"
           @if (!auth()->check() && is_null($book->subscription_image))
               onclick="window.location='{{ route('login') }}';"
           @elseif (auth()->check() && auth()->user()->plan_name)
               onclick="window.location='{{ route('description', $book->id) }}';"
           @elseif (auth()->check() && auth()->user()->plan_name === null && is_null($book->subscription_image))
               onclick="window.location='{{ route('description', $book->id) }}';"
           @else
               onclick="event.preventDefault(); upgradeModal(event, {{ $book->id }}, '', '', '');"
           @endif
        >
            Read
        </a><br><br><br><br><br>
    </div>
</div>
</div>
@endforeach

</div>

            </div>
        </div>

        <!-- Single Modal for All Books -->
        <div class="modal fade" id="upgradeModal" tabindex="-1" role="dialog" aria-labelledby="upgradeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <h4 style="color: green;">Premium Subscription</h4>
                        <p>To read this book, please choose one of the following subscription plans.</p>
                        <div class="row text-center">
                            <!-- 15 Days Plan -->
                            <div class="col-md-4">
            <div class="subscription-plan">
                <h5>15 Days</h5>
                <p>Access for 15 days</p>
                <p style="color: green;margin-top:37px;">Price: $<span id="price-15days">0</span></p>
                <a href="{{ route('payment') }}?plan=15_days" class="btn btn-success">Choose Plan</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="subscription-plan">
                <h5>1 Month</h5>
                <p>Access for 1 month</p>
                <p style="color: green;">Price: $<span id="price-1month">0</span></p>
                <a href="{{ route('payment') }}?plan=1_month" class="btn btn-success">Choose Plan</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="subscription-plan">
                <h5>6 Months</h5>
                <p>Access for 6 months</p>
                <p style="color: green;">Price: $<span id="price-6months">0</span></p>
                <a href="{{ route('payment') }}?plan=6_month" class="btn btn-success">Choose Plan</a>
            </div>
        </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function upgradeModal(event, bookId, price15days, price1month, price6months) {
                document.getElementById('price-15days').textContent = price15days;
                document.getElementById('price-1month').textContent = price1month;
                document.getElementById('price-6months').textContent = price6months;
                
                $('#upgradeModal').modal('show'); // Show the modal
            }
        </script>

<script>
    </div>
</div>
@endif


        <div class="modal fade" id="upgradeModal" tabindex="-1" role="dialog" aria-labelledby="upgradeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <h4 style="color: green;">Premium Subscription</h4>
                        <p>To read this book, please choose one of the following subscription plans.</p>
                        <div class="row text-center">
                            <!-- 15 Days Plan -->
                            <div class="col-md-4">
            <div class="subscription-plan">
                <h5>15 Days</h5>
                <p>Access for 15 days</p>
                <p style="color: green;margin-top:37px;">Price: $<span id="price-15days">0</span></p>
                <a href="{{ route('payment') }}?plan=15_days" class="btn btn-success">Choose Plan</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="subscription-plan">
                <h5>1 Month</h5>
                <p>Access for 1 month</p>
                <p style="color: green;">Price: $<span id="price-1month">0</span></p>
                <a href="{{ route('payment') }}?plan=1_month" class="btn btn-success">Choose Plan</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="subscription-plan">
                <h5>6 Months</h5>
                <p>Access for 6 months</p>
                <p style="color: green;">Price: $<span id="price-6months">0</span></p>
                <a href="{{ route('payment') }}?plan=6_month" class="btn btn-success">Choose Plan</a>
            </div>
        </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
        <script>
            function upgradeModal(event, bookId, price15days, price1month, price6months) {
                document.getElementById('price-15days').textContent = price15days;
                document.getElementById('price-1month').textContent = price1month;
                document.getElementById('price-6months').textContent = price6months;
                
                $('#upgradeModal').modal('show'); // Show the modal
            }
        </script>



@endsection

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>