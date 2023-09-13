@props(['post'])

@if($post->image_url !== null)
<img src="{{$post->image_url}}" height="200px"/>
@endif

<h1>{{$post->title}}</h1>
<a href="{{route('post.edit', ['post' => $post->id])}}">edit post</a>
<p><b>Minutes to Read:</b> {{$post->minutes_to_read}}</p>
<p><b>Excerpt:</b> {{$post->excerpt}}</p>
<hr/>
<h3>Post Content</h3>
<p>{{$post->body}}</p>
<hr/>
<p><b>Created At:</b> {{$post->created_at}}</p>
<p><b>Updated At:</b> {{$post->updated_at}}</p>