<x-layout.app>
    <h1>All Blogs</h1>
    <a href="{{route('blog.create')}}" class="floating-action-button">Create a new blog!</a>
    @foreach($blogs as $blog)
    <x-blog.card :blog="$blog" class="collection-card"/>
    @endforeach
    <x-layout.navigation.pagination :collection="$blogs"/>
</x-layout.app>