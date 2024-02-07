const Encore = require('@symfony/webpack-encore');

// Project configuration
Encore
    // Directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // Public path used by the web server to access the output path
    .setPublicPath('/build')
    // Only needed for CDN's or sub-directory deploy
    .setManifestKeyPrefix('build/')

    // Entry for the app
    .addEntry('app', './assets/js/app.js')

    // Enable loading jQuery globally
    .autoProvidejQuery()

    // Enable SASS/SCSS processing
    .enableSassLoader()

    // Enable source maps during development
    .enableSourceMaps(!Encore.isProduction())

    // Empty the outputPath dir before each build
    .cleanupOutputBeforeBuild()

    // Show OS notifications when builds finish/fail
    .enableBuildNotifications()

    // Enable versioning (recommended when you deploy)
    .enableVersioning(Encore.isProduction())

    // Configure Babel
    .configureBabel((babelConfig) => {
        // No additional configuration needed at this point
    })
    .enableSingleRuntimeChunk();

// Export the final configuration
module.exports = Encore.getWebpackConfig();