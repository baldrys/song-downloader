<template>
    <div class="search">
        <div class="search__inner">
            <div class="search__bar">
                <h1 class="search__title">
                    Type the song name
                </h1>
                <div class="search__bar-input">
                    <input
                        class="search__input"
                        type="text"
                        name="songTitle"
                        id="songTitle"
                        v-model="songTitle"
                    />
                    <button class="search__btn" @click="searchSongs">search</button>
                </div>
            </div>

            <div v-if="isSearched" class="finded-songs">
                <hr class="finded-songs__br-line" />
                <h2 class="finded-songs__title">
                    Finded songs:
                </h2>

                <div v-for="song in songs" :key="song.id" class="songs">
                    <Song :title="song.title" :id="song.id" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Song from "../components/Song";
import Api from "../api"

export default {
    name: "search",
    components: { Song },
    data() {
        return {
            songTitle: "",
            songs: [],
            isSearched: false
        }
    },
    methods: {
        async searchSongs() {
            const response = await Api.getSongs(this.songTitle);
            this.songs = response.data.songs;
            this.isSearched = true;
        }
    }
};
</script>

<style>
.search {
    width: 914px;
    background: #dc8080;
    border: 2px solid #030303;
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
}
.search__inner {
    margin: 50px 155px;
}
.search__bar {
    background: #85c1d4;
    border: 1px solid #000000;
    padding-left: 30px;
    filter: drop-shadow(0px 8px 8px rgba(0, 0, 0, 0.5));
}
.search__title {
    font-family: "Rowdies", cursive;
    font-weight: 900;
    margin-left: 30px;
    margin-top: 15px;
    font-size: 40px;
    line-height: 65px;
}

.search__bar-input {
    display: flex;
    align-items: center;
    margin-bottom: 30px;
}

.search__input {
    margin-left: 30px;
    background: #ffffff;
    border: 2px solid #000000;
    box-sizing: border-box;
    box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.5);
    border-radius: 19px;
    line-height: 38px;
    max-width: 400px;
    width: 100%;
    font-size: 20px;
    padding-left: 10px;
}
.search__input:focus {
    outline: none;
}
.search__btn {
    background: #85c1d4;
    border: 2px solid #000000;
    /* box-sizing: border-box; */
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 4px;
    font-weight: bold;
    font-size: 18px;
    line-height: 29px;
    margin-left: 20px;
    padding: 5px;
    display: inline-flex;
    cursor: pointer;
}
.search__btn:active {
    background: #a9d6e4;
}

.finded-songs__br-line {
    margin: 15px 0;
    height: 3px;
    border-width: 0;
    color: rgb(0, 0, 0);
    background-color: rgb(0, 0, 0);
}

.finded-songs__title {
    font-family: "Rowdies", cursive;
    font-weight: 400;
    font-size: 20px;
    line-height: 29px;
}
</style>
