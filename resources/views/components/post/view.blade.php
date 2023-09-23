@props(['post'])

<div class="document">
    @if($post->image_url !== null)
    {{-- Cover Image --}}<img src="{{$post->image_url}}" class="w-full"/>
    @endif
    {{-- Title --}}<h1>{{$post->title}}</h1>
    {{-- Creation & Modification Instants --}}
    <div class="flex">
        <div class="basis-full">
            <h3>Created At</h3><p class="text-center">{{$post->created_at}}</p>
        </div>
        <div class="basis-full">
            <h3>Updated At</h3><p class="text-center">{{$post->updated_at}}</p>
        </div>
    </div>
    {{-- Minutes to Read --}}<p class="bg-transparent text-center text-lg border-b-4"><b>Minutes to Read:</b> {{$post->minutes_to_read}}</p>
    @if(isset($post->excerpt) || $post->excerpt !== "")
    {{-- Excerpt --}}<h3>Excerpt</h3><p>{{$post->excerpt}}</p><hr/>
    @endif
    {{-- Post Content --}}<h3>Post Content</h3><pre class="preview"><?=$post->body ?></pre>
</div>