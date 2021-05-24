<script lang="ts">
import '../../../node_modules/bootstrap5/dist/css/bootstrap.min.css';
import Example       from './__example.svelte';
import Sample        from './layout-sample.svelte';
import Sample_src    from './layout-simplifiedsample.svelte';
import Container     from './layout-container.svelte';
import Container_src from './layout-container.svelte';
</script>

<h1>Layout</h1>
<a href="https://getbootstrap.com/docs/5.0/layout/grid/" target="_blank">Bootstrap layout grid</a>
<Example source={Sample_src}><Sample /></Example>
<Example title="Container" stacked source={Container_src}><Container /></Example>
