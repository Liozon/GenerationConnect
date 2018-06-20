const path = require('path');
const webpack = require('webpack');

module.exports = {
    mode: 'development',
    entry: {
    statique: './src/IndexStatique/index.js',
    junior: './src/IndexJunior/index.js',
    senior: './src/IndexSenior/index.js',
	admin: './src/IndexAdmin/index.js'
  },
    output: {
        filename: '[name].bundle.js',
        path: path.resolve(__dirname, 'dist')
    },
    module: {   
        rules: [
            { test: /\.html$/, use: 'handlebars-loader' }
        ]
    },
    resolve: {
        modules: [
            path.resolve('./src'),
            path.resolve('./node_modules')
        ]
    },
    plugins: [
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery'
        }),
        new webpack.ProvidePlugin({
            _: 'underscore'            
        })
    ]
};