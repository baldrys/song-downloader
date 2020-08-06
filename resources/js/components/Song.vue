<template>
    <div class="song">
        <span class="song__title">{{ title }}</span>
        <a class="song__download">
            <img class="song__download-icon" src="/images/downloadIcon.png" />
        </a>
    </div>
</template>

<script>
export default {
    name: "song",
    props: {
        title: String,
        status: String
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
}
.song__title {
    font-size: 24px;
    line-height: 39px;
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
