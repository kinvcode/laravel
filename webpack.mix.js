const mix = require('laravel-mix');
const path = require('path');
require('./webpack.extend');
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

// vue-i18n单文件组件配置
mix.i18n()

// 支持vue单文件组件
mix.vue({version: 2})

// js切片
mix
  .js('resources/vue/main.js', 'main.js')
  .webpackConfig({
    resolve: {
      alias: {
        '@': path.resolve(__dirname, 'resources/vue/'),
      }
    },
    module: {
      rules: [
        {
          test: /\.s[ac]ss$/i,
          use: [
            {
              loader: 'sass-loader',
              options: {
                sassOptions: {
                  includePaths: ['node_modules', 'resources/vue/assets']
                },
              }
            }
          ]
        },
        // {
        //   test: /\.(png|jpg|gif)$/,
        //   use: [
        //     {
        //       loader: 'file-loader',
        //       options: {
        //         name: '[path][hash].[ext]',
        //       },
        //     },
        //   ],
        // },
        {
          test: /\.mp4$/,
          use: [
            {
              loader: 'file-loader',
              options: {
                name: "[hash].[ext]",
                outputPath: "video"
              }
            }
          ],
        },
      ]
    },
    output: {
      chunkFilename: 'js/chunks/[name].[chunkhash].js',
    },
  });
