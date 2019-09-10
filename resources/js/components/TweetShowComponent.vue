<template>
    <div>
        <div class="card mb-2" v-for="(tweet, index) in result" v-bind:key="index">
            <div class="card-body">
                <div class="media">
                    <img :src="tweet.user.profile_image_url_https" class="rounded-circle mr-4">
                    <div class="media-body">
                        <h5 class="d-inline mr-3"><strong>{{ tweet.user.name }}</strong></h5>
                        <h6 class="d-inline text-secondary">{{ ( (new Date(tweet.created_at)).getFullYear().toString() + "/" + (new Date(tweet.created_at)).getMonth().toString() + "/" + (new Date(tweet.created_at)).getDate().toString() )}}</h6>
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
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["result"],
    computed: {
        resultObject: function(){
            console.log(this.result);
            return JSON.parse(this.result);
        }
    }
}
</script>>

<style scoped>

</style>