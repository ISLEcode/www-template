<script lang="ts">
import Example      from './__example.svelte';
import Sample       from './nav-sample.svelte';
import Sample_src   from './nav-sample.svelte';
import Pills        from './nav-pills.svelte';
import Pills_src    from './nav-pills.svelte';
import Tabs         from './nav-tabs.svelte';
import Tabs_src     from './nav-tabs.svelte';
import Vertical     from './nav-vertical.svelte';
import Vertical_src from './nav-vertical.svelte';
</script>

<h1>Navs</h1>
<a href="https://getbootstrap.com/docs/5.0/components/navs/" target="_blank">Bootstrap Navs</a>
<Example                  source={Sample_src  }><Sample   /></Example>
<Example title="Tabs"     source={Tabs_src    }><Tabs     /></Example>
<Example title="Pills"    source={Pills_src   }><Pills    /></Example>
<Example title="Vertical" source={Vertical_src}><Vertical /></Example>
