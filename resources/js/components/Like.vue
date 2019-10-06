<template>
    <div>
        <button v-if="!liked" type="button" class="btn btn-primary" @click="like(answerId)">いいね{{likeCount}}</button>
        <button v-else type="button" class="btn btn-primary" @click="unlike(answerId)">いいね{{likeCount}}</button>
    </div>
</template>

<script>
    export default {
        props: ['answerId','userId', 'defaultLiked', 'defaultCount'],
        data(){
            return{
                liked:false,
                likeCount: 0,
            };
        },

        created(){
            this.liked = this.defaultLiked
            this.likeCount = this.defaultCount
        },

        methods:{
            like(answerId){
                let url = `/api/answers/${answerId}/like`

                axios.post(url, {
                    user_id: this.userId
                })
                .then(response => {
                    this.liked = true
                    this.likeCount = response.data.likeCount
                })
                .catch(error => {
                    alert(error)
                });
            },
        
            unlike(answerId){
                let url = `/api/answers/${answerId}/unlike`

                axios.post(url, {
                    user_id: this.userId
                })
                .then(response => {
                    this.liked = false
                    this.likeCount = response.data.likeCount
                })
                .catch(error => {
                    alert(error)
                });
            }
        }

    }
</script>