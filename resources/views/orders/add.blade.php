<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Order') }}
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
                            <form action="{{route("post-add-order")}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}" />
                                <!-- Order Details -->
                                <div class="mb-3">
                                    <x-input-label for="details" :value="__('Order Details')" />
                                    <x-textarea-input id="details" class="block mt-1 w-full" name="details" :value="old('details')" required autofocus autocomplete="details" />
                                </div>
                                <!-- Total Amount -->
                                <div class="mb-3">
                                    <x-input-label for="total" :value="__('Total Amount')" />
                                    <x-text-input id="total" class="block mt-1 w-full" type="text" name="total" :value="old('total')" required autofocus autocomplete="total" />
                                </div>
                                <!-- Address -->
                                <div class="mb-4">
                                    <x-input-label for="address" :value="__('Order Address')" />
                                    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus autocomplete="quantity" />
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

