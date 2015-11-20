@if (count($tags) > 0)
    <div class="row tags-items">
        <div class="col-md-1 col-xs-2">
            <div class="glyphicon glyphicon-tags tags-icon"></div>
        </div>
        <div class="col-md-11 col-xs-10">
            @foreach ($tags as $tag)
                <a href="/list/tag/{{ $tag->slug }}" class="<?= $tag->type == 2 ? 'brand' : '' ?>">{{ $tag->name }}</a>
            @endforeach
        </div>
    </div>
@endif