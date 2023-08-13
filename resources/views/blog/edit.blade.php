<x-layout.app>
    @if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
        <li>
            {{$error}}
        </li>
        @endforeach
    </ul>
    <hr/>
    @endif
    <hr/>
    
    @if($blog->image_url !== null)
    <form action="{{route("blog.uncover", ['blog' => $blog->id])}}" method="POST">
        @csrf
        @method("DELETE")

        <img src="{{$blog->image_url}}"/><br/>
        
        <input type="submit" value="Remove Cover Image"/>

    </form>
    @endif

    <hr/>
    <form action="{{route('blog.update', ['blog' => $blog->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <span><b>Blog Name:</b> </span><input name="name" type="text" value="{{ old('name') ?? $blog->name}}"/><br/>
        <h3><b>Brief Description:</b> </h3><textarea name="description">  {{old('description') ?? $blog->description}}  </textarea><br/>
        <h3>Cover Image</h3><input name="image" type="file"/><br/>
        <hr/>
        <input type="submit" />
    </form>
</x-layout.app>
