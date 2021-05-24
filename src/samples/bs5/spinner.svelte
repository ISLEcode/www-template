<script lang="ts">
  import Example from './__example.svelte';
  import Colors from './spinner-colors.svelte';
  import Size from './spinner-size.svelte';
  import Type from './spinner-type.svelte';
  import Colors_src from './spinner-colors.svelte';
  import Size_src from './spinner-size.svelte';
  import Type_src from './spinner-type.svelte';
</script>

<h1>Spinner</h1>
<a
  href="https://getbootstrap.com/docs/5.0/components/spinners/"
  target="_blank">
  Bootstrap Spinner
</a>

<Example title="Colors" source={Colors_src}>
  <Colors />
</Example>

<Example title="Types" source={Type_src}>
  <Type />
</Example>

<Example title="Sizes" source={Size_src}>
  <Size />
</Example>
