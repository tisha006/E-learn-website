@extends('adminnav')
@section('content')
    <h1>Dashboard</h1>
    <div class="row">
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card">
                <div class="card-header">
                    Total Books
                </div>
                <div class="card-body">
                    <p class="card-text">Number of books available: 150</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card">
                <div class="card-header">
                    Total Users
                </div>
                <div class="card-body">
                    <p class="card-text">Number of users: 2000</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12 mb-4">
            <div class="card">
                <div class="card-header">
                    Daily Visits
                </div>
                <div class="card-body">
                    <p class="card-text">Number of visits today: 500</p>
                </div>
            </div>
        </div>
    </div>

<h2 style="text-align:center;color:#FF4501;">Types of Books</h2> 
<div class="central-image-container"> 
    <div class="three-images-container text-center">
        <div class="image-wrapper">
            <a href="{{ URL::to('/books') }}">
                <img src="images/vedas-text.png" class="image-text img-fluid" style="width:200px;">
                <img src="images/imges2/letter.png" alt="Image 1" class="img-fluid">
            </a>
        </div>
        <div class="image-wrapper">
            <a href="{{ URL::to('/books') }}">
                <img src="images/purana-text.png" class="image-text img-fluid" style="width:200px;">
                <img src="images/imges2/letter.png" alt="Image 2" class="img-fluid">
            </a>
        </div>
        <div class="image-wrapper">
            <a href="{{ URL::to('/books') }}">
                <img src="images/mahakvaya-text.png" class="image-text img-fluid" style="width:200px;">
                <img src="images/imges2/letter.png" alt="Image 3" class="img-fluid">
            </a>
        </div>
    </div>
</div>


    <hr>
    <div class="book-section">
        <h2>Books</h2>
        <div class="row">
            <div class="col-md-4 col-sm-6 col-12 mb-4 book-card">
                <div class="card">
                    <img src="images/talesVedas.jpg" alt="Book 1" class="img-fluid" style="height:495px;width:100%;">
                    <div class="card-body">
                        <h5 class="card-title">Tales of Vedas</h5>
                        <p class="card-text" style="color:#FF4501;">This is a Book of Vedas</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12 mb-4 book-card">
                <div class="card">
                    <img src="images/puranas1.jpg" alt="Book 2" class="img-fluid" style="height:auto;width:100%;">
                    <div class="card-body">
                        <h5 class="card-title">Tales of Puranas</h5>
                        <p class="card-text" style="color:#FF4501;">This is a brief description of Puranas.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12 mb-4 book-card">
                <div class="card">
                    <img src="images/mahakavyas/bhagwatgita.jpg" alt="Book 3" class="img-fluid" style="height:470px;width:100%;">
                    <div class="card-body">
                        <h5 class="card-title">Bhagavad Gita</h5>
                        <p class="card-text" style="color:#FF4501;">This book detail explanation of Bhagavad Gita</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
