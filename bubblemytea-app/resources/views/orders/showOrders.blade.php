
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="grid text-center max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> --}}
                    @foreach ($orders as $order)
                        <div class="p-6 table border-collapse border border-slate-400 shadow-lg mb-6">
                            <h1 class="font-semibold text-gray-900 text-l">Commande n° : {{ $order->id }}</h1>
                            <p>{{ $order->created_at }}</p>
                            <p>Prix : {{ $order->total_price }}€</p>
                            <p>Nombre de produit : {{ $order->total_qty }}<p>
                            <a href="{{ route('orders.index', $order->id) }}" class="font-semibold text-gray-900 hover:text-gray-400">
                            --> Détails</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>