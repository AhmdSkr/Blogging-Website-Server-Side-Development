@props(['post' => null])

@php
    use App\Models\Post;

    $isUpdating = isset($post) && isset($post->id);
    $action = $isUpdating? route('post.update', ['post' => $post->id]) : route('post.store');
    
    $title = $isUpdating? $post->title : '';
    $excerpt = $isUpdating? $post->excerpt : '';
    $body = $isUpdating? $post->body : '';
@endphp

<x-layout.app>
    <form action="{{$action}}" method="POST">
        @csrf
        @if($isUpdating)
            @method('PATCH')
        @endif
        <span><b>Title:</b> </span><input name="title" type="text" value="{{$title}}"/><br/>
        <h3><b>Excerpt:</b> </h3><textarea name="excerpt">  {{$excerpt}}    </textarea><br/>
        <h3>Post Content</h3><textarea name="body">         {{$body}}       </textarea><br/>
        <h3>Cover Image</h3><input name="image" type="file"/><br/>
        <input type="submit" />
    </form>
</x-layout.app>
