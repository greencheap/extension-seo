(()=>{"use strict";var t=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("seo-module",{attrs:{data:t.post.data},on:{"update:data":function(e){return t.$set(t.post,"data",e)}}})],1)};t._withStripped=!0;var e=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"uk-form-horizontal"},[a("div",{staticClass:"uk-margin"},[a("label",{staticClass:"uk-form-label",attrs:{for:"form-meta-title"}},[t._v(t._s(t._f("trans")("Title")))]),t._v(" "),a("div",{staticClass:"uk-form-controls"},[a("input",{directives:[{name:"model",rawName:"v-model",value:t.data.meta["og:title"],expression:"data.meta['og:title']"}],staticClass:"uk-form-width-large uk-input",attrs:{id:"form-meta-title",type:"text"},domProps:{value:t.data.meta["og:title"]},on:{input:function(e){e.target.composing||t.$set(t.data.meta,"og:title",e.target.value)}}})])]),t._v(" "),a("div",{staticClass:"uk-margin"},[a("label",{staticClass:"uk-form-label",attrs:{for:"form-meta-description"}},[t._v(t._s(t._f("trans")("Description")))]),t._v(" "),a("div",{staticClass:"uk-form-controls"},[a("textarea",{directives:[{name:"model",rawName:"v-model",value:t.data.meta["og:description"],expression:"data.meta['og:description']"}],staticClass:"uk-form-width-large uk-textarea",attrs:{id:"form-meta-description",rows:"5",type:"text"},domProps:{value:t.data.meta["og:description"]},on:{input:function(e){e.target.composing||t.$set(t.data.meta,"og:description",e.target.value)}}})])]),t._v(" "),a("div",{staticClass:"uk-margin"},[a("label",{staticClass:"uk-form-label",attrs:{for:"form-meta-image"}},[t._v(t._s(t._f("trans")("Image")))]),t._v(" "),a("div",{staticClass:"uk-form-controls"},[a("v-multi-finder",{staticClass:"pk-image-max-height",attrs:{image:t.image},on:{"update:image":function(e){t.image=e}},model:{value:t.image,callback:function(e){t.image=e},expression:"image"}})],1)])])};function a(t,e,a,s,i,o,r,n){var l,m="function"==typeof t?t.options:t;if(e&&(m.render=e,m.staticRenderFns=a,m._compiled=!0),s&&(m.functional=!0),o&&(m._scopeId="data-v-"+o),r?(l=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),i&&i.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(r)},m._ssrRegister=l):i&&(l=n?function(){i.call(this,(m.functional?this.parent:this).$root.$options.shadowRoot)}:i),l)if(m.functional){m._injectStyles=l;var d=m.render;m.render=function(t,e){return l.call(e),d(t,e)}}else{var c=m.beforeCreate;m.beforeCreate=c?[].concat(c,l):[l]}return{exports:t,options:m}}e._withStripped=!0;var s=a({props:["data"],data:()=>({image:{src:"",alt:""}}),watch:{"image.src":{handler(){this.data.meta["og:image"]=this.image.src},deep:!0}},created(){this.data.meta||this.$set(this.data,"meta",{"og:title":"","og:description":"","og:image":""}),this.data.meta["og:image"]&&(this.image.src=this.data.meta["og:image"])}},e,[],!1,null,null,null);s.options.__file="app/components/seo-module.vue";const i={section:{label:"Meta",priority:100},props:["post"],components:{SeoModule:s.exports}},o=i;window.Post.components["post-meta"]=i;var r=a(o,t,[],!1,null,null,null);r.options.__file="app/modules/blog-meta.vue",r.exports})();