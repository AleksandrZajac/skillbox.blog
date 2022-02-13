<template>
    <div class="col-md-8 blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title">Подписка</h2>
            <form method="POST" action="/api/subscribe">
                <input type="checkbox" id="checkbox" v-model="checked" @change="addSubscribe()">
                <label for="checkbox">{{ message }}</label>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    props: ['user_id'],
    data: function() {
        return {
            checked: false,
            subscribe_id: 0,
            message: ''
        }
    },
    mounted() {
        this.showSubscribe();
    },
    methods: {
        addSubscribe: function() {
            axios.post('/api/subscribe', {
                subscribe_id: this.checked,
                user_id: this.user_id,
                message: this.getMessage(),
            });
        },
        showSubscribe: function() {
            axios.get('/show/subscribe').then((response) => {
                this.checked = response.data;
            });
        },
        getMessage: function(){
            if (this.checked) {
                this.message = 'Вы подписались на канал вебсокет';
            } else {
                this.message = 'Вы отменили подписку на канал вебсокет';
            }
        }
    }
};
</script>
