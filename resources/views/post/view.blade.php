<x-layout.app>
    
    {{-- Target View --}}
    @if(isset($post->target))
    <div class="max-w-screen-lg m-auto">
        <h1>Reviewing:</h1>
        <x-post.card :post="$post->target"/>
    </div>
    @endif

    <div>
        {{-- Edit and Delete Buttons --}}
        <div class="floating-action-button-group">
            <a href="{{route('post.personal.create', ['target' => $post->id])}}" class="btn btn-info">Review Post</a>
            <a href="{{route('post.edit', ['post' => $post->id])}}" class="btn btn-warning">Edit Post</a>
            <x-post.form.delete :post="$post"/>
        </div>

        {{-- Main Post View --}}
        <x-post.view :post="$post"/>
        
        {{-- Reviews View --}}
        <h3>Reviews</h3>
        <x-post.collection :posts="$post->reviews"/>
    </div>
</x-layout.app>