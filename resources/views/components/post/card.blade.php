@props(['post'])

<div {{$attributes->merge(["class" => "basic-card"])}}>
    @if(isset($post->image_url))
    <img src="{{$post->image_url}}" class="max-w-xs basis-3/12"/>
    @endif
    <div class="grow">
        <a href="{{route("post.show", [ 'post' => $post->id])}}" class="post-title-summary">{{$post->title}}</a>
        <p class="post-excerpt-summary">{{$post->excerpt}}</p>
    </div>
</div>