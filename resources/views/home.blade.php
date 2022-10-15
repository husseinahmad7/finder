@extends('layouts.app')
@section('title')
    Finder
@endsection

@section('content')
<div class="container">
    @auth
    <a class="btn btn-outline-primary mb-1" href="{{route('orders.create')}}">Post an Order</a>
    @endauth
    <div class="hstack gap-3">
        <span class="p-3 bg-info bg-opacity-10 border border-info border-start-0 rounded-pill">available: {{$available}}</span>
        <div class="vr"></div>
        <span class="p-3 bg-info bg-opacity-10 border border-info border-start-0 rounded-end">unavailable: {{$unavailable}}</span>
        <div class="vr"></div>
        @foreach ($popular as $p)
            <x-order-tags :tagsCsv="$p" />
        @endforeach
    </div>
<form action="{{route('orders.index')}}">
    <div class="row border-2 m-4 rounded-lg align-items-center">
        <div class="col-sm-6">
            <input type="text" name="search" class="form-control h-14 pl-10 pr-20 rounded-lg z-0 shadow-sm"
        placeholder="Search Anything..." value="{{request()->input('search')}}"/>
        </div>
      <div class="col-sm">
        <button type="submit" class="btn btn-primary btn-sm text-white rounded">
          Search
        </button>
      </div>
    </div>
  </form>
    <div class="container">

        @unless(count($orders) == 0)
        <div class="d-flex flex-wrap justify-content-center gap-1">
        @foreach($orders as $order)
        <x-order-card :order="$order" :loop="$loop" />
        @endforeach
        </div>
        @else
        <p class="alert alert-info">No orders yet</p>
        @endunless

      </div>
      <div class="mt-6 p-4">
        {{$orders->links()}}
      </div>
</div>
@endsection
