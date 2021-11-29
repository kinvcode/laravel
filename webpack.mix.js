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

// 设置输出目录
mix.setPublicPath('public/dist');

// js切片
mix.webpackConfig({
    output: {
        chunkFilename: 'chunks/[name].js',
    },
});

// 仅为解决Element-UI无法加载字体
mix.options({fileLoaderDirs: {fonts: 'dist/fonts'}});

// element按需引入配置
mix.element()

// vue-i18n单文件组件配置
mix.i18n()

// 支持vue单文件组件
mix.vue({version: 2})

mix.js('resources/vue/main.js', 'public/dist')
