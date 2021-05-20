<script>
import Router from 'svelte-spa-router';
import routes from './router/routes';
</script>

<h2>Basic routing</h2>

<ul>
    <li><a href="#/">Home</a></li>
    <li><a href="#/hello/svelte">Say hi!</a></li>
    <li><a href="#/wild/card">Wildcard route</a></li>
    <li><a href="#/does/not/exist">Not found</a></li>
</ul>

<h2>Dynamic imports</h2>

<ul>
    <li><a href="#/">Home</a></li>
    <li><a href="#/hello/svelte">Say hi!</a> (dynamically imported route)</li>
    <li><a href="#/wild/card">Wildcard route </a> (dynamically imported route, with a 5 seconds artificial delay)</li>
    <li><a href="#/does/not/exist">Not found</a></li>
</ul>

<main>
<Router {routes} />
</main>

<style>
main { text-align: center; padding: 1em; max-width: 240px; margin: 0 auto; }
@media (min-width: 640px) { main { max-width: none; }}
</style>
