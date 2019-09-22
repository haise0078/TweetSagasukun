<template>
<div class="parent">
    <!-- <div class="position-sticky search-btn">
        <button class="toggle_form btn btn-primary" v-show="!open_form" @click="toggleForm"><i class="fas fa-search-plus"></i></button>
        <button class="toggle_form btn btn-primary" v-show="open_form" @click="toggleForm"><i class="fas fa-search-minus"></i></button>
        <tweet-search-component v-show="open_form" :result="result" :selectedTerm="selectedTerm" v-on:searched="getResult" v-on:saved="getSavedTerms"></tweet-search-component>
    </div> -->
    <!-- <nav class="sidebar">
        <div class="remote-controller sticky-sidebar">
            <button class="btn btn-primary controll-btn" v-show="savedTerms.length > 0" @click="toggleShowTerms"><i class="fas fa-bars"></i></button>
            <select-term-component class="sticky-sidebar" v-bind:showTerms="showTerms" v-bind:savedTerms="savedTerms" v-on:selected="getSelectedTerm"></select-term-component>
        </div>
    </nav> -->
    <!-- <tweet-show-component v-for="tweet in result" :key="tweet.id" v-bind:tweet="tweet"></tweet-show-component> -->
    <nav id="sidebar" class="sidebar-wrapper">
        <div class="sidebar-content">
            <ul>
                <li class="header-menu">
                    <span>MENU</span>
                </li>
                <li class="sidebar-dropdown">
                    <!-- <button class="toggle_form btn btn-primary" v-show="!open_form" @click="toggleForm"><i class="fas fa-search-plus"></i></button> -->
                    <a href="#" class="toggle_form" v-show="!open_form" @click="toggleForm"><i class="fas fa-search-plus"></i></a>
                    <!-- <button class="toggle_form btn btn-primary" v-show="open_form" @click="toggleForm"><i class="fas fa-search-minus"></i></button> -->
                    <a href="#" class="toggle-form" v-show="open_form" @click="toggleForm"><i class="fas fa-search-minus"></i></a>
                    <tweet-search-component v-show="open_form" :result="result" :selectedTerm="selectedTerm" v-on:searched="getResult" v-on:saved="getSavedTerms"></tweet-search-component>
                </li>
                <li>
                    <a href="#" @click="toggleShowTerms">
                        <i class="fas fa-list"></i><span>保存条件</span>
                    </a>
                    <select-term-component class="sticky-sidebar" v-bind:showTerms="showTerms" v-bind:savedTerms="savedTerms" v-on:selected="getSelectedTerm"></select-term-component>
                </li>
            </ul>
        </div>
    </nav>
    <div class="main-contents">
        <tweet-show-component v-for="tweet in result" :key="tweet.id" v-bind:tweet="tweet"></tweet-show-component>
    </div>
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
    .sidebar-wrapper {
        width: 260px;
        height: 100%;
        max-height: 100%;
        position: fixed;
        top: 55px;
        left: 0px;
        z-index: 999;
    }
    .parent {
        position:relative;
    }
    .main-contents {
        margin-left: 260px
    }
    .sidebar-content {
        max-height: calc(100% - 30px);
        height: calc(100% - 30px);
        overflow-y: auto;
        position: relative;
        padding-bottom: 2rem;
        font-size: 1.0rem;
        border-right: 1px groove #4DB6AC;
    }
    .sidebar-wrapper ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }
    .sidebar-wrapper li {
        border-bottom: 1px groove #4DB6AC;
    }
    .sidebar-wrapper ul li a {
        display: inline-block;
        width: 100%;
        text-decoration: none;
        position: relative;
        padding: 8px 30px 8px 20px;
    }
    .header-menu {
        font-weight: bold;
        width: 100%;
        font-size: 0.8rem;
        padding: 15px 20px 5px 20px;
        display: inline-block;
    }
</style>