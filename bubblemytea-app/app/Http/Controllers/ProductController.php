<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        
        return view('products.index', [
            'products' => $products
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $poppings = DB::table('poppings')
        //->join('products', 'order_details.product_id', '=', 'products.id')
        ->select('name')
        ->get();
        //dd($poppings[0]->name);
        return view ('products.create', ['poppings' => $poppings]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:1000',
            'picture' => 'required',
            'price' => 'required',
        ]);
 
        // $product = Product::create($validated);
        /*return redirect()->route('show', ['id' => $product->id]); */

        // $response = Gate::inspect('store', $request->product);
        // // dd($request);
        // // dd($response);
        // if ($response->allowed()) {
        // The action is authorized...
        $product = Product::create($validated);
        return redirect()->route('show', ['id' => $product->id]);
        // } else {
        //     echo $response->message();
        // }

    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::find($id);
        $poppings = DB::table('poppings')
        //->join('products', 'order_details.product_id', '=', 'products.id')
        ->select('name')
        ->get();
        return view('products.show', [
            'product' => $product,
            'poppings' => $poppings
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $poppings = DB::table('poppings')
        //->join('products', 'order_details.product_id', '=', 'products.id')
        ->select('name')
        ->get();
        return view('products.edit', [
            'product' => $product,
            'poppings' => $poppings
    ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:1000',
            'picture' => 'required',
            'price' => 'required',
        ]);

        $product->name = $validated['name'];
        $product->description = $validated['description'];
        $product->picture = $validated['picture'];
        $product->price = $validated['price'];

        $response = Gate::inspect('update', $product);
        // dd($response);
        if ($response->allowed()) {
        // The action is authorized...
        $product->save();
        return redirect()->route('show', ['id' => $product->id]);
        } else {
            echo $response->message();
        } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
