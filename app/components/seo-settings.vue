<template>
    <form class="uk-margin-large" @submit.prevent="save">
        <div class="uk-modal-header">
            <h1 class="uk-h3">{{ 'Seo Settings' | trans }}</h1>
        </div>
        <div class="uk-modal-body">
            <div>
                <label class="uk-form-label">Robots.txt</label>
                <div class="uk-form-controls">
                    <textarea v-model="robotsTxt" class="uk-textarea uk-width-expand uk-height-medium"></textarea>
                </div>
            </div>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-primary" type="submit">{{ 'Save' | trans }}</button>
        </div>
    </form>
</template>

<script>

    module.exports = {
        name: 'seo',

        settings: true,

        props: ['package'],

        data(){
            return {
                robotsTxt:''
            }
        },

        mounted(){
            this.load();
        },

        methods: {
            load() {
                this.$http.get('admin/api/seo/getconfig').then((res) => {
                    this.$set(this,'robotsTxt' , res.data.robots_txt)
                })
            },

            save() {
               this.$http.get('admin/api/seo/saveconfig', {
                   params:{
                        robots_txt: this.robotsTxt,
                        config: this.package.config
                   }
               }).then(function () {
                   this.$notify('Settings saved.', '');
               }).catch(function (response) {
                   this.$notify(response.message, 'danger');
               }).finally(function () {
                   this.$parent.close();
               });
           }
       }
    };

    window.Extensions.components['seo-settings'] = module.exports;
</script>
