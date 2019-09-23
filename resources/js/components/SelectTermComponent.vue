<template>
    <div>
        <div v-show="showTerms" class="nav flex-column nav-terms">
            <ul class="nav flex-column">
                <li class="nav-item" v-for="savedTerm in savedTerms" :key="savedTerm.id">
                    <a href="#" class="selected-btn" @click="selectedTerm = savedTerm.name"><i class="fas fa-check"  v-show="savedTerm.name===selectedTerm"></i>{{ savedTerm.name }}</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    data: function(){
        return{
            selectedTerm: '',
        }
    },
    props: {
        savedTerms: Array,
        showTerms: false,
    },
    mounted() {
        // 初期クエリ発行
        let savedTerms = JSON.parse(localStorage.getItem('savedTerms'));
        console.log(savedTerms);
        this.selectedTerm = savedTerms.shift().name;
    },
    watch: {
        selectedTerm: function(){
            console.log("selected");
            this.$emit('selected', this.selectedTerm);
        }
    },
}
</script>

<style scoped>
    .nav-item {
        display: inline-block;
        width: 100%;
        text-decoration: none;
        position: relative;
        padding: 8px 30px 8px 20px;
        border-bottom: 1px groove #4DB6AC;
    }
    .nav-item a {
        color: black;
    }
    .nav-item a:hover {
        color: #818896;
    }
</style>