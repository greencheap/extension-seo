<template>
    <div>
        <seo-module :data.sync="category.data"></seo-module>
    </div>
</template>

<script>
import SeoModule from "../components/seo-module.vue";


const CategoryMeta = {

    section: {
        label: 'Meta',
        priority: 100,
    },

    props:['category'],

    components:{
        SeoModule
    }
};

export default CategoryMeta;

window.Categories.components['blog-category-meta'] = CategoryMeta;

</script>
