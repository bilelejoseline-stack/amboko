<!-- Bande d'information type France24 -->
<div>
  @if($hasInfos)
    <div
      x-data="{
        infos: @js($infos),
        current: 0,
        get message() {
          return this.infos[this.current]?.message ?? '';
        },
        get title() {
          return this.infos[this.current]?.title ?? '';
        },
        next() {
          this.current = (this.current + 1) % this.infos.length;
          this.scroll();
        },
        scroll() {
          this.$nextTick(() => {
            const content = this.$refs.content;
            const container = this.$refs.marquee;

            const contentWidth = content.offsetWidth;
            const containerWidth = container.offsetWidth;

            const baseSpeed = 15; // ← vitesse normale
            const duration = (contentWidth + containerWidth) * baseSpeed;

            content.style.animation = 'none';
            void content.offsetWidth; // Reflow
            content.style.animation = `marquee ${duration}ms linear 1`;

            setTimeout(() => {
              this.next();
            }, duration + 100);
          });
        }
      }"
      x-init="scroll()"
      x-show="infos.length > 0"
      x-cloak
      class="bg-yellow-500 text-black px-3 flex items-center space-x-3 overflow-hidden z-40 relative text-sm md:text-base"
    >
      <!-- Titre fixe à gauche -->
      <span class="font-bold uppercase whitespace-nowrap text-gray-900 shrink-0" x-text="title"></span>

      <!-- Marquee défilant -->
      <div class="overflow-hidden flex-1 relative h-5 md:h-6" x-ref="marquee">
        <div class="absolute whitespace-nowrap text-gray-900">
          <div x-ref="content" x-text="message"></div>
        </div>
      </div>
    </div>
  @endif
</div>
