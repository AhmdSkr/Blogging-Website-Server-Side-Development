<x-layout.app>
    @if(isset($post->target))
        <h1>Reviewing:</h1>
        <x-post.card :post="$post->target"/>
    @endif

    <x-post.delete :post="$post"/>
    <hr/>
    <x-post.view :post="$post"/>
    <hr/>
    
    <h2>Reviews</h2>
    <a href="{{route('post.personal.create', ['target' => $post->id])}}">Write a review</a>
    <x-post.collection :posts="$post->reviews"/>
</x-layout.app>