<template>
    <div class="tweet_search">
        <h2 class="title">Search tweets</h2>
        <form @submit.prevent="searchTweets">
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
        <p v-if="error.length > 0">
            {{ error }}
        </p>
    </div>
</template>

<script>
export default {
    props: {
        selectedTerm: String,
    },
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
            query: '',
            termsName: '',
            savedTerms: [],
            error: '',
            result: {},
        }
    },
    created() {
        let savedTerms = JSON.parse(localStorage.getItem('savedTerms'));
        if (savedTerms !== null) {
            // ローカルストレージの整合性確認（savedTermsの条件が存在しているか）
            JSON.parse(localStorage.getItem('savedTerms')).forEach(function(element){
                if (localStorage.getItem(element.name) !== null) {
                    console.log(element);
                    this.savedTerms.push(element);
                } else {
                    this.error = '【ERROR】ローカルストレージから条件「' + element.name + '」が削除されています';
                }
            }.bind(this));
            // 親コンポーネントと同期
            this.$emit('saved', this.savedTerms);
        }
    },
    watch: {
        selectedTerm: function(){
            this.terms = JSON.parse(localStorage.getItem(this.selectedTerm));
            this.searchTweets();
        },
    },
    methods: {
        searchTweets(){
            this.createQuery();
            axios.post('/tweet/search', {
                query: this.query
            }).then(res=>{
                if(typeof(res.data) === "object"){
                    this.result = res.data;
                }
                console.log(res.data);
                this.$emit('searched', this.result);
            }).catch(function(error){
                if (error.response) {
                    console.log(error.response.data);
                    console.log(error.response.status);      
                    console.log(error.response.statusText);
                    console.log(error.response.headers);
                } else if (error.request) {
                    console.log(error.request);
                } else {
                    console.log('Error', error.message);
                }
            });
        },
        saveTerms(){
            if (this.termsName.length > 0) {
                if (localStorage.getItem(this.termsName) !== null) {
                    if (window.confirm("条件「" + this.termsName + "」を上書きします")) {
                        localStorage.setItem(this.termsName, JSON.stringify(this.terms));
                        // 親コンポーネントと同期
                        this.$emit('saved', this.savedTerms);
                    }
                    return;
                } else {
                    localStorage.setItem(this.termsName, JSON.stringify(this.terms));
                    this.savedTerms.push({id: this.savedTerms.length + 1, name: this.termsName});
                    localStorage.setItem('savedTerms', JSON.stringify(this.savedTerms));
                    // 親コンポーネントと同期
                    this.$emit('saved', this.savedTerms);
                }
            } else {
                alert('条件名を入力してください');
                return;
            }
        },
        createQuery(){
            let query_buffer ='';
            if (this.terms.keyword.length > 0) {
                query_buffer += this.terms.keyword;
            }
            if (this.terms.exclude_keyword.length > 0) {
                let temp = this.terms.exclude_keyword.split(' ');
                let temp2 = temp.map(function(element){
                    return('-' + element);
                });
                temp2.forEach(function(element){
                    query_buffer = query_buffer + ' ' + element;
                })
            }
            if (this.terms.hash_tag.length > 0) {
                let temp = this.terms.hash_tag.split(' ');
                let temp2 = temp.map(function(element){
                    return('#' + element);
                });
                temp2.forEach(function(element){
                    query_buffer = query_buffer + ' ' + element;
                })
            }
            if (this.terms.image) {
                query_buffer = query_buffer + ' ' + 'filter:images';
            }
            if (this.terms.video) {
                query_buffer = query_buffer + ' ' + 'filter:videos';
            }
            if (this.terms.exclude_retweet) {
                query_buffer = query_buffer + ' ' + 'exclude:retweets';
            }
            if (this.terms.exclude_reply) {
                query_buffer = query_buffer + ' ' + 'exclude:replies';
            }
            if (this.terms.favorite_num > 0) {
                query_buffer = query_buffer + ' ' + 'min_faves:' + this.terms.favorite_num;
            }
            if (this.terms.retweet_num > 0) {
                query_buffer = query_buffer + ' ' + 'min_retweets:' + this.terms.retweet_num;
            }
            this.query = query_buffer;
            console.log(this.query);
        }
    }
}
</script>

<style scoped>
.tweet_search {
    padding:15px;
    background-color:#64B5F6;
}
</style>