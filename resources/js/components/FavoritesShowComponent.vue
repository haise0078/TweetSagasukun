<template>
<div>
    <favorite-show-component v-for="tweet in result" :key="tweet.id" v-bind:tweet="tweet.tweet_json" v-bind:saved="saved"></favorite-show-component>
</div>
</template>

<script>
export default {
    props: ["result"],
    data: function() {
        return{
            saved: true,
        }
    },
}
</script>>

<style scoped>

</style>