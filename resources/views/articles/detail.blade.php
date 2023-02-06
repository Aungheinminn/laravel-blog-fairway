@extends("layouts/app")

@section("content")
    <div class="container">

        @if($errors->any())
            <div class="alert alert-warning">
                @foreach($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif


        @if(session("info"))
            <div class="alert alert-warning">
                {{session("info")}}
            </div>
        @endif
        
            <div class="card mb-2 border-primary">
                <div class="card-body">
                    <h3 class="card-title">{{$article->title}}</h3>
                    <div>
                        <small class="text-muted">
                            {{ $article->created_at }}
                        </small>
                    </div>
                    <div>{{ $article->body }}</div>
                    @auth
                        @can('delete-article',$article)
                            <div class="mt-2">
                                <a href="{{url("/articles/delete/$article->id")}}" class="btn btn-warning">Delete</a>
                            </div> 
                            <div class="mt-2">
                                <a href="{{ url("/articles/edit/$article->id") }}" class="btn btn-secondary">Edit</a>
                            </div>
                        @endcan
                    @endauth
                </div>
            </div>
            <ul class="list-group mb-2">
                <li class="list-group-item active">
                    Comments {{ count($article->comments) }}
                </li>
                @foreach($article->comments as $comment)
                    <li class="list-group-item">
                        @auth 
                            <b class="text-success">
                                {{ $comment->user->name }}
                            </b> -
                            @can('delete-comment',$comment)
                                  <a href="{{ url("/comments/delete/$comment->id") }}" class="btn-close float-end"></a>
                            @endcan
                        @endauth
                        {{ $comment->content }}
                    </li>
                @endforeach
            </ul>  
            @auth 
                <form action="{{ url("/comments/add") }}" method="post">
                    @csrf 
                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                    <textarea name="content" class="form-control mb-2"></textarea>
                    <button class="btn btn-secondary">Add Comment</button>
                </form>
            @endauth
    </div>
@endsection