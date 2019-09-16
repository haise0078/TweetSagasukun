<template>
<div class="parent">
    <div class="position-sticky search-btn">
        <button class="toggle_form btn btn-primary" v-show="!open_form" @click="toggleForm"><i class="fas fa-search-plus"></i></button>
        <button class="toggle_form btn btn-primary" v-show="open_form" @click="toggleForm"><i class="fas fa-search-minus"></i></button>
        <tweet-search-component v-show="open_form" :result="result" :selectedTerm="selectedTerm" v-on:searched="getResult" v-on:saved="getSavedTerms"></tweet-search-component>
    </div>
    <tweet-show-component v-for="tweet in result" :key="tweet.id" v-bind:tweet="tweet"></tweet-show-component>
    <nav class="sidebar">
        <select-term-component class="sticky-sidebar" v-show="savedTerms.length > 0" v-bind:selectedTerm="selectedTerm" v-bind:savedTerms="savedTerms" v-on:selected="getSelectedTerm"></select-term-component>
    </nav>
</div>
</template>

<script>
export default {
    data: function() {
        return{
            open_form: false,
            result: {},
            savedTerms: [],
            selectedTerm: '',
        }
    },
    methods: {
        toggleForm: function(){
            this.open_form = !this.open_form;
        },
        getResult: function(result){
            this.result = result;
        },
        getSavedTerms: function(savedTerms){
            this.savedTerms = savedTerms;
        },
        getSelectedTerm: function(selectedTerm){
            this.selectedTerm = selectedTerm;
        }
    }
}
</script>>

<style scoped>
    .toggle_form {
        width:100%;
        height:48px;
        font-size:25px;
    }
    .parent {
        position:relative;
    }
    .sticky-sidebar {
        position:fixed;
        left: 0;
        top: 55px;
        width:3rem;
    }
    button {
        background-color:#1E88E5;
        color:white;
    }
    .search-btn {
        top:55px; 
        z-index:1000;
    }
</style>