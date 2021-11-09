const mix = require('laravel-mix');
const path = require('path')


mix.js('resources/src/main.js', 'public/js')
    .vue()
    .extract(['vue'])
    .sourceMaps();


mix.sass('resources/src/styles/index.scss', 'public/css');

if (mix.inProduction()) {
    mix.version();
}

mix.webpackConfig({
    optimization: {
        splitChunks: {
            cacheGroups: {
                vendors: false,
            },
        },
    },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/src')
        }
    }
});
