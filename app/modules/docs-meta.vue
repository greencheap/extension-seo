<template>
    <div>
        <module-seo :module.sync="query" :moduleType="'default'"/>
    </div>
</template>

<script>
import ModuleSeo from '../components/module-seo.vue';
let seo = {

    props: ['query'],

    section:{
        label: 'SEO',
        priority: 200
    },

    components: {
        ModuleSeo
    }
}

export default seo;

window.Docs.components['docs-meta'] = seo;

</script>