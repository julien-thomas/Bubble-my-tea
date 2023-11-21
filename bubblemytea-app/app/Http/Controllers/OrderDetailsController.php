<?php

namespace App\Http\Controllers;

use App\Models\OrderDetails;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showOrders()
    {
        $user_id = session()->get('user_id')[0]->id;
        // $orders = DB::table('orders')
        //             //->join('products', 'order_details.product_id', '=', 'products.id')
        //             ->select('*')
        //             ->where('user_id', $user_id)
        //             ->get();
        $orders = Order::getOrders($user_id);
        return view('orders.showOrders', [
            'orders' => $orders
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        //$orderDetails = OrderDetails::all();
        // $orders = DB::table('order_details')
        //             ->join('products', 'order_details.product_id', '=', 'products.id')
        //             ->select('products.name','products.picture', 'order_details.*')
        //             ->where('order_id', $id)
        //             ->get();
        //dd($orders);
        //$orders = DB::select('select * from order_details where order_id = ?', [$id]);
        //dd($orders);
        //$products =  DB::select('select name from products where id = ?', [$orderDetails->product_id]);
        //dd($products);
        $orders = OrderDetails::getOrderDetails($id);
        return view('orders.index', [
            'orders' => $orders
            //'products' => $products
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Order::find($id);

        return view('orders.show', [
            'order' => $order
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $order_details = session()->get("cart"); // On récupère le panier en session
        $user = session()->get('user_id'); // On récupère le user en session
        $user_id = $user[0]->id; // et son id

        $total_qty = 0;
        $total_price = 0;
        
        foreach ($order_details as $keys => $values) {
            $orderDetail =
                [
                    'price'        => $order_details[$keys]['price'] + $order_details[$keys]['sugar'],
                    'qty'          => $order_details[$keys]['quantity'],
                    // 'order_id'     => $id,
                    // 'product_id'   => $keys
                ];
            // OrderDetails::create($orderDetail);
            $total_qty += $order_details[$keys]['quantity'];
            $total_price += ($order_details[$keys]['price']  + $order_details[$keys]['sugar']) * $order_details[$keys]['quantity'];
            //dump($orderDetail);

        }
        $order = 
            [
                'user_id'       => $user_id,
                'total_price'   => $total_price,
                'total_qty'     => $total_qty,
            ];
        // Order::create($order);
        // //dd($orderDetail);
        // //return redirect()->route('show', ['id' => $order_details->id]);
        // return 'Commande ajoutée';
        $order = Order::create($order);
        $order_id = DB::select('select id from orders where id = ?', [$order->id])[0]->id;
        
        foreach ($order_details as $keys => $values) {
            $orderDetail =
                [
                    'price'        => $order_details[$keys]['price'] + $order_details[$keys]['sugar'],
                    'qty'          => $order_details[$keys]['quantity'],
                    'order_id'     => $order_id,
                    'product_id'   => $keys
                ];
            OrderDetails::create($orderDetail);
            $total_qty += $order_details[$keys]['quantity'];
            $total_price += ($order_details[$keys]['price'] + $order_details[$keys]['sugar']) * $order_details[$keys]['quantity'];
            //dump($orderDetail);
        }
        session()->forget("cart"); // On supprime le panier en session
        return redirect()->route('orders.show', ['id' => $order_id]);
    }
}
