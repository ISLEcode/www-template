<script lang="ts">
  import Sample from './carousel-sample.svelte';
  import Sample_src from './carousel-sample.svelte';

  import WithControls from './carousel-withcontrols.svelte';
  import WithControlsSource from './carousel-withcontrols.svelte';

  import WithIndicators from './carousel-withindicators.svelte';
  import WithIndicatorsSource from './carousel-withindicators.svelte';

  import WithCaptions from './carousel-withcaptions.svelte';
  import WithCaptionsSource from './carousel-withcaptions.svelte';

  import Dark from './carousel-dark.svelte';
  import DarkSource from './carousel-dark.svelte';

  import Example from './__example.svelte';
</script>

<h1>Carousel</h1>

<a
  href="https://getbootstrap.com/docs/5.0/components/carousel/"
  target="_blank">
  Bootstrap Carousel
</a>

<Example title="Slides only" source={Sample_src}>
  <Sample />
</Example>

<Example title="With Controls" source={WithControlsSource}>
  <WithControls />
</Example>

<Example title="With Indicators" source={WithIndicatorsSource}>
  <WithIndicators />
</Example>

<Example title="With Captions" source={WithCaptionsSource}>
  <WithCaptions />
</Example>

<Example title="Dark variant" source={DarkSource}>
  <Dark />
</Example>
