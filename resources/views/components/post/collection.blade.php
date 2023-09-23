@props(['posts' => []])

<div {{$attributes}}>
    {{-- Grid of Posts --}}
    @foreach($posts as $post)
        <x-post.card :$post class="collection-card"/>
    @endforeach
    <x-layout.navigation.pagination :collection="$posts"/>
</div>