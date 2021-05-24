<script lang="ts">
  import Example from './__example.svelte';
  import BasicSample from './tooltip-basicsample.svelte';
  import Controlled from './tooltip-controlled.svelte';
  import HtmlSample from './tooltip-htmlsample.svelte';
  import basicSampleSource from './tooltip-basicsample.svelte';
  import Controlled_src from './tooltip-controlled.svelte';
  import htmlSampleSource from './tooltip-htmlsample.svelte';
</script>

<h1>Tooltip</h1>
<a href="https://getbootstrap.com/docs/5.0/components/tooltips/" target="_blank">
  Bootstrap Tooltip
</a>

<Example title="Basic" source={basicSampleSource}>
  <BasicSample />
</Example>

<Example title="HTML Content" source={htmlSampleSource}>
  <HtmlSample />
</Example>

<Example title="Controlled" source={Controlled_src}>
  <Controlled />
</Example>
