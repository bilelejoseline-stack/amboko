<div class="fixed top-4 right-4 space-y-2 z-50">
    @foreach ($notifications as $index => $note)
        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform translate-y-2"
            @click="show = false"
            @click.outside="show = false"
            x-init="setTimeout(() => show = false, 5000)"
            id="notification-{{ $index }}"
            class="p-4 rounded shadow cursor-pointer text-white max-w-xs
                @if($note['type'] === 'success') bg-green-600
                @elseif($note['type'] === 'error') bg-red-600
                @elseif($note['type'] === 'warning') bg-yellow-600
                @else bg-gray-600 @endif"
            role="alert"
            @show.window="
                if ($el.id === 'notification-{{ $index }}' && !show) {
                    $wire.dispatch('remove-notification', index: {{ $index }})
                }
            "
        >
            {{ $note['message'] }}
        </div>
    @endforeach
</div>
