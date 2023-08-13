@props(['posts' => []])
<x-layout.app>
    <h1>All Posts</h1>
    <hr/>
    <x-post.collection :$posts/>
</x-layout.app>