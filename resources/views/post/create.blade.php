<x-layout.app>
    <form action="{{route('post.store')}}" method="POST">
        @csrf
        <span><b>Title:</b> </span><input name="title" type="text" /><br/>
        <h3><b>Excerpt:</b> </h3><textarea name="excerpt"></textarea><br/>
        <h3>Post Content</h3><textarea name="body"></textarea><br/>
        <h3>Cover Image</h3><input name="image" type="file"/><br/>
        <input type="submit" />
    </form>
</x-layout.app>
