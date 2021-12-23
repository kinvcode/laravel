let mix = require('laravel-mix');

class i18n {
  webpackRules () {
    return [
      {
        resourceQuery: /blockType=i18n/,
        type: 'javascript/auto',
        loader: '@kazupon/vue-i18n-loader',
      },
    ];
  }
}

mix.extend('i18n', new i18n());
