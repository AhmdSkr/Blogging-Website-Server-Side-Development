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
    
    <h2><u>Create your own blog:</u></h2>
    <form action="{{route('blog.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <span><b>Blog Name:</b> </span><input name="name" type="text" value="{{old('name')}}"/><br/>
        <h3><b>Brief Description:</b> </h3><textarea name="description">{{old('description')}}</textarea><br/>
        <h3>Cover Image</h3><input name="image" type="file"/><br/>
        <hr/>
        <input type="submit" />
    </form>
</x-layout.app>
