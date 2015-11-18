@extends('layouts.master')

@section('pagemaster')
    <div class="container padding-null">
        <div class="col-sm-9 article-content padding-null">
            @include('layouts.partials.breadcrumbs')
            @yield('content')
        </div>
        <div class="col-sm-3">
            @yield('sidebar')
        </div>
    </div>
@endsection