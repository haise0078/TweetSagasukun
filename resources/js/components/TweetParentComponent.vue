<template>
<div>
    <div>
        <button class="open_form" v-show="!open_form" @click="toggleForm"><i class="fas fa-search-plus"></i></button>
        <button class="close_form" v-show="open_form" @click="toggleForm"><i class="fas fa-search-minus"></i></button>
    </div>
    <tweet-search-component v-show="open_form" :result="result" v-on:searched="getResult"></tweet-search-component>
    <tweet-show-component v-for="tweet in result" :key="tweet.id" v-bind:tweet="tweet" :message="message">
    </tweet-show-component>
</div>
</template>

<script>
export default {
    data: function() {
        return{
            message: "default",
            open_form: false,
            result: {},
        }
    },
    methods: {
        toggleForm: function(){
            this.open_form = !this.open_form;
        },
        getResult: function(result){
            this.result = result;
        }
    }
}
</script>>

<style scoped>

</style>