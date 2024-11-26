@extends('Nav')
@section('nav')

<div class="container mt-5">
    <h2>Update Homepage Content</h2>
    <form action="{{ route('homepage.update') }}" method="POST">
        @csrf
        @method('PUT')

        <h4>Carousel Images</h4>
        @foreach ($carouselImages as $index => $image)
            <div class="form-group">
                <label for="carousel_image_{{ $index }}">Image URL {{ $index + 1 }}</label>
                <input type="text" name="carousel_images[{{ $index }}][image_url]" id="carousel_image_{{ $index }}" value="{{ $image->image_url }}" class="form-control" required>
                <input type="text" name="carousel_images[{{ $index }}][alt_text]" value="{{ $image->alt_text }}" class="form-control" placeholder="Alt Text" required>
            </div>
        @endforeach

        <h4>Slider Images</h4>
        @foreach ($sliderImages as $index => $image)
            <div class="form-group">
                <label for="slider_image_{{ $index }}">Image URL {{ $index + 1 }}</label>
                <input type="text" name="slider_images[{{ $index }}][image_url]" id="slider_image_{{ $index }}" value="{{ $image->image_url }}" class="form-control" required>
                <input type="text" name="slider_images[{{ $index }}][alt_text]" value="{{ $image->alt_text }}" class="form-control" placeholder="Alt Text" required>
            </div>
        @endforeach

        <h4>Central Image</h4>
        @if ($centralImage)
            <div class="form-group">
                <label for="central_image">Central Image URL</label>
                <input type="text" name="central_image[image_url]" id="central_image" value="{{ $centralImage->image_url }}" class="form-control" required>
                <!-- <input type="text" name="central_image[alt_text]" value="{{ $centralImage->alt_text }}" class="form-control" placeholder="Alt Text" required> -->
            </div>
        @endif

        <h4>Three Images</h4>
        @foreach ($threeImages as $index => $image)
            <div class="form-group">
                <label for="three_image_{{ $index }}">Image URL {{ $index + 1 }}</label>
                <input type="text" name="three_images[{{ $index }}][image_url]" id="three_image_{{ $index }}" value="{{ $image->image_url }}" class="form-control" required>
                <input type="text" name="three_images[{{ $index }}][link]" value="{{ $image->link }}" class="form-control" placeholder="Link" required>
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Update Content</button>
    </form>
</div>

@endsection
