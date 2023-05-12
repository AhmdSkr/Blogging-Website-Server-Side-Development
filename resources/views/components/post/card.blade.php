@props(['post'])

<div>
    <img src="{{$post->image_url}}"/>
    <h3>{{$post->title}}</h3>
    <p>{{$post->excerpt}}</p>
    <a href="{{route('post.show',['post' => $post->id])}}">view post</a>
</div>