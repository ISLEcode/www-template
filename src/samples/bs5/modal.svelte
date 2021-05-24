<script lang="ts">
  import Example from './__example.svelte';
  import Backdrop from './modal-backdrop.svelte';
  import Backdrop_src from './modal-backdrop.svelte';
  import Events from './modal-events.svelte';
  import Events_src from './modal-events.svelte';
  import External from './modal-external.svelte';
  import External_src from './modal-external.svelte';
  import Fade from './modal-fade.svelte';
  import Fade_src from './modal-fade.svelte';
  import Sample from './modal-sample.svelte';
  import Sample_src from './modal-sample.svelte';
  import Fullscreen from './modal-fullscreen.svelte';
  import Fullscreen_src from './modal-fullscreen.svelte';
  import Sizes from './modal-sizes.svelte';
  import Sizes_src from './modal-sizes.svelte';
  import Shorthand from './modal-shorthand.svelte';
  import Shorthand_src from './modal-shorthand.svelte';
  import Static from './modal-static.svelte';
  import Static_src from './modal-static.svelte';
</script>

<h1>Modals</h1>
<a href="https://getbootstrap.com/docs/5.0/components/modal/" target="_blank">
  Bootstrap Modals
</a>

<Example source={Sample_src}>
  <Sample />
</Example>

<Example title="Shorthand" source={Shorthand_src}>
  <p slot="info">
    The <code>body</code> and <code>header</code> props let you create simple Modals without needing to add <code>ModalHeader</code> and <code>ModalBody</code>.
  </p>
  <Shorthand />
</Example>

<Example title="Sizes" source={Sizes_src}>
  <Sizes />
</Example>

<Example title="Fullscreen" source={Fullscreen_src}>
  <Fullscreen />
</Example>

<Example title="Backdrop" source={Backdrop_src}>
  <Backdrop />
</Example>

<Example title="Fade" source={Fade_src}>
  <Fade />
</Example>

<Example title="Events" source={Events_src}>
  <Events />
</Example>

<Example title="Static" source={Static_src}>
  <Static />
</Example>

<Example title="External Content" source={External_src}>
  <External />
</Example>
