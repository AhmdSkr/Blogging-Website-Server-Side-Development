<x-layout.app>
    {{-- Validation --}}
    <x-post.validation :errors class="border-b-4"/>

    <div class="form-main-portal">
        @if($blog->image_url !== null)
        <form action="{{route("blog.uncover", ['blog' => $blog->id])}}" method="POST">
            @csrf
            @method("DELETE")
            <img src="{{$blog->image_url}}"/>
            <input type="submit" value="Remove Cover Image" class="uncover-btn"/>
        </form>
        @endif
        <form action="{{route('blog.update', ['blog' => $blog->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            {{-- Name & Cover --}}
            <div class="form-meta-input">
                <h3 class="meta-input-label">Blog name</h3><textarea name="name" class="title-input" maxlength="64" required>{{ old('name') ?? $blog->name}}</textarea>
                <h3 class="meta-input-label">Cover Image</h3><input name="image" type="file" class="image-input"/>
            </div>
            <h3>Brief Description:</h3><textarea name="description" class="max-h-52">{{old('description') ?? $blog->description}}</textarea><br/>
            <input type="submit" class="floating-action-button"/>
        </form>
    </div>
</x-layout.app>
