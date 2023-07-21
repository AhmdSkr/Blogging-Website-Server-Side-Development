<x-layout.app>
    @if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
        <li>
            {{$error}}
        </li>
        @endforeach
    </ul>
    <hr/>
    @endif
    <hr/>
    <form action="{{route("post.show", ['post' => $post->id])}}" method="GET">
        <img src="{{$post->image_url}}"/><br/>
        <input type="submit" value="Remove Cover Image"/>
    </form>
    <hr/>
    <form action="{{route('post.update', ['post' => $post->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <span><b>Title:</b> </span><input name="title" type="text" value="{{ old('title') ?? $post->title}}"/><br/>
        <h3><b>Excerpt:</b> </h3><textarea name="excerpt">  {{old('excerpt') ?? $post->excerpt}}  </textarea><br/>
        <h3>Post Content</h3><textarea name="body">         {{old('body') ?? $post->body}}     </textarea><br/>
        <h3>Cover Image</h3><input name="image" type="file"/><br/>
        <hr/>
        <input type="submit" />
    </form>
</x-layout.app>