const Encore = require('@symfony/webpack-encore');

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

    .copyFiles({
        from: './assets/images',
        to: 'images/',
        // pattern: /\.(png|jpg|jpeg)$/
        pattern: /\.(png|svg|jpg|jpeg|ico)$/
    })
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */
    .addEntry('app', './assets/frontend/default/app.js')
    .addEntry('chart', './assets/frontend/default/chart.js')
    .addEntry('default_dashboard', './assets/frontend/default/Dashboard.js')

    // Worker Section
    .addEntry('worker_base', './assets/frontend/worker/base.js')
    .addEntry('worker_index', './assets/frontend/worker/Index.js')

    .addEntry('supervisor_index', './assets/frontend/supervisor/Index.js')
    .addEntry('manager_index', './assets/frontend/manager/Index.js')

    // Jednostki Section
    .addEntry('jednostki_base', './assets/frontend/jednostki/base.js') // Podgląd szczegółowy pod daną jednostkę (readonly)
    .addEntry('jednostki_index', './assets/frontend/jednostki/Index.js')         // Lista jednostek w formie tabeli

    // Uzytkownicy Section
    .addEntry('uzytkownicy_base', './assets/frontend/uzytkownicy/base.js')
    .addEntry('uzytkownicy_index', './assets/frontend/uzytkownicy/Index.js')

    // Zestawienie Section
    .addEntry('zestawienie_chart', './assets/frontend/default/web/chart.js')
    .addEntry('zestawienie_corrects', './assets/frontend/zestawienie/corrects.js')
    .addEntry('zestawienie_complex', './assets/frontend/zestawienie/complex.js')

    .addEntry('admin_messages', './assets/frontend/admin/messages.js')
    .addEntry('admin_search', './assets/frontend/admin/search.js')
    .addEntry('admin_year', './assets/frontend/admin/year.js')
    .addEntry('manager_search', './assets/frontend/manager/search.js')

    // React Component
    .addEntry('react_app', './assets/react/ReactApp.js')

    // enables the Symfony UX Stimulus bridge (used in assets/bootstrap.js)
    .enableStimulusBridge('./assets/controllers.json')

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

    .configureBabel((config) => {
        config.plugins.push('@babel/plugin-proposal-class-properties');
    })

    // enables @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })

    // enables Sass/SCSS support
    .enableSassLoader()

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment if you use React
    .enableReactPreset()

    // uncomment to get integrity="..." attributes on your script & link tags
    // requires WebpackEncoreBundle 1.4 or higher
    //.enableIntegrityHashes(Encore.isProduction())

    // uncomment if you're having problems with a jQuery plugin
    .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
