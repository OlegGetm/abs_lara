@foreach ($pictures as $picture)
    <figure class="full-width">
        <img src="/pictures/article/big/{{ $picture->src }}" alt="{{ $picture->caption }}">
    @if (!empty($picture->caption))
        <figcaption>{{ $picture->caption }}</figcaption>
    @endif
    </figure>
@endforeach
