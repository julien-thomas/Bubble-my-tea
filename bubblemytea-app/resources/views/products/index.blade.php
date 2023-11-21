<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <body class="antialiased">

        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        {{-- <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a> --}}
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif   
                @foreach ($products as $product)
                <div class="p-6">
                    <div><a href="{{ route('show', $product) }}"><img src={{ $product->picture }} width=280px></a></div>
                    <div class="text-center">
                        <div class="font-semibold text-gray-900"><h1>"{{ $product->name }}"</h1></div>
                        <div><p>{{ $product->description }}</p></div>
                        <div><p>Price : {{ $product->price }} €</p></div>
                        <div class="p-6 font-semibold text-gray-900 hover:text-gray-400 dark:text-gray-800">
                            <a href="{{ route('show', $product) }}">--> Voir le produit</a></div>
                    </div>
                </div>
                @endforeach
        </div>
        <a href="{{ route('products.create') }}">Ajouter un produit</a>
    </body>
</x-app-layout>