<script lang="ts">
  import Example from './__example.svelte';
  import Colors from './navbar-colors.svelte';
  import Colors_src from './navbar-colors.svelte';
  import Sample from './navbar-sample.svelte';
  import Sample_src from './navbar-sample.svelte';
  import Toggler from './navbar-toggler.svelte';
  import Toggler_src from './navbar-toggler.svelte';
</script>

<h1>Navbar</h1>
<a href="https://getbootstrap.com/docs/5.0/components/navbar/" target="_blank">
  Bootstrap Navbar
</a>

<Example source={Sample_src} stacked>
  <Sample />
</Example>

<Example title="Colors" source={Colors_src} stacked>
  <p slot="info">
    Change the Navbar's background color using the
    <code>color</code>
    prop. Use the
    <code>light</code>
    or
    <code>dark</code>
    props to change Navbar text color for lighter or darker
    <code>color</code>
    values.
  </p>
  <Colors />
</Example>

<Example title="Toggler" source={Toggler_src} stacked>
  <Toggler />
</Example>

<!-- TODO Add {fixed} {expand} sample -->
