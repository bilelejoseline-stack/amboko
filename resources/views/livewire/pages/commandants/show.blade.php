<section class="bg-gray-900 text-gray-100 py-16 px-6 md:px-12">
    <div class="max-w-4xl mx-auto text-center space-y-6">
        <img src="{{ asset('storage/' . $commandant->image) }}"
             alt="{{ $commandant->nom }}"
             class="mx-auto w-40 h-40 rounded-full border-4 border-yellow-500 shadow-xl">

        <h2 class="text-4xl font-bold text-yellow-400">{{ $commandant->nom }}</h2>
        <p class="text-lg text-gray-300 italic">{{ $commandant->titre }}</p>
        <p class="text-md text-gray-400">{{ $commandant->periode }}</p>

        <div class="mt-6 text-left text-gray-200 prose max-w-none">
          {!! tiptap_converter()->asHTML($commandant->description) !!}


        </div>
    </div>
</section>
