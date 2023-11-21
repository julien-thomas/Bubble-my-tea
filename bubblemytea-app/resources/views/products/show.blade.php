<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12 w-80">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                        <div class="font-semibold text-gray-900"><h1>"{{ $product->name }}"</h1></div>
                        <img src={{ $product->picture }} width=250px>
                        <p>{{ $product->description }}</p>
                              <!-- Poppings -->
                        {{-- <label>Poppings</label>
                        <select class="mt-4" name="poppings">
                        <option value="0">Poppings</option>
                        @for ($i = 0; $i < count($poppings); $i++)
                        <option value="<?= $i + 1 ?>" selected>
                        {{ $poppings[$i]->name }}
                        </option>
                        @endfor
                        </select> --}}
                        {{-- <p>{{ $product->poppings }}test poppings</p> --}}
                        <p>{{ $product->price }} €<p>
                        <form method="POST" action="{{ route('cart.store', $product) }}" class="form-inline d-inline-block" >
                            @csrf
                            <label>Poppings :</label>
                            <select class="mt-4" name="poppings">
                            {{-- <option value="">Poppings</option> --}}
                                    @for ($i = 0; $i < count($poppings); $i++)
                                    <option value="<?= $i + 1 ?>" selected>
                                        {{ $poppings[$i]->name }}
                                    </option>
                                    @endfor
                            </select>
                            <label class="pl-6">   Sugar quantity : </label>
                            <select name="sugar" id="sugar">
                                    {{-- <option value="">--Please choose an option--</option> --}}
                                    <option value="0">normal</option>
                                    <option value="0.5">sucré +0.5€</option>
                                    <option value="1">sucré +1€</option>
                            </select>
      
                            <input type="number" name="quantity" placeholder="Quantité ?" class="form-control mr-2" value="{{ isset(session('basket')[$product->id]) ? session('basket')[$product->id]['quantity'] : null }}" >
                            <button type="submit" class="btn btn-warning" >+ Ajouter</button>
                        </form>
                        <br><br><br><br>
                        <div class="p-6 font-semibold text-gray-400 hover:text-gray-800">
                            <a href="{{ route('edit', $product->id) }}">Edit</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>