let mix = require('laravel-mix');
class ExtendConfig {
  babelConfig () {
    return {
      "presets": [["@babel/preset-env", {"modules": false}]],
      "plugins": [
        [
          "component",
          {
            "libraryName": "element-ui",
            "styleLibraryName": "theme-chalk"
          }
        ]
      ]
    };
  }
}
mix.extend('extendConfig', new ExtendConfig());
