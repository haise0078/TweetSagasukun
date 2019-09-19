<template>
<div class="parent">
    <div class="position-sticky search-btn">
        <button class="toggle_form btn btn-primary" v-show="!open_form" @click="toggleForm"><i class="fas fa-search-plus"></i></button>
        <button class="toggle_form btn btn-primary" v-show="open_form" @click="toggleForm"><i class="fas fa-search-minus"></i></button>
        <tweet-search-component v-show="open_form" :result="result" :selectedTerm="selectedTerm" v-on:searched="getResult" v-on:saved="getSavedTerms"></tweet-search-component>
    </div>
    <tweet-show-component v-for="tweet in result" :key="tweet.id" v-bind:tweet="tweet"></tweet-show-component>
    <nav class="sidebar">
        <div class="remote-controller sticky-sidebar">
            <button class="btn btn-primary controll-btn" v-show="savedTerms.length > 0" @click="toggleShowTerms"><i class="fas fa-bars"></i></button>
            <select-term-component class="sticky-sidebar" v-bind:showTerms="showTerms" v-bind:savedTerms="savedTerms" v-on:selected="getSelectedTerm"></select-term-component>
        </div>
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
            showTerms: false,
        }
    },
    methods: {
        toggleForm: function(){
            this.open_form = !this.open_form;
            this.showTerms = false;
        },
        getResult: function(result){
            this.result = result;
        },
        getSavedTerms: function(savedTerms){
            this.savedTerms = savedTerms;
        },
        getSelectedTerm: function(selectedTerm){
            this.selectedTerm = selectedTerm;
        },
        toggleShowTerms: function(){
            this.showTerms = !this.showTerms;
            this.open_form = false;
        },
    }
}
</script>>

<style scoped>
    .controll-btn {
        height: 48px;
        width: 48px;
        font-size: 25px;
        background-color:#66BB6A;
        color:white;
    }
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