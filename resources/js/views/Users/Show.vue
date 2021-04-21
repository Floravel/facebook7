<template>
    <div class="flex flex-col items-center">
        <div class="relative mb-8">
            <div class="w-100 h-64 overflow-hidden z-10">
                <img src="https://www.technocrazed.com/wp-content/uploads/2015/12/Landscape-wallpaper-7.jpg" alt="user background-image" class="object-cover w-full">
            </div>
            <div class="absolute bottom-0 left-0 -mb-8 ml-12 z-20 flex items-center">
                <div class="w-32">
                    <img src="https://i.pinimg.com/originals/7c/e9/bf/7ce9bf4925f798487d8a09271af891ab.jpg" alt="user profile image" class="object-cover w-32 h-32 rounded-full border-4 border-gray-200 shadow-2xl">
                </div>
                <p class="ml-4 text-2xl text-gray-200">
                    {{ user.data.attributes.name }}
                </p>
            </div>
        </div>

        <p v-if="postLoading">
            Loading Posts...
        </p>
        <Post v-else v-for="post in posts.data" :key="post.data.post_id" :post="post"/>

        <p v-if="! postLoading && posts.data.length < 1">No posts found. Get started!</p>
    </div>
</template>

<script>

import Post from "../../components/Post";

export default {
    name: "Show",

    components: {
      Post
    },
    data: () => {
        return {
            user: null,
            posts: null,
            userLoading: true,
            postLoading: true,
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
            this.userLoading = false
        });

        axios.get('/api/users/' + this.$route.params.userId + '/posts')
            .then(res => {
                this.posts = res.data;
            })
            .catch(error => {
                console.log('Unable to fetch posts');
            })
            .finally(() => {
                this.postLoading = false
            });
    }
}
</script>

<style scoped>

</style>
