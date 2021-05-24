<script lang="ts">
  import Example from './__example.svelte';
  import Binding from './input-binding.svelte';
  import Binding_src from './input-binding.svelte';
  import On from './input-on.svelte';
  import On_src from './input-on.svelte';
  import Sample from './input-sample.svelte';
  import Sample_src from './input-sample.svelte';

  const snippet = 'bind:value={yourValue}';
</script>

<h1>Inputs</h1>
<a
  href="https://getbootstrap.com/docs/5.0/components/forms/#form-controls"
  target="_blank">
  Bootstrap Inputs
</a>

<Example source={Sample_src}>
  <Sample />
</Example>

<Example title="Binding" source={Binding_src}>
  <p slot="info">
    The recommended way to bind values to Inputs is via
    <code>{snippet}</code>
  </p>
  <Binding />
</Example>

<Example title="Event Binding" source={On_src}>
  <p slot="info">
    You can also bind directly to these event handlers:
    <code>
      on:blur on:focus on:keydown on:keypress on:keyup on:change on:input
    </code>
    <br />
    but this is not recommended if you are just binding to a simple value -
    Svelte is not React. :-)
    <br />
    If you need more exotic events please follow issue
    <a href="https://github.com/bestguy/sveltestrap/issues/36" target="new">
      #36
    </a>
    .
  </p>
  <On />
</Example>
