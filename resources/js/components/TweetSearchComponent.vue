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
        <input type="text" v-model="termsName" placeholder="条件の名前を入力">
        <button @click='saveTerms'>条件を保存</button>
        <br>
        <select v-model="selectedTerm">
            <option disabled value="">条件を選択</option>
            <option v-for="savedTerm in savedTerms" v-bind:key="savedTerm.id">
                <p v-if="savedTerm.id!==0">
                    {{ savedTerm.name }}
                </p>
            </option>
        </select>
        <p v-if="error.length > 0">
            {{ error }}
        </p>
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
            termsName: '',
            selectedTerm: '',
            savedTerms: [],
            error: '',
        }
    },
    mounted() {
        if (localStorage.getItem('savedTerms') !== null) {
            // ローカルストレージの整合性確認（savedTermsの条件が存在しているか）
            JSON.parse(localStorage.getItem('savedTerms')).forEach(function(element){
                if (localStorage.getItem(element.name) !== null) {
                    this.savedTerms.push(element);
                } else {
                    this.error = '【ERROR】ローカルストレージから条件「' + element.name + '」が削除されています';
                }
            }.bind(this));
        }
    },
    watch: {
        selectedTerm: function(){
            this.terms = JSON.parse(localStorage.getItem(this.selectedTerm));
        },
        savedTerms: function(){
            localStorage.setItem('savedTerms', JSON.stringify(this.savedTerms));
        }
    },
    methods: {
        saveTerms(){
            if (this.termsName.length != 0) {
                localStorage.setItem(this.termsName, JSON.stringify(this.terms));
                this.savedTerms.push({id: this.savedTerms.length + 1, name: this.termsName});
                localStorage.setItem('savedTerms', JSON.stringify(this.savedTerms));
            } else {
                alert('条件名を入力してください');
            }
        },
    }
}
</script>

<style scoped>
.tweet_search {
    padding:15px;
    background-color:skyblue;
}
</style>