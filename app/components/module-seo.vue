<template>
    <div v-cloak>
        <div class="uk-child-width-1-2@m" uk-grid>
            <div>
                <div class="uk-margin" style="display:none">
                    <div>
                        <div for="form-meta-title" class="uk-form-label uk-float-right">
                            <a class="uk-margin-left" uk-toggle="target: #seo-subject-rule">Rule</a> 
                        </div>
                        <label for="form-meta-title" class="uk-form-label">{{ 'Subject' | trans }}</label>
                    </div>
                    <div id="input-title-for-website-name" class="uk-form-controls">
                        <input id="form-meta-subject" v-model="module.data.meta['subject']" class="uk-width-expand uk-input" type="text">
                    </div>
                    <p id="seo-subject-rule" class="uk-text-small" hidden>
                        <span class="uk-text-meta uk-display-block">{{'Subject needs a word or two. This input is data in my post. Link structure will provide you with a clearer information by checking in the Title, Description and Content sections.' | trans}}</span>
                    </p>
                </div>
                <div class="uk-margin">
                    <div>
                        <div for="form-meta-title" class="uk-form-label uk-float-right">
                            <span>{{ '{0} You must enter a title|{1} %count% Character|]1,Inf[ %count% Characters' | transChoice(getTitleCount, {count:getTitleCount}) }}</span>
                            <a class="uk-margin-left" uk-toggle="target: #seo-title-rule">Rule</a> 
                        </div>
                        <label for="form-meta-title" class="uk-form-label">{{ 'Title' | trans }}</label>
                    </div>
                    <div id="input-title-for-website-name" class="uk-form-controls">
                        <input id="form-meta-title" v-model="module.data.meta['og:title']" class="uk-width-expand uk-input" :class="{
                                'uk-form-success': getTitleCount >= 50 && getTitleCount <= 60,
                                'tm-form-warning': getTitleCount >= 1 && getTitleCount <= 49,
                                'uk-form-danger': getTitleCount > 60,
                            }" :placeholder="module.title" type="text">
                        <span id="input-title-position"> | {{project_title}}</span>
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
            </div>
            <div>
                <div class="uk-margin">
                    <ul class="uk-list tm-card">
                        <li><span class="tm-search-engine-title">{{module.data.meta['og:title'] ? module.data.meta['og:title']:module.title}} | {{project_title}}</span></li>
                        <li><span class="tm-search-engine-uri uk-text-success">{{getLink}}</span></li>
                        <li><p class="tm-search-engine-desc uk-text-muted uk-width-expand uk-text-break">{{getDesc}}</p></li>
                    </ul>
                </div>

                <div class="uk-margin">
                    <ul class="uk-list tm-information">
                        <li>
                            <i :class="{
                            'pk-icon-circle-success': getTitleCount >= 50 && getTitleCount <= 60,
                            'pk-icon-circle-warning': getTitleCount >= 0 && getTitleCount <= 49,
                            'pk-icon-circle-danger': getTitleCount > 60,
                            }"></i> 
                            <span>{{'Title' | trans}} </span>
                            <span v-show="getTitleCount >= 0 && getTitleCount <= 49 || getTitleCount > 60">{{'length is not recommended character length.'}}</span>
                            <span v-show="getTitleCount >= 50 && getTitleCount <= 60">{{'length is recommended character length.'}}</span>
                        </li>

                        <li>
                            <i :class="{
                            'pk-icon-circle-success': module.data.meta['og:description'].length >= 141 && module.data.meta['og:description'].length <= 160,
                            'pk-icon-circle-warning': module.data.meta['og:description'].length >= 1 && module.data.meta['og:description'].length <= 140,
                            'pk-icon-circle': module.data.meta['og:description'].length <= 1,
                            'pk-icon-circle-danger': module.data.meta['og:description'].length > 160,
                            }"></i> 
                            <span>{{'Description' | trans}} </span>
                            <span v-show="module.data.meta['og:description'].length >= 0 && module.data.meta['og:description'].length <= 140 || module.data.meta['og:description'].length > 160">{{'length is not recommended character length.'}}</span>
                            <span v-show="module.data.meta['og:description'].length >= 141 && module.data.meta['og:description'].length <= 160">{{'length is recommended character length.'}}</span>
                        </li>
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
            let title = this.module.data.meta['og:title'] +' | '+ this.project_title;
            return title;
        },

        getTitleCount(isString = false){
            return this.getTitle.length;
        },

        getLink(){
            return this.project_uri+this.module.url
        },
        
        getDesc(){
            let val = this.module.data.meta['og:description'];
            if(!val.length){
                val = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ante nisl, vehicula at scelerisque sed, tempor vel risus. Morbi vitae pellentesque lectus antes.'
            }
            return val;
        }
    },

    methods: {
        checkSubject(content = ''){
            const subject = this.module.data.meta.subject;
            const regex = /subject/gim;
            const matches = regex.exec(content);
            console.log(matches)
            return 1;
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

    .tm-search-engine-uri{
        font-size:13px;
    }
    .tm-search-engine-title{
        font-size: 20px;
        line-height: normal;
        color: #1a0dab;
    }
    .tm-search-engine-desc{
        display: inline-block;
        font: 9px;
        line-height: normal;
        color: #6a6a6a;
    }
    .tm-card{
        border: 1px solid #d2cfcf;
        padding:10px 20px;
    }

    .tm-card > li{
        margin-top: 5px;
    }

    .tm-information > li i{margin-right:10px}
    .tm-information > li span{font-size:11px}
</style>