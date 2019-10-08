<?php

namespace App\Http\Controllers;

use App\Core\OrderManager;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
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

        return 'kiir';

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
    public function store(Request $request)
    {
        $rules = array(
            'user_id' => 'required|numeric',
            'product_id' => 'required|numeric',
            'quantity' => 'required|numeric'
        );

        $validator = \Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return \Redirect::to('order')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
            // store
            $this->manager->create(
                User::find(Input::get('user_id')),
                Product::find(Input::get('product_id')),
                Input::get('quantity')
            );

            // redirect
            \Session::flash('message', 'Successfully created order!');
            return \Redirect::to('order');
        }
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
    public function update(Request $request, Order $order)
    {
        $rules = array(
            'user_id' => 'required|numeric',
            'product_id' => 'required|numeric',
            'quantity' => 'required|numeric'
        );

        $validator = \Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return \Redirect::to('order/' . $order->id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
            // store
            $order->user_id = Input::get('user_id');
            $order->product_id = Input::get('product_id');
            $order->quantity = Input::get('quantity');
            $order->total = Input::get('quantity') * Product::find(Input::get('product_id'))->price;
            $order->save();

            // redirect
            \Session::flash('message', 'Successfully updated order!');
            return \Redirect::to('order');
        }
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
