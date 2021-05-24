<script lang="ts">
  import { Spinner } from 'sveltestrap5';
  const colors = [
    'primary',
    'secondary',
    'success',
    'danger',
    'warning',
    'info',
    'light',
    'dark'
  ];
</script>

<div>
  {#each colors as color}
    <Spinner {color} type="border" />
  {/each}
</div>

<div>
  {#each colors as color}
    <Spinner {color} type="grow" />
  {/each}
</div>
