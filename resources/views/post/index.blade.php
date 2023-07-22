@props(['posts' => []])
<x-layout.app>
    <h1>All Posts</h1>

    <a href="{{route("post.create")}}">Create new Post</a>
    <hr/>

    <x-post.collection :$posts/>
</x-layout.app>