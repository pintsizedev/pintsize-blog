@extends('layout')

@section('content')
    <h1>Login</h1>

    <!-- Checks for login error var -->
    @if(Session::has('flash_error'))
        <div id="flash_error"> {{ Session::get('flash_error') }} </div>
    @endif

    {{ Form::open(array('route' => 'login')) }}

    <!-- Username field -->
    <p>
        {{ Form::label('username','username') }}
        {{ Form::text('username', Input::old('username')) }}
    </p>

    <!-- Password field -->
    <p>
        {{ Form::label('password','password') }}
        {{ Form::password('password') }}
    </p>

    <!-- Submit button -->
    <p>{{ Form::submit('Login') }}</p>

    {{ Form::close() }}


@stop