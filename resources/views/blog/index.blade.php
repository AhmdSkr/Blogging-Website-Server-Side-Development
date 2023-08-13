<x-layout.app>
    <h1>All Blogs</h1>
    <a href="{{route('blog.create')}}">Create a blog</a>
    <br/><hr/>

    @foreach($blogs as $blog)
    <x-blog.card :blog="$blog"/>
    <hr/>
    @endforeach
</x-layout.app>