@props(['posts' => []])

<div>
    @foreach($posts as $post)
        <x-post.card :$post/>
        <hr/>
    @endforeach
</div>