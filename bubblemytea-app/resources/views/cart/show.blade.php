<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panier') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div><!--class="bg-white overflow-hidden shadow-sm sm:rounded-lg"-->
                <div class="p-6 text-gray-900">
                    <div class="container">

                        @if (session()->has('message'))
                        <div class="alert alert-info">{{ session('message') }}</div>
                        @endif
                    
                        @if (session()->has("cart"))
                        <div class="p-6 font-semibold text-gray-900 text-xl">Mon panier</div>
                        <div class="pb-6">
                        <a href="http://127.0.0.1:8000/products">
                            <span class="p-6 font-semibold text-gray-900 hover:text-gray-400 dark:text-gray-800">Ajouter un produit    
                        </a>
                        <a class="x-danger-button" href="{{ route('cart.empty') }}" title="Retirer tous les produits du panier" >
                            <span class="p-6 font-semibold text-gray-400 hover:text-gray-800">Vider le panier</a>
                        </div>
                        <div class="table-responsive border-collapse border border-slate-400 shadow-lg mb-3">
                            <table class="caption-top">
                                <thead>
                                    <tr>   
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Poppings</th>
                                        <th>Price</th></div>
                                        <th class="text-center">Poppings <span class="pl-6">/ <span class="pl-6">Sugar <span class="pl-6">/ <span class="pl-6">Quantity</th>
                                        <th>Total</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Initialisation du total général à 0 -->
                                    @php $total = 0 @endphp
                    
                                    <!-- On parcourt les produits du panier en session : session('cart') -->
                                    @foreach (session("cart") as $key => $item)
                    
                                        <!-- On incrémente le total général par le total de chaque produit du panier -->
                                        @php $total += ($item['price'] + $item['sugar']) * $item['quantity'] @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-center">
                                                <strong><a href="{{ route('show', $key) }}" title="Afficher le produit" >{{ $item['name'] }}</a></strong>
                                                <img src="{{ $item['picture'] }}" width=100px>
                                            </td>
                                            <td>
                                                {{ $item['poppings'] }}
                                            </td>
                                            <td class="text-center">{{ $item['price'] + $item['sugar']}} €</td>
                                            <td class="text-center">
                                                <!-- Le formulaire de mise à jour de la quantité -->
                                                <form method="POST" action="{{ route('cart.store', $key) }}" class="form-inline d-inline-block">
                                                @csrf
                                                 {{-- <label>Poppings</label> --}}
                                                <select class="mt-4" name="poppings">
                                                        {{-- <option value="0">Poppings</option> --}}
                                                        @for ($i = 0; $i < count($poppings); $i++)
                                                        <option value="<?= $i + 1 ?>" selected>
                                                            {{ $poppings[$i]->name }}
                                                        </option>
                                                        @endfor
                                                </select>
                                                <select name="sugar" id="sugar">
                                                        {{-- <option value="">--Please choose an option--</option> --}}
                                                        <option value="0">normal</option>
                                                        <option value="0.5">sucré +0.5€</option>
                                                        <option value="1">sucré +1€</option>
                                                </select>
    
                                                    <input type="number" name="quantity" placeholder="Quantité ?" value="{{ $item['quantity'] }}" class="form-control mr-2" style="width: 80px" ><br>
                                                    <input type="submit" class="btn btn-primary font-semibold text-gray-900 hover:text-gray-400 dark:text-gray-800" value="Actualiser" />
                                                </form>
                                            </td>
                                            <td>
                                                <!-- Le total du produit = prix * quantité -->
                                                {{ ($item['price'] + $item['sugar']) * $item['quantity'] }} €
                                            </td>
                                            <td>
                                                <!-- Le Lien pour retirer un produit du panier -->
                                                <a href="{{ route('cart.remove', $key) }}" class="btn btn-outline-danger" title="Retirer le produit du panier" >Retirer</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{-- <tr colspan="2" >
                                        <td colspan="5" >Total général</td>
                                        <td colspan="2">
                                            <!-- On affiche total général -->
                                            <strong>{{ $total }} €</strong>
                                        </td>
                                    </tr> --}}
                                </tbody>
                    
                            </table>
                            <tr colspan="2" >
                                <td colspan="5" >Total général : </td>
                                <td colspan="2">
                                    <!-- On affiche total général -->
                                    <strong>{{ $total }} €</strong>
                                </td>
                            </tr>
                        </div>
                    
                        <!-- Lien pour vider le panier -->
                        {{-- <a href="http://127.0.0.1:8000/products">
                            <span class="p-6 font-semibold text-gray-900 hover:text-gray-400 dark:text-gray-800">Ajouter un produit    
                        </a>
                        <a class="x-danger-button" href="{{ route('cart.empty') }}" title="Retirer tous les produits du panier" >
                            <span class="p-6 font-semibold text-gray-400 hover:text-gray-800">Vider le panier</a> --}}
                        <a class="btn btn-danger" href="{{ route('orderDetails.store') }}" title="Commander">
                            <div class="p-6 font-semibold text-gray-900 hover:text-gray-400 dark:text-gray-800 text-xl">--> Commander</div></a>

                        @else
                        <div class="alert alert-info">Aucun produit au panier</div>
                        <a href="http://127.0.0.1:8000/products">
                            <span class="p-6 font-semibold text-gray-900 hover:text-gray-400 dark:text-gray-800">Retourner aux produits    
                        </a>
                        @endif
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>