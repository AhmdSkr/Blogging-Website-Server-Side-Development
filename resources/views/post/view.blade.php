<x-layout.app>
    <img src="{{$post->image_url}}"/>
    <h1>{{$post->title}}</h1>
    <p><b>Minutes to Read:</b> {{$post->minutes_to_read}}</p>
    <p><b>Excerpt:</b> {{$post->excerpt}}</p>
    <hr/>
    <h3>Post Content</h3>
    <p>{{$post->body}}</p>
    <hr/>
{{-- 
    <p>{{$post->author}}</p>
    <p>{{$post->rating}}</p>
    <ul>
        @foreach($post->reviews as $review)
        <li>
            <h5>    {{$review->writer}}     </h5>
            <p>     {{$review->comment}}    </p>
            <p>     {{$review->rating}}     </p>
        </li>
        @endforeach
    </ul>
 --}}
</x-layout.app>