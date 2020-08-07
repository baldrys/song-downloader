<template>
    <div class="song">
        <span class="song__title">{{ title }}</span>
        <a class="song__download" @click="prepareSong">
            <img class="song__download-icon" src="/images/downloadIcon.png" />
        </a>
        {{ status }}
    </div>
</template>

<script>
import Api from "../api";

export default {
    name: "song",
    props: {
        title: String,
        id: String
    },
    data() {
        return {
            status: null,
            downloadId: 0,
            interval: ""
        }
    },
    methods: {
        async prepareSong() {
            const response = await Api.prepareSong(this.id);
            this.downloadId = response.data.id;
            console.log(this.downloadId);
            this.interval = setInterval(this.checkStatus, 2000);
            this.checkStatus();
        },

        async checkStatus() {
            let response =  await Api.getStatus(this.downloadId);
            this.status = response.data.status;
            console.log("status", this.status);
            if(this.status === "completed"){
                clearInterval(this.interval);
                const downloaded = await Api.downloadSong(this.downloadId);
                let blob = new Blob([downloaded.data], { type: 'audio/mpeg' });
                let link = document.createElement('a');
                const fileName = downloaded.headers["content-disposition"].split("filename=")[1].replace(/['"]+/g, '');
                link.setAttribute('download', fileName);
                link.href = window.URL.createObjectURL(blob)
                link.click();
            }
                
        },   
    },
    beforeDestroy() {
        clearInterval(this.interval);
    }
};
</script>

<style>
.song {
    background: #85c1d4;
    border: 1px solid #000000;
    padding: 10px;
    filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.5));
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}
.song__title {
    font-size: 20px;
    line-height: 29px;
    font-family: "Rowdies", cursive;
    font-weight: 400;
    padding-left: 20px;
}
.song__download {
    cursor: pointer;
}
.song__download:hover {
    opacity: 0.5;
}
</style>
