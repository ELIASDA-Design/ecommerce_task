<div class="container" style="width: 300px;">
    <div class="mt-8" style="margin-top: 10px;">
        <div class="flex flex-col md:flex-row" style="margin-bottom: 30px;border: 1px solid gray;border-radius:15px;padding: 20px;">
            <div class="flex-shrink-0">
                <img src="https://picsum.photos/id/237/150/150" alt="Product image" class="w-32 h-32 object-cover">
            </div>
            <div class="mt-4 md:mt-0 md:ml-6">
                <h2 class="text-lg font-bold">{{$item['name']}}</h2>
                <div class="mt-4 flex items-center">
                    <span class="mr-2 text-gray-600" style="margin-right: 15px;">Quantity:</span>
                    <div class="flex items-center" style="margin-right: 15px;">
                        <button onclick="onDecrementClick({{$item['productId']}},{{$item['price']}})" id="decrement-{{$item['productId']}}" class="bg-gray-200 rounded-l-lg px-2 py-1" style="margin-right: 15px;">-</button>
                        <span id="quantity-{{$item['productId']}}" class="mx-2 text-gray-600" style="margin-right: 15px;">{{$item['quantity']}}</span>
                        <button onclick="onIncrementClick({{$item['productId']}},{{$item['price']}})" id="increment-{{$item['productId']}}" class="bg-gray-200 rounded-r-lg px-2 py-1">+</button>
                    </div>
                    <span class="ml-auto font-bold">$ <span id="subtotal-{{$item['productId']}}">{{$item['price']}}</span></span>
                </div>
                <div class="mt-4 flex items-center">
                    <form action="{{ route('remove-cart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $item['productId'] }}">
                        <button type="submit">Remove</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
