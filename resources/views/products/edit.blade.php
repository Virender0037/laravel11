<div>
<h1>Edit Post</h1>
<form method="POST" action="{{ route('products.update', $product) }}">
    @csrf
    @method('PUT')

    @if($errors->any())
    @foreach($errors->all() as $error)
    <div class="alert alert-danger" role="alert">
    {{$error}}
    </div>
    @endforeach
    @endif
    
    <label for="sku">sku:</label>
    <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku) }}" required></br>

    <label for="name">name:</label>
    <textarea name="name" id="name" rows="4" required>{{ old('name', $product->name) }}</textarea></br>

    <label for="price">price:</label>
    <textarea name="price" id="price" rows="4" required>{{ old('price', $product->price) }}</textarea></br>

    <label for="stock">stock:</label>
    <textarea name="stock" id="stock" rows="4" required>{{ old('stock', $product->stock) }}</textarea></br>

    <label for="status">status:</label>
    <textarea name="status" id="status" rows="4" required>{{ old('status', $product->status) }}</textarea></br>

    <label for="created_by">created by:</label>
    <textarea readonly id="created_by" rows="4" required>{{ old('created_by', $product->user->name) }}</textarea></br>

    <button type="submit">Update Product</button>
    <a href="{{ route('products.index') }}">Cancel</a>
</form>
</div>
