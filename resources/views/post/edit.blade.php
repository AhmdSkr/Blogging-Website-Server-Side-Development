<x-layout.app>
    <x-post.delete :$post/>
    <hr/>
    <form action="{{route('post.update', ['post' => $post->id])}}" method="POST">
        @csrf
        @method('PATCH')
        <span><b>Title:</b> </span><input name="title" type="text" value="{{$post->title}}"/><br/>
        <h3><b>Excerpt:</b> </h3><textarea name="excerpt">  {{$post->excerpt}}  </textarea><br/>
        <h3>Post Content</h3><textarea name="body">         {{$post->body}}     </textarea><br/>
        <h3>Cover Image</h3><input name="image" type="file"/><br/>
        <hr/>
        <input type="submit" />
    </form>
</x-layout.app>
