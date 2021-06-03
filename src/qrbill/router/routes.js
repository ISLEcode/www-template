import Home     from './home.svelte';
import Loading  from './loading.svelte';
import Lorem    from './lorem.svelte';
import Name     from './name.svelte';
import NotFound from './404.svelte';
import Wild     from './wild.svelte';
import { wrap } from 'svelte-spa-router/wrap';

export default {
    '/':                    Home,       // Exact path

    '/lorem/:repeat':       Lorem,
    '/hello/:first/:last?': Name,       // Using named parameters, with last being optional
    '/wild':                Wild,       // Wildcard parameter
    '/wild/*':              Wild,       // (idem)

    // Using named parameters, with last being optional
    // This is dynamically imported, so the code is loaded on-demand from the server
    '/hello/:first/:last?': wrap({
        // Note that this is a function that returns the import
        asyncComponent: () => import('.name.svelte'),
        // Show the loading component while the component is being downloaded
        loadingComponent: Loading,
        // Pass values for the `params` prop of the loading component
        loadingParams: { message: 'Loading the Name route…' }
    }),

    // Wildcard parameter
    // This matches `/wild/*` (with anything after), but NOT `/wild` (with nothing after)
    // This is dynamically imported too
    '/wild/*': wrap({
        // Note that this is a function that returns the import
        // We're adding an artificial delay of 5 seconds so you can experience the loading even on localhost
        // Note that normally the modules loaded with `import()` are cached, so the delay exists only on the first request.
        // In this case, we're adding a delay every time the component is loaded
        asyncComponent: () => import('wild.svelte')
            .then((component) => {
                return new Promise((resolve) => { setTimeout(() => resolve(component), 5000) }) // Wait 5s
            }),
        // Show the loading component while the component is being downloaded
        loadingComponent: Loading,
        // Pass values for the `params` prop of the loading component
        loadingParams: { message: 'Loading the Wild route…' }
    }),

    '*':                    NotFound    // 404
};
