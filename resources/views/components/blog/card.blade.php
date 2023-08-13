@props([ 'blog'])

<div>
@if($blog->image_url !== null)
<img src="{{$blog->image_url}}"/>
@endif
<a href="{{route('blog.show', ['blog' => $blog->id])}}"><h3>{{$blog->name}}</h3></a>
<p>{{$blog->description}}</p>
</div>
