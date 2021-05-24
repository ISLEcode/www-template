<script lang="ts">
  import Example from './__example.svelte';
  import Events from './collapse-events.svelte';
  import Events_src from './collapse-events.svelte';
  import Sample from './collapse-sample.svelte';
  import Sample_src from './collapse-sample.svelte';
  import Uncontrolled from './collapse-uncontrolled.svelte';
  import Uncontrolled_src from './collapse-uncontrolled.svelte';
</script>

<h1>Collapse</h1>
<a
  href="https://getbootstrap.com/docs/5.0/components/collapse/"
  target="_blank">
  Bootstrap Collapse
</a>

<Example source={Sample_src}>
  <Sample />
</Example>

<Example title="Events" source={Events_src}>
  <p slot="info">
    Use the on:opening, on:open, on:closing and on:close props for
    callbacks when the Collapse has finished opening (entering) or closing
    (exiting).
  </p>
  <Events />
</Example>

<Example title="Uncontrolled Collapse" source={Uncontrolled_src}>
  <p slot="info">
    For the most basic use-case, an uncontrolled component can provide the
    functionality wanted without the need to manage/control the state of the
    component. Collapse does not require an isOpen prop. Instead
    pass a toggler prop. The toggler prop is a string which will run
    querySelectorAll to find dom elements which will trigger toggle.
  </p>
  <Uncontrolled />
</Example>
