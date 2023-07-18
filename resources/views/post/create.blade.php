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
    
    <h2><u>Create your own post:</u></h2>
    <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <span><b>Title:</b> </span><input name="title" type="text" value="{{old('title')}}"/><br/>
        <h3><b>Excerpt:</b> </h3><textarea name="excerpt">{{old('excerpt')}}</textarea><br/>
        <h3>Post Content</h3><textarea name="body">{{old('body')}}</textarea><br/>
        <h3>Cover Image</h3><input name="image" type="file"/><br/>
        <hr/>
        <input type="submit" />
    </form>
</x-layout.app>