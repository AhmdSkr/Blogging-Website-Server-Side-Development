@props(['post'])

<form action="{{route('post.destroy',['post' => $post->id])}}" method="POST" {{$attributes}}>
    @csrf
    @method('DELETE')
    <input type="submit" value="Delete Post" class="btn btn-error w-full"/>
</form>