<x-layout.app>
    @if($errors->any())
    <h3>You have entered invalid data</h3>    
    <ul>
    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
    </ul>
    <hr/>
    @endif
    <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <span><b>Title:</b> </span><input name="title" type="text"/><br/>
        <h3><b>Excerpt:</b> </h3><textarea name="excerpt"></textarea><br/>
        <h3>Post Content</h3><textarea name="body"></textarea><br/>
        <h3>Cover Image</h3><input name="image" type="file"/><br/>
        <hr/>
        <input type="submit" />
    </form>
</x-layout.app>
