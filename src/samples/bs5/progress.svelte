<script lang="ts">
  import Example from './__example.svelte';

  import Animated from './progress-animated.svelte';
  import Colors from './progress-colors.svelte';
  import Labels from './progress-labels.svelte';
  import Max from './progress-max.svelte';
  import Multi from './progress-multi.svelte';
  import Sample from './progress-sample.svelte';
  import Striped from './progress-striped.svelte';

  import Animated_src from './progress-animated.svelte';
  import Colors_src from './progress-colors.svelte';
  import Labels_src from './progress-labels.svelte';
  import Max_src from './progress-max.svelte';
  import Multi_src from './progress-multi.svelte';
  import Sample_src from './progress-sample.svelte';
  import Striped_src from './progress-striped.svelte';
</script>

<h1>Progress</h1>
<a
  href="https://getbootstrap.com/docs/5.0/components/progress/"
  target="_blank">
  Bootstrap Progress
</a>

<Example title="Sample" source={Sample_src}>
  <Sample />
</Example>

<Example title="Colors" source={Colors_src}>
  <Colors />
</Example>

<Example title="Labels" source={Labels_src}>
  <Labels />
</Example>

<Example title="Striped" source={Striped_src}>
  <Striped />
</Example>

<Example title="Animated" source={Animated_src}>
  <Animated />
</Example>

<Example title="Multi" source={Multi_src}>
  <Multi />
</Example>

<Example title="Max" source={Max_src}>
  <Max />
</Example>
