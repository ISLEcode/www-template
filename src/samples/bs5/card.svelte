<script lang="ts">
  import Example from './__example.svelte';
  import Body from './card-body.svelte';
  import Body_src from './card-body.svelte';
  import Colors from './card-colors.svelte';
  import Colors_src from './card-colors.svelte';
  import Header from './card-header.svelte';
  import Header_src from './card-header.svelte';
  import Sample from './card-sample.svelte';
  import Sample_src from './card-sample.svelte';
</script>

<h1>Card</h1>
<a href="https://getbootstrap.com/docs/5.0/components/card/" target="_blank">
  Bootstrap Card
</a>

<Example source={Sample_src}>
  <Sample />
</Example>

<Example title="Body shorthand" source={Body_src}>
  <Body />
</Example>

<Example title="Headers and Footers" source={Header_src}>
  <Header />
</Example>

<Example title="Colors & Inverse" source={Colors_src}>
  <Colors />
</Example>
