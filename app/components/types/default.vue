<template>
    <div>
        <div class="uk-margin">
            <input-image-meta v-model="module.data.meta.type.image" :image.sync="module.data.meta.type.image" class="pk-image-max-height" />
        </div>
    </div>
</template>

<script>
    export default {
        props:['module'],

        name: 'StructuredProperties',

        ModulesSeo:{
            label: 'default'
        },

        created(){
            if (!this.module.data.meta.type) {
            this.$set(this.module.data.meta, 'type', { 
                'image': {
                    src:'',
                    alt:''
                },
            });
        }
        }
    }
</script>