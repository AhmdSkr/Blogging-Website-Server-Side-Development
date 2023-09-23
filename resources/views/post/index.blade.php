@props(['posts' => []])
<x-layout.app>
    <a href="{{route('post.personal.create')}}" class="floating-action-button">Write what is on your mind!</a>
    <h1 class="grow">Global Collection</h1>
    <hr/>
    <x-post.collection :$posts/>
</x-layout.app>