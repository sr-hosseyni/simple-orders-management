<?php

namespace App\Http\Controllers;

use App\Core\OrderManager;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequestRequest;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Input;

class OrderController extends Controller
{
    /**
     * @var OrderManager
     */
    protected $manager;

    public function __construct(OrderManager $orderManager)
    {
        $this->manager = $orderManager;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filters = Input::get('filters');

        $queryBuilder = Order::query()
            ->select([
                'orders.*'
            ])
            ->join('users', 'user_id', 'users.id')
            ->join('products', 'product_id', 'products.id');

        if ($filters['created_at']) {
            $queryBuilder
                ->where(
                    'orders.created_at',
                    '>',
                    \DB::raw('NOW() - INTERVAL ' . $filters['created_at'] . ' DAY')
                );
        }

        if ($filters['keyword']) {
            $queryBuilder
                ->where(function($queryBuilder) use ($filters) {
                    $queryBuilder
                        ->where('users.name', 'LIKE', '%' . $filters['keyword'] . '%')
                        ->orWhere('products.name', 'LIKE', '%' . $filters['keyword'] . '%');
                });
        }

        $orders = $queryBuilder
            ->orderBy('orders.created_at', 'desc')
            ->get();

        return view('order/index', [
            'orders' => $orders,
            'users' => User::all()->pluck('name', 'id'),
            'products' => Product::all()->pluck('name', 'id'),
            'filters' => $filters
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        $data = $request->validated();

        // store
        $this->manager->create(
            User::find($data['user_id']),
            Product::find($data['product_id']),
            $data['quantity']
        );

        // redirect
        \Session::flash('message', 'Successfully created order!');
        return \Redirect::to('order');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        // show the edit form and pass the nerd
        return \View::make('order.edit')
            ->with('order', $order)
            ->with('users', User::all()->pluck('name', 'id'))
            ->with('products', Product::all()->pluck('name', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequestRequest $request, Order $order)
    {
        $data = $request->validated();

        // store
        $order->user_id = $data['user_id'];
        $order->product_id = $data['product_id'];
        $order->quantity = $data['quantity'];
        $order->total = $data['quantity'] * Product::find($data['product_id'])->price;
        $order->save();

        // redirect
        \Session::flash('message', 'Successfully updated order!');
        return \Redirect::to('order');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        // redirect
        \Session::flash('message', 'Successfully deleted order!');
        return \Redirect::to('order');
    }
}
