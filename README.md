<!--
TODO HTTP support (https://stackoverflow.com/a/53489924)
TODO Test HTTP/2 and SSL with sirv (https://www.npmjs.com/package/sirv-cli)
-->

# Svelte app

This is a customised project template for [Svelte]. It lives at https://github.com/ISLEcode/www-template and was forked from
https://github.com/sveltejs/template to adjust to ISLE practices and, optionally, integrates with the ISLE [AIT framework][ait].

## Features

  - Makefile-based builds
  - Typescript support
  - Deploying to GitHub pages

## Pre-requisites

  - [Node.js] (latest version)
  - Handy UNIX `make(1)` command
  - YAML-based configuration files

## Create a new project

ISLE AIT developers can use the `git degit` command to use this template. We will be using YAML configuration files in lieu of
JSON files; by precaution we will delete the auto-generated JSON files.

``` {.sh .ksh}
git degit ISLEcode/www-template my-app
cd my-app
rm package.json
```

_Note_: If you don't have an installed Apache HTTPD server, edit the `package.yaml` file and uncomment the `sirv-cli` development
dependency.

Other user's can use Rich Harris' [degit] utility to get a copy of this template. Since the AIT framework is not available the
YAML configuration files should be removed.

``` {.sh .ksh}
npx degit ISLEcode/www-template my-app
cd my-app
rm package.yaml
```

## Get started

1.  Install the dependencies:

    ```{.sh .ksh}
    cd my-app
    make configure
    ```

...then start [Rollup](https://rollupjs.org):

```{.sh .ksh}
make dev
```

Navigate to [localhost:5000](http://localhost:5000). You should see your app running.
Edit a component file in `src`, save it, and reload the page to see your changes.

By default, the server will only respond to requests from localhost. To allow connections from other computers, edit the `sirv`
commands in package.json to include the option `--host 0.0.0.0`.

## Building and running in production mode

To create an optimised version of the app:

```{.sh .ksh}
make build
```

## Single-page app mode

By default, sirv will only respond to requests that match files in `public`. This is to maximise compatibility with static
fileservers, allowing you to deploy your app anywhere.

If you're building a single-page app (SPA) with multiple routes, sirv needs to be able to respond to requests for *any* path. You
can make it so by editing the `"start"` command in package.json:.

```js
"start": "sirv public --single"
```

## Using TypeScript

This template comes with a script to set up a TypeScript development environment, you can run it immediately after cloning the
template with:

```{.sh .ksh}
node scripts/setupTypeScript.js
```

Or remove the script via:

```{.sh .ksh}
rm scripts/setupTypeScript.js
```

## Deploying to the web

### With [Vercel](https://vercel.com)

Install `vercel` if you haven't already:

```{.sh .ksh}
npm install -g vercel
```

Then, from within your project folder:

```{.sh .ksh}
cd public
vercel deploy --name my-project
```

### With [surge](https://surge.sh/)

Install `surge` if you haven't already:

```{.sh .ksh}
npm install -g surge
```

Then, from within your project folder:

```{.sh .ksh}
make build
surge public my-project.surge.sh
```

  [ait]: https://github.com/ISLEcode/AIT
  [node.js]: https://nodejs.org
  [degit]: https://github.com/Rich-Harris/degit
  [svelte]: https://svelte.dev

