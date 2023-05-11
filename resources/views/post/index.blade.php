@props(['posts' => []])
<x-layout.app>
    <h1>All Posts</h1>
    <x-post.collection :$posts/>
</x-layout.app>