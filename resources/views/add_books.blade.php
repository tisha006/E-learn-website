@extends('adminnav')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Books</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        .book {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            background-color: #fff;
            margin-bottom: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .book:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 12px rgba(0,0,0,0.2);
        }
        .book img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        /* .book .heart-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            color: red;
        } */
        .btn-custom {
            background-color: #f39c12;
            color: white;
            border: none;
        }
        .btn-custom:hover {
            background-color: #e67e22;
        }
        .form-control, .form-control-file {
            border-radius: 5px;
        }
        .nav-tabs .nav-link.active {
            background-color: #f39c12;
            color: white;
        }
        .nav-tabs .nav-link {
            color: #f39c12;
        }
        .container {
            margin-top: 30px;
        }
        .feedback-message {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
        <h1 class="mb-4">Add Books</h1>

        <!-- Feedback Messages -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
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
    

        <!-- Feedback Messages -->
        <!-- <div class="feedback-message">
            
            <div class="alert alert-success" role="alert">
                Book added successfully!
            </div>
           
            <div class="alert alert-danger" role="alert">
                Error adding book. Please try again.
            </div>
        </div> -->

        <!-- Tabs for Categories -->
        <ul class="nav nav-tabs" id="libraryTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="vedas-tab" data-toggle="tab" href="#vedas" role="tab" aria-controls="vedas" aria-selected="true">Vedas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="puranas-tab" data-toggle="tab" href="#puranas" role="tab" aria-controls="puranas" aria-selected="false">Puranas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="mahakavyas-tab" data-toggle="tab" href="#mahakavyas" role="tab" aria-controls="mahakavyas" aria-selected="false">Mahakavyas</a>
            </li>
        </ul>

        <div class="tab-content" id="libraryTabContent">
    <!-- Vedas Tab -->
    <div class="tab-pane fade show active" id="vedas" role="tabpanel" aria-labelledby="vedas-tab">
        <h2 class="mt-4">Add Vedas</h2>
        <form action="{{ route('store.book') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="category" value="vedas">
            <div class="form-group">
                <label for="name">Book Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter book name">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter book description"></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
            <div class="form-group">
                    <label for="detail">Detail</label>
                    <textarea class="form-control" id="detail" name="detail" rows="3" placeholder="Enter book detail"></textarea>
                </div>
                <div class="form-group">
                    <label for="pdf">PDF</label>
                    <input type="file" class="form-control-file" id="pdf" name="pdf">
                </div>
                <div>
    <label for="category_id">Category:</label>
    <select name="category_id" required>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
</div>
            <button type="submit" class="btn btn-custom">Add Book</button>
        </form>

        <h2 class="mt-4">Books in Vedas</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Book Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Detail</th>
                    <th scope="col">PDF</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vedas as $book)
                    <tr>
                        <td>
                        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->name }}" class="rounded" style="height: 60px;">
                        </td>
                        <td>{{ $book->name }}</td>
                        <td>{{ $book->description }}</td>
                        <td>{{ $book->detail }}</td>
                            <td>
                                @if ($book->pdf)
                                    <a href="{{ asset('storage/' . $book->pdf) }}" target="_blank">View PDF</a>
                                @else
                                    N/A
                                @endif
                            </td>
                        <td>
                            <a href="#" class="btn btn-custom">Edit</a>
                            <a href="#" class="btn btn-custom">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Puranas Tab -->
    <div class="tab-pane fade" id="puranas" role="tabpanel" aria-labelledby="puranas-tab">
        <h2 class="mt-4">Add Puranas</h2>
        <form action="{{ route('store.book') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="category" value="puranas">
            <div class="form-group">
                <label for="name">Book Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>
                <div class="form-group">
                    <label for="detail">Detail</label>
                    <textarea class="form-control" id="detail" name="detail" rows="3" placeholder="Enter book detail"></textarea>
                </div>
                <div class="form-group">
                    <label for="pdf">PDF</label>
                    <input type="file" class="form-control-file" id="pdf" name="pdf">
                </div>
                <div>
    <label for="category_id">Category:</label>
    <select name="category_id" required>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
</div>
            <button type="submit" class="btn btn-custom">Add Book</button>
        </form>

        <h2 class="mt-4">Books in Puranas</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Book Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Detail</th>
                    <th scope="col">PDF</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($puranas as $book)
                    <tr>
                        <td>
                        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->name }}" class="rounded" style="height: 60px;">
                        </td>
                        <td>{{ $book->name }}</td>
                        <td>{{ $book->description }}</td>
                        <td>{{ $book->detail }}</td>
                            <td>
                                @if ($book->pdf)
                                    <a href="{{ asset('storage/' . $book->pdf) }}" target="_blank">View PDF</a>
                                @else
                                    N/A
                                @endif
                            </td>
                        <td>
                            <a href="#" class="btn btn-custom">Edit</a>
                            <a href="#" class="btn btn-custom">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Mahakavyas Tab -->
    <div class="tab-pane fade" id="mahakavyas" role="tabpanel" aria-labelledby="mahakavyas-tab">
        <h2 class="mt-4">Add Mahakavyas</h2>
        <form action="{{ route('store.book') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="category" value="mahakavyas">
            <div class="form-group">
                <label for="name">Book Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control-file" id="image" name="image" required>
                </div>
                <div class="form-group">
                    <label for="detail">Detail</label>
                    <textarea class="form-control" id="detail" name="detail" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="pdf">PDF</label>
                    <input type="file" class="form-control-file" id="pdf" name="pdf">
                </div>
            <button type="submit" class="btn btn-custom">Add Book</button>
        </form>

        <h2 class="mt-4">Books in Mahakavyas</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Book Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Detail</th>
                    <th scope="col">PDF</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mahakavyas as $book)
                    <tr>
                        <td>
                        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->name }}" class="rounded" style="height: 60px;">
                        <td>{{ $book->name }}</td>
                        <td>{{ $book->description }}</td>
                        <td>{{ $book->detail }}</td>
                        <td>
                            @if ($book->pdf)
                                <a href="{{ asset('storage/' . $book->pdf) }}" target="_blank">View PDF</a>
                            @else
                                N/A
                            @endif
                        </td>

                        <td>
                            <a href="#" class="btn btn-custom">Edit</a>
                            <a href="#" class="btn btn-custom">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
@endsection