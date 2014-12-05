@extends('layout')

@section('content')
    <div class="container container-fluid">
        <section>
            <h1><p> {{ $post->title }} </p></h1>
            <div class="well">
                <p> {{ $post->content }} </p>
            </div>
        </section>

        <section id="addComment" class="hidden">
            {{ Form::open(array('route'=>'addComment')) }}
            {{ Form::text('username')}}
            {{ Form::text('content') }}
            {{ Form::submit('Search Tags', array('class' => 'btn btn-default')) }}
            {{ Form::close() }}
        </section>

        <section>
            @if(count($comments) === 0)
                There aren't any comments!
            @else
                @foreach($comments as $comment)
                    <p>
                        {{ $post->username }}
                    </p><p>
                        {{ $post->content }}
                    </p>
                @endforeach
            @endif
        </section>

    </div>

@stop