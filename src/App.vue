<template>
  <div class="flex-1 flex flex-col items-center justify-center">
    <div class="mb-8 md:mb-16">
      <img src="/images/logo.svg" alt="MAGENTA" class="mx-auto h-12 md:h-16 xl:h-20" />
    </div>
    <Machine />
    <div class="mt-8 md:mt-16">
      <div class="h-12 md:h-16 xl:h-20" />
    </div>
  </div>

  <div class="hidden md:block absolute inset-0 top-auto font-michroma uppercase">
    <div class="flex justify-between items-end">
      <div class="col p-4 bg-decorations-2">
        <button class="uppercase" @click="shareModal = true">Share my mix</button><br />
        <button class="uppercase" @click="magentaLinksModal = true">MAGENTA links</button><br />
      </div>
      <div class="col text-right text-sm p-4 bg-decorations-1">
        <span class="version">{{ version }}</span><br />
        Handcrafted with ❤<br />
        by <a href="https://mgk.dev" target="_blank">Simon R.</a>
      </div>
    </div>
  </div>

  <div class="md:hidden absolute inset-0 top-auto font-michroma text-xs">
    <div class="text-center mb-4 uppercase text-muted">
      <span class="version">{{ version }}</span> - by <a href="https://mgk.dev" target="_blank">Simon R.</a>
    </div>
    <div class="flex flex-row bg-radial-gradient">
      <button class="button focus:outline-none py-2 px-4 flex-grow uppercase" style="border-radius: 0;" @click="shareModal = true">
        <i class="fas fa-share" /><br />
        Share
      </button>
      <button class="button focus:outline-none py-2 px-4 flex-grow uppercase" style="border-radius: 0;" @click="magentaLinksModal = true">
        <i class="fas fa-external-link-square-alt" /><br />
        MAGENTA
      </button>
    </div>
  </div>

  <div class="fixed z-10 inset-0 overflow-y-auto" :class="{ 'hidden': !magentaLinksModal }">
    <div class="min-h-screen pt-4 px-4 text-center sm:block sm:p-0">
      <div class="fixed inset-0 transition-opacity">
        <div class="absolute inset-0 bg-radial-gradient opacity-75" />
      </div>

      <span class="hidden sm:inline-block sm:align-middle sm:h-screen" />&#8203;

      <div class="inline-block bg-radial-gradient text-white text-left overflow-hidden shadow-xl transform transition-all my-8 align-middle max-w-lg w-64">
        <div class="p-4">
          <a href="https://www.facebook.com/magentamusique/" class="button py-2 w-full mb-2 block text-lg" target="_blank"><i class="fab fa-facebook" /></a>
          <a href="https://www.youtube.com/channel/UCDJL7wvwArdhfydZR-XFtgw" class="button py-2 w-full mb-2 block text-lg" target="_blank"><i class="fab fa-youtube" /></a>
          <a href="https://www.instagram.com/magenta.club/" class="button py-2 w-full mb-2 block text-lg" target="_blank"><i class="fab fa-instagram" /></a>
          <a href="https://open.spotify.com/artist/5du1Lf0YKbak13Ym58jKsA" class="button py-2 w-full mb-2 block text-lg" target="_blank"><i class="fab fa-spotify" /></a>
          <a href="https://music.apple.com/fr/artist/magenta/1482405700" class="button py-2 w-full mb-2 block text-lg" target="_blank"><i class="fab fa-apple" /></a>
          <a href="https://mtl.fm/magenta?fbclid=IwAR3uKDD5RqFPbpl0ziM3xub62vQQ8OC3oHWHg2-dkz_iQqwyXWbFyuHV9Aw#!/index" class="button py-2 w-full mb-2 block text-lg" target="_blank"><i class="fas fa-phone" /></a>
        </div>

        <div class="p-4">
          <button class="focus:outline-none button button-red py-2 font-michroma uppercase block" style="width: 100%; height: auto; line-height: initial;" @click="magentaLinksModal = false">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="fixed z-10 inset-0 overflow-y-auto font-michroma" :class="{ 'hidden': !shareModal }">
    <div class="min-h-screen pt-4 px-4 text-center sm:block sm:p-0">
      <div class="fixed inset-0 transition-opacity">
        <div class="absolute inset-0 bg-radial-gradient opacity-75" />
      </div>

      <span class="hidden sm:inline-block sm:align-middle sm:h-screen" />&#8203;

      <div class="inline-block bg-radial-gradient text-white text-left overflow-hidden shadow-xl transform transition-all my-8 align-middle max-w-lg w-full">
        <div class="p-4">
          <div class="mb-2">Share this link with your friends :</div>
          <input v-model="shareUrl" type="text" class="block form-control mx-auto focus:outline-none px-3 py-2 font-michroma w-full" readonly />
        </div>

        <div class="p-4">
          <button class="focus:outline-none button button-red py-2 font-michroma uppercase block mb-2" style="width: 100%; height: auto; line-height: initial;" @click="copyToClipboard(shareUrl)">
            <span v-if="copied"><i class="fas fa-check" /> Copied</span>
            <span v-else>Copy to clipboard</span>
          </button>
          <button class="focus:outline-none button button-red py-2 font-michroma uppercase block" style="width: 100%; height: auto; line-height: initial;" @click="shareModal = false">Close</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Machine from './components/Machine.vue'

export default {
  components: {
    Machine,
  },

  data() {
    return {
      magentaLinksModal: false,
      shareModal: false,
      shareUrl: '',
      copied: false,
    }
  },

  computed: {
    version() {
      return 'v' + __APP_VERSION__
    },
  },

  watch: {
    shareModal(value) {
      if (value) {
        this.shareUrl = window.location.href
      }
    },
  },

  methods: {
    copyToClipboard(text) {
      const input = document.createElement('input')
      input.value = text
      document.body.appendChild(input)
      input.select()
      input.setSelectionRange(0, 99999) // For mobile devices
      navigator.clipboard.writeText(text)
      document.body.removeChild(input)

      this.copied = true
      setTimeout(() => {
        this.copied = false
      }, 2000)
    },
  },
}
</script>
