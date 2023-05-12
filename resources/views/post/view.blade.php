<x-layout.app>
    <img src="{{$post->image_url}}"/>
    <h1>{{$post->title}}</h1>
    <a href="{{route('post.edit', ['post' => $post->id])}}">edit post</a>
    <p><b>Minutes to Read:</b> {{$post->minutes_to_read}}</p>
    <p><b>Excerpt:</b> {{$post->excerpt}}</p>
    <hr/>
    <h3>Post Content</h3>
    <p>{{$post->body}}</p>
    <hr/>
</x-layout.app>