<x-app-layout>

    <div class="mb-3 d-flex justify-content-between align-items-center">
        <div>
            <h4>Users Management</h4>
            <p class="text-muted">Manage all registered users.</p>
        </div>
        <button class="btn btn-primary btn-sm"
            data-bs-toggle="modal" data-bs-target="#addUserModal">
            + Add User
        </button>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table align-middle table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('M d, Y') }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#editUserModal{{ $user->id }}">
                                Edit
                            </button>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Delete this user?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title">Edit User</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name" value="{{ $user->name }}"
                                                class="form-control form-control-sm" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" value="{{ $user->email }}"
                                                class="form-control form-control-sm" required>
                                        </div>
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    @empty
                    <tr>
                        <td colspan="5" class="py-3 text-center text-muted">No users found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Add User Modal --}}
    <div class="modal fade" id="addUserModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Add New User</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control form-control-sm"
                                placeholder="" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control form-control-sm"
                                placeholder="" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control form-control-sm"
                                placeholder="" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-sm">Add User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
