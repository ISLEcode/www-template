<script lang="ts">
  import Example from './__example.svelte';
  import Sample from './buttondropdown-sample.svelte';
  import Sample_src from './buttondropdown-sample.svelte';
  import Split from './buttondropdown-split.svelte';
  import Split_src from './buttondropdown-split.svelte';
  import Controlled from './buttondropdown-controlled.svelte';
  import Controlled_src from './buttondropdown-controlled.svelte';
</script>

<h1>ButtonDropdown</h1>
<a
  href="https://getbootstrap.com/docs/4.5/components/dropdowns/#single-button"
  target="_blank">
  Bootstrap Button Dropdowns
</a>

<Example title="Single Button Dropdowns" source={Sample_src}>
  <Sample />
</Example>

<Example title="Split Button Dropdowns" source={Split_src}>
  <Split />
</Example>

<Example title="Controlled" source={Controlled_src}>
  <Controlled />
</Example>
