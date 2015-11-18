@if (isset($pictures[$k][1]) && $pictures[$k][1]->layout > 1)
    <?php $picture = $pictures[$k][1] ?>
    <figure class="{{ $picture->layout == 2 ? 'float-left' : 'float-right' }}">
        <img src="/pictures/article/big/{{ $picture->src }}" alt="{{ $picture->caption }}">
        @if (!empty($picture->caption))
            <figcaption>{{ $picture->caption }}</figcaption>
        @endif
    </figure>
@endif