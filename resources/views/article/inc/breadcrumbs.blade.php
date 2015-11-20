@section('breadcrumbs')
    <ul class="breadcrumb"><li><a href="/">Главная</a></li>
        <li class="active">{{ $article->category->parent->name }}</li>
        <li>
            <a href="/list/category/{{ $article->category->slug }}">{{ $article->category->name }}</a>
        </li>
    </ul>
@endsection