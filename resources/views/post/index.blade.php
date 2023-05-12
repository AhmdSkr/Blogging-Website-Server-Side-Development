@props(['posts' => []])
<x-layout.app>
    <h1>All Posts</h1>
    <a href="{{route('post.create')}}">create new post</a>
    <x-post.collection :$posts/>
</x-layout.app>