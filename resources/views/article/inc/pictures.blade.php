@if (isset($pictures[$k][1]) && $pictures[$k][1]->layout == 1)
    @foreach ($pictures[$k] as $picture)
        <figure class="full-width">
            <img src="/pictures/article/big/{{ $picture->src }}" alt="{{ $picture->caption }}">
        @if (!empty($picture->caption))
            <figcaption>{{ $picture->caption }}</figcaption>
        @endif
        </figure>
    @endforeach
@endif