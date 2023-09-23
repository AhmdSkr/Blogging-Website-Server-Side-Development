@props([ 'collection' => []])
{{-- Pagination links --}}
@if(method_exists($collection, 'links'))
<div class="flex items-center m-6">
    <div class="join m-auto">
        
        @if($collection->onFirstPage())
        <button class="join-item btn btn-disabled">«</button>
        @else
        <a href="{{$collection->previousPageUrl()}}" class="join-item btn">«</a>
        @endif

        <button class="join-item btn">Page {{$collection->currentPage()}}</button>

        @if($collection->lastPage() == $collection->currentPage())
        <button class="join-item btn btn-disabled">»</button>
        @else
        <a href="{{$collection->nextPageUrl()}}" class="join-item btn">»</a>
        @endif
    </div>
</div>
@endif