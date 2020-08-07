<template>
    <div>
        <module-seo :module.sync="category" :moduleType="'default'"/>
    </div>
</template>

<script>
import ModuleSeo from '../components/module-seo.vue';
let seo = {

    props: ['category'],

    section:{
        label: 'SEO',
        priority: 200
    },

    components: {
        ModuleSeo
    }
}

export default seo;

window.Categories.components['node-meta'] = seo;

</script>