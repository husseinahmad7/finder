@extends('layouts.app')
@section('title')
{{$order->title}}
@endsection
@section('head')
<link rel="stylesheet" href="{{url('css/rate.css')}}">
@endsection
@section('content')
<div class="card border-secondary text-center">
    <div class="card-header">
      {{$order->title}}
    </div>
    <div class="card-body">

    <img src="{{$order->picture ? asset('storage/' . $order->picture) : asset('/images/no-image.png')}}" class="card-img-top vh-100" alt="{{$order->title}}">
      <p class="card-text text-start">{{$order->description}}</p>
      <hr>
      <p class="card-text text-start">{{$order->address}}</p>
      <hr>
      <p class="card-text text-start">{{$order->contact}}</p>
      <a class="btn border float-sm-start" href="{{route('ordersByUser',['user'=>$order->user_id])}}">{{$order->user->name}}</a>
        <div class="hstack">
            <x-order-tags :tagsCsv="$order->tags" />
        </div>
        <span class="badge text-bg-info rounded-pill">Rating: {{round($avg,3)}}</span>
    </div>
    <div class="card-footer text-muted text-center">
        <div class="hstack">
            <span class="mx-2">{{$order->created_at}}</span>
            @if (auth()->user()->id == $order->user_id)
                <a href="{{route('orders.edit',['order'=>$order->id])}}" class="btn btn-primary btn-sm mx-1">Edit</a>
            <form method="POST" action="{{route('orders.destroy',['order'=>$order->id])}}">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm mx-1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                </svg> Delete</button>
            </form>
            @endif
        </div>
    </div>
  </div>


  <form method="POST" action="{{route('orders.comments.store',['order'=>$order->id])}}">
    @csrf
    @method('POST')
    <div class="vstack text-bg-secondary p-3">
        <div class="mb-1 mt-3">
            <div class="rate action hstack">
                <span class="text-dark m-sm-2">Rate: </span>
                <input type="radio" id="star5" name="rate" value="5" />
                <label for="star5" title="text"></label>
                <input type="radio" id="star4" name="rate" value="4" />
                <label for="star4" title="text"></label>
                <input type="radio" id="star3" name="rate" value="3" />
                <label for="star3" title="text"></label>
                <input type="radio" id="star2" name="rate" value="2" />
                <label for="star2" title="text"></label>
                <input type="radio" id="star1" name="rate" value="1" />
                <label for="star1" title="text"></label>
            </div>
        </div>
        <div class="mb-3">
            <label for="FormControlTextarea" class="form-label">Comment</label>
            <textarea name="text" class="form-control" id="exampleFormControlTextarea" rows="3"></textarea>
        </div>
          <button type="submit" class="btn btn-primary">Add</button>
    </div>

  </form>
@unless (count($order->comments) == 0)
    @foreach ($order->comments as $comment)
    <x-comment-card :comment="$comment"/>
    @endforeach

@else
    <p class="alert alert-light">No Reviews yet...</p>
@endunless

@endsection
