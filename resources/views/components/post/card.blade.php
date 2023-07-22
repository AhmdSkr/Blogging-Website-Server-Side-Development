@props(['post'])

<div>
    <img src="{{$post->image_url}}"/>
    <a href="{{route("post.show", [ 'post' => $post->id])}}"><h3>{{$post->title}}</h3></a>
    <p>{{$post->excerpt}}</p>
    <a href="{{route('post.show',['post' => $post->id])}}">view post</a>
</div>