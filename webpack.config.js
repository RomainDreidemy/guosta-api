const Encore = require('@symfony/webpack-encore');
const path = require('path');

if (!Encore.isRuntimeEnvironmentConfigured()) {
  Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
// directory where compiled assets will be stored
  .setOutputPath('public/build/')
// public path used by the web server to access the output path
  .setPublicPath('/build')

/*
     * ENTRY CONFIG
     *
     * Add 1 entry for each "page" of your app
     * (including one that's included on every page - e.g. "app")
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */
  .addEntry('app', './front/app.js')
  .addStyleEntry('tailwind', './front/src/assets/styles/tailwind.css')

// When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
  .splitEntryChunks()

  .enableSingleRuntimeChunk()
  .cleanupOutputBeforeBuild()
  .enableBuildNotifications()
  .enableSourceMaps(!Encore.isProduction())
  .enableVersioning(Encore.isProduction())
  .configureBabelPresetEnv((config) => {
    config.useBuiltIns = 'usage';
    config.corejs = 3;
  })
  .enablePostCssLoader((options) => {
    options.postcssOptions = {
      // the directory where the postcss.config.js file is stored
      config: path.resolve(__dirname, '', 'postcss.config.js'),
    };
  })
  .enableReactPreset();
module.exports = Encore.getWebpackConfig();
