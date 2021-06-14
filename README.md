<!--
TODO HTTP support (https://stackoverflow.com/a/53489924)
TODO Test HTTP/2 and SSL with sirv (https://www.npmjs.com/package/sirv-cli)
-->

https://dusaasp1.isle.plus/qrcode/


# Svelte app

This is a customised project template for [Svelte]. It lives at https://github.com/ISLEcode/www-template and was forked from
https://github.com/sveltejs/template to adjust to ISLE practices and, optionally, integrates with the ISLE [AIT framework][ait].

## Features

  - Makefile-based builds
  - Bootstrap 5 <sup>(a)</sup>
  - SASS/PostCSS <sup>(b)</sup>
  - Pug <sup>(c)</sup>
  - Typescript
  - GitHub pages

<sup>(a)</sup> It is intended that this template supports (simultaneously) Bootstrap versions 4 and 5. In the meantime we are
focusing on Bootstrap 5. We will rapidly retrofit the template to support Bootstrap 4; note that the Bootstrap 4 and associated
Node packages are already included.

<sup>(b)</sup> LESS and Stylus can also be easily adopted since they are already handled by Svelte's preprocessor. We are using
SASS as this is the Bootstrap team's choice, and Bootstrap is our primary UI framework.

<sup>(c)</sup> Pug support is currently experimental not so much for the language itself, or its integration -- Svelte handles it
through its pre-processor, but rather because of its combined use with Markdown.

## Pre-requisites

  - [Node.js] (latest version)
  - Handy UNIX `make(1)` command
  - YAML-based configuration files

## Filesystem layout

The essential top-level components:

```
├─ docs/ (auto-built)   GitHub pages directory for target build
├─ src/                 Source files that need to be `compiled`
├─ www/                 Static files that are used as-is
├─ Makefile             The `make(1)` rules for this project
├─ README.md            Brief overview of this project
├─ package.yaml         The `npm(1)` configuration file
├─ rollup.config.js     The `rollup(1)` configuration file
└─ tsconfig.yaml        The `ts(1)` configuration file
```

The `www` and `docs` directories follow the same base layout:

```
www (→ docs)
├─ zip/                 A zip-full directory of static assets
│  ├─ vendor/           Third party dependencies
│  └─ app/              Application static/generated media components
│     ├─ css/           Stylesheets
│     ├─ fonts/         Fonts and typography-related resources
│     ├─ img/           Images and graphical resources
│     └─ js/            Browser-compatible Javascript files
└─ index.html           The applications `entry` point
```

## Create a new project

ISLE AIT developers can use the `git degit` command to use this template. We will be using YAML configuration files in lieu of
JSON files; by precaution we will delete the auto-generated JSON files.

```  .sh
git degit ISLEcode/www-template my-app
cd my-app
rm package.json
```

_Note_: If you don't have an installed Apache HTTPD server, edit the `package.yaml` file and uncomment the `sirv-cli` development
dependency.

Other user's can use Rich Harris' [degit] utility to get a copy of this template. Since the AIT framework is not available the
YAML configuration files should be removed.

```  .sh
npx degit ISLEcode/www-template my-app
cd my-app
rm package.yaml
```

## Get started

1.  Install the dependencies:

    ``` .sh
    cd my-app
    make configure
    ```

...then start [Rollup](https://rollupjs.org):

``` .sh
make dev
```

Navigate to [localhost:5000](http://localhost:5000). You should see your app running.
Edit a component file in `src`, save it, and reload the page to see your changes.

By default, the server will only respond to requests from localhost. To allow connections from other computers, edit the `sirv`
commands in package.json to include the option `--host 0.0.0.0`.

## Building and running in production mode

To create an optimised version of the app:

``` .sh
make prod
```

## Single-page app mode

By default, sirv will only respond to requests that match files in `docs`. This is to maximise compatibility with static
fileservers, allowing you to deploy your app anywhere.

If you're building a single-page app (SPA) with multiple routes, sirv needs to be able to respond to requests for *any* path. You
can make it so by editing the `"start"` command in package.json:.

```js
"start": "sirv docs --single"
```

## Using TypeScript

This template comes with a script to set up a TypeScript development environment, you can run it immediately after cloning the
template with:

``` .sh
node scripts/setupTypeScript.js
```

Or remove the script via:

``` .sh
rm scripts/setupTypeScript.js
```

## Deploying to the web

### With [Vercel](https://vercel.com)

Install `vercel` if you haven't already:

``` .sh
npm install -g vercel
```

Then, from within your project folder:

``` .sh
cd docs
vercel deploy --name my-project
```

### With [surge](https://surge.sh/)

Install `surge` if you haven't already:

``` .sh
npm install -g surge
```

Then, from within your project folder:

``` .sh
make prod
surge docs my-project.surge.sh
```

  [ait]: https://github.com/ISLEcode/AIT
  [node.js]: https://nodejs.org
  [degit]: https://github.com/Rich-Harris/degit
  [svelte]: https://svelte.dev

