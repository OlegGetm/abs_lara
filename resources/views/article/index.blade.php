@extends('layouts.pagemasters.common')

@section('title',  $articles->first()->category->name)

@section('content')
    <div class="col-sm-12 article-content">
        <section id="breadcrumbs-list"></section>

        <section id="article-list">
        @if (count($articles) > 0)
            <ul class="article-list">
            @foreach ($articles as $article)
                @include ('article.inc.list_item', ['article' => $article])
            @endforeach
        @endif
        </section>
    </div>
@endsection

@section('sidebar')
    @include('layouts.sidebars.slim')
@endsection