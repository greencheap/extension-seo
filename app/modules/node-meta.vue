<template>
    <div>
        <module-seo v-if="node.type != 'external' " :module.sync="node" :moduleType="'default'"/>
        <div v-else class="uk-section uk-text-center">
            <h3 class="uk-margin-remove">{{'No Seo Support For This Data Type' | trans}}</h3>
            <em class="uk-display-block">{{node.type}}</em>
        </div>
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