<template>
    <div>
        <div v-show="showTerms" class="nav flex-column nav-terms">
            <ul class="nav flex-column">
                <li class="nav-item" v-for="savedTerm in savedTerms" :key="savedTerm.id">
                    <button class="btn btn-primary selected-btn" @click="selectedTerm = savedTerm.name"><i class="fas fa-check"  v-show="savedTerm.name===selectedTerm"></i>{{ savedTerm.name }}</button>
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
.controll-btn {
    height: 48px;
    width: 48px;
    font-size: 25px;
    background-color:#66BB6A;
    color:white;
}
.nav-terms{
    position:fixed;
    z-index: 1020;
    top:103px;
    left:0;
    overflow: visible scroll;
}
.selected-btn {
    color:white;
    background-color:#81C784;
    width:20rem;
}
</style>