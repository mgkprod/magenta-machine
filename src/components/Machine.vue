<template>
  <div class="wrapper">
    <div class="flex flex-col md:flex-row justify-center gap-3 md:gap-8 mb-8 xl:gap-16 md:mb-16">
      <div>
        <div class="font-michroma text-left md:text-center mb-4 text-base md:text-sm xl:text-base">
          drums
        </div>

        <div class="flex flex-row md:grid md:grid-cols-2 gap-3 md:gap-2 xl:gap-4">
          <button
            v-for="player in getPlayersByType('drums')"
            :key="player.sample.id"
            :disabled="!player.sample.ready"
            class="focus:outline-none button button-music button-blue"
            :class="{ active: player.howl.volume() == 1 }"
            @click="toggle(player.sample.id)"
          />
        </div>
      </div>
      <div>
        <div class="font-michroma text-left md:text-center mb-4 text-base md:text-sm xl:text-base">
          bass
        </div>

        <div class="flex flex-row md:grid md:grid-cols-2 gap-3 md:gap-2 xl:gap-4">
          <button
            v-for="player in getPlayersByType('bass')"
            :key="player.sample.id"
            :disabled="!player.sample.ready"
            class="focus:outline-none button button-music button-red"
            :class="{ active: player.howl.volume() == 1 }"
            @click="toggle(player.sample.id)"
          />
        </div>
      </div>
      <div>
        <div class="font-michroma text-left md:text-center mb-4 text-base md:text-sm xl:text-base">
          vocals
        </div>

        <div class="flex flex-row md:grid md:grid-cols-2 gap-3 md:gap-2 xl:gap-4">
          <button
            v-for="player in getPlayersByType('vocals')"
            :key="player.sample.id"
            :disabled="!player.sample.ready"
            class="focus:outline-none button button-music button-green"
            :class="{ active: player.howl.volume() == 1 }"
            @click="toggle(player.sample.id)"
          />
        </div>
      </div>
      <div>
        <div class="font-michroma text-left md:text-center mb-4 text-base md:text-sm xl:text-base">
          other
        </div>

        <div class="flex flex-row md:grid md:grid-cols-2 gap-3 md:gap-2 xl:gap-4">
          <button
            v-for="player in getPlayersByType('other')"
            :key="player.sample.id"
            :disabled="!player.sample.ready"
            class="focus:outline-none button button-music button-yellow"
            :class="{ active: player.howl.volume() == 1 }"
            @click="toggle(player.sample.id)"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Howl } from 'howler'

export default {
  data() {
    return {
      shareVisible: false,
      shareUrl: 'https://magenta-machine.test/#1-3-8-9',
      players: [],
    }
  },

  async mounted() {
    // Audio
    await this.loadSample( 4, 'bass', 'bass_chance', '/audio/bass_chance.mp3')
    await this.loadSample( 5, 'drums', 'drums_chance', '/audio/drums_chance.mp3')
    await this.loadSample( 6, 'vocals', 'vocals_chance', '/audio/vocals_chance.mp3')
    await this.loadSample( 7, 'other', 'other_chance', '/audio/other_chance.mp3')

    await this.loadSample( 8, 'bass', 'bass_lapaix', '/audio/bass_lapaix.mp3')
    await this.loadSample( 9, 'drums', 'drums_lapaix', '/audio/drums_lapaix.mp3')
    await this.loadSample(10, 'vocals', 'vocals_lapaix', '/audio/vocals_lapaix.mp3')
    await this.loadSample(11, 'other', 'other_lapaix', '/audio/other_lapaix.mp3')

    await this.loadSample(12, 'bass', 'bass_nikki', '/audio/bass_nikki.mp3')
    await this.loadSample(13, 'drums', 'drums_nikki', '/audio/drums_nikki.mp3')
    await this.loadSample(14, 'vocals', 'vocals_nikki', '/audio/vocals_nikki.mp3')
    await this.loadSample(15, 'other', 'other_nikki', '/audio/other_nikki.mp3')

    await this.loadSample(16, 'bass', 'bass_boum_bap', '/audio/bass_boum_bap.mp3')
    await this.loadSample(17, 'drums', 'drums_boum_bap', '/audio/drums_boum_bap.mp3')
    await this.loadSample(18, 'vocals', 'vocals_boum_bap', '/audio/vocals_boum_bap.mp3')
    await this.loadSample(19, 'other', 'other_boum_bap', '/audio/other_boum_bap.mp3')

    await this.loadSample( 1, 'bass', 'bass_2019', '/audio/bass_2019.mp3')
    await this.loadSample( 2, 'drums', 'drums_2019', '/audio/drums_2019.mp3')
    await this.loadSample( 3, 'other', 'other_2019', '/audio/other_2019.mp3')

    // await this.loadSample(20, 'drums', 'drums_longfeu', '/audio/drums_longfeu.mp3')
    // await this.loadSample(21, 'vocals', 'vocals_longfeu', '/audio/vocals_longfeu.mp3')
    // await this.loadSample(22, 'other', 'other_longfeu', '/audio/other_longfeu.mp3')

    setTimeout(this.start, 100)
  },

  methods: {
    async loadSample(id, type, name, url){
      let enabledIds = []

      let hash = window.location.hash.substr(1)
      if (hash) {
        enabledIds = hash.split('-')
      }

      let howl = new Howl({
        src: [url],
        loop: true,
        volume: (enabledIds.includes(id.toString())),
        onload: () => {
          let player = this.players.find(p => p.sample.id === id)
          player.sample.ready = true
        },
      })

      this.players.push({
        howl: howl,
        sample: {
          id: id,
          name: name,
          type: type,
          url: url,
          ready: false,
        },
      })
    },

    toggle(sampleId) {
      let player = this.players.find(p => p.sample.id === sampleId)

      if (player.howl.volume() == 1) {
        player.howl.volume(0)
      } else {
        this.players
          .filter((p) => p.sample.type === player.sample.type)
          .forEach((player) => { player.howl.volume(0) })

        player.howl.volume(1)
      }

      setTimeout(() => {
        this.buildShareUrl()
      }, 100)
    },

    start() {
      let unloadedPlayer = this.players.find(p => p.howl.state() != 'loaded')
      if (unloadedPlayer) return setTimeout(this.start, 100)

      this.players.forEach((player) => { player.howl.play() })
    },

    getPlayersByType(type) {
      return this.players.filter((p) => p.sample.type == type)
    },

    buildShareUrl() {
      let shareIds = []

      this.players
        .filter((p) => p.howl.volume() == 1)
        .forEach((player) => { shareIds.push(player.sample.id) })

      this.shareUrl = window.location.href.split('#')[0] + (shareIds.length ? '#' + shareIds.join('-') : '')
      window.history.pushState({}, null, this.shareUrl)
    },
  },
}
</script>
