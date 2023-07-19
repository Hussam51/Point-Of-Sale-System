<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {

        $orders = Order::whereHas('client', function ($q) use ($request) {

            return $q->where('name', 'LIKE', '%' . $request->search . '%');
        })->paginate(5);

        return view('layouts.dashboard.main_orders.index', compact('orders'));
    }


    public function products(Order $order)
    {


           $data=$order->products;
           
     //  $col= $produ->products;
       return response()->json($data);
        //  return view('layouts.dashboard.main_orders._products',compact('products'));
    }
}
