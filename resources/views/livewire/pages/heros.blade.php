<section id="hero"
         x-data="heroSlider({{ $heroes->toJson() }})"
         x-init="startTyping()"
         class="relative h-screen w-full overflow-hidden text-white"
         x-cloak>

    <!-- Images en arrière-plan -->
    <template x-for="(hero, index) in heroes" :key="index">
      <div
        class="absolute inset-0 transition-opacity duration-1000"
        :class="{ 'opacity-100': index === currentIndex, 'opacity-0': index !== currentIndex }"
      >
        <img
          :src="`/storage/${hero.image}`"
          alt=""
          class="w-full h-full object-cover"
          loading="lazy"
        >
      </div>
    </template>


    <!-- Voile sombre -->
    <div class="absolute inset-0 bg-black bg-opacity-60"></div>

    <!-- Texte -->
    <div class="relative z-10 flex h-full items-center justify-center px-4">
        <div class="text-center max-w-3xl">
            <h2 class="text-4xl md:text-6xl font-extrabold tracking-wide min-h-[5rem]">
                <span x-text="displayedTitle"></span>
            </h2>
            <p class="mt-4 text-xl md:text-2xl text-yellow-400 italic min-h-[3rem]">
                <span x-text="displayedSubtitle"></span>
            </p>
            <p class="mt-8 text-lg">L'élite des Forces Armées Congolaises</p>
        </div>
    </div>
</section>
