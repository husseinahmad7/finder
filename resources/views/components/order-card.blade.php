@props(['order','loop'])

<div class="card shadow @if ($loop->even)
bg-black bg-opacity-10
@else
bg-light
@endif" style="width: 20rem;">
    <div class="card-body" style="transform: rotate(0)">
        <img src="{{$order->picture ? asset('storage/' . $order->picture) : asset('/images/no-image.png')}}" class="card-img-top h-50" alt="{{$order->title}}">

        <a class="stretched-link" href="{{route('orders.show',['order'=>$order->id])}}">
        <h5 class="card-title">{{$order->title}}</h5>
        </a>
        <p class="card-text">{{Str::words($order->description, 20)}}</p>
        <small>{{$order->updated_at}}</small>
    </div>
    <div class="card-footer">
        <div class="hstack">
            <small><a href="{{route('ordersByUser',['user'=>$order->user_id])}}" class="text-dark btn btn-sm border mx-2">{{$order->user->name}}</a></small>
                <x-order-tags :tagsCsv="$order->tags" />
        </div>
    </div>
</div>
