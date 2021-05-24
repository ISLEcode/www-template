<script lang="ts">
  import Example from './__example.svelte';
  import Sample from './accordion-sample.svelte';
  import source from './accordion-sample.svelte';
  import Events from './accordion-events.svelte';
  import Events_src from './accordion-events.svelte';
  import Slots from './accordion-slots.svelte';
  import Slots_src from './accordion-slots.svelte';
</script>

<h1>Accordion</h1>
<a
  href="https://getbootstrap.com/docs/5.0/components/accordion/"
  target="_blank">
  Bootstrap Accordion
</a>

<Example {source}>
  <Sample />
</Example>

<Example title="Slots" source={Slots_src}>
  <Slots />
</Example>

<Example title="Events" source={Events_src}>
  <Events />
</Example>
