<script lang="ts">
import Example    from './__example.svelte';
import Sample     from './pagination-sample.svelte';
import Sample_src from './pagination-sample.svelte';
import Sizes      from './pagination-sizes.svelte';
import Sizes_src  from './pagination-sizes.svelte';
</script>

<h1>Pagination</h1>
<a href="https://getbootstrap.com/docs/5.0/components/pagination/" target="_blank">Bootstrap Pagination</a>

<Example source={Sample_src}><Sample /></Example>
<Example title="Sizes" source={Sizes_src}><Sizes /></Example>
