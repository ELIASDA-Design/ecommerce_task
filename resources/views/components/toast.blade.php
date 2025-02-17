<div id="toast" class="hidden fixed bottom-5 right-5">
    <div class="flex items-center p-4 rounded-lg shadow-lg bg-white border-l-4 {{ $type === 'success' ? 'border-green-500' : ($type === 'error' ? 'border-red-500' : 'border-blue-500') }}">
        <span class="mr-2">
            @if ($type === 'success')
                ✅
            @elseif ($type === 'error')
                ❌
            @else
                ℹ️
            @endif
        </span>
        <span>{{ $message }}</span>
    </div>
</div>
