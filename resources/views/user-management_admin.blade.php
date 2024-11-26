@extends('adminnav')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <style>
        .table-row-spacing {
            margin-bottom: 1rem; /* Space between rows */
        }
        .profile-pic {
            width: 40px;
            height: 40px;
            padding: 5px;
            border-radius: 50%; /* Makes the image circular */
        }
        .table-responsive {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container mt-5"> <!-- Added margin at the top of the page -->
    <div class="row mb-3">
        <div class="col-12 col-md-6">
            <h2>User Management</h2>
        </div>
        <div class="col-12 col-md-6 text-md-right text-center">
            <!-- Button to trigger the modal -->
            <button class="btn btn-success" data-toggle="modal" data-target="#addUserModal">Add New User</button>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Profile Picture</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr class="table-row-spacing">
                <td>
                    <img src="{{ asset('images/' . ($user->profile_picture ?? 'user2.webp')) }}" class="profile-pic" alt="Profile Picture">
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->status === 'active')
                        <span class="badge badge-success">Active</span>
                    @elseif($user->status === 'suspended')
                        <span class="badge badge-danger">Suspended</span>
                    @else
                        <span class="badge badge-warning">Inactive</span>
                    @endif
                </td>
                <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editUserModal-{{ $user->id }}">
                    Edit User
                </button>
                <!-- Edit User Modal -->
                <div class="modal fade" id="editUserModal-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel-{{ $user->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="{{ route('user.update', ['id' => $user->id]) }}" method="POST">
                                @csrf
                                <!-- Include this input for method spoofing -->
                                <input type="hidden" name="_method" value="POST">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="editUserModalLabel-{{ $user->id }}">Edit User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="user_name">Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="user_email">Email</label>
                                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="user_status">Status</label>
                                        <select class="form-control" name="status" required>
                                            <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="suspended" {{ $user->status === 'suspended' ? 'selected' : '' }}>Suspended</option>
                                            <option value="inactive" {{ $user->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                 
            <form action="{{ route('user.delete', ['id' => $user->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">
                             <i class="fas fa-trash"></i>
                        </button>
                    </form>           
                </td>
            </tr>
            @endforeach
        </tbody>
            </tbody>
        </table>
    </div>

    <nav aria-label="Page navigation" class="mt-4">
        <ul class="pagination justify-content-center">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item active"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li>
            <li class="page-item"><a class="page-link" href="#">5</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </nav>

    
    
    <!-- Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addUserForm" action="{{ route('user.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="suspended">Suspended</option>
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 
    <div class="mt-5">
        <h3>Ratings and Feedback</h3>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Rating</th>
                        <th>Feedback</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-row-spacing">
                        <td>Michael Holz</td>
                        <td>⭐⭐⭐⭐⭐</td>
                        <td>Great service, very satisfied!</td>
                        <td>04/10/2023</td>
                    </tr>
                    <tr class="table-row-spacing">
                        <td>Paula Wilson</td>
                        <td>⭐⭐⭐⭐</td>
                        <td>Good, but there's room for improvement.</td>
                        <td>05/08/2023</td>
                    </tr>
                    <tr class="table-row-spacing">
                        <td>Antonio Moreno</td>
                        <td>⭐⭐⭐⭐⭐</td>
                        <td>Excellent experience, highly recommend!</td>
                        <td>11/05/2023</td>
                    </tr>
                    <tr class="table-row-spacing">
                        <td>Mary Saveley</td>
                        <td>⭐⭐⭐</td>
                        <td>Average experience, could be better.</td>
                        <td>06/09/2023</td>
                    </tr>
                    <tr class="table-row-spacing">
                        <td>Martin Sommer</td>
                        <td>⭐⭐⭐⭐⭐</td>
                        <td>Outstanding service, will use again!</td>
                        <td>12/08/2023</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div> -->

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- <script>
    $('#editUserModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id'); // Extract info from data-* attributes
        var name = button.data('name');
        var email = button.data('email');
        var status = button.data('status');

        var modal = $(this);
        modal.find('#editUserId').val(id);
        modal.find('#editName').val(name);
        modal.find('#editEmail').val(email);
        modal.find('#editStatus').val(status);
        
        // Update the form action to include the user ID
        modal.find('form').attr('action', '/user/update/' + id);
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // Event listener for opening the modal
    $('#editUserModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var userId = button.data('id'); // Extract info from data-* attributes
        var userName = button.data('name'); 
        var userEmail = button.data('email'); 
        var userStatus = button.data('status');

        // Update the form action URL
        var form = $(this).find('#editUserForm');
        var actionUrl = form.attr('action').replace('/user/update/', '/user/update/' + userId);
        form.attr('action', actionUrl);

        // Populate the form fields with user data
        $('#editUserId').val(userId);
        $('#editName').val(userName);
        $('#editEmail').val(userEmail);
        $('#editStatus').val(userStatus);
    });
});
</script> -->

</body>
</html>
@endsection
