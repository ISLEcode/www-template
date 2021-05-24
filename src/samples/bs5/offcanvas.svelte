<script lang="ts">
  import Example from './__example.svelte';
  import Events from './offcanvas-events.svelte';
  import Events_src from './offcanvas-events.svelte';
  import Sample from './offcanvas-sample.svelte';
  import Sample_src from './offcanvas-sample.svelte';
  import Backdrop from './offcanvas-backdrop.svelte';
  import Backdrop_src from './offcanvas-backdrop.svelte';
  import Manual from './offcanvas-manual.svelte';
  import Manual_src from './offcanvas-manual.svelte';
  import Scroll from './offcanvas-scroll.svelte';
  import Scroll_src from './offcanvas-scroll.svelte';
  import Slots from './offcanvas-slots.svelte';
  import Slots_src from './offcanvas-slots.svelte';
</script>

<h1>Offcanvas</h1>
<a href="https://getbootstrap.com/docs/5.0/components/offcanvas/" target="_blank">
  Bootstrap Offcanvas
</a>

<Example title="Placement" source={Sample_src}>
  <Sample />
</Example>

<Example source={Backdrop_src} title="No Backdrop">
  <Backdrop />
</Example>

<Example source={Scroll_src} title="Scrollable">
  <Scroll />
</Example>

<Example source={Slots_src} title="Slots">
  <Slots />
</Example>

<Example source={Manual_src} title="Manual toggling">
  <Manual />
</Example>

<Example source={Events_src} title="Events">
  <Events />
</Example>
