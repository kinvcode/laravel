const mix = require('laravel-mix');
require('./webpack.extend');
require('laravel-mix-eslint-config');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.webpackConfig({
  output: {
    chunkFilename: 'dist/chunks/[name].js',
  }
});


mix.extendConfig()

mix.vue({version: 2})

mix.js('resources/vue/main.js', 'public/dist')
