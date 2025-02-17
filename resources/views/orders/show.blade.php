<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View Orders') }}
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

                    <div class="pt-15 w-4/5 mb-6">
                        <form method="GET" action="{{route("add-order")}}">
                            @csrf
                            <x-primary-button>Create Order</x-primary-button>
                        </form>
                    </div>
                    @if(count($orders) > 0)
                        <table class="w-full text-left table-auto min-w-max">
                            <thead>
                            <tr class="border-b border-blue-gray-100">
                                <th class="border-b border-blue-gray-100">ID</th>
                                <th class="border-b border-blue-gray-100">Person Name</th>
                                <th class="border-b border-blue-gray-100">Total Amount</th>
                                <th class="border-b border-blue-gray-100">Order Products</th>
                                <th class="border-b border-blue-gray-100">Address</th>
                                <th class="border-b border-blue-gray-100">Order Track Code</th>
                                <th class="border-b border-blue-gray-100">Order Create Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr class="border-b border-blue-gray-100">
                                    <td class="border-r border-blue-gray-100">{{$order["id"]}}</td>
                                    <td class="border-r border-blue-gray-100">{{$order["username"]}}</td>
                                    <td class="border-r border-blue-gray-100">{{$order["total"]}} $</td>
                                    <td class="border-r border-blue-gray-100">
                                        @foreach($order["products"] as $product)
                                            {{$product->name}} <br/>
                                        @endforeach
                                    </td>
                                    <td class="border-r border-blue-gray-100">{{$order["address"]}}</td>
                                    <td class="border-r border-blue-gray-100">{{$order["track_code"]}}</td>
                                    <td class="border-r border-blue-gray-100">{{$order["created_at"]}}</td>
                                    <td class="flex space-x-6 items-center">
                                        {{--                                        edit--}}
{{--                                        <a href="{{route("edit-order",[$order["id"]])}}">--}}
{{--                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-6">--}}
{{--                                                <path strokeLinecap="round" strokeLinejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />--}}
{{--                                            </svg>--}}
{{--                                        </a>--}}
                                        <x-nofill-button x-data=""
                                                         x-on:click.prevent="$dispatch('open-modal', 'delete-order-{{$order['id']}}')">
                                            <svg class="h-5 w-5 mt-2 ml-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-6">
                                                <path strokeLinecap="round" strokeLinejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </x-nofill-button>

                                        <x-modal name="delete-order-{{$order['id']}}" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                            <form method="post" action="{{ route('delete-order') }}" class="p-6">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$order['id']}}">
                                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                    {{ __('Are you sure you want to delete this order?') }}
                                                </h2>

                                                <div class="mt-6 flex justify-end">
                                                    <x-secondary-button x-on:click="$dispatch('close')">
                                                        {{ __('Cancel') }}
                                                    </x-secondary-button>

                                                    <x-danger-button class="ms-3">
                                                        {{ __('Confirm') }}
                                                    </x-danger-button>
                                                </div>
                                            </form>
                                        </x-modal>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="w-100 h-100 text-center">No Data</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- from node_modules -->
    <script src="node_modules/@material-tailwind/html@latest/scripts/dialog.js"></script>
</x-app-layout>
