<template>

    <div class="col-md-8 blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title">Страница создания статьи</h2>
            <form method="POST" action="">
                    <div class="form-group">
                    <div class="form-group form-check">
                        <input type="checkbox" id="checkbox" v-model="checked">
                        <label for="checkbox">Подписка</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                    </div>
                </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            checked: false,
        }
    },
    mounted() {
        console.log('Component mounted.');
    },
    methods: {

    }
};
</script>
