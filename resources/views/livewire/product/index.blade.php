<div>
    <h2 class="fw-bold mb-3">All Products</h2>
    <div class="mt-3 d-flex justify-content-end">
        <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">Create Product</a>
    </div>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Description</th>
            <th>Status</th>
            <th>Images</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->title }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->status == 1 ? 'Active' : 'Inactive' }}</td>
                <td>
                    <div>
                        <img src="{{ $product->image_url }}" style="max-width: 150px; object-fit: cover">
                    </div>
                </td>
                <td>
                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-warning">
                        Edit
                    </a>

                    <button wire:click="deleteProduct({{ $product->id }})" class="btn btn-sm btn-danger">
                        Delete
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
