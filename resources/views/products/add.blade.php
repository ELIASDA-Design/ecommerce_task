<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session()->has('message'))
                        <div class="w-4/5 m-auto mt-10 pl-2">
                            <p class="w-2/6 mb-4 text-gray-50 bg-green-500 rounded-2xl py-4 px-6">
                                {{ session()->get('message') }}
                            </p>
                        </div>
                    @endif

                        @if ($errors->any())
                            <div class="w-4/5 m-auto">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="w-1/5 mb-4 text-gray-50 bg-red-700 rounded-2xl py-4">
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="w-4/5 m-auto pt-20">
                            <form action="{{route("post-add-product")}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- Name -->
                                <div class="mb-3">
                                    <x-input-label for="name" :value="__('Name')" />
                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                </div>
                                <!-- Price -->
                                <div class="mb-3">
                                    <x-input-label for="price" :value="__('Price')" />
                                    <x-text-input id="price" class="block mt-1 w-full" type="text" name="price" :value="old('price')" required autofocus autocomplete="price" />
                                </div>
                                <!-- Stock Quantity -->
                                <div class="mb-4">
                                    <x-input-label for="quantity" :value="__('Quantity')" />
                                    <x-text-input id="quantity" class="block mt-1 w-full" type="text" name="quantity" :value="old('quantity')" required autofocus autocomplete="quantity" />
                                </div>
                                <x-primary-button>
                                    Save
                                </x-primary-button>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

