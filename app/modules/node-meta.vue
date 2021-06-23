<template>
    <div>
        <seo-module :data.sync="node.data"></seo-module>
    </div>
</template>

<script>
import SeoModule from "../components/seo-module.vue";

const Meta = {
    section: {
        label: "Meta",
        priority: 100,
    },

    props: ["node"],

    components: {
        SeoModule,
    },
};

export default Meta;

window.Site.components["node-meta"] = Meta;
</script>
