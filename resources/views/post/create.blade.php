@php
    $route = null;
    if(isset($blog->id))
    {
        $route = route('post.store', ['blog' => $blog->id]);
    }
    else
    {
        $route = route('post.personal.store');
    }
@endphp

<x-layout.app>
    @if(isset($target->id))<x-post.card :post="$target"/>@endif
    
    <x-post.validation :errors/>

    <h2><u>Create your own post:</u></h2>
    <form action="{{$route}}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($target))<input name="target_id" type="hidden" value="{{$target->id}}"/>@endif
        <span><b>Title:</b> </span><input name="title" type="text" value="{{old('title')}}"/><br/>
        <h3><b>Excerpt:</b> </h3><textarea name="excerpt">{{old('excerpt')}}</textarea><br/>
        <h3>Post Content</h3><textarea name="body">{{old('body')}}</textarea><br/>
        <h3>Cover Image</h3><input name="image" type="file"/><br/>
        <hr/>
        <input type="submit" />
    </form>
</x-layout.app>
