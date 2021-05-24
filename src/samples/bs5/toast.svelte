<script lang="ts">
  import Example from './__example.svelte';
  import Sample from './toast-sample.svelte';
  import Sample_src from './toast-sample.svelte';
  import Dismissing from './toast-dismissing.svelte';
  import Dismissing_src from './toast-dismissing.svelte';
  import Icons from './toast-icons.svelte';
  import Icons_src from './toast-icons.svelte';
</script>

<h1>Toast</h1>
<a href="https://getbootstrap.com/docs/5.0/components/toasts/" target="_blank">
  Bootstrap Toasts
</a>

<Example title="Colors" source={Sample_src}>
  <Sample />
</Example>

<Example title="Icons" source={Icons_src}>
  <Icons />
</Example>

<Example title="Dismissible" source={Dismissing_src}>
  <Dismissing />
</Example>
