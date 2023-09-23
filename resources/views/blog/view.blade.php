<x-layout.app>
    {{-- <p style="color:red">{{session('image_upload_status')}}</p> --}}

    {{-- Edit and Delete Buttons --}}
    <div class="floating-action-button-group">
        {{-- Create Post button --}}<a href="{{route('post.create', ['blog' => $blog->id])}}" class="btn btn-info">Create a new post</a>
        {{-- Edit Blog button --}}<a href="{{route('blog.edit', ['blog' => $blog->id])}}" class="btn btn-warning">Edit Blog</a>
        {{-- Delete Blog button --}}
        <form action="{{route("blog.destroy", ['blog' => $blog->id])}}" method="POST" class="w-full">
            @csrf
            @method('DELETE')
            <input type="submit" value="delete blog" class="btn btn-error w-full"/>
        </form>
    </div>
    {{-- Main Blog View --}}
    <div class="document">
        @if($blog->image_url !== null)
        {{-- Cover Image --}}<img src="{{$blog->image_url}}"/>
        @endif
        {{-- Name --}}<h1>{{$blog->name}}</h1>
        {{-- Creation & Modification Instants --}}
        <div class="flex justify-evenly">
            <p class="w-full text-center"><b>Created At: </b>{{$blog->created_at}}</p>
            <p class="w-full text-center"><b>Updated At: </b>{{$blog->updated_at}}</p>
        </div>
        {{-- Description --}}<h3>Description</h3><p>{{$blog->description}}</p>
    </div>
    {{-- Post Collection --}}<h3>This blog's posts</h3><x-post.collection :posts="$blog->posts"/>
</x-layout.app>