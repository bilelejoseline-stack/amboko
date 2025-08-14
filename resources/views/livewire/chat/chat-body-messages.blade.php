<div class="py-20 px-4 relative flex flex-col overflow-y-auto space-y-2 bg-gray-900 text-white scrollbar-custom" style="height: calc(100vh - 200px);">
    @foreach ($messages as $msg)
        @php
            $isSender = $msg->from_id === auth()->id();
        @endphp

        <div class="{{ $isSender ? 'ml-auto speech-bubble-right bg-green-600 rounded-tr-none text-white' : 'mr-auto speech-bubble-left bg-gray-700 rounded-tl-none text-white' }}
                    max-w-xs md:max-w-sm lg:max-w-md w-fit rounded-lg p-2 my-1 text-sm flex flex-col relative shadow"
        >
            <p>{{ $msg->content }}</p>
            <p class="text-gray-300 text-xs text-right leading-none mt-1">
                {{ \Carbon\Carbon::parse($msg->created_at)->format('H:i') }}
            </p>
        </div>
    @endforeach
</div>
