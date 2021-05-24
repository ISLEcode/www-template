<script lang="ts">
  import { Alert } from 'sveltestrap5';
  import Example from './__example.svelte';
  import Controlled from './popover-controlled.svelte';
  import Dismissible from './popover-dismissible.svelte';
  import Sample from './popover-sample.svelte';
  import Slots from './popover-slots.svelte'
  import Triggers from './popover-triggers.svelte'
  import Controlled_src from './popover-controlled.svelte';
  import Dismissible_src from './popover-dismissible.svelte';
  import Sample_src from './popover-sample.svelte';
  import Slots_src from './popover-slots.svelte';
  import Triggers_src from './popover-triggers.svelte';
</script>

<h1>Popover</h1>

<a
  href="https://getbootstrap.com/docs/5.0/components/popovers/"
  target="_blank">
  Bootstrap Popover
</a>

<Example source={Sample_src}>
  <Sample />
</Example>

<Example title="Slots" source={Slots_src}>
  <Slots />
</Example>

<Example title="Trigger" source={Triggers_src}>
  <Triggers />
</Example>

<Example title="Dismissible" source={Dismissible_src}>
  <div slot="info">
    <Alert color="info">
      <b>Note:</b>
      For proper cross-browser and cross-platform behavior for dismiss-on-next-click,
      you must use the &lt;a&gt; tag, not the &lt;Button&gt; tag,
      and you also must include a tabindex attribute.
    </Alert>
  </div>
  <Dismissible />
</Example>

<Example title="Controlled" source={Controlled_src}>
  <Controlled />
</Example>