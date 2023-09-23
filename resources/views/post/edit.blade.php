<x-layout.app>
    {{-- TinyMCE RichText Editor configuration --}}
    <x-slot:head>
        <x-head.tinymce-config/>
    </x-slot>

    {{-- Validation --}}
    <x-post.validation :errors class="border-b-4"/>
    
    {{-- Review Here --}}
    @if(isset($target))
    <div class="flex ">
        <div class="form-review-portal">
            <h1>Reviewing Post:</h1><x-post.view :post="$target"/>
        </div>
    @endif

    <div class="form-main-portal">
        {{-- Uncover Form --}}
        @if($post->image_url !== null)
        <form action="{{route("post.uncover", ['post' => $post->id])}}" method="POST"> @csrf @method("DELETE")
            <img src="{{$post->image_url}}"/>
            <input type="submit" value="Remove Cover Image" class="btn btn-square btn-error btn-block rounded-none"/>
        </form>
        @endif

        {{-- Editing Form --}}
        <form action="{{route('post.update', ['post' => $post->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            {{-- Title & Cover --}}
            <div class="form-meta-input">
                <h3 class="meta-input-label">Title</h3><textarea name="title" class="title-input" maxlength="64" required>{{ old('title') ?? $post->title}}</textarea>
                <h3 class="meta-input-label">Cover Image</h3><input name="image" type="file" class="image-input"/>
            </div>
            {{-- Excerpt & Body --}}
            <div class="form-main-input">
                {{-- Discard button --}}<a href="{{route('post.index')}}" class="btn btn-error">Discard</a>
                {{-- Submit button --}}<input type="submit" class="btn btn-success"/>
                {{-- Excerpt --}}<h3>Excerpt</h3><textarea name="excerpt" class="max-h-72" maxlength="256">{{old('excerpt') ?? $post->excerpt}}</textarea><br/>
                {{-- Post Content --}}<h3>Post Content</h3><textarea name="body" class="h-96" id="tinyeditor"> {{old('body') ?? $post->body}}</textarea>
            </div>
        </form>
    </div>

</x-layout.app>
