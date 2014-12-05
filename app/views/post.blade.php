@extends('layout')

@section('content')
    <h1> Post </h1>

    <!-- Checks for posting error -->
    @if(Session::has('flash_error'))
        <div id="flash_error"> {{ Session::get('flash_error') }} </div>
    @endif

    <!-- Start post form -->
    {{ Form::open(array('route' => 'post')) }}

    <!-- Title field -->
    <p>
        {{ Form::label('title','Title') }}
        {{ Form::text('title') }}
    </p>

    <!-- Content -->
    <p>
        {{ Form::label('content', 'Content') }}
        {{ Form::textarea('content') }}
    </p>

    <!-- Tags (comma separated) -->
    <p>
        {{ Form::label('tags', 'Tags') }}
        {{ Form::text('tags') }}
    </p>

    <!-- Permalink -->
    <p>
        {{ Form::label('permalink', 'Permalink') }}
        {{ Form::text('permalink') }}
    </p>

    <!-- Submit button -->
    {{ Form::submit('Submit') }}

    {{ Form::close() }}

@stop