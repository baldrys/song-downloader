<template>
    <div v-if="status !== 'completed'" class="song">
        <span class="song__title">{{ title }}</span>
        <a class="song__download" @click="prepareSong">
            <img class="song__download-icon" src="/images/downloadIcon.png" />
        </a>
        <div v-if="status === 'in_progress'" class="overlay">
            <span class="song__title-downloading"
                >Processing the song ...
            </span>
            <div class="loader"></div>
        </div>
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
        };
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
            let response = await Api.getStatus(this.downloadId);
            this.status = response.data.status;
            console.log("status", this.status);
            if (this.status === "completed") {
                clearInterval(this.interval);
                const downloaded = await Api.downloadSong(this.downloadId);
                let blob = new Blob([downloaded.data], { type: "audio/mpeg" });
                let link = document.createElement("a");
                const fileName = downloaded.headers["content-disposition"]
                    .split("filename=")[1]
                    .replace(/['"]+/g, "");
                link.setAttribute("download", fileName);
                link.href = window.URL.createObjectURL(blob);
                link.click();
            }
            if (this.status === "failed") {
                clearInterval(this.interval);
            }
        }
    },
    beforeDestroy() {
        clearInterval(this.interval);
    }
};
</script>

<style>
.song {
    position: relative;
    background: #85c1d4;
    border: 1px solid #000000;
    padding: 10px;
    filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.5));
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    position: relative;
}
.song__title-downloading,
.song__title {
    font-size: 20px;
    line-height: 29px;
    font-family: "Rowdies", cursive;
    font-weight: 400;
    padding-left: 20px;
}
.overlay {
    position: absolute; /* Sit on top of the page content */
    display: flex;
    width: 100%; /* Full width (cover the whole page) */
    height: 100%; /* Full height (cover the whole page) */
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: white; /* Black background with opacity */
    z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
    flex-direction: column;
    padding-top: 20px;
    box-sizing: border-box;
    align-items: center;
}
.song__download {
    cursor: pointer;
}
.song__download:hover {
    opacity: 0.5;
}
/* SPINNER */

.loader,
.loader:before,
.loader:after {
    border-radius: 50%;
    width: 2.5em;
    height: 2.5em;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
    -webkit-animation: load7 1.8s infinite ease-in-out;
    animation: load7 1.8s infinite ease-in-out;
}
.loader {
    color: #85c1d4;
    font-size: 10px;
    /* margin: 80px auto; */
    position: absolute;
    /* top: 10%;
    right: 45%; */
    text-indent: -9999em;
    -webkit-transform: translateZ(0);
    -ms-transform: translateZ(0);
    transform: translateZ(0);
    -webkit-animation-delay: -0.16s;
    animation-delay: -0.16s;
}
.loader:before,
.loader:after {
    content: "";
    position: absolute;
    top: 0;
}
.loader:before {
    left: -3.5em;
    -webkit-animation-delay: -0.32s;
    animation-delay: -0.32s;
}
.loader:after {
    left: 3.5em;
}
@-webkit-keyframes load7 {
    0%,
    80%,
    100% {
        box-shadow: 0 2.5em 0 -1.3em;
    }
    40% {
        box-shadow: 0 2.5em 0 0;
    }
}
@keyframes load7 {
    0%,
    80%,
    100% {
        box-shadow: 0 2.5em 0 -1.3em;
    }
    40% {
        box-shadow: 0 2.5em 0 0;
    }
}
/* SPINNER */
</style>
