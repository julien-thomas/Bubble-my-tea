<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="font-semibold hover:text-gray-800">Merci pour votre commande!</div>
                        <h1>Commande n° {{ $order->id }}</h1>
                        <p>Prix total: {{ $order->total_price }}€</p>
                        <p>Quantité: {{ $order->total_qty }}<p>
                        <a href="{{ route('orders.index', $order->id) }}" class="font-semibold hover:text-gray-800">->Détails</a>
                        
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
