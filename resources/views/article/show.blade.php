@extends('layouts.pagemasters.common')


@section('title',  $article->title)
@include ('article.inc.breadcrumbs', ['article' => $article])


@section('content')
    <article class="article">

        <h1>{{ $article->title }}</h1>
        @include ('article.inc.picture_main', ['picture'=> $article->image_src])

        @foreach (explode("\n", $article->content) as $k => $par)
            @include ('article.inc.picture_float', ['pictures' => $pictures, 'k' => $k])

            <?= preg_match('/^(<h|<table|<div|<ul)/i', ltrim($par)) ? $par : "<p>$par</p>" ?>
            @include ('article.inc.pictures', ['pictures' => $pictures, 'k' => $k])
        @endforeach
        
        @include ('article.inc.authors', ['authors' => $article->authors])
        @include ('article.inc.tags', ['tags' => $article->tags])
    </article>
    @include ('article.inc.similars', ['similars' => $article->similars(8)])
@endsection



@section('sidebar')
    @include('layouts.sidebars.slim')
@endsection




