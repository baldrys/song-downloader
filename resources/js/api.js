import axios from "axios";
import qs from "qs";

const SEARCH_SONGS = title => `/api/search/${title}`;
const PREPARE_SONG = "/api/prepare";
const GET_STATUS = id => `/api/status/${id}`;
const DOWNLOAD_SONG = id => `/api/download/${id}`

export default {

    getSongs(title) {
        return axios.get(SEARCH_SONGS(title));
    },

    prepareSong(videoId) {
        return axios.post(PREPARE_SONG, { videoId: videoId });
    },
    
    getStatus(id) {
        return axios.get(GET_STATUS(id));
    },

    downloadSong(id) {
        return axios.get(DOWNLOAD_SONG(id), {responseType: 'arraybuffer'});
    },

};
