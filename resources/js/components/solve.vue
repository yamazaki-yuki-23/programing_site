<template>
    <div>
        <button v-if="!state" type="button" class="btn btn-danger" @click="solve(postId)" >解決した</button>
        <button v-else type="button" class="btn btn-danger" disabled="disabled">解決済</button>
    </div>
</template>

<script>
    export default {
        props:['postId', 'defaultState'],
        data(){
            return{
                state: false,
            };
        },
        created(){
            this.state = this.defaultState
        },

        methods:{
            solve(postId){
                if(confirm('質問は解決しましたか？')){
                    let url = `/api/posts/${postId}/solve`
    
                    axios.post(url, {
                        user_id: this.userId
                    })
                    .then(response => {
                        this.state = true
                    })
                    .catch(error => {
                        alert(error)
                    });
                }
            },

        }
    }
</script>
