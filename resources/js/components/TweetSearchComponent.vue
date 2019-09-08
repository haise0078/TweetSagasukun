<template>
    <div class="tweet_search">
        <h2 class="title">Search tweets</h2>
        <form action="/tweet/search" method="POST">
            <input type="hidden" name="_token" :value="csrf">
            <input type="text" v-model="terms.keyword" name="keyword" placeholder="キーワードを入力">
            <input type="text" v-model="terms.hash_tag" name="hash_tag" placeholder="ハッシュタグを入力">
            <input type="text" v-model="terms.exclude_keyword" name="exclude_keyword" placeholder="除外ワードを入力">
            <br>
            <b>画像を含む ：</b><input type="checkbox" v-model="terms.image" name="image">
            <br>
            <b>動画を含む ：</b><input type="checkbox" v-model="terms.video" name='video'>
            <br>
            <b>リツイートを除外 ：</b><input type="checkbox" v-model="terms.exclude_retweet" name="exclude_retweet" checked="checked">
            <br>
            <b>リプライを除外 ：</b><input type="checkbox" v-model="terms.exclude_reply" name="exclude_reply" checked="checked">
            <br>
            <b>いいね数 ：</b><input type="text" v-model="terms.favorite_num" name="favorite_num" placeholder="いいね数を指定"><b>以上</b>
            <br>
            <b>リツイート数 ：</b><input type="text" v-model="terms.retweet_num" name="retweet_num" placeholder="リツイート数を指定"><b>以上</b>
            <br>
            <input type="submit" value="検索">
            <br>
        </form>
        <button @click='saveTerms'>検索条件を保存</button>
        <input type="text" v-model="termsName">
        <br>
        <button @click='selectTerm'>検索条件を反映</button>
        <select v-model="selectedTerm">
            <option disabled value="">条件を選択</option>
            <option v-for="savedTerm in savedTerms" v-bind:key="savedTerm.id">
                {{ savedTerm.name }}
            </option>
        </select>
    </div>
</template>

<script>
export default {
    data: function(){
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            terms: {
                keyword: '',
                hash_tag: '',
                exclude_keyword: '',
                image: false,
                video: false,
                exclude_retweet: true,
                exclude_reply: true,
                favorite_num: 0,
                retweet_num: 0,
            },
            termsName: '保存条件1',
            selectedTerm: '',
            savedTerms: [{id: 0, name: ''}],
        }
    },
     mounted() {
        if (localStorage.getItem(this.termsName)) {
            this.terms = JSON.parse(localStorage.getItem(this.termsName));
            console.log(localStorage.getItem(this.termsName));
        }
        if (localStorage.savedTerms) {
            this.savedTerms = JSON.parse(localStorage.getItem('savedTerms'));
            console.log(this.savedTerms);
        }
    },
    methods: {
        saveTerms(){
            localStorage.setItem(this.termsName, JSON.stringify(this.terms));
            console.log(this.termsName);
            this.savedTerms.push({id: this.savedTerms.length, name: this.termsName});
            // this.$set(this.savedTerms, this.savedTerms.length, this.termsName);
            localStorage.setItem('savedTerms', JSON.stringify(this.savedTerms));
            console.log(this.savedTerms.length);
        },
        selectTerm(){
            this.terms = JSON.parse(localStorage.getItem(this.selectedTerm));
        }
    }        
}
</script>

<style scoped>
.tweet_search {
    padding:15px;
    background-color:skyblue;
}
</style>