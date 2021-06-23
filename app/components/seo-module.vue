<template lang="html">
    <div class="uk-form-horizontal">
        <div class="uk-margin">
            <label for="form-meta-title" class="uk-form-label">{{ "Title" | trans }}</label>
            <div class="uk-form-controls">
                <input id="form-meta-title" v-model="data.meta['og:title']" class="uk-form-width-large uk-input"
                       type="text"/>
            </div>
        </div>

        <div class="uk-margin">
            <label for="form-meta-description" class="uk-form-label">{{ "Description" | trans }}</label>
            <div class="uk-form-controls">
                <textarea id="form-meta-description" v-model="data.meta['og:description']"
                class="uk-form-width-large uk-textarea" rows="5" type="text"/>
            </div>
        </div>

        <div class="uk-margin">
            <label for="form-meta-image" class="uk-form-label">{{ "Image" | trans }}</label>
            <div class="uk-form-controls">
                <v-multi-finder v-model="image" :image.sync="image"
                class="pk-image-max-height"/>
            </div>
        </div>
    </div>
</template>

<script>
const SeoModule = {
    props: ["data"],

    data() {
        return {
            image: {
                src: "",
                alt: ""
            }
        }
    },

    watch: {
        "image.src": {
            handler() {
                this.data.meta['og:image'] = this.image.src;
            }, deep: true
        }
    },

    created() {
        if (!this.data.meta) {
            this.$set(this.data, "meta", {
                "og:title": "",
                "og:description": "",
                "og:image": "",
            });
        }

        if (this.data.meta['og:image']) {
            this.image.src = this.data.meta['og:image'];
        }
    },
};

export default SeoModule;
</script>
