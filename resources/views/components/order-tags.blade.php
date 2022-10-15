@props(['tagsCsv'])

@php
$tags = explode(',', $tagsCsv);
@endphp

  @foreach($tags as $tag)
  <span class="rounded-xl py-1 px-1 mr-1 text-xs">
    <a class="btn btn-secondary btn-sm" href="{{route('orders.index')}}/?tag={{trim($tag)}}">{{$tag}}</a>
  </span>
  @endforeach
