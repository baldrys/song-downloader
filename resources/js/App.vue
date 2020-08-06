<template>
    <main class="app-container">
        <Search />
    </main>
</template>

<script>
import Search from "./components/Search";

export default {
    name: "app",
    components: { Search }
};
</script>

<style>
/* Normalize */

body,
h1 {
    margin: 0;
    padding: 0;
}

/* Normalize */

.app-container {
    align-items: center;
    padding-top: 50px;
    box-sizing: border-box;
    flex-direction: column;
    background: #e2b5b5;
    display: flex;
    height: 100vh;
}
</style>
