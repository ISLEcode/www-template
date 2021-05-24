<script lang="ts">
  import Example from './__example.svelte';
  import Colors from './alert-colors.svelte';
  import Colors_src from './alert-colors.svelte';
  import Controlled from './alert-controlled.svelte';
  import Controlled_src from './alert-controlled.svelte';
  import Dismissible from './alert-dismissible.svelte';
  import Dismissible_src from './alert-dismissible.svelte';
  import NoFade from './alert-nofade.svelte';
  import noFadeSource from './alert-nofade.svelte';
</script>

<h1>Alerts</h1>
<a href="https://getbootstrap.com/docs/5.0/components/alerts/" target="_blank">
  Bootstrap Alerts
</a>

<Example title="Colors" source={Colors_src}>
  <Colors />
</Example>

<Example title="Dismissible" source={Dismissible_src}>
  <Dismissible />
</Example>

<Example title="Controlled Alerts" source={Controlled_src}>
  <p slot="info">
    Alert provides the dismissible prop, but if you need to manually control the open state,
    you manage the <code>isOpen</code> and <code>toggle</code> prop.
  </p>
  <Controlled />
</Example>

<Example title="Alerts without fade" source={noFadeSource}>
  <p slot="info">
    Fade can be disabled using <code>fade=false</code>.
  </p>
  <NoFade />
</Example>
