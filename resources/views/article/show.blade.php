@extends('layouts.pagemasters.common')

@section('title',  $article->title)

@section('content')
    @include ('article.inc.breadcrumbs', ['article' => $article])
    <article class="article">

        <h1>{{ $article->title }}</h1>
        @include ('article.inc.picture_main', ['picture'=> $article->image_src])

        @foreach (explode("\n", $article->content) as $k => $par)
            @if (isset($pictures[$k][1]) && $pictures[$k][1]->layout > 1)
                @include ('article.inc.picture_float', ['picture' => $pictures[$k][1]])
            @endif
            <?= preg_match('/^(<h|<table|<div|<ul|<div)/i', ltrim($par)) ? $par : "<p>$par</p>" ?>
            @if (isset($pictures[$k][1]) && $pictures[$k][1]->layout == 1)
                @include ('article.inc.pictures', ['pictures' => $pictures[$k]])
            @endif
        @endforeach
        
        @include ('article.inc.authors', ['authors' => $article->authors])
        @include ('article.inc.tags', ['tags' => $article->tags])
    </article>
    @include ('article.inc.similars', ['similars' => $article->similars(8)])
@endsection


@section('sidebar')
    @include('layouts.sidebars.slim')
@endsection




