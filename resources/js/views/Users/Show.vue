<template>
    <div>
        <div class="w-100 h-64 overflow-hidden">
            <img src="https://www.technocrazed.com/wp-content/uploads/2015/12/Landscape-wallpaper-7.jpg" alt="user background-image" class="object-cover w-full">
        </div>
    </div>
</template>

<script>
export default {
    name: "Show",
    data: () => {
        return {
            user: null,
            loading: true,
        }
    },
    mounted()
    {
        axios.get('/api/users/' + this.$route.params.userId)
        .then( res => {
            this.user = res.data;
            })
        .catch(
            error => {
                console.log('Unable to fetch the users data from server');
            }
        )
        .finally(() => {
            this.loading = false
        });

        axios.get('/api/posts' + this.$route.params.userId)
            .then(res => {
                this.posts = res.data;
                this.loading = false;
            })
            .catch(error => {
                console.log('Unable to fetch posts');
                this.loading = false;
            });
    }
}
</script>

<style scoped>

</style>
