<div class="product-card">
    <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->
    <img src="{{ asset('storage/images/' . $image) }}" alt="{{ $name }}">
    <div class="product-card__details">
        <h3>{{ $name }}</h3>
        <p>¥{{ $price }}</p>
    </div>
</div>