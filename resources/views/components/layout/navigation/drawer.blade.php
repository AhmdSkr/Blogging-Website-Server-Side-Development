
{{-- Drawer main --}}
<div class="drawer">

    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    
    <div class="drawer-content">
    {{-- Page content HERE --}}{{$slot}}
    </div> 
  
    <div class="drawer-side">
      <label for="my-drawer" class="drawer-overlay"></label> 
      <ul class="menu p-4 w-80 min-h-full bg-base-200 text-base-content">
        <!-- Sidebar content here -->
        <p class="sidebar-header">Collections</p>
        <li><a href="{{route('blog.index')}}">Blog Index</a></li>
        <li><a href="{{route('post.index')}}">Post Index</a></li>
      </ul>
    </div>  
  </div>
    