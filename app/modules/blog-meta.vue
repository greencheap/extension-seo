<template>
    <div>
        <module-seo :module.sync="post" :moduleType="'default'"/>
    </div>
</template>

<script>
import ModuleSeo from '../components/module-seo.vue';

let seo = {

    props: ['post'],

    section:{
        label: 'SEO',
        priority: 200
    },

    components: {
        ModuleSeo
    }
}

export default seo;

window.Post.components['post-meta'] = seo;

</script>
