@extends('Nav')

@section('nav')
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: 'Garamond', serif;
            background-image: url('background.jpg');
            background-size: cover;
            color: #333;
        }
        .content-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            margin-top: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .star {
            cursor: pointer;
            font-size: 24px;
            color: gray;
            transition: color 0.2s;
        }
        .star.selected {
            color: orange;
        }
        .pdf-viewer {
            display: none;
            width: 100%;
            height: 80vh;
            border: none;
            margin-top: 20px;
        }
        .pdf-viewer.show {
            display: block;
        }
        .btn-read {
            background-color: #f39c12;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        .close-pdf {
            background-color: #f39c12;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="content-card">
                    @if($book)
                        <h2>{{ $book->name }}</h2>
                        <img src="{{ asset('storage/' . $book->image) }}" style="width:56%;margin-left:22%;">
                        <p>{{ $book->detail }}</p>

                        <!-- Read Button -->
                        <button class="btn-read btn btn-primary" id="openPdf">Read PDF</button>

                        <!-- PDF Viewer -->
                        <iframe id="pdfViewer" class="pdf-viewer mt-3" style="width: 100%; height: 500px; display: none;"></iframe>
                        <button class="close-pdf btn btn-danger mt-2" id="closePdf" style="display: none;">Close PDF</button>

                        <!-- Rating Form (Initially Hidden) -->
                        <div id="ratingForm" style="display: none;" class="mt-4">
                            <h4>Rate this book:</h4>
                            <form method="POST" action="{{ route('rateBook', $book->id) }}">
                                @csrf
                                <div id="starInput" class="d-flex mb-3">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="star" data-value="{{ $i }}" style="cursor: pointer; font-size: 24px; color: gray;">★</span>
                                    @endfor
                                </div>
                                <input type="hidden" name="rating" id="rating" required>

                                <label for="review">Your Review:</label>
                                <textarea name="review" id="review" rows="3" class="form-control mb-2"></textarea>

                                <button type="submit" class="btn btn-primary">Submit Review</button>
                            </form>
                        </div>

                        <!-- Reviews Section -->
                        <div class="reviews mt-4">
                            <h4>Reviews:</h4>
                            @if($reviews->count() > 0)
                                @foreach($reviews as $review)
                                    <div class="review-item">
                                        <p>
                                            <strong>{{ $review->user->name ?? 'Anonymous' }}</strong>: 
                                            {{ $review->review ?? 'No comment' }} 
                                            ({{ $review->rating }} stars)
                                        </p>
                                    </div>
                                @endforeach
                            @else
                                <p>No reviews yet.</p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
       // Handle "Read" button click
// Handle "Read" button click
document.getElementById('openPdf').addEventListener('click', function () {
    const iframe = document.getElementById('pdfViewer');
    const closeBtn = document.getElementById('closePdf');
    const ratingForm = document.getElementById('ratingForm'); // Get the rating form element

    // Show PDF
    iframe.src = "{{ asset('storage/' . $book->pdf) }}"; // Adjust the path to your PDF file
    iframe.style.display = 'block'; // Show the iframe
    closeBtn.style.display = 'inline-block'; // Show the Close button
    fetch("{{ route('books.markAsRead', $book->id) }}", {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    }
}).then(response => {
    console.log('Response Status:', response.status); // Log response status
    if (response.ok) {
         // Show the form
         console.error('Failed to notify the server', response); // Log the response if it failed
        alert('There was an issue notifying the server.');
    } else {
        console.log('PDF opened successfully');
        ratingForm.style.display = 'block';
    }
}).catch(error => {
    console.error('Error:', error); // Log network errors
    alert('An error occurred while notifying the server: ' + error.message);
});


});


// Close PDF Viewer
document.getElementById('closePdf').addEventListener('click', function () {
    const iframe = document.getElementById('pdfViewer');
    const closeBtn = document.getElementById('closePdf');

    // Hide PDF and reset iframe source
    iframe.src = '';
    iframe.style.display = 'none';
    closeBtn.style.display = 'none';

    // Hide the rating form when closing PDF
    document.getElementById('ratingForm').style.display = 'none'; // Hide rating form
});

// Star input interaction
document.querySelectorAll('.star').forEach(star => {
    star.addEventListener('click', function () {
        const rating = this.getAttribute('data-value');
        document.getElementById('rating').value = rating; // Set rating input value

        // Highlight selected stars
        document.querySelectorAll('.star').forEach(s => {
            s.style.color = s.getAttribute('data-value') <= rating ? 'gold' : 'gray';
        });
    });
});

    </script>
</body>
</html>
@endsection
