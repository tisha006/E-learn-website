<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update About Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        
        .container1 {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 14px;
        }

        input[type="text"]:focus,
        textarea:focus {
            border-color: #80bdff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, .25);
        }

        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container1">
        <h1>Update About Us</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('about.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="image_path">Image Path</label>
                <input type="text" name="image_path" id="image_path" value="{{ old('image_path', $aboutDetails->image_path) }}" class="form-control" required>
                @error('image_path')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="text_content">Text Content</label>
                <textarea name="text_content" id="text_content" class="form-control" rows="5" required>{{ old('text_content', $aboutDetails->text_content) }}</textarea>
                @error('text_content')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn"style="background-color:#f39c12;">Update About Details</button>
        </form>
    </div>
</body>
</html>
