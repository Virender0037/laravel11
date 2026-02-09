<div>
<h1>Create Products</h1>
<form method="POST" action="{{ route('products.store') }}">
    @csrf

    @if($errors->any())
    @foreach($errors->all() as $error)
    <div class="alert alert-danger" role="alert">
    <ul>
    <li>{{$error}}</li>
    </ul>
    </div>
    @endforeach
    @endif
    <div>
        <label for="sku">sku:</label>
        <input type="text" id="sku" name="sku" required>
    </div>

    <div>
        <label for="name">name:</label>
        <textarea id="name" name="name" required></textarea>
    </div>

    <div>
        <label for="price">price:</label>
        <textarea id="price" name="price" required></textarea>
    </div>

    <div>
        <label for="stock">stock:</label>
        <textarea id="stock" name="stock" required></textarea>
    </div>

    <div>
        <label for="status">status:</label>
        <textarea id="status" name="status" required></textarea>
    </div>
    <button type="submit">Submit</button>
</form>
<div>
