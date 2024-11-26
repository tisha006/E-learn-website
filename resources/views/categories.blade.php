@extends('adminnav')

@section('content')
<div class="container">
    <ul class="nav nav-tabs" id="libraryTab" role="tablist" style="margin-top:-5%;">
        @foreach($categories as $category)
            <li class="nav-item">
                <a class="nav-link {{ isset($selectedCategory) && $selectedCategory->name == $category->name ? 'active' : '' }}" id="{{ $category->name }}-tab" href="{{ route('category.show', ['name' => $category->name]) }}" role="tab" aria-controls="{{ $category->name }}" aria-selected="{{ isset($selectedCategory) && $selectedCategory->name == $category->name ? 'true' : 'false' }}" style="color:#f39c12">{{ ucfirst($category->name) }}</a>
            </li>
        @endforeach
    </ul>
    
    <h2>Add New Category</h2>
    <form action="{{ route('categories.add') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Category Name:</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Enter category name" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Category</button>
    </form>

    <hr>

    <h2>Categories List</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#editModal{{ $category->id }}">Edit</button>
                        <form action="{{ route('categories.delete', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?');">Delete</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal for Editing Category -->
                <div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $category->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $category->id }}">Edit Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="name">Category Name:</label>
                                        <input type="text" name="name" class="form-control" id="name" value="{{ $category->name }}" required>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update Category</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
