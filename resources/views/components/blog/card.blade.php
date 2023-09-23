@props([ 'blog'])


<div {{$attributes->merge(['class' => "basic-card"])}}>
    @if(isset($blog->image_url))
    <img src="{{$blog->image_url}}" class="max-w-xs basis-3/12"/>
    @endif
    <div class="grow">
        <a href="{{route('blog.show', ['blog' => $blog->id])}}" class="blog-name-summary">{{$blog->name}}</a>
        <p class="blog-description-summary">{{$blog->description}}</p>
    </div>
</div>
