@extends('adminnav')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Library</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Garamond', serif;
        }
        .book {
            text-align: center;
            position: relative;
        }
        .book img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        .heart-icons, .heart-icon {
            position: absolute;
            top: -10px;
            right: -10px;
            color: #DEAD37;
            font-size: 20px;
            cursor: pointer;
        }
        .tab-pane {
            display: flex;
            flex-wrap: wrap;
            background-color: transparent !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        .tab-pane .col-md-4, .tab-pane .col-md-3 {
            margin-bottom: 30px;
        }
        /* Specific image sizes for different categories */
        .Vishnu-book img,
        .Shiv-book img,
        .vamana-book img,
        .kurma-book img,
        .garuda-book img,
        .Brahma-book img,
        .Brahmanda-book img,
        .Agni-book img,
        .ramayan img,
        .mahabharat img,
        .naishadha img,
        .kumarasambhava img,
        .bhagavata img,
        .raghuvansh img,
        .shishupala img,
        .Bhagavata img {
            width: 230px !important;
            height: 365px !important;
        }
        .rig img,
        .sam img,
        .yajur img,
        .Athrv img {
            height: 315px;
            width: 87%;
        }
        #mahakavyas .book img {
            width: 200px;
            height: 300px;
            object-fit: cover;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
<div class="container">
        <br><br>
        <ul class="nav nav-tabs" id="libraryTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="vedas-tab" data-toggle="tab" href="#vedas" role="tab" aria-controls="vedas" aria-selected="true" style="color:#f39c12">Vedas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="puranas-tab" data-toggle="tab" href="#puranas" role="tab" aria-controls="puranas" aria-selected="false" style="color:#f39c12">Puranas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="mahakavyas-tab" data-toggle="tab" href="#mahakavyas" role="tab" aria-controls="mahakavyas" aria-selected="false" style="color:#f39c12">Mahakavyas</a>
            </li>
        </ul>
        
  <div class="tab-content" id="libraryTabContent">
            <!-- Vedas -->
     <div class="tab-pane fade show active" id="vedas" role="tabpanel" aria-labelledby="vedas-tab">
        <br><br>
        @if (session('success'))
            <div class="alert alert-success">
            {{ session('success') }}
            </div>
        @endif
        <div class="row">
            @foreach ($data['vedas'] as $book)
            <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                <div class="book {{ $book['class'] }}">
                    <a href="#"><i class="fas fa-heart heart-icons"></i></a>
                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->name }}" style="height:300px;width:200px;">
                    <br><br>
                    <h3>{{ $book['name'] }}</h3>
                    <p style="font-size: 13px;">{{ $book['description'] }}</p>
                    <button type="button" class="btn btn-edit" style="background-color: #f39c12; width: 30%; color: white;"
                        onclick="document.getElementById('editForm{{ $book->id }}').style.display='block'">Edit</button>

                    <form action="{{ route('books.delete', ['id' => $book->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-edit" style="background-color: #f39c12; width: 30%; color: white;">
                            Delete
                        </button>
                    </form>
                    <br><br><br>

                    <!-- Edit Book Form -->
                    <div id="editForm{{ $book->id }}" style="display: none;">
                        <form action="{{ route('books.update', ['id' => $book->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="form-group">
                                <label for="editName{{ $book->id }}">Book Name:</label>
                                <input type="text" name="name" id="editName{{ $book->id }}" class="form-control" value="{{ $book->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="editDescription{{ $book->id }}">Description:</label>
                                <textarea name="description" id="editDescription{{ $book->id }}" class="form-control" required>{{ $book->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="editCategory{{ $book->id }}">Category:</label>
                                <select name="category" id="editCategory{{ $book->id }}" class="form-control" required>
                                    <option value="vedas" {{ $book->category == 'vedas' ? 'selected' : '' }}>Vedas</option>
                                    <option value="puranas" {{ $book->category == 'puranas' ? 'selected' : '' }}>Puranas</option>
                                    <option value="mahakavyas" {{ $book->category == 'mahakavyas' ? 'selected' : '' }}>Mahakavyas</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="editImage{{ $book->id }}">Book Image:</label>
                                <input type="file" name="image" id="editImage{{ $book->id }}" class="form-control">
                                <img src="{{ asset('storage/' . $book->image) }}" alt="Book Image" style="width: 100px; height: auto; margin-top: 10px;">
                            </div>
                            <div class="form-group">
    <label for="editDetail{{ $book->id }}">Detail:</label>
    <textarea name="detail" id="editDetail{{ $book->id }}" class="form-control">{{ old('detail', $book->detail) }}</textarea>
</div>
<div class="form-group">
    <label for="editPdf{{ $book->id }}">PDF:</label>
    <input type="file" name="pdf" id="editPdf{{ $book->id }}" class="form-control">
    @if ($book->pdf)
        <a href="{{ asset('storage/' . $book->pdf) }}" target="_blank">View PDF</a>
    @endif
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" onclick="document.getElementById('editForm{{ $book->id }}').style.display='none'">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

              <!-- Puranas -->
    <div class="tab-pane fade" id="puranas" role="tabpanel" aria-labelledby="puranas-tab">
        <br><br>
        @if (session('success'))
            <div class="alert alert-success">
            {{ session('success') }}
            </div>
        @endif
        <div class="row">
            @foreach ($data['puranas'] as $book)
            <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-4">
                <div class="book {{ $book['class'] }}">
                    <a href="#"><i class="fas fa-heart heart-icons"></i></a>
                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->name }}" style="height:400px;width:250px;">
                    <br><br>
                    <h3>{{ $book['name'] }}</h3>
                    <p style="font-size: 13px;">{{ $book['description'] }}</p>
                    <button type="button" class="btn btn-edit" style="background-color: #f39c12; width: 30%; color: white;"
                        onclick="document.getElementById('editFormPuranas{{ $book->id }}').style.display='block'">Edit</button>

                    <form action="{{ route('books.delete', ['id' => $book->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-edit" style="background-color: #f39c12; width: 30%; color: white;">
                            Delete
                        </button>
                    </form>
                    <br><br><br>

                    <!-- Edit Book Form for Puranas -->
                    <div id="editFormPuranas{{ $book->id }}" style="display: none;">
                        <form action="{{ route('books.update', ['id' => $book->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label for="editNamePuranas{{ $book->id }}">Book Name:</label>
                                <input type="text" name="name" id="editNamePuranas{{ $book->id }}" class="form-control" value="{{ $book->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="editDescriptionPuranas{{ $book->id }}">Description:</label>
                                <textarea name="description" id="editDescriptionPuranas{{ $book->id }}" class="form-control" required>{{ $book->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="editCategoryPuranas{{ $book->id }}">Category:</label>
                                <select name="category" id="editCategoryPuranas{{ $book->id }}" class="form-control" required>
                                    <option value="vedas" {{ $book->category == 'vedas' ? 'selected' : '' }}>Vedas</option>
                                    <option value="puranas" {{ $book->category == 'puranas' ? 'selected' : '' }}>Puranas</option>
                                    <option value="mahakavyas" {{ $book->category == 'mahakavyas' ? 'selected' : '' }}>Mahakavyas</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="editImagePuranas{{ $book->id }}">Book Image:</label>
                                <input type="file" name="image" id="editImagePuranas{{ $book->id }}" class="form-control">
                                <img src="{{ asset('storage/' . $book->image) }}" alt="Book Image" style="width: 100px; height: auto; margin-top: 10px;">
                            </div>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" onclick="document.getElementById('editFormPuranas{{ $book->id }}').style.display='none'">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Mahakavyas -->
    <div class="tab-pane fade" id="mahakavyas" role="tabpanel" aria-labelledby="mahakavyas-tab">
        <br><br>
        @if (session('success'))
            <div class="alert alert-success">
            {{ session('success') }}
            </div>
        @endif
        <div class="row">
            @foreach ($data['mahakavyas'] as $book)
            <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                <div class="book {{ $book['class'] }}">
                    <a href="#"><i class="fas fa-heart heart-icons"></i></a>
                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->name }}">
                    <br><br>
                    <h3>{{ $book['name'] }}</h3>
                    <p style="font-size: 13px;">{{ $book['description'] }}</p>
                    <button type="button" class="btn btn-edit" style="background-color: #f39c12; width: 30%; color: white;"
                        onclick="document.getElementById('editFormMahakavyas{{ $book->id }}').style.display='block'">Edit</button>

                    <form action="{{ route('books.delete', ['id' => $book->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-edit" style="background-color: #f39c12; width: 30%; color: white;">
                            Delete
                        </button>
                    </form>
                    <br><br><br>

                    <!-- Edit Book Form for Mahakavyas -->
                    <div id="editFormMahakavyas{{ $book->id }}" style="display: none;">
                        <form action="{{ route('books.update', ['id' => $book->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label for="editNameMahakavyas{{ $book->id }}">Book Name:</label>
                                <input type="text" name="name" id="editNameMahakavyas{{ $book->id }}" class="form-control" value="{{ $book->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="editDescriptionMahakavyas{{ $book->id }}">Description:</label>
                                <textarea name="description" id="editDescriptionMahakavyas{{ $book->id }}" class="form-control" required>{{ $book->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="editCategoryMahakavyas{{ $book->id }}">Category:</label>
                                <select name="category" id="editCategoryMahakavyas{{ $book->id }}" class="form-control" required>
                                    <option value="vedas" {{ $book->category == 'vedas' ? 'selected' : '' }}>Vedas</option>
                                    <option value="puranas" {{ $book->category == 'puranas' ? 'selected' : '' }}>Puranas</option>
                                    <option value="mahakavyas" {{ $book->category == 'mahakavyas' ? 'selected' : '' }}>Mahakavyas</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="editImageMahakavyas{{ $book->id }}">Book Image:</label>
                                <input type="file" name="image" id="editImageMahakavyas{{ $book->id }}" class="form-control">
                                <img src="{{ asset('storage/' . $book->image) }}" alt="Book Image" style="width: 100px; height: auto; margin-top: 10px;">
                            </div>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" onclick="document.getElementById('editFormMahakavyas{{ $book->id }}').style.display='none'">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
  </div>
</div>
</body>
</html>
@endsection

