<script lang="ts">
  import Example from './__example.svelte';
  import Alignment from './dropdown-alignment.svelte';
  import Alignment_src from './dropdown-alignment.svelte';
  import Dark from './dropdown-dark.svelte';
  import Dark_src from './dropdown-dark.svelte';
  import Direction from './dropdown-direction.svelte';
  import Direction_src from './dropdown-direction.svelte';
  import Sample from './dropdown-sample.svelte';
  import Sample_src from './dropdown-sample.svelte';
  import Sizes from './dropdown-sizes.svelte';
  import Sizes_src from './dropdown-sizes.svelte';
  import Controlled from './dropdown-controlled.svelte';
  import Controlled_src from './dropdown-controlled.svelte';
  import SetActiveFromChild from './dropdown-setactivefromchild.svelte';
  import setActiveFromChildSource from './dropdown-setactivefromchild.svelte';
</script>

<h1>Dropdowns</h1>
<a
  href="https://getbootstrap.com/docs/5.0/components/dropdowns/"
  target="_blank">
  Bootstrap Dropdowns
</a>

<Example source={Sample_src}>
  <Sample />
</Example>

<Example title="Alignment" source={Alignment_src}>
  <Alignment />
</Example>

<Example title="Direction" source={Direction_src}>
  <Direction />
</Example>

<Example title="Sizes" source={Sizes_src}>
  <Sizes />
</Example>

<Example title="Container" source={Controlled_src}>
  <Controlled />
</Example>

<Example title="SetActiveFromChild" source={setActiveFromChildSource}>
  <SetActiveFromChild />
</Example>

<Example title="Dark variant" source={Dark_src}>
  <Dark />
</Example>
