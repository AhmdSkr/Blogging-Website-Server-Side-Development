<x-layout.app>
    
    <p style="color:red">{{session('image_upload_status')}}</p>

    @if($blog->image_url !== null)
    <img src="{{$blog->image_url}}"/>
    <form action="{{route('blog.uncover', ['blog' => $blog->id])}}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="Remove Cover Image"/>
    </form>
    @endif
    <hr/>
    <a href="{{route('blog.edit', ['blog' => $blog->id])}}">edit blog</a>
    <h1>{{$blog->name}}</h1>
    <h3>Description</h3>
    <p>{{$blog->description}}</p>
    <hr/>
    <h2>This blog's posts</h2>
    <a href="{{route('post.create', ['blog' => $blog->id])}}">Create a new post</a>
    <hr/>
    <x-post.collection :posts="$blog->posts"/>
    
    <p><b>Created At:</b>{{$blog->created_at}}</p>
    <p><b>Updated At:</b>{{$blog->updated_at}}</p>
    
    <form action="{{route("blog.destroy", ['blog' => $blog->id])}}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="delete blog"/>
    </form>
</x-layout.app>