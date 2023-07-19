<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {

    }

    public function create(Client $client)
    {

        $categories = Category::with('products')->get();

        return view('layouts.dashboard.orders.create', compact('categories', 'client'));
    }

    //start of store function

    public function store(Request $request, Client $client)
    {


        $total_price = 0;
        foreach ($request->products as $id => $quantity) {

            $prod = Product::find($id);
            $total_price += $prod->sale_price * $quantity['quantity'];

            $prod->update([
                'stock' => $prod->stock - $quantity['quantity']
            ]);
        }

        $order = $client->orders()->create(['total_price' => $total_price]);


        $order->products()->attach($request->products);

        session()->flash('success', 'created successfully');
        return redirect()->route('orders.index');
    }

    //end of store function

    public function edit(Request $request, Client $client, Order $order)
    {
    }

    public function update(Request $request, Client $client, Order $order)
    {
    }

    public function destroy(Client $client, Order $order)
    {
    }
}
