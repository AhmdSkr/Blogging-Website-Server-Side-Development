<x-layout.app>
    <h1 class="form-header">Create you own Blog</h1>
    
    {{-- Validation --}}
    <x-post.validation :errors class="border-b-4"/>

    <div class="form-main-portal">
        <form action="{{route('blog.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- Name & Cover --}}
            <div class="form-meta-input">
                {{-- Name input --}}<h3 class="meta-input-label">Blog name</h3><textarea name="name" class="title-input" maxlength="64" required>{{old('name')}}</textarea>
                {{-- Cover Image input --}}<h3 class="meta-input-label">Cover Image</h3><input name="image" type="file" class="file-input block m-auto"/>
            </div>
            <h3>Brief Description:</h3><textarea name="description" class="max-h-52">{{old('description')}}</textarea><br/>
            <input type="submit" class="floating-action-button"/>
        </form>
    </div>
</x-layout.app>
