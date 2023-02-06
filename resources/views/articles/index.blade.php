@extends("layouts/app")

@section("content")
    <div class="container">
        {{ $articles->links()}}

        @if(session("info"))
            <div class="alert alert-warning">
                {{session("info")}}
            </div>
        @endif

        @foreach($articles as $article)
            <div class="card mb-2">
                <div class="card-body">
                    <h3 class="card-title">{{$article->title}}</h3>
                    <div>
                        <small class="text-success">
                            {{ $article->user->name }},
                        </small>
                        <small class="text-muted">
                            Comments: <b>{{ count($article->comments) }}</b>
                            Category: <b>{{ $article->category->name }}</b>
                            {{ $article->created_at }}
                        </small>
                    </div>
                    <div>{{ $article->body }}</div>
                    <div class="mt-2">
                        <a href="{{ url("/articles/detail/$article->id") }}" class="card-link">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection