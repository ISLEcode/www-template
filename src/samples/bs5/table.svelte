<script lang="ts">
import Example        from './__example.svelte';
import Bordered       from './table-bordered.svelte';
import Borderless     from './table-borderless.svelte';
import Column         from './table-column.svelte';
import Dark           from './table-dark.svelte';
import Hover          from './table-hover.svelte';
import Responsive     from './table-responsive.svelte';
import Sample         from './table-sample.svelte';
import Sizes          from './table-sizes.svelte';
import Striped        from './table-striped.svelte';
import Striped_src    from './table-striped.svelte';
import Bordered_src   from './table-bordered.svelte';
import Borderless_src from './table-borderless.svelte';
import Column_src     from './table-column.svelte';
import Dark_src       from './table-dark.svelte';
import Hover_src      from './table-hover.svelte';
import Responsive_src from './table-responsive.svelte';
import Sample_src     from './table-sample.svelte';
import Sizes_src      from './table-sizes.svelte';
</script>

<h1>Table</h1>
<a href="https://getbootstrap.com/docs/5.0/content/tables/" target="_blank">Bootstrap Table</a>

<Example source={Sample_src}><Sample /></Example>
<Example title="Bordered" source={Bordered_src}><Bordered /></Example>
<Example title="Borderless" source={Borderless_src}><Borderless /></Example>
<Example title="Dark" source={Dark_src}> <Dark /> </Example>
<Example title="Hover" source={Hover_src}> <Hover /> </Example>
<Example title="Striped" source={Striped_src}> <Striped /> </Example>
<Example title="Sizes" source={Sizes_src}> <Sizes /> </Example>
<Example title="Responsive" source={Responsive_src}> <Responsive /> </Example>
<Example title="Columns" source={Column_src}> <Column /> </Example>
