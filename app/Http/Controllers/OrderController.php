<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $top = Order::all()->groupBy('');
        // $popular = DB::table('orders')->join('comments','comments.order_id','=','orders.id')
        // ->selectRaw('orders.title, max(comments.rate) as max')
        // ->groupBy(['orders.id','orders.title'])->orderBy('max','desc')->get();
        // $popular = DB::table('orders')->select('tags')->get();
        $popular = DB::table('orders')->take(5)->selectRaw('tags, count(id) as count')->where('availability', false)->
        groupBy('tags')->orderByDesc('count')->distinct()->pluck('tags');
        // foreach($popular as $p){
        //     $p->tags;
        // }

        // $popular = Order::take(5)
        // ->groupBy('tags')
        // ->orderBy('tags', 'desc')
        // ->count('tags');

        // ->max('comments.rate');
        // $popular = strval($popular);
        // $y = str_word_count($popular['tags']);
        // $x = array_count_values($y);
        // arsort($x);

        $unavailable = count(Order::where('availability', true)->get());
        $available = count(Order::where('availability', false)->get());
        return view('home', [
            'available'=> $available,
            'orders' => Order::latest()->where('availability', false)->filter(request(['tag','search']))->paginate(10),
            'unavailable' => $unavailable,
            'popular'=> $popular
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'tags' => 'required',
        ]);

        if($request->hasFile('picture')) {
            $formFields['picture'] = $request->file('picture')->store('pictures', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Order::create($formFields);

        return redirect('/orders')->with('message', 'Order has created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $avg = $order->averageRating();
        return view('orders.show',['order'=>$order,'avg'=>$avg]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('orders.edit',['order'=>$order]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        if($order->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        $formFields = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'tags' => 'required',
            'picture' => 'image|mimes:png,jpg,jpeg|max:4096'
        ]);

        if($request->hasFile('picture')) {
            $formFields['picture'] = $request->file('picture')->store('pictures', 'public');
        }
        $order->update($formFields);

        return redirect('/orders')->with('message', 'Order has updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        if($order->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $order->delete();
        return redirect('/orders')->with('message', 'Order deleted successfully');
    }

    public function manage() {

        return view('orders.manage', ['orders' => auth()->user()->orders()->filter(request(['tag','search']))->orderBy('availability')->paginate(10)]);
    }

    public function markedDone(Order $order){
        if ($order->availability == 0){
        $array = ['availability'=>1];
        $msg = 'Order has been marked UnAvailable';
        } else {
        $array = ['availability'=>0];
        $msg = 'Order has been marked Available';
        }
        $order->update($array);
        return redirect('user/manage')->with('message', $msg);
    }
    public function userOrders(User $user)
    {
        $name = $user->name;
        $user_id = $user->id;
        return view('orders.user-orders', ['name'=> $name,'user_id'=>$user_id,'orders'=> $user->orders()->where('availability', false)->filter(request(['tag','search']))->orderByDesc('created_at')->paginate(10)]);
    }
}
