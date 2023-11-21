<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Product $product, Request $request)
    {
        $cart = session()->get("cart"); // On récupère le panier en session

        $validated = $request->validate([
            'quantity' => 'numeric|min:1',
            'sugar' => 'numeric'
        ]);
        $quantity = $validated['quantity'];
        $sugar = $validated['sugar'];
        $poppings_id = $request->poppings;
        $poppings = (DB::table('poppings')
        ->select('name')
        ->where('id', $poppings_id)
        ->get())[0]->name;

		// Les informations du produit à ajouter
		$product_details = [
			'name' => $product->name,
            'picture' => $product->picture,
			'price' => $product->price,
            'poppings' => $poppings,
			'quantity' => $quantity,
            'sugar' => $sugar,
		];
		
		$cart[$product->id] = $product_details; // On ajoute ou on met à jour le produit au panier
		session()->put('cart', $cart); // On enregistre le panier
        // dd($cart);
        //session(['cart' => $cart]);
        //dd(session());
        return redirect()->route("cart.show")->withMessage("Produit ajouté au panier");
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //dd(session());
        // return view("cart.show"); // resources\views\cart\show.blade.php
        $poppings = DB::table('poppings')
        //->join('products', 'order_details.product_id', '=', 'products.id')
        ->select('name')
        ->get();
        return view("cart.show", [
            'poppings' => $poppings
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function remove(Product $product)
    {
        $cart = session()->get("cart"); // On récupère le panier en session
		unset($cart[$product->id]); // On supprime le produit du tableau $basket
		session()->put("cart", $cart); // On enregistre le panier
        // Redirection vers le panier
        return redirect()->route("cart.show")->withMessage("Produit retiré du panier");
    }

    public function empty () {
		session()->forget("cart"); // On supprime le panier en session
        return redirect()->route("cart.show")->withMessage("Produits retirés du panier");
	}
}
