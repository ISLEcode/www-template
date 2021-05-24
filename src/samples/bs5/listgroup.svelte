<script lang="ts">
  import Example from './__example.svelte';
  import Sample from './listgroup-sample.svelte';
  import Sample_src from './listgroup-sample.svelte';
  import Colors from './listgroup-colors.svelte';
  import Colors_src from './listgroup-colors.svelte';
  import Actions from './listgroup-actions.svelte';
  import Actions_src from './listgroup-actions.svelte';
  import Flush from './listgroup-flush.svelte';
  import Flush_src from './listgroup-flush.svelte';
  import Numbered from './listgroup-numbered.svelte';
  import Numbered_src from './listgroup-numbered.svelte';
</script>

<h1>List Groups</h1>
<a
  href="https://getbootstrap.com/docs/5.0/components/list-group/"
  target="_blank">
  Bootstrap List Groups
</a>

<Example source={Sample_src}>
  <Sample />
</Example>

<Example title="Colors" source={Colors_src}>
  <Colors />
</Example>

<Example title="Actions" source={Actions_src}>
  <p slot="info">
    The
    <code>action</code>
    prop will fill the ListGroupItem with the clickable area for anchors and
    buttons.
  </p>
  <Actions />
</Example>

<Example title="Flush" source={Flush_src}>
  <Flush />
</Example>

<Example title="Numbered" source={Numbered_src}>
  <Numbered />
</Example>
