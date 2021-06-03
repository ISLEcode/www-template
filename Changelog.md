---
revision  : 2021-06-04 (Fri) 01:57:55
title     : SAMinfo QRcode chanage log
---

## Ideas & things to do/add

### Urgent matters

  - [ ] Numerical values should be rounded
  - [ ] Calendar widget missing
  - [ ] Add validation pane
  - [ ] +/- buttons should be smaller on smaller devices.

### Functional scope

  - Submit data
    - Fetch [SAMdata](https://svelte-recipes.netlify.app/components/) on component load

  - [Reference implementation](http://demo.qr-invoice.ch/app/index.html#/)

  - Form data input and validation (this should be delivered as a wrapper around Sveltestrap's `Input` component.
    - Started working on https://github.com/xnimorz/svelte-input-mask (cf https://www.npmjs.com/package/input-core)
    - Check these: https://github.com/xnimorz/masked-input/tree/master/examples
    - See this REPL as a practical example https://svelte.dev/repl/de6a6dcc92ee43d19ad2274599ba34c8?version=3.12.1
    - See also:
        - https://github.com/tanepiper/svelte-formula for contract-based forms
        - https://github.com/chainlist/svelte-forms
        - https://github.com/pstanoev/simple-svelte-autocomplete for autocompletion

  - ERP-related widgets and functionality
    - [Query Zefix](https://github.com/nexys-admin/zefix)
    - [Swiss cantons](https://github.com/nexys-admin/payroll-switzerland)
    - [IBAN and related validators](https://github.com/nexys-admin/iban)
      and also https://github.com/MechaPoulpe/IBAN-JStools
    - [Swiss banks](https://github.com/nexys-admin/swiss-banks)
    - [ISO20022 on github](https://github.com/ISO20022)
    - [Java validators to be converted](https://github.com/boessu/SwissQRBill)

  - QRbill
    - Typescript [QRBill library](https://github.com/nexys-admin/qrbill)
    - PHP stuff
      - https://github.com/whatwedo/EsrBundle (53)
      - https://github.com/sprain/php-swiss-qr-bill (Generator, 433)
      - https://github.com/jschaedl/iban-validation
    - Other language implementations to scan for functionality
      - https://github.com/manuelbl/SwissQRBill (Java)
      - https://github.com/boessu/SwissQRBill (Java)
      - https://github.com/stapelberg/qrbill (Go)

  - Extend Sveltestrap with a _rate it_ widget
    - https://github.com/emrekara37/svelte-rate-it
    - https://github.com/dmitrykurmanov/waxwing-rating

  - Client-side router
    - https://github.com/arthurgermano/svelte-client-router
    - https://github.com/EmilTholin/svelte-routing
    - https://www.newline.co/@kchan/svelte-single-page-applications-with-svelte-router-spa--bbc57ba8

  - PWA
    - https://developer.mozilla.org/en-US/docs/Web/Progressive_web_apps
    - https://github.com/mdn/pwa-examples
    - https://mdn.github.io/pwa-examples/js13kpwa/
    - https://github.com/tretapey/svelte-pwa/

  - Upload scanned/generated QR codes and/or QR bills
    - Upload [a file](https://mzl.la/3oM1r6i)
    - Upload [several files](https://mzl.la/3vl75hX)

  - QRcode generation
    - [Cross-language QR code generator](https://github.com/nayuki/QR-Code-generator)
    - https://github.com/schoero/SwissQRBill (Typescript, 874)
    - https://github.com/multisum/html-swiss-qr-bill (3)

  - Load QRData from PNG file
    - see tests in https://github.com/cozmo/jsQR and this https://github.com/cozmo/jsQR/issues/52
    - https://codesandbox.io/s/pwoywz6n5x

  - i18n
    - [Svelte template](https://github.com/kaisermann/svelte-i18n)

### User interface

  - A treasure of marketing-style widgets built with Svelte + Ionic (CPIH?)

  - Select widget (https://github.com/pavish/select-madu) to be made compatible with SvelteStrap
    (See also https://github.com/rob-balfre/svelte-select).
    - https://github.com/rob-balfre/svelte-select
    - https://github.com/pstanoev/simple-svelte-autocomplete

  - Learn more about web components (https://www.webcomponents.org)
    - https://github.com/LunaTK/svelte-web-component-builder

  - Sveltestrap
    - https://github.com/bestguy/sveltestrap
    - https://sveltestrap.js.org/?path=/story/components--navbar

  - Bootstrap widgets
    - https://github.com/themesberg/volt-bootstrap-5-dashboard
    - https://preview.colorlib.com/theme/bootstrap/calendar-09/
    - https://colorlib.com/wp/bootstrap-calendars/
    - https://colorlib.com/wp/bootstrap-footer/
    - https://colorlib.com/wp/bootstrap-tabs/
    - https://colorlib.com/wp/bootstrap-checkbox/
    - https://colorlib.com/wp/bootstrap-buttons/
    - https://colorlib.com/wp/bootstrap-menu/

  - Check out these articles:
    - https://javascript.plainenglish.io/36-best-practices-to-improve-the-user-experience-of-your-website-457bf871bf90

### Automation

  - Form automation through JSON datasets (Cf. https://github.com/arabdevelop/svelte-formly).
    We should standardise on Sveltestrap widgets; enabling multi-column layouts and column widths.:w

  - Storyboard
    - https://github.com/jerriclynsjohn/svelte-storybook-tailwind


### Build environment

  - Build a _Storybook_:
    - https://storybook.js.org/blog/storybook-for-svelte/
    - https://storybook.js.org/docs/react/get-started/examples
    - https://storybook.js.org/addons
    - https://github.com/redradix/svelte-custom-element-template

  - Migrate from Jest to TAP (https://gitlab.com/bagrounds/test-anything-protocol) -- or not?
    - See https://timdeschryver.dev/blog/how-to-test-svelte-components
    - https://github.com/ktsn/svelte-jest (perhaps not https://github.com/colossal-digital/jest-svelte (2 commits!))

  - Electon template
    - https://github.com/Rich-Harris/svelte-template-electron
    - https://github.com/nye/svelte-electron-better-sqlite3-starter
    - https://github.com/chuanqisun/svelte-electron-template

  - Svelte devtools (https://github.com/RedHatter/svelte-devtools) -- Chrome/Firefox extension

  - Check these articles:
    - https://javascript.plainenglish.io/top-7-must-know-npm-packages-for-every-web-developer-95e727855309

  - API + Login
    - [Svete and GraphQL](https://github.com/techformist/svedo)
    - https://github.com/webonyx/graphql-php
    - https://dev.to/lukocastillo/svelte-3-how-to-connect-your-app-with-a-rest-api-axios-2h4e
    - https://developer.okta.com/blog/2019/03/08/simple-rest-api-php
    - https://stackoverflow.com/questions/36691200/get-username-password-and-email-from-a-form-and-create-database-row-with-it
    - [Auth0 integration](https://github.com/auth0-blog/svelte-auth0/tree/main/src)
    - https://github.com/axios/axios


  - MySQL
    - https://medium.com/@haseeb.basil/mysql-vs-mysqli-vs-pdo-performance-benchmark-difference-and-security-comparison-37a9c2ec8d49
    - https://stackoverflow.com/questions/50177216/how-to-grant-all-privileges-to-root-user-in-mysql-8-0
    - https://codeofaninja.com/2011/12/php-and-mysql-crud-tutorial.html

### Ready reference

  - Fetch and asynchronous Javascript
      - [Async and await](https://developer.mozilla.org/en-US/docs/Learn/JavaScript/Asynchronous/Async_await)
      - [Resolve promises in Svelte templates](https://flaviocopes.com/svelte-templates-promises)
      - [Github fetch example](https://svelte.dev/repl/dcc69ccad6c341e8b75ee38c3eac1524?version=3.20.1)
      - [Playing fetch() with my API](https://code.sololearn.com/WW12zfYC7BSR/#html)

  - PWA
    - [Lab](https://github.com/marcastel/lab-javascript/tree/master/serviceworker)
    - [Security](https://www.mckennaconsultants.com/securing-tokens-in-a-progressive-web-app/)

  - Svelte
    - [Svelte Handbook](https://www.freecodecamp.org/news/the-svelte-handbook/)
    - [Svelte tutorial](https://svelte.dev/tutorial)
    - [Svelte documentation](https://svelte.dev/docs)
    - [DevSamples](https://www.devsamples.com/search?q=svelte)
    - The now classical [Todo](https://github.com/vuesomedev/todomvc-svelte) application
    - [Svelte Society components](https://sveltesociety.dev/components)
    - [Styles with Svelte](https://css-tricks.com/what-i-like-about-writing-styles-with-svelte)
    - [Svelte 3 book to get](https://www.amazon.com/dp/B08D6T6BKS/)
    - https://translate.google.com/translate?sl=ru&tl=en&u=https://habr.com/ru/post/541834/

  - Svelte samples
    - https://svelte.dev/repl/a05a35e700cb45d1b2c94299c5de070c?version=3.38.2 Side panel no scroll
    - https://svelte.dev/repl/a13e3002a4d8450c8d86d141a16e9df7?version=3.38.2 Circle of 5ths 
    - https://svelte.dev/repl/d952fab2ec3344bdbcdd84396e07d2c1?version=3.38.2 Chord/Scale Builder
    - https://svelte.dev/repl/e8edc7160db740d5a8a7dd4aa230c697?version=3.38.2 Managing fetch promises with a store
    - https://svelte.dev/repl/ee4f76a5900e4e5a99e8fa158cb94328?version=3.30.1 <svelte:self> example with writable store
    - https://github.com/rixo/svelte-preprocess-autoimport

  - Frameworks galore
    - A [Svelte vs React article](https://blog.bitsrc.io/react-vs-sveltejs-the-war-between-virtual-and-real-dom-59cbebbab9e9)

## 2021-06-04 (Fri) 01:57:55 {#wip}

<!-- vim: set nospell :-->
