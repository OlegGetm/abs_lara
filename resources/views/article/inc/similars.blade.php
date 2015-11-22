@if (count($similars) > 0)
<div class="line_1"></div>
<div class="row similar-list">
    <ul>
        <h3 class="rubric">А вы читали?</h3>
        @foreach($similars as $item)
            <li>
                <div class="col-md-3 col-xs-6 similar-item">
                    <a href="/article/{{ $item->slug }}">
                        <img src="{{ $item->thumbMidi }}">
                        <h4>{{ $item->title }}</h4>
                    </a>
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endif