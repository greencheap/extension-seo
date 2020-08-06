<template>
    <div v-cloak>
        <div class="uk-child-width-1-2@m" uk-grid>
            <div>
                <div class="uk-margin">
                    <div>
                        <div for="form-meta-title" class="uk-form-label uk-float-right">
                            <span>{{ '{0} You must enter a title|{1} %count% Character|]1,Inf[ %count% Characters' | transChoice(getTitle, {count:getTitle}) }}</span>
                            <a class="uk-margin-left" uk-toggle="target: #seo-title-rule">Rule</a> 
                        </div>
                        <label for="form-meta-title" class="uk-form-label">{{ 'Title' | trans }}</label>
                    </div>
                    <div id="input-title-for-website-name" class="uk-form-controls">
                        <input id="form-meta-title" v-model="module.data.meta['og:title']" class="uk-width-expand uk-input" :class="{
                                'uk-form-success': getTitle >= 50 && getTitle <= 60,
                                'tm-form-warning': getTitle >= 1 && getTitle <= 49,
                                'uk-form-danger': getTitle > 60,
                            }" :placeholder="module.title" type="text">
                        <span id="input-title-position"> - {{project_title}}</span>
                    </div>
                    <p id="seo-title-rule" class="uk-text-small" hidden>
                        <span class="uk-text-meta uk-display-block">{{'Google typically displays the first 50–60 characters of a title tag. If you keep your titles under 60 characters, our research suggests that you can expect about 90% of your titles to display properly. There\'s no exact character limit, because characters can vary in width and Google\'s display titles max out (currently) at 600 pixels.' | trans}}</span>
                        <span>Source: </span>
                        <a href="https://moz.com/learn/seo/title-tag" target="_blank">moz.com</a>
                    </p>
                </div>

                <div class="uk-margin">
                    <div>
                        <div for="form-meta-title" class="uk-form-label uk-float-right">
                            <span>{{ '{0} You must enter a description|{1} %count% Character|]1,Inf[ %count% Characters' | transChoice(module.data.meta['og:description'].length , {count:module.data.meta['og:description'].length }) }}</span>
                            <a class="uk-margin-left" uk-toggle="target: #seo-desc-rule" >Rule</a> 
                        </div>
                        <label for="form-meta-description" class="uk-form-label">{{ 'Description' | trans }}</label>
                    </div>
                    <div class="uk-form-controls">
                        <textarea id="form-meta-description" v-model="module.data.meta['og:description']" class="uk-width-expand uk-textarea" rows="5" type="text" :class="{
                                'uk-form-success': module.data.meta['og:description'].length >= 141 && module.data.meta['og:description'].length <= 160,
                                'tm-form-warning': module.data.meta['og:description'].length >= 1 && module.data.meta['og:description'].length <= 140,
                                'uk-form-danger': module.data.meta['og:description'].length > 160,
                            }"  />
                    </div>
                    <p id="seo-desc-rule" class="uk-text-small" hidden>
                        <span class="uk-text-meta uk-display-block">{{'Meta descriptions can be any length, but Google generally truncates snippets to ~155–160 characters. It\'s best to keep meta descriptions long enough that they\'re sufficiently descriptive, so we recommend descriptions between 50–160 characters. Keep in mind that the "optimal" length will vary depending on the situation, and your primary goal should be to provide value and drive clicks.' | trans}}</span>
                        <span>Source: </span>
                        <a href="https://moz.com/learn/seo/meta-description" target="_blank">moz.com</a>
                    </p>
                </div>

                <component :is="typeMode.name" :module.sync="module"></component>
            </div>
            <div>
                <div class="uk-margin">
                    <ul class="uk-list">
                        <li><span class="tm-search-engineer-uri">{{module.url}}</span></li>
                        <li><span class="tm-search-engineer-title">{{module.data.meta['og:title'] ? module.data.meta['og:title']:module.title}} - {{project_title}}</span></li>
                        <li><span class="tm-search-engineer-desc uk-width-expand">{{module.data.meta['og:description']}}</span></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="uk-margin-large-top">
            <p class="uk-text-small">{{ 'This plugin is developed according to the protocol specified in' | trans }} <a href="https://ogp.me" target="_blank">https://ogp.me</a></p>
        </div>
    </div>
</template>

<script>

import StandartType from './types/default.vue';

let moduleseo = {
    props:{
        module:{
            type: Object,
            default: {}
        },
        RealSubject:{
            type:String,
            default:''
        },
        moduleType:{
            type:String,
            default:'default'
        }
    },

    data() {
        return _.merge({
            typeMode: '',
            inputStyle: {
                title:null,
                desc:null
            }
        } , window.$client)
    },

    created() {
        if (!this.module.data.meta) {
            this.$set(this.module.data, 'meta', { 
                'og:title': '',
                'og:description': '',
                'real_subject': this.RealSubject
            });
        }

        if(!this.module.data.meta['og:description']){
            this.$set(this.module.data, 'meta', _.merge({ 
                'og:description': '',
                'real_subject': this.RealSubject
            } , this.module.data.meta));
        }
         _.forIn(this.$options.components, (component, name) => {
            if (component.ModulesSeo) {
                if (component.ModulesSeo.label == this.moduleType) {
                    this.typeMode = _.extend({ name }, component.ModulesSeo);
                }
            }
        });
    },

    computed:{
        getTitle(){
            let title = this.module.data.meta['og:title'] +' - '+ this.project_title;
            return title.length;
        }
    },

    components: {
        StandartType
    }
}

export default moduleseo;

window.ModuleSeo = moduleseo;
</script>

<style scoped>
    #input-title-for-website-name{
        position:relative;
    }

    #input-title-for-website-name > input{
        padding-right:184px;
    }

    #input-title-position{
        position: absolute;right: 10px;top: 8px;color: #ccc;
    }

    .tm-form-warning{
        color: #fd9867;
        border-color: #fd9867;
    }

    .tm-search-engineer-uri{
        font-size:13px;
    }
    .tm-search-engineer-title{
        font-size: 20px;
        line-height: normal;
        color: #1a0dab;
    }
    .tm-search-engineer-desc{
        display: inline-block;
        font: 14px;
        line-height: normal;
        color: #6a6a6a;
    }
</style>