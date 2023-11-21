<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("My orders") }}
                </div>
            </div>
            @foreach ($orders as $order)
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-6 text-gray-900 px-3 py-4 border">
                <div> {{ $order->created_at }} </div>
                <div> {{ $order->total_price }}€ </div>
                <div> {{ $order->total_qty }} product(s) </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>