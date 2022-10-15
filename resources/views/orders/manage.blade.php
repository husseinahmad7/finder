@extends('layouts.app')
@section('title')
    Manage orders
@endsection

@section('content')
<div class="container">
    <h6>welcome {{auth()->user()->name}}</h6>
    @auth
    <a href="{{route('orders.create')}}">Post an Order</a>
    @endauth
<form action="{{route('orders.manage')}}">
    <div class="row border-2 m-4 rounded-lg align-items-sm-center">
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
        <x-order-manage-card :order="$order" />
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
