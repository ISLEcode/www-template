<script lang="ts">
import Example      from './__example.svelte';
import Colors       from './button-colors.svelte';
import Disabled     from './button-disabled.svelte';
import Groups       from './button-groups.svelte';
import Outline      from './button-outline.svelte';
import Sizes        from './button-sizes.svelte';
import Toolbars     from './button-toolbars.svelte';
import Disabled_src from './button-disabled.svelte';
import Groups_src   from './button-groups.svelte';
import Outline_src  from './button-outline.svelte';
import Sizes_src    from './button-sizes.svelte';
import source       from './button-colors.svelte';
import Toolbars_src from './button-toolbars.svelte';
</script>

<h1>Buttons</h1>
<a href="https://getbootstrap.com/docs/5.0/components/buttons/" target="_blank">
  Bootstrap Buttons
</a>

<Example title="Colors" {source}>
  <Colors />
</Example>

<Example title="Outline" source={Outline_src}>
  <Outline />
</Example>

<Example title="Disabled" source={Disabled_src}>
  <Disabled />
</Example>

<Example title="Sizes" source={Sizes_src}>
  <Sizes />
</Example>

<Example title="ButtonGroups" source={Groups_src}>
  <Groups />
</Example>

<Example title="ButtonToolbars" source={Toolbars_src}>
  <Toolbars />
</Example>
