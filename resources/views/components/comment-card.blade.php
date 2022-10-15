@props(['comment'])

<div class="card mb-3 p-1 bg-light bg-opacity-10 border border-white-50 border-start-0 rounded-end">
    <div class="card-body">
      <p>{{$comment->text}}</p>

      <div class="d-flex justify-content-between">
        <div class="d-flex flex-row align-items-center">
          <a href="{{route('ordersByUser',['user'=>$comment->user_id])}}" class="border btn small mb-0 ms-2">{{$comment->user->name}}</a>
        </div>
        <div class="d-flex flex-row align-items-center">
            <div class="rate hstack">
                @for ($i = $comment->rate; $i >= 1; $i--)
                <input type="checkbox" id="star{{$i}}" name="comment{{$comment->id}}" checked disabled />
                <label for="star{{$i}}" title="text"></label>
                @endfor
            </div>
        </div>
        <div class="d-flex flex-row align-items-baseline">
          <p class="text-sm mx-2">{{$comment->created_at}}</p>
          @if (auth()->user()->id == $comment->user_id)
            <form method="POST" action="{{route('orders.comments.destroy',['order' => $comment->order_id ,'comment' => $comment->id ])}}">
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
</div>
