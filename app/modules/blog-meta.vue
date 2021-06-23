<template>
    <div>
        <seo-module :data.sync="post.data"></seo-module>
    </div>
</template>

<script>
import SeoModule from "../components/seo-module.vue";


const PostMeta = {

    section: {
        label: 'Meta',
        priority: 100,
    },

    props:['post'],

    components:{
        SeoModule
    }
};

export default PostMeta;

window.Post.components['post-meta'] = PostMeta;

</script>
