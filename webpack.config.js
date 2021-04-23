var Encore = require('@symfony/webpack-encore');
var CopyWebpackPlugin = require('copy-webpack-plugin');
// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}


Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Add 1 entry for each "page" of your app
     * (including one that's included on every page - e.g. "app")
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */
    .addEntry('app', './assets/js/app.js')
    .addEntry('site', './assets/js/site.js')
    //.addEntry('page1', './assets/js/page1.js')
    //.addEntry('page2', './assets/js/page2.js')

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // enables @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })

    .addStyleEntry('css/account-pages', './assets/scss/_account-pages.scss')
    .addStyleEntry('css/alertify', './assets/scss/_alertify.scss')
    .addStyleEntry('css/alerts', './assets/scss/_alerts.scss')
    .addStyleEntry('css/bootstrap-custom', './assets/scss/_bootstrap-custom.scss')
    .addStyleEntry('css/buttons', './assets/scss/_buttons.scss')
    .addStyleEntry('css/calendar', './assets/scss/_calendar.scss')
    .addStyleEntry('css/card', './assets/scss/_card.scss')
    .addStyleEntry('css/charts', './assets/scss/_charts.scss')
    .addStyleEntry('css/demo-only', './assets/scss/_demo-only.scss')
    .addStyleEntry('css/form-advanced', './assets/scss/_form-advanced.scss')
    .addStyleEntry('css/form-editor', './assets/scss/_form-editor.scss')
    .addStyleEntry('css/form-elements', './assets/scss/_form-elements.scss')
    .addStyleEntry('css/form-upload', './assets/scss/_form-upload.scss')
    .addStyleEntry('css/form-validation', './assets/scss/_form-validation.scss')
    .addStyleEntry('css/general', './assets/scss/_general.scss')
    .addStyleEntry('css/helper', './assets/scss/_helper.scss')
    .addStyleEntry('css/loader', './assets/scss/_loader.scss')
    .addStyleEntry('css/maps', './assets/scss/_maps.scss')
    .addStyleEntry('css/menu', './assets/scss/_menu.scss')
    .addStyleEntry('css/nestable', './assets/scss/_nestable.scss')
    .addStyleEntry('css/pagination', './assets/scss/_pagination.scss')
    .addStyleEntry('css/popover-tooltips', './assets/scss/_popover-tooltips.scss')
    .addStyleEntry('css/print', './assets/scss/_print.scss')
    .addStyleEntry('css/progressbar', './assets/scss/_progressbar.scss')
    .addStyleEntry('css/range-slider', './assets/scss/_range-slider.scss')
    .addStyleEntry('css/responsive', './assets/scss/_responsive.scss')
    .addStyleEntry('css/session-timeout', './assets/scss/_session-timeout.scss')
    .addStyleEntry('css/tables', './assets/scss/_tables.scss')
    .addStyleEntry('css/variables', './assets/scss/_variables.scss')
    .addStyleEntry('css/waves', './assets/scss/_waves.scss')
    .addStyleEntry('css/widgets', './assets/scss/_widgets.scss')
    .addStyleEntry('css/icons', './assets/scss/icons.scss')
    .addStyleEntry('css/style', './assets/scss/style.scss')
    .addStyleEntry('css/style/icons/font-awesome/scss/variables', './assets/icons/font-awesome/scss/_variables.scss')
    .addStyleEntry('css/style/icons/font-awesome/scss/stacked', './assets/icons/font-awesome/scss/_stacked.scss')
    .addStyleEntry('css/style/icons/font-awesome/scss/screen-reader', './assets/icons/font-awesome/scss/_screen-reader.scss')
    .addStyleEntry('css/style/icons/font-awesome/scss/rotated-flipped', './assets/icons/font-awesome/scss/_rotated-flipped.scss')
    .addStyleEntry('css/style/icons/font-awesome/scss/path', './assets/icons/font-awesome/scss/_path.scss')
    .addStyleEntry('css/style/icons/font-awesome/scss/mixins', './assets/icons/font-awesome/scss/_mixins.scss')
    .addStyleEntry('css/style/icons/font-awesome/scss/list', './assets/icons/font-awesome/scss/_list.scss')
    .addStyleEntry('css/style/icons/font-awesome/scss/larger', './assets/icons/font-awesome/scss/_larger.scss')
    .addStyleEntry('css/style/icons/font-awesome/scss/icons', './assets/icons/font-awesome/scss/_icons.scss')
    .addStyleEntry('css/style/icons/font-awesome/scss/fixed-width', './assets/icons/font-awesome/scss/_fixed-width.scss')
    .addStyleEntry('css/style/icons/font-awesome/scss/core', './assets/icons/font-awesome/scss/_core.scss')
    .addStyleEntry('css/style/icons/font-awesome/scss/bordered-pulled', './assets/icons/font-awesome/scss/_bordered-pulled.scss')
    .addStyleEntry('css/style/icons/font-awesome/scss/animated', './assets/icons/font-awesome/scss/_animated.scss')
    .addStyleEntry('css/style/icons/font-awesome/scss/font-awesome', './assets/icons/font-awesome/scss/font-awesome.scss')
    // enables Sass/SCSS support
    .enableSassLoader()

    .addPlugin(new CopyWebpackPlugin([
        { from: './assets/images', to: 'images' }
    ]))
    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment to get integrity="..." attributes on your script & link tags
    // requires WebpackEncoreBundle 1.4 or higher
    //.enableIntegrityHashes(Encore.isProduction())

    // uncomment if you're having problems with a jQuery plugin
    //.autoProvidejQuery()

    // uncomment if you use API Platform Admin (composer req api-admin)
    //.enableReactPreset()
    //.addEntry('admin', './assets/js/admin.js')
;

module.exports = Encore.getWebpackConfig();
