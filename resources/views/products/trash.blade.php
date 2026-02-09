<div>
    <h1>Trash Products Listing</h1>
    <div>
    <a href="{{route('dashboard')}}" class="btn btn-primary">Back</a>
    </div>
    <style>
    table, th, td {
    border:1px solid black;
    }
    </style>
    <table>
        <thead>
            <tr>
                <th>sku</th>
                <th>name</th>
                <th>price</th>
                <th>stock</th>
                <th>status</th>
                <th>created by</th>
                <th>Action</th>
            </tr>
        </thead>
        @if($Products->count())
        <tbody>
            {{-- Loop through the $products collection --}}
            @foreach ($Products as $product)
                <tr>
                    {{-- Display individual products using double curly braces --}}
                    <td>{{ $product->sku }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->status }}</td>
                    <td>{{ $product->user->name }}</td>
                    <td>
                    {{-- Restore Button --}}
                    <form method="POST" action="{{ route('products.restore', $product->id) }}" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-danger">
                        Restore
                        </button>
                    </form>
                    {{-- Delete Button (using a separate form for correct HTTP method handling) --}}
                    <form method="POST" action="{{ route('products.permanentdelete', $product->id) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to permanent delete this product?');">
                        Permanently Delete
                        </button>
                    </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        @else
        <p>No products found</p>
        @endif
        </table>
    </div>