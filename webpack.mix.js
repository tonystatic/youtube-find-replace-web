const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 */

const paths = {
    node : './node_modules/',
    src  : './resources/assets/',
    dest : './public/assets/'
};

mix.options({
    terser : {
        extractComments: false
    }
});

// Styles
mix.sass(
    paths.src + 'scss/app.scss',
    paths.dest + 'css/app.css'
).options({
    processCssUrls: false
    // postCss: postCssProcessors
});

// Scripts
mix.js(
    paths.src + 'js/app.js',
    paths.dest + 'js/app.js'
);

if (mix.inProduction()) {
    mix.version();
}
