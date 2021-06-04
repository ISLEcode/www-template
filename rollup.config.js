import commonjs         from '@rollup/plugin-commonjs';
import json from "@rollup/plugin-json";
import css              from 'rollup-plugin-css-only';
import livereload       from 'rollup-plugin-livereload';
import { mdsvex }       from "mdsvex";
import resolve          from '@rollup/plugin-node-resolve';
import svelte           from 'rollup-plugin-svelte';
import sveltePreprocess from 'svelte-preprocess';
import { terser }       from 'rollup-plugin-terser';
import typescript       from '@rollup/plugin-typescript';

// import buble from 'rollup-plugin-buble';
// import uglify from 'rollup-plugin-uglify';

const production = !process.env.ROLLUP_WATCH;

function serve() {
    let server;

    function toExit() { if (server) server.kill(0); }

    return {
        writeBundle() {
            if (server) return;
            server = require('child_process').spawn('make', ['preview'], {
                stdio: ['ignore', 'inherit', 'inherit'],
                shell: true
            });

            process.on('SIGTERM', toExit);
            process.on('exit', toExit);
        }
    };
}


function build (bundle, source) {

    return {
        input:      source,
        output:     { name: 'app', file: 'docs/zip/app/js/' + bundle + '.js', format: 'iife', sourcemap: true },
        plugins:    [

            svelte ({
                extensions: [ '.svx', '.md' ],
                preprocess: mdsvex({
                    extensions: [ '.svx', '.md' ],
                })
            }),

            svelte ({
                preprocess: sveltePreprocess ({
                    mdsvex: true,
                    postcss: { plugins: [require('autoprefixer')()] },
                    sourceMap: !production,
                    // defaults:  { script: typescript, style: sass },
                    scss: { prependData: `@import 'src/styles/variables.scss';` },
                }),
                compilerOptions: {
                    // enable run-time checks when not in production
                    dev: !production
                }
            }),

            json ({ compact: true }),

            // Extract any component CSS out into a separate file (better for performance)
            css ({ output: bundle + '.css' }),

            // When using external npm dependencies (cf. https://github.com/rollup/plugins/tree/master/packages/commonjs)
            resolve ({ browser: true, dedupe: ['svelte'] }),
            commonjs(),

            // typescript({ sourceMap: !production, inlineSources: !production }),
            // typescript ({ sourceMap: !production, inlineSources: !production }),
            // TODO typescript ({ tsconfig: production? "./tsconfig.prod.json" : "./tsconfig.json",})
            typescript ({ tsconfig: './tsconfig.json' }),

            // In dev mode, call `make start` once the bundle has been generated
            !production && serve(),

            // Watch the `docs` directory and refresh the browser on changes when not in production
            !production && livereload ('docs'),

            // If we're building for production (`make prod` instead of `make dev`), minify
            production && terser()
            // production && buble({ exclude: 'node_modules/**' }),
            // production && uglify()
        ],

        watch: { clearScreen: false }

    }
}


export default [
    // build ('bundle',     'src/main.ts'),
    // build ('markdown',   'src/markdown.ts'),
    // build ('router',     'src/router.ts'),
    // build ('qrbill',        'src/qrbill.ts'),
    build ('sampler',       'src/qrbill/sampler.ts')
    // build ('typescript', 'src/typescript.ts'),
    // build ('bootstrap5', 'src/samples/bs5/index.ts')
];

// __END__
