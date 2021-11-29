let mix = require('laravel-mix');

class Element {
  babelConfig () {
    return {
      "presets": [["@babel/preset-env", {"modules": false}]],
      "plugins": [
        [
          "component",
          {
            "libraryName": "element-ui",
            "styleLibraryName": "theme-chalk",
          }
        ]
      ],
    };
  }
}

mix.extend('element', new Element());

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
