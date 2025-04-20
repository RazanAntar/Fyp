@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ url('/feedback') }}" method="POST">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">

    <label for="rating">Rating (1-5):</label>
    <select name="rating" required>
        <option value="5">⭐️⭐️⭐️⭐️⭐️</option>
        <option value="4">⭐️⭐️⭐️⭐️</option>
        <option value="3">⭐️⭐️⭐️</option>
        <option value="2">⭐️⭐️</option>
        <option value="1">⭐️</option>
    </select>

    <label for="comment">Feedback:</label>
    <textarea name="comment"></textarea>

    <button type="submit">Submit</button>
</form>
