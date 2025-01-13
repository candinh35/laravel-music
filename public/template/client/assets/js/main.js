// const $ = document.querySelector.bind(document);
// const $$ = document.querySelectorAll.bind(document);
let songs = song != null ? JSON.parse(song) : ''
const title = document.querySelector('.plyr__title');
const audio = document.querySelector('#audio');
const image = document.querySelector('.plyr__poster');
const playBtn = document.querySelector('.plyr__play')
const player = document.querySelector('.playpause-track');
const seek = document.querySelector('.seek');
const nextBtn = document.querySelector('.plyr__next');
const prevBtn = document.querySelector('.plyr__prev');
const list = document.querySelector('#list');
let time_duration = document.querySelector('.plyr__time--duration');
let time_current = document.querySelector('.plyr__time--current');
const progressVolume = document.querySelector('.plyr__volume')
const app = {
    currentIndex: 0,
    isPlaying: false,
    songs: songs,
    defineProperties: function () {
        Object.defineProperty(this, 'currentSong', {
            get: function () {
                return this.songs[this.currentIndex]
            }
        })
    },
    loadCurrentSong: function () {
        title.textContent = this.currentSong.name
        image.style.backgroundImage = `url('${this.currentSong.image}')`;
        audio.src = this.currentSong.file_url;
        audio.pause()
    },
    handleEvents: function () {
        const _this = this;
        playBtn.onclick = function () {
            if (_this.isPlaying) {
                audio.pause();
            } else {
                audio.play();
            }
        }
        audio.onplay = function () {
            _this.isPlaying = true;
            player.innerHTML = '<i class="fa fa-pause-circle fa-3x"></i>';

            document.querySelector(`[data-index="${_this.currentIndex}"]`).innerHTML = '<i class="fa fa-pause-circle fa-3x"></i>';
        }

        audio.onpause = function () {
            _this.isPlaying = false;
            player.innerHTML = '<i class="fa fa-play-circle fa-3x"></i>';
            document.querySelector(`[data-index="${_this.currentIndex}"]`).innerHTML = '<i class="fa fa-play-circle fa-3x"></i>';

        }

        audio.ontimeupdate = function () {
            if (audio.duration) {
                const seekPercent = Math.floor(audio.currentTime / audio.duration * 100);
                seek.value = seekPercent
                seek.style.setProperty('--value', seekPercent + '%');
                time_current.textContent = _this.convertTime(audio.currentTime)
                time_duration.textContent = _this.convertTime(audio.duration)
            }
        }
        // Thay đổi âm lượng
        progressVolume.oninput = function (e) {
            audio.volume = e.target.value;
            progressVolume.style.setProperty('--value', e.target.value * 100 + '%');
        }
        // seek.onchange = function (e) {
        //     audio.currentTime =  audio.duration / 100 * e.target.value
        // }

        nextBtn.onclick = function () {
            _this.nextSong()
            audio.play()
            this.loadCurrentSong()
        }

        prevBtn.onclick = function () {
            _this.prevSong()
            audio.play()
            this.loadCurrentSong()
        }

        audio.onended = function () {
            nextBtn.click()
            this.loadCurrentSong()
        }

        list.onclick = function (e) {
            const songNode = e.target.closest('.playpause-track1');
            if (_this.currentIndex == songNode.getAttribute('data-index') && _this.isPlaying == true) {
                audio.pause();
                songNode.innerHTML = '<i class="fa fa-play-circle fa-3x"></i>';
            } else {
                document.querySelector(`[data-index="${_this.currentIndex}"]`).innerHTML = '<i class="fa fa-play-circle fa-3x"></i>';
                songNode.innerHTML = '<i class="fa fa-pause-circle fa-3x"></i>';
                _this.currentIndex = songNode.getAttribute('data-index')
                _this.loadCurrentSong()
                audio.play()
            }
        }
    },
    nextSong: function () {
        document.querySelector(`[data-index="${this.currentIndex}"]`).innerHTML = '<i class="fa fa-play-circle fa-3x"></i>';
        this.currentIndex++;
        if (this.currentIndex >= this.songs.length) {
            this.currentIndex = 0;
        }
        this.loadCurrentSong()
    },
    convertTime: function (time) {
        let mins = Math.floor(time / 60);
        let secs = Math.floor(time % 60);
        if (mins < 10) {
            mins = '0' + mins;
        }
        if (secs < 10) {
            secs = '0' + secs;
        }
        return `${mins}:${secs}`;
    },
    prevSong: function () {
        document.querySelector(`[data-index="${this.currentIndex}"]`).innerHTML = '<i class="fa fa-play-circle fa-3x"></i>';
        this.currentIndex--;
        if (this.currentIndex < 0) {
            this.currentIndex = this.songs.length - 1;
        }
        this.loadCurrentSong()
    },
    start: function () {
        this.defineProperties();
        this.handleEvents();
        this.loadCurrentSong()
    }
}

app.start();
