const VueLoaderPlugin = require("vue-loader/lib/plugin");
const path = require("path");

module.exports = {
    entry: {
        "node-meta": "./app/modules/node-meta.vue",
        "blog-meta": "./app/modules/blog-meta.vue",
        "blog-category-meta": "./app/modules/blog-category-meta.vue",
    },
    output: {
        path: path.resolve(__dirname, "./app/bundle"),
        filename: "[name].js",
    },
    module: {
        rules: [
            {
                test: /\.vue$/,
                loader: "vue-loader",
            },
            {
                test: /\.js$/,
                loader: "babel-loader",
            },
            {
                test: /\.css$/,
                use: ["vue-style-loader", "css-loader"],
            },
        ],
    },
    plugins: [new VueLoaderPlugin()],
};
