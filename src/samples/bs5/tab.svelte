<script lang="ts">
  import Example from './__example.svelte';
  import Events from './tab-events.svelte';
  import Events_src from './tab-events.svelte';
  import Sample from './tab-sample.svelte';
  import Sample_src from './tab-sample.svelte';
  import Slots from './tab-slots.svelte';
  import Slots_src from './tab-slots.svelte';
  import Pills from './tab-pills.svelte';
  import Pills_src from './tab-pills.svelte';
  import Vertical from './tab-vertical.svelte';
  import Vertical_src from './tab-vertical.svelte';
</script>

<h1>TabContent and TabPane</h1>
<a href="https://getbootstrap.com/docs/5.0/components/navs-tabs/#javascript-behavior" target="_blank">
  Bootstrap Tabs
</a>

<Example source={Sample_src}>
  <Sample />
</Example>

<Example title="Pills" source={Pills_src}>
  <Pills />
</Example>

<Example title="Slots" source={Slots_src}>
  <Slots />
</Example>

<Example title="Vertical" source={Vertical_src}>
  <Vertical />
</Example>

<Example title="Events" source={Events_src}>
  <Events />
</Example>