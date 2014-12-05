@extends('layout')

@section('content')
    <div class="container container-fluid">
        @foreach($tags as $tag)
            <p> {{ $tag->name }} </p>
        @endforeach
    </div>
@stop