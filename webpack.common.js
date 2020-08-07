const VueLoaderPlugin = require('vue-loader/lib/plugin');
const path = require('path');

module.exports = {
    entry: {
        'modules/node-meta':'./app/modules/node-meta.vue',
        'modules/categories-meta':'./app/modules/categories-meta.vue',
        'modules/blog-meta':'./app/modules/blog-meta.vue',
        'modules/docs-meta':'./app/modules/docs-meta.vue',
    },
    output: {
        path: path.resolve(__dirname, './app/bundle'),
        filename: '[name].js'
    },
    module: {
        rules: [
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            },
            {
                test: /\.js$/,
                loader: 'babel-loader'
            },
            {
                test: /\.css$/,
                use: [
                    'vue-style-loader',
                    'css-loader',
                ]
            }
        ]
    },
    plugins: [
        new VueLoaderPlugin()
    ]
};
