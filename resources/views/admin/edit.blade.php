<h1>Edit Product</h1>

<form method="POST" action="/products/{{ $product->id }}">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ $product->name }}"><br><br>
    <input type="text" name="category" value="{{ $product->category }}"><br><br>
    <input type="number" name="price" value="{{ $product->price }}"><br><br>
    <input type="text" name="condition" value="{{ $product->condition }}"><br><br>
    <textarea name="description">{{ $product->description }}</textarea><br><br>

    <button type="submit">Update Product</button>
</form>

<br>
<a href="/products">Back</a>