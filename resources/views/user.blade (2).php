
@extends('nav')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <!-- User Profile Section -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">User Profile</h4>
                    <img src="images/puranas.jpg" class="img-fluid rounded-circle mb-3" style="width: 100px; height: 100px;" alt="Profile Picture">                    <p class="card-text"><strong>Name:</strong> John Doe</p>
                    <p class="card-text"><strong>Email:</strong> john.doe@example.com</p>
                    <p class="card-text"><strong>Bio:</strong> A brief bio about the user.</p>
                    <a href="#" class="btn btn-primary">Edit Profile</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">User Profile</h4>
                    <img src="path/to/profile-picture.jpg" class="img-fluid rounded-circle mb-3" alt="Profile Picture">
                    <p class="card-text"><strong>Name:</strong> John Doe</p>
                    <p class="card-text"><strong>Email:</strong> john.doe@example.com</p>
                    <p class="card-text"><strong>Bio:</strong> A brief bio about the user.</p>
                    <a href="#" class="btn btn-primary">Edit Profile</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">User Profile</h4>
                    <img src="path/to/profile-picture.jpg" class="img-fluid rounded-circle mb-3" alt="Profile Picture">
                    <p class="card-text"><strong>Name:</strong> John Doe</p>
                    <p class="card-text"><strong>Email:</strong> john.doe@example.com</p>
                    <p class="card-text"><strong>Bio:</strong> A brief bio about the user.</p>
                    <a href="#" class="btn btn-primary">Edit Profile</a>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <!-- User Activity/Content Section -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">User Activities</h4>
                    <ul class="list-group">
                        <!-- Sample Activity: Reading a Book -->
                        <li class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Read Book: The Bhagavad Gita</h5>
                                <small>2 days ago</small>
                            </div>
                            <p class="mb-1">John Doe recently finished reading "The Bhagavad Gita".</p>
                            <small>Rating: ★★★★★</small>
                        </li>
                        <!-- Sample Activity: Commenting on a Book -->
                        <li class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Commented on: The Ramayana</h5>
                                <small>5 days ago</small>
                            </div>
                            <p class="mb-1">John Doe commented: "A timeless epic that provides profound insights into duty and righteousness."</p>
                        </li>
                        <!-- Sample Activity: Adding a Book to Favorites -->
                        <li class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Added to Favorites: The Vedas</h5>
                                <small>1 week ago</small>
                            </div>
                            <p class="mb-1">John Doe added "The Vedas" to his list of favorite books.</p>
                        </li>
                        <li class="list-group-item">
    <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1">Liked a Comment on: The Mahabharata</h5>
        <small>4 days ago</small>
    </div>
    <p class="mb-1">John Doe liked a comment: "An extraordinary tale of valor and moral dilemmas."</p>
</li>
                        <!-- More activities can be added in a similar format -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
