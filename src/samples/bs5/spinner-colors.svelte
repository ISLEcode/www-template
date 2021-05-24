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

{#each colors as color}
  <Spinner {color} />
{/each}
