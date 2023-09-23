@php
    $route = null;
    if(isset($blog->id))
    {
        $route = route('post.store', ['blog' => $blog->id]);
    }
    else
    {
        $route = route('post.personal.store');
    }
@endphp

<x-layout.app>
    <x-slot:head>
        <x-head.tinymce-config/>
    </x-slot>
    <h1 class="form-header">Create you own Post</h1>
    
    {{-- Validation --}}
    <x-post.validation :errors class="border-b-4"/>

    {{-- Review Here --}}
    @if(isset($target))
    <div class="flex">
        <div class="form-review-portal">
            <h1>Reviewing Post:</h1>
            <x-post.view :post="$target"/>
        </div>
    @endif



    <div class="form-main-portal">
        <form action="{{$route}}" method="POST" enctype="multipart/form-data">
            @csrf
            
            {{-- target specifier --}}
            @if(isset($target))
                <input name="target_id" type="hidden" value="{{$target->id}}"/>
            @endif

            {{-- main input --}}
            <div class="min-h-screen">

                {{-- Title & Cover --}}
                <div class="form-meta-input">
                    {{-- Title input --}}<h3 class="meta-input-label">Title</h3><textarea class="title-input" name="title" maxlength="64" required>{{old('title')}}</textarea>
                    {{-- Cover Image input --}}<h3 class="meta-input-label">Cover Image</h3><input class="image-input" name="image" type="file"/>
                </div>

                {{-- Excerpt & Body --}}
                <div class="form-main-input">
                    <a href="{{route('post.index')}}" class="btn btn-error">Discard</a>
                    <input type="submit" class="btn btn-success"/>
                    
                    <h3>Excerpt</h3>
                    <textarea name="excerpt" class="max-h-72" maxlength="256">{{old('excerpt')}}</textarea><br/>
                    
                    <h3>Post Content</h3>
                    <textarea name="body" class="h-96" id="tinyeditor">{{old('body')}}</textarea>
                </div>

            </div> 
        </form>
    </div>
    
    @if(isset($target))
    </div>
    @endif
</x-layout.app>
