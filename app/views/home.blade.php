@extends('layout')

@section('content')
    <div class="container container-fluid">
        <section>
            @foreach($posts as $post)
                <article>
                    <h3><a href="view/{{ $post->permalink }}"> {{ $post->title }} </a><small> - {{ $post->created_at->format('jS F Y \a\t H:i') }}</small></h3>
                    <div class="well">
                        <section>
                            <p>
                                <?php $words = preg_replace('/\s+?(\S+)?$/', '',substr($post->content, 0, 250));?>
                                {{ $words }}...
                            </p>
                        </section>
                    <a href="{{ URL::to('/') }}/view/{{ $post->permalink }}">Read more</a>
                    </div>
                </article>
            @endforeach
        </section>
        <nav>
            @if(!isset($hasSearched))
                {{ $posts->links() }}
            @endif
        </nav>
    </div>
@stop