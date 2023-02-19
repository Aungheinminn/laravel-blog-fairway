@extends("layouts/app")
@section("content")
    <div class="container">

        @if($errors->any())
            <div class="alert alert-warning">
                @foreach($errors->all() as $err)
                    {{ $err }}
                @endforeach
            </div>
        @endif

        <form method="post">
            @csrf 
            <div class="mb-2">
                <label for="">Title</label>
                <input type="text" class="form-control" name="title" value="{{ $article->title }}">
            </div>
            <div class="mb-2">
                <label for="">Body</label>
                <textarea name="body" class="form-control">{{ $article->body }}</textarea>
            </div>
            <div class="mb-2">
                <label for="">Category</label>
                <select name="category_id" class="form-control">
                    @foreach($category as $cat)
                        <option value="{{ $cat->id }}"
                        @if($cat->id === $article->category_id)
                            selected
                        @endif>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary">ADD</button>
        </form>
    </div>
@endsection