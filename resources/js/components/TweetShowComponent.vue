<template>
    <div class="card mb-2">
        <div class="card-body">
            <div class="media">
                <img :src="tweet.user.profile_image_url_https" class="rounded-circle mr-4">
                <div class="media-body">
                    <h5 class="d-inline mr-3"><strong>{{ tweet.user.name }}</strong></h5>
                    <h6 class="d-inline text-secondary">{{ ( (new Date(tweet.created_at)).getFullYear().toString() + "/" + ((new Date(tweet.created_at)).getMonth()+ 1).toString() + "/" + (new Date(tweet.created_at)).getDate().toString() )}}</h6>
                    <p class="mt-3 mb-0">{{ (tweet.full_text).replace(/https:\/\/t.co\/[a-zA-Z0-9]*/, '') }}</p>
                    <div v-if="tweet.entities.media!==null && tweet.entities.media!==undefined">

                    </div>
                        <div class="image-box" v-for="(media, index) in tweet.entities.media" :key="index">
                            <img :src="media.media_url" class="rounded tweet-image">
                        </div>
                </div>
            </div>
        </div>
        <div class="card-footer bg-white border-top-0">
            <div class="d-flex flex-row justify-content-end">
                <div class="mr-5"><i class="fas fa-retweet text-secondary"></i>{{ tweet.retweet_count }}</div>
                <div class="mr-5"><i class="far fa-heart text-secondary"></i>{{ tweet.favorite_count }}</div>
                <div class="mr-5"><button v-show="!saved" @click.once="saveTweet()"><i class="far fa-bookmark" ></i></button><button v-show="saved" @click.once="saveTweet()"><i class="fas fa-bookmark" ></i></button></div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function(){
        return{
            saved: false,
        }
    },
    props: {
        tweet:Object,
    },
    methods: {
        saveTweet: function(){
            axios.post('/tweet/save/', {
                tweet: this.tweet
                }).then(res=>{
                    if(res.data === 'save_successed'){
                        this.saved = !this.saved;    
                    }
                }
                ).catch(function(error){
                if (error.response) {
                    console.log(error.response.data);
                    console.log(error.response.status);      // 例：400
                    console.log(error.response.statusText);  // Bad Request
                    console.log(error.response.headers);
                } else if (error.request) {
                    console.log(error.request);
                } else {
                    console.log('Error', error.message);
                }
            });
        },
    },
}
</script>>

<style scoped>
.image-box{
    max-width: 100%;
    max-height: 20rem;
}

.tweet-image{
    max-width: 100%;
    max-height: 20rem;
}
.media-body{
    max-width: 80%;
}
</style>