<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin') }}
        </h2>
    </x-slot>
</x-app-layout>
<x-guest-layout>
    <form method="POST" action="{{ route('products.update', $product->id) }}">
        @csrf
        @method('PUT')
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nom')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $product->name }}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Description -->
        <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" value="{{ $product->description }}" required autofocus autocomplete="description" />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <!-- Price -->
        <div class="mt-4">
            <x-input-label for="price" :value="__('Prix')" />
            <x-text-input id="price" class="block mt-1 w-full" type="text" name="price" value="{{ $product->price }}" required autocomplete="price" />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>

       <!-- Poppings -->
       <label>Poppings</label>
       <select class="mt-4" name="poppings">
           <option value="0">Poppings</option>
           @for ($i = 0; $i < count($poppings); $i++)
               <option value="<?= $i + 1 ?>" selected>
                   {{ $poppings[$i]->name }}
               </option>
           @endfor
       </select>

        <!-- Picture -->
        <div class="mt-4">
            <x-input-label for="picture" :value="__('Photo')" />
            <x-text-input id="picture" class="block mt-1 w-full" type="text" name="picture" value="{{ $product->picture }}" required autocomplete="picture" />
            <x-input-error :messages="$errors->get('picture')" class="mt-2" />
        </div>

        <div>
            <img src="{{ $product->picture }}">
        </div>

        <div class="flex items-center justify-start mt-4">
            <x-primary-button class="ms-4">
                {{ __('Edit') }}
            </x-primary-button>
        </div>
    </form>
    <div>
        <a href="http://127.0.0.1:8000/create" class="font-semibold text-gray-900 hover:text-gray-400 dark:text-gray-800 text-l">Create new</a>
    </div>
</x-guest-layout>