<template>
<div>
    <div id="tweet-show">
        <tweet-show-component v-for="(tweet, index) in result" :key="tweet[index]" v-bind:tweet="tweet">
        </tweet-show-component>
    </div>
</div>
</template>

<script>
export default {
    props: ["result"],
}
</script>>

<style scoped>

</style>