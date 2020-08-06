<template>
    <div>
        <module-seo :module.sync="node" :moduleType="'default'"/>
    </div>
</template>

<script>
import ModuleSeo from '../components/module-seo.vue';
let seo = {

    props: ['node'],

    section:{
        label: 'SEO',
        priority: 200
    },

    components: {
        ModuleSeo
    }
}

export default seo;

window.Site.components['node-meta'] = seo;

</script>