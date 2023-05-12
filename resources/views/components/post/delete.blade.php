@props(['post'])
<form action="{{route('post.destroy',['post' => $post->id])}}" method="POST">
    @csrf
    @method('DELETE')
    <input type="submit" value="delete post"/>
</form>