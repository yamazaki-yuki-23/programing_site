<template>
    <div>
        <button v-if="!evaluated" type="button" class="btn btn-primary" @click="evaluate(postId)" >高評価{{goodCount}}</button>
        <button v-else type="button" class="btn btn-primary" @click="unevaluate(postId)" >取り消す{{goodCount}}</button>
    </div>
</template>

<script>
    export default {
        props:['postId', 'userId', 'defaultEvaluated', 'defaultCount'],
        data(){
            return{
                evaluated: false,
                goodCount: 0,
            };
        },
        created(){
            this.evaluated = this.defaultEvaluated
            this.goodCount = this.defaultCount
        },

        methods:{
            evaluate(postId){
                let url = `/api/posts/${postId}/good`
   
                axios.post(url, {
                    user_id: this.userId
                })
                .then(response => {
                    this.evaluated = true
                    this.goodCount = response.data.goodCount

                })
                .catch(error => {
                    alert(error)
                });
            },
            unevaluate(postId){
                let url = `/api/posts/${postId}/ungood`
   
                axios.post(url, {
                    user_id: this.userId
                })
                .then(response => {
                    this.evaluated = false;
                    this.goodCount = response.data.goodCount

                })
                .catch(error => {
                    alert(error)
                });
            }            
        }
    }
</script>
