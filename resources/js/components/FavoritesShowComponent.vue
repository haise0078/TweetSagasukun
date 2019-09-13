<template>
<div>
    <input type="text" v-model="message">{{ message }}
        <tweet-show-component v-for="tweet in result" :key="tweet.id" v-bind:tweet="tweet.tweet_json">
        </tweet-show-component>
</div>
</template>

<script>
export default {
    props: ["result"],
    data: function() {
        return{
            message: "default",
        }
    },
}
</script>>

<style scoped>

</style>