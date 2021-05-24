<script lang="ts">
  import { Button } from 'sveltestrap5';
  import Example from './__example.svelte';
  import Sample from './styles-sample.svelte';
  import Sample_src from './styles-sample.svelte';
</script>

<h1>Styles</h1>

<Example source={Sample_src}>
  <p slot="info">
    The Styles component is not required, but is a convenient way to include the
    CDN Bootstrap 5 styles needed for Sveltestrap if you don't already include
    Bootstrap styles. If you don't want to include Bootstrap's icons styles
    needed for the <Button color="link" class="p-0" style="vertical-align: unset;">Icon</Button> component, you can set
    <code>
      &lt;Styles icons=&lbrace;false&rbrace; /&gt;
    </code>
  </p>
  <Sample />
</Example>
