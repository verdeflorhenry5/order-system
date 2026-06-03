<x-app-layout>

    <div class="mb-3 d-flex justify-content-between align-items-center">
        <div>
            <h4>Food Orders</h4>
            <p class="text-muted">Track and manage all food orders.</p>
        </div>
        <button class="btn btn-primary btn-sm"
            data-bs-toggle="modal" data-bs-target="#addOrderModal">
            + Add Order
        </button>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table align-middle table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Food Item</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Ordered By</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $index => $order)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $order->food_name }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>₱{{ number_format($order->price, 2) }}</td>
                        <td>
                            @if($order->status === 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif($order->status === 'completed')
                                <span class="badge bg-success">Completed</span>
                            @else
                                <span class="badge bg-danger">Cancelled</span>
                            @endif
                        </td>
                        <td>{{ $order->user->name ?? 'N/A' }}</td>
                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#editOrderModal{{ $order->id }}">
                                Edit
                            </button>
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Delete this order?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <div class="modal fade" id="editOrderModal{{ $order->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title">Edit Order</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="mb-3">
                                            <label class="form-label">Food Item</label>
                                            <input type="text" name="food_name" value="{{ $order->food_name }}"
                                                class="form-control form-control-sm" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Quantity</label>
                                            <input type="number" name="quantity" value="{{ $order->quantity }}"
                                                class="form-control form-control-sm" min="1" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Price (₱)</label>
                                            <input type="number" name="price" value="{{ $order->price }}"
                                                class="form-control form-control-sm" step="0.01" min="0" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-select form-select-sm">
                                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
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
                        <td colspan="8" class="py-3 text-center text-muted">No orders yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Add Order Modal --}}
    <div class="modal fade" id="addOrderModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Add New Order</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Food Item</label>
                            <input type="text" name="food_name" class="form-control form-control-sm"
                                placeholder="" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Quantity</label>
                            <input type="number" name="quantity" class="form-control form-control-sm"
                                placeholder="" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price (₱)</label>
                            <input type="number" name="price" class="form-control form-control-sm"
                                placeholder="" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select form-select-sm">
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-sm">Place Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
