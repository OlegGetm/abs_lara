<li class="row">
    <div class="col-md-3 col-xs-4 pad-left-null">
        <a href="/article/{{ $article->slug }}">
             <img src="{{ $article->thumbMidi }}">
        </a>
    </div>
    <div class="col-md-8 col-xs-8 title">
        <h4>{{ $article->category->parent->name }} / {{$article->category->name }}</h4>
        <h2>
             <a href="/article/{{ $article->slug }}">{{ $article->title }}</a>
        </h2>
    </div>
</li>