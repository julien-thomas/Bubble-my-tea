
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order_details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="grid text-center max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> --}}
                    @foreach ($orders as $order)
                    <div class="bg-white p-6 table border-collapse border border-slate-400 shadow-lg mb-6">
                        <h1 class="font-semibold text-gray-900 text-l">Produit : {{ $order->name }}</h1>
                        <img src={{ $order->picture }}>
                        <p>Prix : {{ $order->price }}€</p>
                        <p class="mb-4">Quantité : {{ $order->qty }}<p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>